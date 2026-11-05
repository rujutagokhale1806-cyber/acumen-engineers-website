<?php
/**
 * Default page template
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <!-- Page Banner -->
    <div class="page-hero-banner">
        <div class="container">
            <h1 class="page-hero-title"><?php the_title(); ?></h1>
            <?php acumen_breadcrumb(); ?>
        </div>
    </div>

    <div class="section-padding">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <div class="entry-content acumen-page-content">
                    <?php the_content(); ?>
                </div>
                <?php
                wp_link_pages( array(
                    'before' => '<nav class="page-links">',
                    'after'  => '</nav>',
                ) );
            endwhile;
            ?>
        </div>
    </div>

</main><!-- #primary -->

<?php get_footer(); ?>
