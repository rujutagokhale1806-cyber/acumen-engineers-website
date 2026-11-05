<?php
/**
 * Search results template
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <div class="page-hero-banner">
        <div class="container">
            <h1 class="page-hero-title">
                <?php
                /* translators: %s: search query */
                printf( esc_html__( 'Search Results: &ldquo;%s&rdquo;', 'acumen-theme' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
                ?>
            </h1>
            <?php acumen_breadcrumb(); ?>
        </div>
    </div>

    <section class="section-padding bg-light">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <p style="color:var(--acumen-muted);margin-bottom:30px;">
                    <?php
                    global $wp_query;
                    printf(
                        /* translators: %d: number of results */
                        esc_html( _n( '%d result found', '%d results found', (int) $wp_query->found_posts, 'acumen-theme' ) ),
                        (int) $wp_query->found_posts
                    );
                    ?>
                </p>
                <div class="acumen-post-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'acumen-post-card' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="post-card-thumb">
                                    <?php the_post_thumbnail( 'acumen-card-thumb', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
                                </a>
                            <?php endif; ?>
                            <div class="post-card-body">
                                <h2 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="post-card-excerpt"><?php the_excerpt(); ?></div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm"><?php esc_html_e( 'View Page', 'acumen-theme' ); ?></a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
            <?php else : ?>
                <div class="content-none-wrap">
                    <h2><?php esc_html_e( 'Nothing found', 'acumen-theme' ); ?></h2>
                    <p><?php esc_html_e( 'No results matched your search. Try different keywords.', 'acumen-theme' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
