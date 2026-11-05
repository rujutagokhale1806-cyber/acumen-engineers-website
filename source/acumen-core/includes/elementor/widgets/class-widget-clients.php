<?php
/**
 * Elementor Widget: Clients Showcase / Marquee
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Acumen_Widget_Clients extends Widget_Base {

    public function get_name() {
        return 'acumen_clients_showcase';
    }

    public function get_title() {
        return esc_html__( 'Acumen: Clients Carousel / Grid', 'acumen-core' );
    }

    public function get_icon() {
        return 'eicon-logo';
    }

    public function get_categories() {
        return array( 'acumen-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Clients Display', 'acumen-core' ),
            )
        );

        $this->add_control(
            'layout',
            array(
                'label'   => esc_html__( 'Layout Style', 'acumen-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'ticker',
                'options' => array(
                    'ticker' => esc_html__( 'Continuous Ticker / Carousel', 'acumen-core' ),
                    'grid'   => esc_html__( 'Static Grid', 'acumen-core' ),
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $layout   = ! empty( $settings['layout'] ) ? $settings['layout'] : 'ticker';

        echo do_shortcode( sprintf( '[acumen_clients layout="%s"]', $layout ) );
    }
}
