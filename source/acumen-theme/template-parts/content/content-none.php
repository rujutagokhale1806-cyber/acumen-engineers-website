<?php
/**
 * Content None: Displayed when no posts found
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="content-none-wrap">
    <div class="content-none-icon" aria-hidden="true">
        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="var(--acumen-blue)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
    </div>
    <h2><?php esc_html_e( 'Nothing Found', 'acumen-theme' ); ?></h2>
    <?php if ( is_search() ) : ?>
        <p><?php esc_html_e( 'No results were found for your search. Please try different keywords.', 'acumen-theme' ); ?></p>
        <?php get_search_form(); ?>
    <?php else : ?>
        <p><?php esc_html_e( 'It seems there is no content here yet. Please check back soon.', 'acumen-theme' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Return to Homepage', 'acumen-theme' ); ?></a>
    <?php endif; ?>
</div>
