<?php
/**
 * Elementor Widget: Stats Counter
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;

class Acumen_Widget_Stats extends Widget_Base {

    public function get_name() {
        return 'acumen_stats_counter';
    }

    public function get_title() {
        return esc_html__( 'Acumen: Stats Counter', 'acumen-core' );
    }

    public function get_icon() {
        return 'eicon-counter';
    }

    public function get_categories() {
        return array( 'acumen-category' );
    }

    protected function render() {
        echo do_shortcode( '[acumen_stats]' );
    }
}
