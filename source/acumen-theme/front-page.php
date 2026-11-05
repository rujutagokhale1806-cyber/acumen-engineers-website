<?php
/**
 * Front Page Template (Homepage)
 * Assembles all homepage section template parts.
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <?php
    /**
     * Dual-mode: If page is built with Elementor, render Elementor canvas.
     * Otherwise, render the full PHP section-based homepage.
     */
    $use_elementor = false;
    if ( did_action( 'elementor/loaded' ) && class_exists( '\Elementor\Plugin' ) ) {
        $front_page_id = (int) get_option( 'page_on_front' );
        if ( $front_page_id && \Elementor\Plugin::$instance->documents->get( $front_page_id )->is_built_with_elementor() ) {
            $use_elementor = true;
        }
    }

    if ( $use_elementor ) :
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
    else : ?>

        <?php get_template_part( 'template-parts/home/hero-section' ); ?>
        <?php get_template_part( 'template-parts/home/intro-section' ); ?>
        <?php get_template_part( 'template-parts/home/services-section' ); ?>
        <?php get_template_part( 'template-parts/home/industries-section' ); ?>
        <?php get_template_part( 'template-parts/home/stats-section' ); ?>
        <?php get_template_part( 'template-parts/home/projects-section' ); ?>
        <?php get_template_part( 'template-parts/home/why-choose-section' ); ?>
        <?php get_template_part( 'template-parts/home/clients-section' ); ?>
        <?php get_template_part( 'template-parts/home/cta-section' ); ?>

    <?php endif; ?>

</main><!-- #primary -->

<?php get_footer(); ?>
