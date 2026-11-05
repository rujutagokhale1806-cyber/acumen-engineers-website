<?php
/**
 * Homepage: Industries Section
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="section-padding bg-navy" aria-label="<?php esc_attr_e( 'Industries We Serve', 'acumen-theme' ); ?>">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge"><?php esc_html_e( 'Industries Served', 'acumen-theme' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'Sectors We Operate In', 'acumen-theme' ); ?></h2>
            <p class="section-desc"><?php esc_html_e( 'Our expertise spans a wide range of industrial sectors — from pharma and chemicals to oil & gas, sugar, dairy and more.', 'acumen-theme' ); ?></p>
        </div>

        <?php
        if ( shortcode_exists( 'acumen_industries' ) ) {
            echo do_shortcode( '[acumen_industries columns="5"]' );
        } else {
            $sectors = array(
                array( 'icon' => 'sector-pharma',    'title' => 'Pharmaceutical' ),
                array( 'icon' => 'sector-chemical',  'title' => 'Chemical' ),
                array( 'icon' => 'sector-oil-gas',   'title' => 'Oil & Gas' ),
                array( 'icon' => 'sector-process',   'title' => 'Process Industries' ),
                array( 'icon' => 'sector-refinery',  'title' => 'Refinery' ),
                array( 'icon' => 'sector-dairy',     'title' => 'Dairy' ),
                array( 'icon' => 'sector-sugar',     'title' => 'Sugar' ),
                array( 'icon' => 'sector-brewery',   'title' => 'Brewery' ),
                array( 'icon' => 'sector-surface',   'title' => 'Surface Treatment' ),
                array( 'icon' => 'sector-water',     'title' => 'Water Treatment' ),
            );
            echo '<div class="acumen-sectors-grid">';
            foreach ( $sectors as $sec ) {
                $icon_svg = acumen_get_svg_icon( $sec['icon'], 'sectors' );
                echo '<div class="sector-card">';
                echo '<div class="sector-card-icon">' . $icon_svg . '</div>'; // phpcs:ignore
                echo '<span class="sector-card-title">' . esc_html( $sec['title'] ) . '</span>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>

        <div style="text-align:center;margin-top:40px;">
            <a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>" class="btn btn-outline-white btn-lg">
                <?php esc_html_e( 'Explore All Industries', 'acumen-theme' ); ?>
            </a>
        </div>
    </div>
</section>
