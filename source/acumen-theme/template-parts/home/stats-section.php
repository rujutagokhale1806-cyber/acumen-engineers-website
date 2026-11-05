<?php
/**
 * Homepage: Stats/Counters Section
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="acumen-stats-section section-padding" aria-label="<?php esc_attr_e( 'Company Statistics', 'acumen-theme' ); ?>">
    <div class="container">
        <?php
        if ( shortcode_exists( 'acumen_stats' ) ) {
            echo do_shortcode( '[acumen_stats]' );
        } else {
            ?>
            <div class="stats-grid">
                <div class="stat-item">
                    <strong class="stat-number" data-target="25">25+</strong>
                    <span class="stat-label"><?php esc_html_e( 'Years of Experience', 'acumen-theme' ); ?></span>
                </div>
                <div class="stat-item">
                    <strong class="stat-number" data-target="200">200+</strong>
                    <span class="stat-label"><?php esc_html_e( 'Projects Completed', 'acumen-theme' ); ?></span>
                </div>
                <div class="stat-item">
                    <strong class="stat-number" data-target="25">25+</strong>
                    <span class="stat-label"><?php esc_html_e( 'Clients Served', 'acumen-theme' ); ?></span>
                </div>
                <div class="stat-item">
                    <strong class="stat-number">6,000</strong>
                    <span class="stat-label"><?php esc_html_e( 'Sq.Ft. Workshop', 'acumen-theme' ); ?></span>
                </div>
                <div class="stat-item">
                    <strong class="stat-number">10</strong>
                    <span class="stat-label"><?php esc_html_e( 'Industrial Sectors', 'acumen-theme' ); ?></span>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
