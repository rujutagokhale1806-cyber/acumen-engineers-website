<?php
/**
 * Footer template part: Site Footer
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$company_name   = acumen_get_option( 'company_name', 'Acumen Engineers' );
$tagline        = acumen_get_option( 'tagline', 'Turnkey Project Solutions' );
$phone_land     = acumen_get_option( 'phone_landline', '+91 20 2765 8234' );
$phone_mob1     = acumen_get_option( 'phone_mobile_1', '+91 9423 019 234' );
$phone_mob2     = acumen_get_option( 'phone_mobile_2', '+91 98509 57425' );
$email_primary  = acumen_get_option( 'email_primary', 'info@acumenengineers.in' );
$corp_address   = acumen_get_option( 'corp_address', '#7, Gnd Floor, Sant Dnyaneshwar Sankul, Sector 28, P.C.N.T.D.A. Nigdi, Pune – 411 044, Maharashtra, INDIA' );
$whatsapp_no    = acumen_get_option( 'whatsapp_number', '919423019234' );
$current_year   = date( 'Y' );
?>

<footer id="colophon" class="site-footer" role="contentinfo">

    <!-- Footer Top: Main Columns -->
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">

                <!-- Column 1: About / Brand -->
                <div class="footer-col footer-about">
                    <?php acumen_the_footer_logo(); ?>
                    <p><?php echo esc_html( $tagline ); ?></p>
                    <p><?php esc_html_e( 'ISO-certified EPC contractor delivering turnkey industrial projects across India with excellence in fabrication, piping, erection and commissioning.', 'acumen-theme' ); ?></p>
                    <div class="footer-badges">
                        <span class="footer-trust-badge">&#10003; IBR Approved</span>
                        <span class="footer-trust-badge">&#10003; ISO 9001:2015</span>
                        <span class="footer-trust-badge">&#10003; 25+ Years</span>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="footer-col footer-links">
                    <h4><?php esc_html_e( 'Quick Links', 'acumen-theme' ); ?></h4>
                    <?php
                    if ( has_nav_menu( 'footer-menu' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'footer-menu',
                            'menu_class'     => 'footer-nav-list',
                            'container'      => false,
                            'depth'          => 1,
                            'link_before'    => '<span>&#8250;</span> ',
                            'fallback_cb'    => false,
                        ) );
                    } else {
                        // Fallback static links
                        $quick_links = array(
                            __( 'Home', 'acumen-theme' )           => home_url( '/' ),
                            __( 'About Us', 'acumen-theme' )       => home_url( '/about-us/' ),
                            __( 'Services', 'acumen-theme' )       => home_url( '/services/' ),
                            __( 'Industries', 'acumen-theme' )     => home_url( '/industries/' ),
                            __( 'Infrastructure', 'acumen-theme' ) => home_url( '/infrastructure/' ),
                            __( 'Clients', 'acumen-theme' )        => home_url( '/clients/' ),
                            __( 'Gallery', 'acumen-theme' )        => home_url( '/gallery/' ),
                            __( 'Contact Us', 'acumen-theme' )     => home_url( '/contact/' ),
                        );
                        echo '<ul class="footer-nav-list">';
                        foreach ( $quick_links as $label => $url ) {
                            echo '<li><a href="' . esc_url( $url ) . '"><span>&#8250;</span> ' . esc_html( $label ) . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>

                <!-- Column 3: Our Services -->
                <div class="footer-col footer-links">
                    <h4><?php esc_html_e( 'Our Services', 'acumen-theme' ); ?></h4>
                    <?php
                    // Try to pull from CPT; fallback to static list
                    $service_args = array(
                        'post_type'      => 'acumen_service',
                        'posts_per_page' => 8,
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC',
                        'post_status'    => 'publish',
                    );
                    $services = new WP_Query( $service_args );
                    if ( $services->have_posts() ) {
                        echo '<ul class="footer-nav-list">';
                        while ( $services->have_posts() ) {
                            $services->the_post();
                            echo '<li><a href="' . esc_url( get_permalink() ) . '"><span>&#8250;</span> ' . esc_html( get_the_title() ) . '</a></li>';
                        }
                        wp_reset_postdata();
                        echo '</ul>';
                    } else {
                        $static_services = array(
                            'Mechanical Fabrication',
                            'Piping Works',
                            'Structural Erection',
                            'Insulation Works',
                            'Electrical Cabling',
                            'Mechanical Maintenance',
                            'Project Management',
                            'Supply of Goods',
                        );
                        echo '<ul class="footer-nav-list">';
                        foreach ( $static_services as $svc ) {
                            echo '<li><a href="' . esc_url( home_url( '/services/' ) ) . '"><span>&#8250;</span> ' . esc_html( $svc ) . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>

                <!-- Column 4: Contact Information -->
                <div class="footer-col footer-contact">
                    <h4><?php esc_html_e( 'Contact Us', 'acumen-theme' ); ?></h4>

                    <div class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </span>
                        <div>
                            <strong style="color:#CBD5E1;display:block;margin-bottom:4px;"><?php esc_html_e( 'Corporate Office', 'acumen-theme' ); ?></strong>
                            <?php echo esc_html( $corp_address ); ?>
                        </div>
                    </div>

                    <div class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.63 3.36 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.58a16 16 0 0 0 5.71 5.71l.9-.9a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21 16.92z"/></svg>
                        </span>
                        <div>
                            <a href="tel:<?php echo esc_attr( acumen_phone_clean( $phone_land ) ); ?>"><?php echo esc_html( $phone_land ); ?></a><br>
                            <a href="tel:<?php echo esc_attr( acumen_phone_clean( $phone_mob1 ) ); ?>"><?php echo esc_html( $phone_mob1 ); ?></a><br>
                            <a href="tel:<?php echo esc_attr( acumen_phone_clean( $phone_mob2 ) ); ?>"><?php echo esc_html( $phone_mob2 ); ?></a>
                        </div>
                    </div>

                    <div class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </span>
                        <div>
                            <a href="mailto:<?php echo esc_attr( $email_primary ); ?>"><?php echo esc_html( $email_primary ); ?></a>
                        </div>
                    </div>

                    <?php if ( $whatsapp_no ) : ?>
                    <div style="margin-top:20px;">
                        <a href="https://wa.me/<?php echo esc_attr( $whatsapp_no ); ?>?text=<?php echo esc_attr( urlencode( 'Hello, I would like to enquire about your services.' ) ); ?>"
                           class="btn btn-sm"
                           style="background:#25D366;color:#fff;border-color:#25D366;gap:8px;"
                           target="_blank"
                           rel="noopener noreferrer">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            <?php esc_html_e( 'WhatsApp Enquiry', 'acumen-theme' ); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

            </div><!-- .footer-grid -->
        </div><!-- .container -->
    </div><!-- .footer-top -->

    <!-- Footer Bottom Bar -->
    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copy">
                &copy; <?php echo esc_html( $current_year ); ?>
                <strong style="color:#CBD5E1;"><?php echo esc_html( $company_name ); ?></strong>.
                <?php esc_html_e( 'All Rights Reserved.', 'acumen-theme' ); ?>
                &nbsp;|&nbsp; <?php esc_html_e( 'Turnkey Project Solutions — Pune, India', 'acumen-theme' ); ?>
            </p>
            <p class="footer-badge-text">
                &#9889; <?php esc_html_e( 'Engineering Excellence. Delivered On Time.', 'acumen-theme' ); ?>
            </p>
        </div>
    </div><!-- .footer-bottom -->

</footer><!-- #colophon -->
