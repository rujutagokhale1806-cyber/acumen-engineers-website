<?php
/**
 * Template Name: About Us
 * Template Post Type: page
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <!-- Hero Banner -->
    <div class="page-hero-banner">
        <div class="container">
            <h1 class="page-hero-title"><?php esc_html_e( 'About Acumen Engineers', 'acumen-theme' ); ?></h1>
            <p class="page-hero-subtitle"><?php esc_html_e( 'Over 25 years of trusted engineering excellence in turnkey industrial EPC projects.', 'acumen-theme' ); ?></p>
            <?php acumen_breadcrumb(); ?>
        </div>
    </div>

    <!-- Company Story -->
    <section class="section-padding bg-white">
        <div class="container">
            <div class="intro-grid">
                <div class="intro-content">
                    <div class="section-header">
                        <span class="section-badge"><?php esc_html_e( 'Our Story', 'acumen-theme' ); ?></span>
                        <h2 class="section-title"><?php esc_html_e( 'Engineering Built on Trust, Delivered with Precision', 'acumen-theme' ); ?></h2>
                    </div>
                    <?php
                    // Editable via page content
                    while ( have_posts() ) :
                        the_post();
                        if ( '' !== trim( get_the_content() ) ) {
                            echo '<div class="entry-content acumen-page-content">';
                            the_content();
                            echo '</div>';
                        } else {
                    ?>
                    <p style="color:var(--acumen-slate);line-height:1.75;"><?php esc_html_e( 'Acumen Engineers was founded with a singular vision: to be the most reliable EPC contractor for India\'s industrial sector. Based in Pune, Maharashtra, we have grown from a small fabrication enterprise to a full-service EPC company serving clients across the pharmaceutical, chemical, oil & gas, refinery, sugar, dairy and process industries.', 'acumen-theme' ); ?></p>
                    <p style="color:var(--acumen-slate);line-height:1.75;"><?php esc_html_e( 'Our founder and leadership team bring decades of hands-on plant engineering experience. Every project we undertake is executed with the discipline of project management, the craftsmanship of our certified welders and fabricators, and the rigour of our ISO 9001:2015 quality system.', 'acumen-theme' ); ?></p>
                    <p style="color:var(--acumen-slate);line-height:1.75;"><?php esc_html_e( '"We Add Value to Your Projects" is not merely a tagline — it reflects our commitment to doing more than the contract requires, so that your plant performs better, longer, and safer.', 'acumen-theme' ); ?></p>
                    <?php
                        }
                    endwhile;
                    ?>
                </div>

                <div class="intro-value-props">
                    <div class="value-prop-card">
                        <div class="value-prop-icon">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div>
                            <h4><?php esc_html_e( 'Expert Team', 'acumen-theme' ); ?></h4>
                            <p><?php esc_html_e( 'Certified engineers, IBR welders, project managers and site supervisors with deep domain expertise.', 'acumen-theme' ); ?></p>
                        </div>
                    </div>
                    <div class="value-prop-card">
                        <div class="value-prop-icon">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                        </div>
                        <div>
                            <h4><?php esc_html_e( 'Track Record', 'acumen-theme' ); ?></h4>
                            <p><?php esc_html_e( '200+ projects delivered. Zero compromise on safety or quality. Client retention rate that speaks for itself.', 'acumen-theme' ); ?></p>
                        </div>
                    </div>
                    <div class="value-prop-card">
                        <div class="value-prop-icon">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        </div>
                        <div>
                            <h4><?php esc_html_e( 'Pan-India Reach', 'acumen-theme' ); ?></h4>
                            <p><?php esc_html_e( 'Headquartered in Pune with project execution capability across India\'s major industrial belts.', 'acumen-theme' ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quality Policy -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-badge"><?php esc_html_e( 'Quality Policy', 'acumen-theme' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Our Quality Commitment', 'acumen-theme' ); ?></h2>
            </div>
            <div class="about-quality-grid">
                <div class="about-quality-card">
                    <div class="about-quality-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--acumen-blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3><?php esc_html_e( 'ISO 9001:2015', 'acumen-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Our quality management system is certified to ISO 9001:2015, ensuring consistent processes, documented procedures and continuous improvement.', 'acumen-theme' ); ?></p>
                </div>
                <div class="about-quality-card">
                    <div class="about-quality-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--acumen-blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                    </div>
                    <h3><?php esc_html_e( 'IBR Approved Welding', 'acumen-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Our welders hold IBR approval for pressure equipment welding — a mandatory certification for boiler and pressure vessel fabrication.', 'acumen-theme' ); ?></p>
                </div>
                <div class="about-quality-card">
                    <div class="about-quality-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--acumen-blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3><?php esc_html_e( 'Zero Defect Culture', 'acumen-theme' ); ?></h3>
                    <p><?php esc_html_e( 'We embed quality checks at every stage — from raw material inspection and in-process testing to pre-commissioning trials and final handover.', 'acumen-theme' ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Infrastructure Snapshot -->
    <section class="section-padding bg-white">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-badge"><?php esc_html_e( 'Infrastructure', 'acumen-theme' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Our Facility at a Glance', 'acumen-theme' ); ?></h2>
            </div>
            <div class="stats-grid">
                <div class="stat-item">
                    <strong class="stat-number">6,000</strong>
                    <span class="stat-label"><?php esc_html_e( 'Sq.Ft. Fabrication Shop', 'acumen-theme' ); ?></span>
                </div>
                <div class="stat-item">
                    <strong class="stat-number">25+</strong>
                    <span class="stat-label"><?php esc_html_e( 'Years in Operation', 'acumen-theme' ); ?></span>
                </div>
                <div class="stat-item">
                    <strong class="stat-number">200+</strong>
                    <span class="stat-label"><?php esc_html_e( 'Projects Delivered', 'acumen-theme' ); ?></span>
                </div>
                <div class="stat-item">
                    <strong class="stat-number">25+</strong>
                    <span class="stat-label"><?php esc_html_e( 'Marquee Clients', 'acumen-theme' ); ?></span>
                </div>
                <div class="stat-item">
                    <strong class="stat-number">10</strong>
                    <span class="stat-label"><?php esc_html_e( 'Industry Sectors', 'acumen-theme' ); ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <?php get_template_part( 'template-parts/home/cta-section' ); ?>

</main>

<?php get_footer(); ?>
