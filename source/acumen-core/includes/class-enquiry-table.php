<?php
/**
 * Admin Enquiry Management Screen Class
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Acumen_Enquiry_Table {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_enquiry_menu' ) );
        add_action( 'admin_init', array( $this, 'handle_actions' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
    }

    /**
     * Enqueue Admin CSS on enquiries screen
     */
    public function enqueue_admin_assets( $hook ) {
        if ( false !== strpos( $hook, 'acumen-enquiries' ) ) {
            wp_enqueue_style(
                'acumen-admin-css',
                ACUMEN_CORE_URL . 'assets/css/acumen-admin.css',
                array(),
                ACUMEN_CORE_VERSION
            );
        }
    }

    /**
     * Add Enquiry submenu
     */
    public function add_enquiry_menu() {
        add_submenu_page(
            'acumen-settings',
            __( 'Enquiries & RFQ Leads', 'acumen-core' ),
            __( 'Enquiries', 'acumen-core' ),
            'manage_options',
            'acumen-enquiries',
            array( $this, 'render_enquiry_page' )
        );
    }

    /**
     * Handle actions: status update, delete, CSV export
     */
    public function handle_actions() {
        if ( ! isset( $_GET['page'] ) || 'acumen-enquiries' !== $_GET['page'] ) {
            return;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        global $wpdb;
        $table = Acumen_Database::get_enquiries_table();

        // 1. Export CSV
        if ( isset( $_GET['action'] ) && 'export_csv' === $_GET['action'] ) {
            check_admin_referer( 'acumen_export_csv_nonce' );

            $rows = $wpdb->get_results( "SELECT * FROM $table ORDER BY id DESC", ARRAY_A );

            header( 'Content-Type: text/csv; charset=utf-8' );
            header( 'Content-Disposition: attachment; filename=acumen-enquiries-' . date( 'Y-m-d' ) . '.csv' );

            $output = fopen( 'php://output', 'w' );
            fputcsv( $output, array( 'ID', 'Date', 'Status', 'Full Name', 'Email', 'Phone', 'Company', 'Service', 'Message', 'IP' ) );

            if ( ! empty( $rows ) ) {
                foreach ( $rows as $r ) {
                    fputcsv( $output, array(
                        $r['id'],
                        $r['created_at'],
                        $r['status'],
                        $r['full_name'],
                        $r['email'],
                        $r['phone'],
                        $r['company_name'],
                        $r['service_requested'],
                        $r['message'],
                        $r['ip_address'],
                    ) );
                }
            }
            fclose( $output );
            exit;
        }

        // 2. Status update
        if ( isset( $_GET['action'] ) && in_array( $_GET['action'], array( 'mark_contacted', 'mark_closed', 'mark_new' ), true ) && isset( $_GET['enquiry_id'] ) ) {
            $id = absint( $_GET['enquiry_id'] );
            check_admin_referer( 'acumen_enquiry_action_' . $id );

            $new_status = 'new';
            if ( 'mark_contacted' === $_GET['action'] ) {
                $new_status = 'contacted';
            } elseif ( 'mark_closed' === $_GET['action'] ) {
                $new_status = 'closed';
            }

            $wpdb->update( $table, array( 'status' => $new_status ), array( 'id' => $id ), array( '%s' ), array( '%d' ) );

            wp_safe_redirect( remove_query_arg( array( 'action', 'enquiry_id', '_wpnonce' ) ) );
            exit;
        }

        // 3. Delete
        if ( isset( $_GET['action'] ) && 'delete' === $_GET['action'] && isset( $_GET['enquiry_id'] ) ) {
            $id = absint( $_GET['enquiry_id'] );
            check_admin_referer( 'acumen_enquiry_action_' . $id );

            $wpdb->delete( $table, array( 'id' => $id ), array( '%d' ) );

            wp_safe_redirect( remove_query_arg( array( 'action', 'enquiry_id', '_wpnonce' ) ) );
            exit;
        }
    }

    /**
     * Render the admin Enquiry page
     */
    public function render_enquiry_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        global $wpdb;
        $table = Acumen_Database::get_enquiries_table();

        $current_status = isset( $_GET['status'] ) ? sanitize_text_field( wp_unslash( $_GET['status'] ) ) : 'all';

        $where = '';
        if ( in_array( $current_status, array( 'new', 'contacted', 'closed' ), true ) ) {
            $where = $wpdb->prepare( "WHERE status = %s", $current_status );
        }

        $enquiries = $wpdb->get_results( "SELECT * FROM $table $where ORDER BY id DESC" );

        $count_all       = $wpdb->get_var( "SELECT COUNT(*) FROM $table" );
        $count_new       = $wpdb->get_var( "SELECT COUNT(*) FROM $table WHERE status = 'new'" );
        $count_contacted = $wpdb->get_var( "SELECT COUNT(*) FROM $table WHERE status = 'contacted'" );
        $count_closed    = $wpdb->get_var( "SELECT COUNT(*) FROM $table WHERE status = 'closed'" );

        $export_url = wp_nonce_url( admin_url( 'admin.php?page=acumen-enquiries&action=export_csv' ), 'acumen_export_csv_nonce' );
        ?>
        <div class="wrap acumen-enquiries-wrap">
            <h1 class="wp-heading-inline"><?php esc_html_e( 'Enquiries & RFQ Leads', 'acumen-core' ); ?></h1>
            <a href="<?php echo esc_url( $export_url ); ?>" class="page-title-action"><?php esc_html_e( 'Export to CSV', 'acumen-core' ); ?></a>
            <hr class="wp-header-end">

            <!-- Filter Tabs -->
            <ul class="subsubsub">
                <li class="all"><a href="<?php echo esc_url( admin_url( 'admin.php?page=acumen-enquiries' ) ); ?>" class="<?php echo 'all' === $current_status ? 'current' : ''; ?>"><?php esc_html_e( 'All', 'acumen-core' ); ?> <span class="count">(<?php echo esc_html( $count_all ); ?>)</span></a> |</li>
                <li class="new"><a href="<?php echo esc_url( admin_url( 'admin.php?page=acumen-enquiries&status=new' ) ); ?>" class="<?php echo 'new' === $current_status ? 'current' : ''; ?>"><?php esc_html_e( 'New', 'acumen-core' ); ?> <span class="count">(<?php echo esc_html( $count_new ); ?>)</span></a> |</li>
                <li class="contacted"><a href="<?php echo esc_url( admin_url( 'admin.php?page=acumen-enquiries&status=contacted' ) ); ?>" class="<?php echo 'contacted' === $current_status ? 'current' : ''; ?>"><?php esc_html_e( 'Contacted', 'acumen-core' ); ?> <span class="count">(<?php echo esc_html( $count_contacted ); ?>)</span></a> |</li>
                <li class="closed"><a href="<?php echo esc_url( admin_url( 'admin.php?page=acumen-enquiries&status=closed' ) ); ?>" class="<?php echo 'closed' === $current_status ? 'current' : ''; ?>"><?php esc_html_e( 'Closed', 'acumen-core' ); ?> <span class="count">(<?php echo esc_html( $count_closed ); ?>)</span></a></li>
            </ul>

            <!-- Horizontally scrollable container preventing column squashing -->
            <div class="acumen-table-container" style="overflow-x:auto; -webkit-overflow-scrolling:touch; background:#ffffff; border:1px solid #c3c4c7; box-shadow:0 1px 1px rgba(0,0,0,.04); border-radius:4px; margin-top:15px;">
                <table class="wp-list-table widefat striped acumen-enquiries-table" style="min-width:1200px; width:100%; border:none; margin:0; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th class="col-id" style="width:55px; min-width:55px; padding:12px 10px;"><?php esc_html_e( 'ID', 'acumen-core' ); ?></th>
                            <th class="col-date" style="width:135px; min-width:135px; padding:12px 10px;"><?php esc_html_e( 'Date', 'acumen-core' ); ?></th>
                            <th class="col-status" style="width:100px; min-width:100px; padding:12px 10px;"><?php esc_html_e( 'Status', 'acumen-core' ); ?></th>
                            <th class="col-client" style="width:150px; min-width:140px; padding:12px 10px;"><?php esc_html_e( 'Client Name', 'acumen-core' ); ?></th>
                            <th class="col-contact" style="width:180px; min-width:170px; padding:12px 10px;"><?php esc_html_e( 'Contact Info', 'acumen-core' ); ?></th>
                            <th class="col-company" style="width:140px; min-width:130px; padding:12px 10px;"><?php esc_html_e( 'Company', 'acumen-core' ); ?></th>
                            <th class="col-service" style="width:160px; min-width:150px; padding:12px 10px;"><?php esc_html_e( 'Service Requested', 'acumen-core' ); ?></th>
                            <th class="col-message" style="width:340px; min-width:300px; padding:12px 10px;"><?php esc_html_e( 'Project Scope / Message', 'acumen-core' ); ?></th>
                            <th class="col-actions" style="width:140px; min-width:130px; text-align:right; padding:12px 10px;"><?php esc_html_e( 'Actions', 'acumen-core' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( empty( $enquiries ) ) : ?>
                            <tr>
                                <td colspan="9" style="text-align:center; padding: 30px; color:#64748b; font-size:14px;">
                                    <?php esc_html_e( 'No inquiries found in this view.', 'acumen-core' ); ?>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ( $enquiries as $row ) :
                                $nonce_action = 'acumen_enquiry_action_' . $row->id;
                                $contacted_url = wp_nonce_url( admin_url( 'admin.php?page=acumen-enquiries&action=mark_contacted&enquiry_id=' . $row->id ), $nonce_action );
                                $closed_url    = wp_nonce_url( admin_url( 'admin.php?page=acumen-enquiries&action=mark_closed&enquiry_id=' . $row->id ), $nonce_action );
                                $delete_url    = wp_nonce_url( admin_url( 'admin.php?page=acumen-enquiries&action=delete&enquiry_id=' . $row->id ), $nonce_action );

                                $status_bg = '#e2e8f0';
                                $status_fg = '#334155';
                                if ( 'new' === $row->status ) {
                                    $status_bg = '#dbeafe';
                                    $status_fg = '#1e40af';
                                } elseif ( 'contacted' === $row->status ) {
                                    $status_bg = '#fef3c7';
                                    $status_fg = '#92400e';
                                } elseif ( 'closed' === $row->status ) {
                                    $status_bg = '#dcfce7';
                                    $status_fg = '#166534';
                                }
                            ?>
                                <tr>
                                    <td class="col-id" style="vertical-align:top; padding:12px 10px;">
                                        <strong>#<?php echo esc_html( $row->id ); ?></strong>
                                    </td>
                                    <td class="col-date" style="vertical-align:top; padding:12px 10px; color:#475569; font-size:12.5px;">
                                        <?php echo esc_html( date( 'd M Y, H:i', strtotime( $row->created_at ) ) ); ?>
                                    </td>
                                    <td class="col-status" style="vertical-align:top; padding:12px 10px;">
                                        <span class="acumen-status-pill acumen-status-<?php echo esc_attr( $row->status ); ?>" style="display:inline-block; padding:4px 10px; border-radius:12px; font-size:11px; font-weight:700; text-transform:uppercase; background:<?php echo esc_attr( $status_bg ); ?>; color:<?php echo esc_attr( $status_fg ); ?>;">
                                            <?php echo esc_html( $row->status ); ?>
                                        </span>
                                    </td>
                                    <td class="col-client" style="vertical-align:top; padding:12px 10px;">
                                        <strong style="color:#0f172a; font-size:13.5px;"><?php echo esc_html( $row->full_name ); ?></strong>
                                    </td>
                                    <td class="col-contact" style="vertical-align:top; padding:12px 10px; word-break:break-word;">
                                        <div><a href="mailto:<?php echo esc_attr( $row->email ); ?>" style="font-weight:600; text-decoration:none;"><?php echo esc_html( $row->email ); ?></a></div>
                                        <div style="color:#475569; font-size:12px; margin-top:4px;">
                                            <a href="tel:<?php echo esc_attr( $row->phone ); ?>" style="color:#475569; text-decoration:none;"><?php echo esc_html( $row->phone ); ?></a>
                                        </div>
                                    </td>
                                    <td class="col-company" style="vertical-align:top; padding:12px 10px; color:#334155;">
                                        <?php echo esc_html( $row->company_name ? $row->company_name : '—' ); ?>
                                    </td>
                                    <td class="col-service" style="vertical-align:top; padding:12px 10px;">
                                        <span style="font-weight:600; color:#0a4fa8; font-size:12.5px;"><?php echo esc_html( $row->service_requested ? $row->service_requested : 'General Inquiry' ); ?></span>
                                    </td>
                                    <td class="col-message" style="vertical-align:top; padding:12px 10px;">
                                        <div class="acumen-message-box" style="background:#f8fafc; border:1px solid #cbd5e1; border-radius:4px; padding:10px 12px; max-height:120px; min-width:280px; overflow-y:auto; line-height:1.5; color:#1e293b; word-break:break-word; white-space:pre-line; font-size:13px;">
                                            <?php echo esc_html( $row->message ); ?>
                                        </div>
                                    </td>
                                    <td class="col-actions" style="vertical-align:top; padding:12px 10px; text-align:right;">
                                        <?php if ( 'contacted' !== $row->status ) : ?>
                                            <a href="<?php echo esc_url( $contacted_url ); ?>" class="button button-small" title="<?php esc_attr_e( 'Mark as Contacted', 'acumen-core' ); ?>" style="margin-bottom:4px;"><?php esc_html_e( 'Contacted', 'acumen-core' ); ?></a>
                                        <?php endif; ?>
                                        <?php if ( 'closed' !== $row->status ) : ?>
                                            <a href="<?php echo esc_url( $closed_url ); ?>" class="button button-small" title="<?php esc_attr_e( 'Mark as Closed', 'acumen-core' ); ?>" style="margin-bottom:4px;"><?php esc_html_e( 'Close', 'acumen-core' ); ?></a>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( $delete_url ); ?>" class="button button-small button-link-delete" onclick="return confirm('<?php esc_attr_e( 'Delete this inquiry permanently?', 'acumen-core' ); ?>');" style="margin-bottom:4px;"><?php esc_html_e( 'Delete', 'acumen-core' ); ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
}
