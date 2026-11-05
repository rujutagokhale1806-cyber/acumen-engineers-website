<?php
/**
 * Default single post template
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

    <!-- Page Banner -->
    <div class="page-hero-banner">
        <div class="container">
            <h1 class="page-hero-title"><?php the_title(); ?></h1>
            <p class="page-hero-subtitle">
                <?php esc_html_e( 'Posted on', 'acumen-theme' ); ?>
                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
            </p>
            <?php acumen_breadcrumb(); ?>
        </div>
    </div>

    <div class="section-padding">
        <div class="container">
            <div class="acumen-single-post-layout">
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'acumen-single-article' ); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="single-featured-img">
                            <?php the_post_thumbnail( 'acumen-hero-banner', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-content acumen-page-content" style="margin-top:32px;">
                        <?php the_content(); ?>
                    </div>
                    <?php wp_link_pages( array( 'before' => '<nav class="page-links">', 'after' => '</nav>' ) ); ?>
                </article>
            </div>
        </div>
    </div>

    <?php endwhile; ?>

</main><!-- #primary -->

<?php get_footer(); ?>
