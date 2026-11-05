<?php
/**
 * Elementor Widget: WhatsApp Action Button
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Acumen_Widget_WhatsApp extends Widget_Base {

    public function get_name() {
        return 'acumen_whatsapp_button';
    }

    public function get_title() {
        return esc_html__( 'Acumen: WhatsApp Button', 'acumen-core' );
    }

    public function get_icon() {
        return 'eicon-social-icons';
    }

    public function get_categories() {
        return array( 'acumen-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Button Text', 'acumen-core' ),
            )
        );

        $this->add_control(
            'button_text',
            array(
                'label'   => esc_html__( 'Button Label', 'acumen-core' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Chat with us on WhatsApp', 'acumen-core' ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $text     = ! empty( $settings['button_text'] ) ? $settings['button_text'] : esc_html__( 'Chat with us on WhatsApp', 'acumen-core' );

        echo do_shortcode( sprintf( '[acumen_whatsapp text="%s"]', esc_attr( $text ) ) );
    }
}
