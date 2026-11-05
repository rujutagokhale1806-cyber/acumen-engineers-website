
<?php
/**
 * Archive template
 *
 * @package Acumen_Theme
 */

get_header();

// Set professional archive titles.
$archive_heading = '';

if ( is_post_type_archive( 'acumen_service' ) ) {
    $archive_heading = 'Our Services';
} elseif ( is_post_type_archive( 'acumen_industry' ) ) {
    $archive_heading = 'Industries';
} elseif ( is_post_type_archive( 'acumen_client' ) ) {
    $archive_heading = 'Our Clients';
} elseif ( is_post_type_archive( 'acumen_project' ) ) {
    $archive_heading = 'Our Projects';
} elseif ( is_post_type_archive( 'acumen_gallery' ) ) {
    $archive_heading = 'Project Gallery';
} elseif ( is_category() || is_tag() || is_tax() ) {
    $archive_heading = single_term_title( '', false );
} else {
    $archive_heading = 'Explore Acumen Engineers';
}
?>

<main id="primary" class="site-main" role="main">

    <!-- Archive Hero -->
    <div class="page-hero-banner">
        <div class="container">

            <h1 class="page-hero-title">
                <?php echo esc_html( $archive_heading ); ?>
            </h1>

            <?php if ( get_the_archive_description() ) : ?>
                <div class="page-hero-subtitle">
                    <?php the_archive_description(); ?>
                </div>
            <?php endif; ?>

            <?php acumen_breadcrumb(); ?>

        </div>
    </div>

    <!-- Archive Content -->
    <section class="section-padding bg-light">
        <div class="container">

            <?php if ( have_posts() ) : ?>

                <div class="acumen-post-grid">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'acumen-post-card' ); ?>>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="post-card-thumb">
                                    <?php
                                    the_post_thumbnail(
                                        'acumen-card-thumb',
                                        array(
                                            'alt' => esc_attr( get_the_title() ),
                                        )
                                    );
                                    ?>
                                </a>
                            <?php endif; ?>

                            <div class="post-card-body">

                                <h2 class="post-card-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <div class="post-card-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>

                                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">
                                    <?php esc_html_e( 'Read More', 'acumen-theme' ); ?>
                                </a>

                            </div>
                        </article>

                    <?php endwhile; ?>

                </div>

                <?php
                the_posts_pagination(
                    array(
                        'mid_size' => 2,
                    )
                );
                ?>

            <?php else : ?>

                <?php get_template_part( 'template-parts/content/content-none' ); ?>

            <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
