<?php
/**
 * Elementor Widget: Services Grid
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Acumen_Widget_Services extends Widget_Base {

    public function get_name() {
        return 'acumen_services_grid';
    }

    public function get_title() {
        return esc_html__( 'Acumen: Services Grid', 'acumen-core' );
    }

    public function get_icon() {
        return 'eicon-hammer';
    }

    public function get_categories() {
        return array( 'acumen-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Services Configuration', 'acumen-core' ),
            )
        );

        $this->add_control(
            'count',
            array(
                'label'   => esc_html__( 'Number of Services to Display', 'acumen-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 9,
                'min'     => 1,
                'max'     => 20,
            )
        );

        $this->add_control(
            'columns',
            array(
                'label'   => esc_html__( 'Columns', 'acumen-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => array(
                    '2' => esc_html__( '2 Columns', 'acumen-core' ),
                    '3' => esc_html__( '3 Columns', 'acumen-core' ),
                    '4' => esc_html__( '4 Columns', 'acumen-core' ),
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $count    = ! empty( $settings['count'] ) ? $settings['count'] : 9;
        $columns  = ! empty( $settings['columns'] ) ? $settings['columns'] : 3;

        echo do_shortcode( sprintf( '[acumen_services count="%d" columns="%s"]', $count, $columns ) );
    }
}
