<?php
/**
 * Homepage: Services Section
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="section-padding bg-light" aria-label="<?php esc_attr_e( 'Our Services', 'acumen-theme' ); ?>">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge"><?php esc_html_e( 'What We Do', 'acumen-theme' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'Our Core Services', 'acumen-theme' ); ?></h2>
            <p class="section-desc"><?php esc_html_e( 'Comprehensive EPC capabilities under one roof — from detailed engineering and fabrication to site erection, insulation, cabling, and commissioning.', 'acumen-theme' ); ?></p>
        </div>

        <?php
        // Use Acumen Core shortcode if available
        if ( shortcode_exists( 'acumen_services' ) ) {
            echo do_shortcode( '[acumen_services columns="3" count="9"]' );
        } else {
            // Static fallback
            $static = array(
                array( 'icon' => 'service-fabrication',       'title' => 'Mechanical Fabrication',    'desc' => 'Precision fabrication of pressure vessels, heat exchangers, tanks and structural components in our 6,000 sq.ft. workshop.' ),
                array( 'icon' => 'service-piping',            'title' => 'Piping Works',              'desc' => 'Complete piping systems — design, supply, erection, testing and commissioning for all process industries.' ),
                array( 'icon' => 'service-erection',          'title' => 'Structural Erection',       'desc' => 'Structural steel erection and alignment for industrial buildings, equipment supports and mezzanine floors.' ),
                array( 'icon' => 'service-insulation',        'title' => 'Insulation Works',          'desc' => 'Thermal and acoustic insulation for pipelines, vessels and equipment to improve energy efficiency and safety.' ),
                array( 'icon' => 'service-cabling',           'title' => 'Electrical Cabling',        'desc' => 'Instrumentation and power cabling, cable trays, conduits and earthing systems for industrial plants.' ),
                array( 'icon' => 'service-maintenance',       'title' => 'Mechanical Maintenance',    'desc' => 'Planned and breakdown maintenance, overhauling of rotating equipment, heat exchangers and process machinery.' ),
                array( 'icon' => 'service-welding',           'title' => 'IBR Welding',               'desc' => 'IBR-approved welding services for pressure parts with qualified welders and certified procedures.' ),
                array( 'icon' => 'service-project-management','title' => 'Project Management',        'desc' => 'End-to-end project management ensuring on-time, within-budget delivery with dedicated project coordinators.' ),
                array( 'icon' => 'service-goods',             'title' => 'Supply of Goods',           'desc' => 'Sourcing and supply of engineering materials, spares, instruments and equipment from approved vendors.' ),
            );
            echo '<div class="acumen-services-grid">';
            foreach ( $static as $svc ) {
                $icon_svg = acumen_get_svg_icon( $svc['icon'], 'services' );
                echo '<div class="service-card">';
                echo '<div class="service-card-icon">' . $icon_svg . '</div>'; // phpcs:ignore
                echo '<h3 class="service-card-title">' . esc_html( $svc['title'] ) . '</h3>';
                echo '<p class="service-card-desc">' . esc_html( $svc['desc'] ) . '</p>';
                echo '<a href="' . esc_url( home_url( '/services/' ) ) . '" class="service-card-link">' . esc_html__( 'Learn More', 'acumen-theme' ) . ' &rarr;</a>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>

        <div style="text-align:center;margin-top:40px;">
            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn-primary btn-lg">
                <?php esc_html_e( 'View All Services', 'acumen-theme' ); ?>
            </a>
        </div>
    </div>
</section>
