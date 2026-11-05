<?php
/**
 * Elementor Widget: RFQ / Inquiry Form
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;

class Acumen_Widget_RFQ_Form extends Widget_Base {

    public function get_name() {
        return 'acumen_rfq_form_widget';
    }

    public function get_title() {
        return esc_html__( 'Acumen: RFQ Inquiry Form', 'acumen-core' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return array( 'acumen-category' );
    }

    protected function render() {
        echo do_shortcode( '[acumen_rfq_form]' );
    }
}
