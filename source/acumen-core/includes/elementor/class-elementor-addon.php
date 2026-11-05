<?php
/**
 * Elementor Free Integration Loader
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Acumen_Elementor_Addon {

    public function __construct() {
        add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_categories' ) );
        add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
    }

    /**
     * Add Custom Acumen Category to Elementor Panel
     */
    public function add_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'acumen-category',
            array(
                'title' => esc_html__( 'Acumen Engineers', 'acumen-core' ),
                'icon'  => 'fa fa-cogs',
            )
        );
    }

    /**
     * Register 7 Custom Elementor Free Widgets
     */
    public function register_widgets( $widgets_manager ) {
        require_once __DIR__ . '/widgets/class-widget-services.php';
        require_once __DIR__ . '/widgets/class-widget-industries.php';
        require_once __DIR__ . '/widgets/class-widget-clients.php';
        require_once __DIR__ . '/widgets/class-widget-projects.php';
        require_once __DIR__ . '/widgets/class-widget-stats.php';
        require_once __DIR__ . '/widgets/class-widget-rfq-form.php';
        require_once __DIR__ . '/widgets/class-widget-whatsapp.php';

        $widgets_manager->register( new \Acumen_Widget_Services() );
        $widgets_manager->register( new \Acumen_Widget_Industries() );
        $widgets_manager->register( new \Acumen_Widget_Clients() );
        $widgets_manager->register( new \Acumen_Widget_Projects() );
        $widgets_manager->register( new \Acumen_Widget_Stats() );
        $widgets_manager->register( new \Acumen_Widget_RFQ_Form() );
        $widgets_manager->register( new \Acumen_Widget_WhatsApp() );
    }
}
