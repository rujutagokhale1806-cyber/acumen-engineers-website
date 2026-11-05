<?php
/**
 * Homepage: Company Intro Section
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="section-padding bg-white" aria-label="<?php esc_attr_e( 'About Acumen Engineers', 'acumen-theme' ); ?>">
    <div class="container">
        <div class="intro-grid">

            <!-- Left: Company Story -->
            <div class="intro-content">
                <div class="section-header">
                    <span class="section-badge"><?php esc_html_e( 'About Us', 'acumen-theme' ); ?></span>
                    <h2 class="section-title"><?php esc_html_e( 'Engineering Solutions Built on Trust and Expertise', 'acumen-theme' ); ?></h2>
                    <p class="section-desc">
                        <?php esc_html_e( 'Acumen Engineers is a leading EPC contractor based in Pune, India, delivering complete turnkey industrial solutions with over 25 years of industry experience. We specialise in mechanical fabrication, piping, structural erection, insulation, cabling, and project management.', 'acumen-theme' ); ?>
                    </p>
                </div>
                <p style="color:var(--acumen-slate);line-height:1.7;margin-bottom:16px;">
                    <?php esc_html_e( 'From inception to commissioning, we manage every phase of your industrial project — ensuring quality, safety, and on-time delivery. Our IBR-certified welders, in-house fabrication shop, and dedicated project teams give you a single-source partner you can rely on.', 'acumen-theme' ); ?>
                </p>
                <div class="intro-certs">
                    <span class="cert-badge">&#10003; ISO 9001:2015</span>
                    <span class="cert-badge">&#10003; IBR Approved</span>
                    <span class="cert-badge">&#10003; 6,000 Sq.Ft. Workshop</span>
                </div>
                <div style="margin-top:28px;">
                    <a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>" class="btn btn-primary">
                        <?php esc_html_e( 'Learn More About Us', 'acumen-theme' ); ?> &rarr;
                    </a>
                </div>
            </div>

            <!-- Right: Value Propositions -->
            <div class="intro-value-props">
                <div class="value-prop-card">
                    <div class="value-prop-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                        <h4><?php esc_html_e( 'Just-In-Time Delivery', 'acumen-theme' ); ?></h4>
                        <p><?php esc_html_e( 'We prioritise your schedule. Our project management ensures materials, equipment and manpower arrive exactly when needed.', 'acumen-theme' ); ?></p>
                    </div>
                </div>
                <div class="value-prop-card">
                    <div class="value-prop-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div>
                        <h4><?php esc_html_e( 'Uncompromising Quality', 'acumen-theme' ); ?></h4>
                        <p><?php esc_html_e( 'ISO 9001:2015 certified processes and IBR-approved welding ensure every project meets the highest engineering standards.', 'acumen-theme' ); ?></p>
                    </div>
                </div>
                <div class="value-prop-card">
                    <div class="value-prop-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div>
                        <h4><?php esc_html_e( 'Safety First Culture', 'acumen-theme' ); ?></h4>
                        <p><?php esc_html_e( 'Our teams follow stringent safety protocols on every site, protecting your workforce, plant, and environment at all times.', 'acumen-theme' ); ?></p>
                    </div>
                </div>
            </div>

        </div><!-- .intro-grid -->
    </div><!-- .container -->
</section>
