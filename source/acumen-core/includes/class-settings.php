<?php
/**
 * Company Information & System Settings Class
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Acumen_Settings {

    private $option_name = 'acumen_options';

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    /**
     * Add menu items to WordPress Admin
     */
    public function add_admin_menu() {
        add_menu_page(
            __( 'Acumen Engineers', 'acumen-core' ),
            __( 'Acumen Settings', 'acumen-core' ),
            'manage_options',
            'acumen-settings',
            array( $this, 'render_settings_page' ),
            'dashicons-admin-generic',
            20
        );

        add_submenu_page(
            'acumen-settings',
            __( 'Company & System Settings', 'acumen-core' ),
            __( 'Settings', 'acumen-core' ),
            'manage_options',
            'acumen-settings',
            array( $this, 'render_settings_page' )
        );
    }

    /**
     * Register settings and fields
     */
    public function register_settings() {
        register_setting(
            'acumen_settings_group',
            $this->option_name,
            array( $this, 'sanitize_options' )
        );

        // Section 1: Company Info
        add_settings_section(
            'acumen_company_info_section',
            __( 'Corporate & Office Information', 'acumen-core' ),
            array( $this, 'render_company_info_section_desc' ),
            'acumen-settings'
        );

        add_settings_field(
            'company_name',
            __( 'Company Name', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_company_info_section',
            array( 'field' => 'company_name', 'default' => 'Acumen Engineers' )
        );

        add_settings_field(
            'tagline',
            __( 'Tagline / Slogan', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_company_info_section',
            array( 'field' => 'tagline', 'default' => 'Turnkey Project Solutions' )
        );

        add_settings_field(
            'corp_address',
            __( 'Corporate Office Address', 'acumen-core' ),
            array( $this, 'render_textarea_field' ),
            'acumen-settings',
            'acumen_company_info_section',
            array( 'field' => 'corp_address', 'default' => "#7, Gnd Floor, Sant Dnyaneshwar Sankul, Sector 28, P.C.N.T.D.A. Nigdi, Pune – 411 044, Maharashtra, INDIA" )
        );

        add_settings_field(
            'regd_address',
            __( 'Registered Office Address', 'acumen-core' ),
            array( $this, 'render_textarea_field' ),
            'acumen-settings',
            'acumen_company_info_section',
            array( 'field' => 'regd_address', 'default' => "Shreeram Niwas, Plot No. 124, Sr. No. 35/7, Dattawadi, Akurdi, Pune - 411 035, Maharashtra, INDIA" )
        );

        add_settings_field(
            'phone_landline',
            __( 'Landline Telephone', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_company_info_section',
            array( 'field' => 'phone_landline', 'default' => '+91 20 2765 8234' )
        );

        add_settings_field(
            'phone_mobile_1',
            __( 'Mobile Number 1', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_company_info_section',
            array( 'field' => 'phone_mobile_1', 'default' => '+91 9423 019 234' )
        );

        add_settings_field(
            'phone_mobile_2',
            __( 'Mobile Number 2', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_company_info_section',
            array( 'field' => 'phone_mobile_2', 'default' => '+91 98509 57425' )
        );

        add_settings_field(
            'email_primary',
            __( 'Primary Official Email', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_company_info_section',
            array( 'field' => 'email_primary', 'default' => 'info@acumenengineers.in' )
        );

        add_settings_field(
            'profile_pdf_url',
            __( 'Company Profile PDF URL', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_company_info_section',
            array( 'field' => 'profile_pdf_url', 'default' => '' )
        );

        add_settings_field(
            'stat_workshop_sqft',
            __( 'Workshop Facility Size', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_company_info_section',
            array( 'field' => 'stat_workshop_sqft', 'default' => '6,000 Sq. Ft.' )
        );

        // Section 2: WhatsApp Settings
        add_settings_section(
            'acumen_whatsapp_section',
            __( 'WhatsApp Integration Settings', 'acumen-core' ),
            array( $this, 'render_whatsapp_section_desc' ),
            'acumen-settings'
        );

        add_settings_field(
            'whatsapp_enabled',
            __( 'Enable Floating WhatsApp Button', 'acumen-core' ),
            array( $this, 'render_checkbox_field' ),
            'acumen-settings',
            'acumen_whatsapp_section',
            array( 'field' => 'whatsapp_enabled', 'label' => __( 'Show floating button on all frontend pages', 'acumen-core' ) )
        );

        add_settings_field(
            'whatsapp_number',
            __( 'WhatsApp Number (with Country Code)', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_whatsapp_section',
            array( 'field' => 'whatsapp_number', 'default' => '919423019234' )
        );

        add_settings_field(
            'whatsapp_default_msg',
            __( 'Default WhatsApp Message', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_whatsapp_section',
            array( 'field' => 'whatsapp_default_msg', 'default' => 'Hello Acumen Engineers, I would like to inquire about turnkey project solutions.' )
        );

        add_settings_field(
            'whatsapp_position',
            __( 'Button Position', 'acumen-core' ),
            array( $this, 'render_select_field' ),
            'acumen-settings',
            'acumen_whatsapp_section',
            array(
                'field'   => 'whatsapp_position',
                'options' => array(
                    'bottom-right' => __( 'Bottom Right', 'acumen-core' ),
                    'bottom-left'  => __( 'Bottom Left', 'acumen-core' ),
                ),
            )
        );

        // Section 3: Email Notification Settings
        add_settings_section(
            'acumen_email_section',
            __( 'Enquiry & Notification Settings', 'acumen-core' ),
            array( $this, 'render_email_section_desc' ),
            'acumen-settings'
        );

        add_settings_field(
            'notify_recipients',
            __( 'Admin Notification Recipients', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_email_section',
            array( 'field' => 'notify_recipients', 'default' => get_option( 'admin_email' ) . ', info@acumenengineers.in' )
        );

        add_settings_field(
            'notify_from_name',
            __( 'Notification Sender Name', 'acumen-core' ),
            array( $this, 'render_text_field' ),
            'acumen-settings',
            'acumen_email_section',
            array( 'field' => 'notify_from_name', 'default' => 'Acumen Engineers Website' )
        );

        add_settings_field(
            'autorespond_enabled',
            __( 'Enable Client Auto-Responder', 'acumen-core' ),
            array( $this, 'render_checkbox_field' ),
            'acumen-settings',
            'acumen_email_section',
            array( 'field' => 'autorespond_enabled', 'label' => __( 'Send immediate receipt confirmation email to client', 'acumen-core' ) )
        );
    }

    public function render_company_info_section_desc() {
        echo '<p>' . esc_html__( 'Configure corporate contact details, registered office addresses, and high-level company stats.', 'acumen-core' ) . '</p>';
    }

    public function render_whatsapp_section_desc() {
        echo '<p>' . esc_html__( 'Configure direct WhatsApp chat integration for visitors and clients.', 'acumen-core' ) . '</p>';
    }

    public function render_email_section_desc() {
        echo '<p>' . esc_html__( 'Manage notifications sent when visitors submit the RFQ / Contact form.', 'acumen-core' ) . '</p>';
    }

    public function render_text_field( $args ) {
        $options = get_option( $this->option_name, array() );
        $val     = isset( $options[ $args['field'] ] ) ? $options[ $args['field'] ] : ( isset( $args['default'] ) ? $args['default'] : '' );
        ?>
        <input type="text" name="<?php echo esc_attr( $this->option_name . '[' . $args['field'] . ']' ); ?>" value="<?php echo esc_attr( $val ); ?>" class="regular-text" style="width:100%; max-width:500px;" />
        <?php
    }

    public function render_textarea_field( $args ) {
        $options = get_option( $this->option_name, array() );
        $val     = isset( $options[ $args['field'] ] ) ? $options[ $args['field'] ] : ( isset( $args['default'] ) ? $args['default'] : '' );
        ?>
        <textarea name="<?php echo esc_attr( $this->option_name . '[' . $args['field'] . ']' ); ?>" rows="3" class="large-text" style="width:100%; max-width:600px;"><?php echo esc_textarea( $val ); ?></textarea>
        <?php
    }

    public function render_checkbox_field( $args ) {
        $options = get_option( $this->option_name, array() );
        $checked = ! empty( $options[ $args['field'] ] );
        ?>
        <label>
            <input type="checkbox" name="<?php echo esc_attr( $this->option_name . '[' . $args['field'] . ']' ); ?>" value="1" <?php checked( $checked, true ); ?> />
            <?php echo esc_html( $args['label'] ); ?>
        </label>
        <?php
    }

    public function render_select_field( $args ) {
        $options = get_option( $this->option_name, array() );
        $current = isset( $options[ $args['field'] ] ) ? $options[ $args['field'] ] : 'bottom-right';
        ?>
        <select name="<?php echo esc_attr( $this->option_name . '[' . $args['field'] . ']' ); ?>">
            <?php foreach ( $args['options'] as $key => $lbl ) : ?>
                <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $current, $key ); ?>><?php echo esc_html( $lbl ); ?></option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    public function sanitize_options( $input ) {
        $sanitized = array();

        if ( isset( $input['company_name'] ) ) {
            $sanitized['company_name'] = sanitize_text_field( $input['company_name'] );
        }
        if ( isset( $input['tagline'] ) ) {
            $sanitized['tagline'] = sanitize_text_field( $input['tagline'] );
        }
        if ( isset( $input['corp_address'] ) ) {
            $sanitized['corp_address'] = sanitize_textarea_field( $input['corp_address'] );
        }
        if ( isset( $input['regd_address'] ) ) {
            $sanitized['regd_address'] = sanitize_textarea_field( $input['regd_address'] );
        }
        if ( isset( $input['phone_landline'] ) ) {
            $sanitized['phone_landline'] = sanitize_text_field( $input['phone_landline'] );
        }
        if ( isset( $input['phone_mobile_1'] ) ) {
            $sanitized['phone_mobile_1'] = sanitize_text_field( $input['phone_mobile_1'] );
        }
        if ( isset( $input['phone_mobile_2'] ) ) {
            $sanitized['phone_mobile_2'] = sanitize_text_field( $input['phone_mobile_2'] );
        }
        if ( isset( $input['email_primary'] ) ) {
            $sanitized['email_primary'] = sanitize_email( $input['email_primary'] );
        }
        if ( isset( $input['profile_pdf_url'] ) ) {
            $sanitized['profile_pdf_url'] = esc_url_raw( $input['profile_pdf_url'] );
        }
        if ( isset( $input['stat_workshop_sqft'] ) ) {
            $sanitized['stat_workshop_sqft'] = sanitize_text_field( $input['stat_workshop_sqft'] );
        }

        $sanitized['whatsapp_enabled']     = ! empty( $input['whatsapp_enabled'] ) ? 1 : 0;
        $sanitized['whatsapp_number']      = isset( $input['whatsapp_number'] ) ? sanitize_text_field( preg_replace( '/[^0-9]/', '', $input['whatsapp_number'] ) ) : '';
        $sanitized['whatsapp_default_msg'] = isset( $input['whatsapp_default_msg'] ) ? sanitize_text_field( $input['whatsapp_default_msg'] ) : '';
        $sanitized['whatsapp_position']    = isset( $input['whatsapp_position'] ) && in_array( $input['whatsapp_position'], array( 'bottom-right', 'bottom-left' ), true ) ? $input['whatsapp_position'] : 'bottom-right';

        if ( isset( $input['notify_recipients'] ) ) {
            $sanitized['notify_recipients'] = sanitize_text_field( $input['notify_recipients'] );
        }
        if ( isset( $input['notify_from_name'] ) ) {
            $sanitized['notify_from_name'] = sanitize_text_field( $input['notify_from_name'] );
        }
        $sanitized['autorespond_enabled']  = ! empty( $input['autorespond_enabled'] ) ? 1 : 0;

        return $sanitized;
    }

    public function render_settings_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'Acumen Engineers — Settings', 'acumen-core' ); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields( 'acumen_settings_group' );
                do_settings_sections( 'acumen-settings' );
                submit_button( __( 'Save All Settings', 'acumen-core' ) );
                ?>
            </form>
        </div>
        <?php
    }
}
