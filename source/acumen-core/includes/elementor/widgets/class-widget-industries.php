<?php
/**
 * Elementor Widget: Industries / Sectors Grid
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Acumen_Widget_Industries extends Widget_Base {

    public function get_name() {
        return 'acumen_industries_grid';
    }

    public function get_title() {
        return esc_html__( 'Acumen: Industries / Sectors', 'acumen-core' );
    }

    public function get_icon() {
        return 'eicon-site-identity';
    }

    public function get_categories() {
        return array( 'acumen-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Industries Configuration', 'acumen-core' ),
            )
        );

        $this->add_control(
            'columns',
            array(
                'label'   => esc_html__( 'Columns', 'acumen-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '4',
                'options' => array(
                    '2' => esc_html__( '2 Columns', 'acumen-core' ),
                    '3' => esc_html__( '3 Columns', 'acumen-core' ),
                    '4' => esc_html__( '4 Columns', 'acumen-core' ),
                    '5' => esc_html__( '5 Columns', 'acumen-core' ),
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $columns  = ! empty( $settings['columns'] ) ? $settings['columns'] : 4;

        echo do_shortcode( sprintf( '[acumen_industries columns="%s"]', $columns ) );
    }
}
