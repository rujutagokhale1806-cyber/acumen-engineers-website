<?php
/**
 * Template Name: Contact Us
 * Template Post Type: page
 *
 * @package Acumen_Theme
 */

get_header();

$corp_address = acumen_get_option( 'corp_address', '#7, Gnd Floor, Sant Dnyaneshwar Sankul, Sector 28, P.C.N.T.D.A. Nigdi, Pune – 411 044, Maharashtra, INDIA' );
$regd_address = acumen_get_option( 'regd_address', 'Shreeram Niwas, Plot No. 124, Sr. No. 35/7, Dattawadi, Akurdi, Pune - 411 035, Maharashtra, INDIA' );
$phone_land   = acumen_get_option( 'phone_landline', '+91 20 2765 8234' );
$phone_mob1   = acumen_get_option( 'phone_mobile_1', '+91 9423 019 234' );
$phone_mob2   = acumen_get_option( 'phone_mobile_2', '+91 98509 57425' );
$email        = acumen_get_option( 'email_primary', 'info@acumenengineers.in' );
$whatsapp_no  = acumen_get_option( 'whatsapp_number', '919423019234' );
?>

<main id="primary" class="site-main" role="main">

    <div class="page-hero-banner">
        <div class="container">
            <h1 class="page-hero-title"><?php esc_html_e( 'Contact Us', 'acumen-theme' ); ?></h1>
            <p class="page-hero-subtitle"><?php esc_html_e( 'Get in touch for enquiries, project quotations, or general information. We respond within 24 hours.', 'acumen-theme' ); ?></p>
            <?php acumen_breadcrumb(); ?>
        </div>
    </div>

    <!-- Address Cards -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-badge"><?php esc_html_e( 'Find Us', 'acumen-theme' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Our Offices', 'acumen-theme' ); ?></h2>
            </div>
            <div class="contact-offices-grid">

                <div class="contact-office-card">
                    <div class="contact-office-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--acumen-blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h3><?php esc_html_e( 'Corporate Office', 'acumen-theme' ); ?></h3>
                    <address>
                        <?php echo nl2br( esc_html( $corp_address ) ); ?>
                    </address>
                    <div class="contact-office-phones">
                        <a href="tel:<?php echo esc_attr( acumen_phone_clean( $phone_land ) ); ?>"><?php echo esc_html( $phone_land ); ?></a>
                        <a href="tel:<?php echo esc_attr( acumen_phone_clean( $phone_mob1 ) ); ?>"><?php echo esc_html( $phone_mob1 ); ?></a>
                    </div>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact-office-email"><?php echo esc_html( $email ); ?></a>
                </div>

                <div class="contact-office-card">
                    <div class="contact-office-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--acumen-blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <h3><?php esc_html_e( 'Registered Office', 'acumen-theme' ); ?></h3>
                    <address>
                        <?php echo nl2br( esc_html( $regd_address ) ); ?>
                    </address>
                    <div class="contact-office-phones">
                        <a href="tel:<?php echo esc_attr( acumen_phone_clean( $phone_mob2 ) ); ?>"><?php echo esc_html( $phone_mob2 ); ?></a>
                    </div>
                </div>

                <div class="contact-office-card">
                    <div class="contact-office-icon" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--acumen-blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    </div>
                    <h3><?php esc_html_e( 'Fabrication Shop', 'acumen-theme' ); ?></h3>
                    <address>
                        <?php esc_html_e( '6,000 Sq.Ft. Fabrication Shop, Pune, Maharashtra, INDIA', 'acumen-theme' ); ?>
                    </address>
                    <p style="color:var(--acumen-muted);font-size:14px;margin-top:12px;">
                        <?php esc_html_e( 'In-house fabrication facility for pressure vessels, heat exchangers, piping spools and structural components.', 'acumen-theme' ); ?>
                    </p>
                </div>

            </div><!-- .contact-offices-grid -->
        </div>
    </section>

    <!-- RFQ Form -->
    <section class="section-padding bg-white">
        <div class="container">
            <div class="contact-rfq-layout">
                <div class="contact-rfq-intro">
                    <div class="section-header">
                        <span class="section-badge"><?php esc_html_e( 'Enquiry Form', 'acumen-theme' ); ?></span>
                        <h2 class="section-title"><?php esc_html_e( 'Send Us an Enquiry', 'acumen-theme' ); ?></h2>
                        <p class="section-desc"><?php esc_html_e( 'Fill in the form and we will get back to you within 24 hours with an initial assessment or quotation.', 'acumen-theme' ); ?></p>
                    </div>

                    <?php if ( $whatsapp_no ) : ?>
                    <a href="https://wa.me/<?php echo esc_attr( $whatsapp_no ); ?>?text=<?php echo esc_attr( urlencode( 'Hello, I would like to enquire about your EPC services.' ) ); ?>"
                       class="btn btn-lg"
                       style="background:#25D366;color:#fff;border-color:#25D366;margin-top:8px;"
                       target="_blank"
                       rel="noopener noreferrer">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                        <?php esc_html_e( 'Chat on WhatsApp', 'acumen-theme' ); ?>
                    </a>
                    <?php endif; ?>
                </div>

                <div class="contact-rfq-form">
                    <?php
                    if ( shortcode_exists( 'acumen_rfq_form' ) ) {
                        echo do_shortcode( '[acumen_rfq_form]' );
                    } else {
                        echo '<p style="color:var(--acumen-muted)">' . esc_html__( 'Enquiry form coming soon. Please email us directly.', 'acumen-theme' ) . '</p>';
                    }
                    ?>
                </div>
            </div><!-- .contact-rfq-layout -->
        </div>
    </section>

    <!-- Map Placeholder -->
    <section style="background:var(--acumen-navy-dark);padding:8px 0;" aria-label="<?php esc_attr_e( 'Location Map', 'acumen-theme' ); ?>">
        <div class="container" style="text-align:center;padding-top:40px;padding-bottom:40px;">
            <p style="color:#94A3B8;margin-bottom:24px;"><?php esc_html_e( 'Find us at our Corporate Office in Nigdi, Pune, Maharashtra', 'acumen-theme' ); ?></p>
            <a href="https://maps.google.com/?q=P.C.N.T.D.A.+Nigdi+Pune+Maharashtra+India"
               class="btn btn-outline-white"
               target="_blank"
               rel="noopener noreferrer">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <?php esc_html_e( 'View on Google Maps', 'acumen-theme' ); ?>
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
