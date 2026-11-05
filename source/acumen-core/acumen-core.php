<?php
/**
 * Plugin Name: Acumen Core
 * Plugin URI: http://acumen-engineers.local
 * Description: Core business logic, Custom Post Types (Services, Industries, Clients, Projects, Gallery), Enquiry Management, WhatsApp Configuration, and Elementor Free widgets for Acumen Engineers.
 * Version: 1.0.0
 * Author: Acumen Engineers
 * Author URI: http://acumen-engineers.local
 * Text Domain: acumen-core
 * Requires at least: 6.0
 * Requires PHP: 8.0
 * License: Proprietary
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'ACUMEN_CORE_VERSION', '1.0.0' );
define( 'ACUMEN_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'ACUMEN_CORE_URL', plugin_dir_url( __FILE__ ) );

/**
 * Autoload / require all component classes
 */
require_once ACUMEN_CORE_PATH . 'includes/class-database.php';
require_once ACUMEN_CORE_PATH . 'includes/class-post-types.php';
require_once ACUMEN_CORE_PATH . 'includes/class-taxonomies.php';
require_once ACUMEN_CORE_PATH . 'includes/class-meta-boxes.php';
require_once ACUMEN_CORE_PATH . 'includes/class-admin-columns.php';
require_once ACUMEN_CORE_PATH . 'includes/class-settings.php';
require_once ACUMEN_CORE_PATH . 'includes/class-enquiry-handler.php';
require_once ACUMEN_CORE_PATH . 'includes/class-enquiry-table.php';
require_once ACUMEN_CORE_PATH . 'includes/class-shortcodes.php';
require_once ACUMEN_CORE_PATH . 'includes/class-whatsapp.php';

/**
 * Main Orchestration Class
 */
class Acumen_Core {

    private static $instance = null;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        $this->init_components();
        add_action( 'plugins_loaded', array( $this, 'load_elementor_integration' ) );
    }

    /**
     * Instantiate core subsystems
     */
    private function init_components() {
        new Acumen_Post_Types();
        new Acumen_Taxonomies();
        new Acumen_Meta_Boxes();
        new Acumen_Admin_Columns();
        new Acumen_Settings();
        new Acumen_Enquiry_Handler();
        new Acumen_Enquiry_Table();
        new Acumen_Shortcodes();
        new Acumen_WhatsApp();
    }

    /**
     * Load Elementor widgets if Elementor is active
     */
    public function load_elementor_integration() {
        if ( did_action( 'elementor/loaded' ) ) {
            require_once ACUMEN_CORE_PATH . 'includes/elementor/class-elementor-addon.php';
            new Acumen_Elementor_Addon();
        }
    }
}

/**
 * Plugin Activation Handler
 */
function acumen_core_activate() {
    Acumen_Database::create_tables();

    // Register post types and flush rewrite rules
    $pt = new Acumen_Post_Types();
    $pt->register_post_types();

    $tax = new Acumen_Taxonomies();
    $tax->register_taxonomies();

    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'acumen_core_activate' );

/**
 * Plugin Deactivation Handler
 */
function acumen_core_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'acumen_core_deactivate' );

// Launch Plugin
Acumen_Core::instance();
