<?php
/**
 * The main template file
 * Used for blog index / archives when no more specific template exists.
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <!-- Page Banner -->
    <div class="page-hero-banner">
        <div class="container">
            <?php if ( is_home() && ! is_front_page() ) : ?>
                <h1 class="page-hero-title"><?php single_post_title(); ?></h1>
            <?php elseif ( is_archive() ) : ?>
                <?php the_archive_title( '<h1 class="page-hero-title">', '</h1>' ); ?>
                <?php the_archive_description( '<p class="page-hero-subtitle">', '</p>' ); ?>
            <?php else : ?>
                <h1 class="page-hero-title"><?php esc_html_e( 'Latest News', 'acumen-theme' ); ?></h1>
            <?php endif; ?>
            <?php acumen_breadcrumb(); ?>
        </div>
    </div>

    <section class="section-padding bg-light">
        <div class="container">
            <?php if ( have_posts() ) : ?>

                <div class="acumen-post-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'acumen-post-card' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="post-card-thumb">
                                    <?php the_post_thumbnail( 'acumen-card-thumb', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
                                </a>
                            <?php endif; ?>
                            <div class="post-card-body">
                                <div class="post-card-meta">
                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                                </div>
                                <h2 class="post-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="post-card-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm"><?php esc_html_e( 'Read More', 'acumen-theme' ); ?></a>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div><!-- .acumen-post-grid -->

                <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>

            <?php else : ?>
                <?php get_template_part( 'template-parts/content/content-none' ); ?>
            <?php endif; ?>
        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
