<?php
/**
 * Frontend Enquiry / RFQ AJAX Handler Class
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Acumen_Enquiry_Handler {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'wp_ajax_acumen_submit_rfq', array( $this, 'handle_rfq_submission' ) );
        add_action( 'wp_ajax_nopriv_acumen_submit_rfq', array( $this, 'handle_rfq_submission' ) );
    }

    /**
     * Enqueue enquiry form assets
     */
    public function enqueue_scripts() {
        wp_enqueue_style(
            'acumen-enquiry-css',
            ACUMEN_CORE_URL . 'assets/css/acumen-enquiry.css',
            array(),
            ACUMEN_CORE_VERSION
        );

        wp_enqueue_script(
            'acumen-enquiry-js',
            ACUMEN_CORE_URL . 'assets/js/acumen-enquiry.js',
            array( 'jquery' ),
            ACUMEN_CORE_VERSION,
            true
        );

        wp_localize_script(
            'acumen-enquiry-js',
            'acumenEnquiryData',
            array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce( 'acumen_rfq_nonce' ),
                'messages' => array(
                    'submitting' => __( 'Submitting your inquiry...', 'acumen-core' ),
                    'success'    => __( 'Thank you! Your inquiry has been received. Our engineering team will contact you shortly.', 'acumen-core' ),
                    'error'      => __( 'An error occurred while submitting your request. Please try again or call us directly.', 'acumen-core' ),
                ),
            )
        );
    }

    /**
     * Handle AJAX RFQ Submission
     */
    public function handle_rfq_submission() {
        check_ajax_referer( 'acumen_rfq_nonce', 'security' );

        $full_name = isset( $_POST['full_name'] ) ? sanitize_text_field( wp_unslash( $_POST['full_name'] ) ) : '';
        $email     = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
        $phone     = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
        $company   = isset( $_POST['company_name'] ) ? sanitize_text_field( wp_unslash( $_POST['company_name'] ) ) : '';
        $service   = isset( $_POST['service_requested'] ) ? sanitize_text_field( wp_unslash( $_POST['service_requested'] ) ) : '';
        $message   = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

        // Validation
        if ( empty( $full_name ) || empty( $email ) || empty( $phone ) || empty( $message ) ) {
            wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'acumen-core' ) ) );
        }

        if ( ! is_email( $email ) ) {
            wp_send_json_error( array( 'message' => __( 'Please provide a valid email address.', 'acumen-core' ) ) );
        }

        // Get IP
        $ip_address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';

        // Insert into database
        global $wpdb;
        $table = Acumen_Database::get_enquiries_table();

        $inserted = $wpdb->insert(
            $table,
            array(
                'full_name'         => $full_name,
                'email'             => $email,
                'phone'             => $phone,
                'company_name'      => $company,
                'service_requested' => $service,
                'message'           => $message,
                'ip_address'        => $ip_address,
                'status'            => 'new',
                'created_at'        => current_time( 'mysql' ),
            ),
            array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
        );

        if ( false === $inserted ) {
            wp_send_json_error( array( 'message' => __( 'Database error. Could not record inquiry.', 'acumen-core' ) ) );
        }

        // Send Email Notifications
        $this->send_notifications( $full_name, $email, $phone, $company, $service, $message );

        wp_send_json_success( array(
            'message' => __( 'Thank you! Your inquiry has been received. Our engineering team will contact you shortly.', 'acumen-core' ),
        ) );
    }

    /**
     * Dispatch notification emails via wp_mail
     */
    private function send_notifications( $name, $email, $phone, $company, $service, $message ) {
        $options = get_option( 'acumen_options', array() );

        // 1. Admin notification
        $recipients_str = ! empty( $options['notify_recipients'] ) ? $options['notify_recipients'] : get_option( 'admin_email' );
        $recipients     = array_map( 'trim', explode( ',', $recipients_str ) );

        $from_name  = ! empty( $options['notify_from_name'] ) ? $options['notify_from_name'] : 'Acumen Engineers Website';
        $from_email = ! empty( $options['email_primary'] ) ? $options['email_primary'] : get_option( 'admin_email' );

        $subject = sprintf( '[New RFQ] Inbound Inquiry from %s (%s)', $name, $company ? $company : 'Individual' );

        $body  = "<h2>New Project Inquiry / RFQ Received</h2>\n";
        $body .= "<p><strong>Client Name:</strong> " . esc_html( $name ) . "</p>\n";
        $body .= "<p><strong>Email Address:</strong> " . esc_html( $email ) . "</p>\n";
        $body .= "<p><strong>Phone:</strong> " . esc_html( $phone ) . "</p>\n";
        $body .= "<p><strong>Company / Organization:</strong> " . esc_html( $company ? $company : 'N/A' ) . "</p>\n";
        $body .= "<p><strong>Service Requested:</strong> " . esc_html( $service ? $service : 'General Turnkey Solutions' ) . "</p>\n";
        $body .= "<p><strong>Project Details / Scope:</strong></p>\n";
        $body .= "<blockquote>" . nl2br( esc_html( $message ) ) . "</blockquote>\n";
        $body .= "<hr/><p><small>Inquiry logged in WordPress Admin &bull; Acumen Engineers Portal</small></p>";

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $from_name . ' <' . $from_email . '>',
            'Reply-To: ' . $name . ' <' . $email . '>',
        );

        wp_mail( $recipients, $subject, $body, $headers );

        // 2. Client auto-responder (if enabled)
        if ( ! empty( $options['autorespond_enabled'] ) ) {
            $client_subject = 'Acknowledgment: Your Inquiry to Acumen Engineers';
            $client_body    = "<p>Dear " . esc_html( $name ) . ",</p>\n";
            $client_body   .= "<p>Thank you for contacting <strong>Acumen Engineers</strong>. We have received your inquiry regarding <em>" . esc_html( $service ? $service : 'Turnkey Engineering Solutions' ) . "</em>.</p>\n";
            $client_body   .= "<p>Our technical project team is reviewing your requirements and will connect with you within 24 business hours.</p>\n";
            $client_body   .= "<p>Best regards,<br/><strong>Acumen Engineers</strong><br/>Turnkey Project Solutions<br/>Pune, Maharashtra, India<br/>Phone: +91 20 2765 8234 / +91 9423 019 234</p>";

            $client_headers = array(
                'Content-Type: text/html; charset=UTF-8',
                'From: ' . $from_name . ' <' . $from_email . '>',
            );

            wp_mail( $email, $client_subject, $client_body, $client_headers );
        }
    }
}
