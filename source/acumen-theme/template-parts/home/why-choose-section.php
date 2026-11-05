<?php
/**
 * Homepage: Why Choose Us Section
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="section-padding bg-light" aria-label="<?php esc_attr_e( 'Why Choose Acumen Engineers', 'acumen-theme' ); ?>">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge"><?php esc_html_e( 'Our Advantage', 'acumen-theme' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'Why Choose Acumen Engineers?', 'acumen-theme' ); ?></h2>
            <p class="section-desc"><?php esc_html_e( 'We bring together certified expertise, modern infrastructure, and a commitment to safety — delivering industrial projects of any scale, on time and within budget.', 'acumen-theme' ); ?></p>
        </div>

        <div class="features-grid">

            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                </div>
                <h3 class="feature-title"><?php esc_html_e( '25+ Years of Experience', 'acumen-theme' ); ?></h3>
                <p class="feature-desc"><?php esc_html_e( 'Over two decades of delivering complex EPC projects for India\'s most respected industrial companies. Our experience is your assurance.', 'acumen-theme' ); ?></p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="feature-title"><?php esc_html_e( 'IBR Certified & ISO 9001', 'acumen-theme' ); ?></h3>
                <p class="feature-desc"><?php esc_html_e( 'Our IBR-approved welders and ISO 9001:2015 certified quality management system guarantee that every joint, weld and component meets the highest standards.', 'acumen-theme' ); ?></p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <h3 class="feature-title"><?php esc_html_e( 'In-House Fabrication Facility', 'acumen-theme' ); ?></h3>
                <p class="feature-desc"><?php esc_html_e( 'Our 6,000 sq.ft. fabrication shop in Pune gives us full control over quality, schedule and cost — with no dependence on third-party fabricators.', 'acumen-theme' ); ?></p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <h3 class="feature-title"><?php esc_html_e( 'On-Time Project Delivery', 'acumen-theme' ); ?></h3>
                <p class="feature-desc"><?php esc_html_e( 'We understand that plant downtime is costly. Our project management methodology — built around just-in-time principles — ensures punctual completion.', 'acumen-theme' ); ?></p>
            </div>

        </div><!-- .features-grid -->
    </div>
</section>
