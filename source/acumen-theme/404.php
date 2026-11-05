<?php
/**
 * 404 error page
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <div class="page-hero-banner">
        <div class="container">
            <h1 class="page-hero-title"><?php esc_html_e( 'Page Not Found', 'acumen-theme' ); ?></h1>
            <p class="page-hero-subtitle"><?php esc_html_e( 'The page you are looking for may have been moved or does not exist.', 'acumen-theme' ); ?></p>
        </div>
    </div>

    <section class="section-padding">
        <div class="container">
            <div class="acumen-404-wrap">
                <div class="acumen-404-icon" aria-hidden="true">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="var(--acumen-blue)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                </div>
                <h2 class="acumen-404-code">404</h2>
                <p class="acumen-404-msg"><?php esc_html_e( 'The page you\'re looking for can\'t be found. It may have been moved, renamed, or removed.', 'acumen-theme' ); ?></p>
                <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:32px;">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-lg">
                        &#8592; <?php esc_html_e( 'Back to Homepage', 'acumen-theme' ); ?>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline btn-lg">
                        <?php esc_html_e( 'Contact Us', 'acumen-theme' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
