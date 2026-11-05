<?php
/**
 * Homepage Hero Section
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$hero_img = ACUMEN_THEME_URI . '/assets/images/plant-image-1.jpg';
?>

<section class="acumen-hero" aria-label="<?php esc_attr_e( 'Hero Banner', 'acumen-theme' ); ?>">
    <!-- Background image + overlay -->
    <img src="<?php echo esc_url( $hero_img ); ?>"
         alt="<?php esc_attr_e( 'Acumen Engineers Industrial Plant', 'acumen-theme' ); ?>"
         class="hero-bg-img"
         loading="eager"
         fetchpriority="high">
    <div class="hero-bg-overlay" aria-hidden="true"></div>

    <div class="container">
        <div class="hero-grid">

            <!-- Left: Hero Copy -->
            <div class="hero-content">
                <div class="hero-badge-tag">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <?php esc_html_e( 'Turnkey Industrial EPC Solutions', 'acumen-theme' ); ?>
                </div>
                <h1 class="hero-title">
                    <?php esc_html_e( 'Engineering', 'acumen-theme' ); ?>
                    <span><?php esc_html_e( 'Excellence.', 'acumen-theme' ); ?></span>
                    <br><?php esc_html_e( 'Delivered On Time.', 'acumen-theme' ); ?>
                </h1>
                <p class="hero-description">
                    <?php esc_html_e( 'Acumen Engineers is a Pune-based EPC contractor specialising in mechanical fabrication, piping, structural erection, insulation and complete turnkey industrial projects across India\'s key industrial sectors.', 'acumen-theme' ); ?>
                </p>
                <div class="hero-actions">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-accent btn-lg">
                        <?php esc_html_e( 'Request a Quote', 'acumen-theme' ); ?>
                    </a>
                    <?php
                    $pdf_url = ACUMEN_THEME_URI . '/assets/images/company-profile.pdf';
                    // Only show if PDF exists in theme; fallback to about page
                    $pdf_path = ACUMEN_THEME_DIR . '/assets/images/company-profile.pdf';
                    if ( file_exists( $pdf_path ) ) :
                    ?>
                    <a href="<?php echo esc_url( $pdf_url ); ?>" class="btn btn-outline-white btn-lg" download>
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <?php esc_html_e( 'Download Profile', 'acumen-theme' ); ?>
                    </a>
                    <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>" class="btn btn-outline-white btn-lg">
                        <?php esc_html_e( 'About Us', 'acumen-theme' ); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Key Metrics Card -->
            <div class="hero-card-feature" aria-label="<?php esc_attr_e( 'Company Highlights', 'acumen-theme' ); ?>">
                <h3><?php esc_html_e( 'Why Acumen Engineers?', 'acumen-theme' ); ?></h3>
                <p><?php esc_html_e( 'Over two decades of proven EPC delivery across pharma, chemical, oil & gas and process industries.', 'acumen-theme' ); ?></p>
                <div class="hero-metrics">
                    <div class="metric-box">
                        <strong>25+</strong>
                        <span><?php esc_html_e( 'Years Experience', 'acumen-theme' ); ?></span>
                    </div>
                    <div class="metric-box">
                        <strong>200+</strong>
                        <span><?php esc_html_e( 'Projects Delivered', 'acumen-theme' ); ?></span>
                    </div>
                    <div class="metric-box">
                        <strong>25+</strong>
                        <span><?php esc_html_e( 'Marquee Clients', 'acumen-theme' ); ?></span>
                    </div>
                    <div class="metric-box">
                        <strong>IBR</strong>
                        <span><?php esc_html_e( 'Approved Welder', 'acumen-theme' ); ?></span>
                    </div>
                </div>
            </div>

        </div><!-- .hero-grid -->
    </div><!-- .container -->
</section>
