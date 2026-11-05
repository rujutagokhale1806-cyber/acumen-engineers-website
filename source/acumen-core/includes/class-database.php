<?php
/**
 * Database Management Class
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Acumen_Database {

    /**
     * Create or update custom database tables
     */
    public static function create_tables() {
        global $wpdb;

        $table_name      = $wpdb->prefix . 'acumen_enquiries';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            full_name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            phone varchar(50) NOT NULL,
            company_name varchar(255) DEFAULT '',
            service_requested varchar(255) DEFAULT '',
            message text NOT NULL,
            ip_address varchar(100) DEFAULT '',
            status varchar(20) DEFAULT 'new',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            KEY status_idx (status),
            KEY created_idx (created_at)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );
    }

    /**
     * Get table name with prefix
     */
    public static function get_enquiries_table() {
        global $wpdb;
        return $wpdb->prefix . 'acumen_enquiries';
    }
}
