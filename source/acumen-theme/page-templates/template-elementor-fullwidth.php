<?php
/**
 * Template Name: Elementor Full-Width
 * Template Post Type: page
 *
 * Full-width Elementor canvas — suppresses page hero banner.
 * Header and footer are preserved so Elementor Full-Width section
 * can stretch edge-to-edge inside the normal chrome.
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main elementor-fullwidth-main" role="main">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</main><!-- #primary -->

<?php get_footer(); ?>
