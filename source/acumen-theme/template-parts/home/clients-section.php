<?php
/**
 * Homepage: Clients Section
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="section-padding-sm bg-white" aria-label="<?php esc_attr_e( 'Our Clients', 'acumen-theme' ); ?>">
    <div class="container">
        <div class="section-header text-center" style="margin-bottom:30px;">
            <span class="section-badge"><?php esc_html_e( 'Trusted Partners', 'acumen-theme' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'Clients Who Trust Us', 'acumen-theme' ); ?></h2>
            <p class="section-desc"><?php esc_html_e( 'Proud to have served 25+ marquee clients across India\'s leading industrial and pharmaceutical companies.', 'acumen-theme' ); ?></p>
        </div>

        <?php
        if ( shortcode_exists( 'acumen_clients' ) ) {
            echo do_shortcode( '[acumen_clients layout="ticker"]' );
        } else {
            // Static client names fallback
            $clients = array(
                'Bharat Forge Ltd', 'Thermax Ltd', 'Forbes Marshall', 'Praj Industries',
                'Serum Institute of India', 'Lupin Pharmaceuticals', 'Wockhardt Ltd',
                'IOCL', 'BPCL', 'Tata Chemicals', 'UPL Limited', 'Pidilite Industries',
                'Kirloskar Brothers', 'Alfa Laval', 'Pentair',
                'Godrej & Boyce', 'Bajaj Auto', 'Mahindra & Mahindra', 'Bharat Electronics',
                'Sandvik Asia', 'ISRO', 'DRDO', 'Nuclear Power Corporation', 'HPCL', 'CPCL',
            );
            echo '<div class="clients-ticker-wrap">';
            echo '<div class="clients-ticker">';
            foreach ( $clients as $c ) {
                echo '<span class="client-chip">' . esc_html( $c ) . '</span>';
            }
            echo '</div>';
            echo '</div>';
        }
        ?>

        <div style="text-align:center;margin-top:32px;">
            <a href="<?php echo esc_url( home_url( '/clients/' ) ); ?>" class="btn btn-outline">
                <?php esc_html_e( 'View All Clients', 'acumen-theme' ); ?>
            </a>
        </div>
    </div>
</section>
