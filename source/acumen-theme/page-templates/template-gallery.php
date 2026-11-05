<?php
/**
 * Template Name: Gallery
 * Template Post Type: page
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <div class="page-hero-banner">
        <div class="container">
            <h1 class="page-hero-title"><?php esc_html_e( 'Project Gallery', 'acumen-theme' ); ?></h1>
            <p class="page-hero-subtitle"><?php esc_html_e( 'A visual showcase of our industrial EPC projects, fabrication work and site installations.', 'acumen-theme' ); ?></p>
            <?php acumen_breadcrumb(); ?>
        </div>
    </div>

    <?php
    while ( have_posts() ) :
        the_post();
        if ( '' !== trim( get_the_content() ) ) :
    ?>
    <div class="section-padding bg-white">
        <div class="container">
            <div class="entry-content acumen-page-content"><?php the_content(); ?></div>
        </div>
    </div>
    <?php
        endif;
    endwhile;
    ?>

    <section class="section-padding bg-light">
        <div class="container">

            <!-- Category Filter Buttons -->
            <?php
            $gallery_terms = get_terms( array( 'taxonomy' => 'acumen_gallery_cat', 'hide_empty' => true ) );
            if ( ! is_wp_error( $gallery_terms ) && ! empty( $gallery_terms ) ) :
            ?>
            <div class="gallery-filter-bar" role="group" aria-label="<?php esc_attr_e( 'Filter by category', 'acumen-theme' ); ?>">
                <button class="gallery-filter-btn active" data-filter="*"><?php esc_html_e( 'All', 'acumen-theme' ); ?></button>
                <?php foreach ( $gallery_terms as $term ) : ?>
                    <button class="gallery-filter-btn" data-filter=".cat-<?php echo esc_attr( $term->slug ); ?>">
                        <?php echo esc_html( $term->name ); ?>
                    </button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Gallery Grid -->
            <?php
            $gallery_args = array(
                'post_type'      => 'acumen_gallery',
                'posts_per_page' => 50,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'post_status'    => 'publish',
            );
            $gallery = new WP_Query( $gallery_args );

            if ( $gallery->have_posts() ) :
                echo '<div class="acumen-gallery-grid" id="gallery-grid">';
                while ( $gallery->have_posts() ) :
                    $gallery->the_post();
                    $terms     = get_the_terms( get_the_ID(), 'acumen_gallery_cat' );
                    $cat_class = '';
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        foreach ( $terms as $t ) {
                            $cat_class .= ' cat-' . esc_attr( $t->slug );
                        }
                    }
                    $img_url = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'acumen-card-thumb' ) : esc_url( ACUMEN_THEME_URI . '/assets/images/plant-image-1.jpg' );
                    $full_url = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'full' ) : $img_url;
                    ?>
                    <div class="gallery-item<?php echo esc_attr( $cat_class ); ?>">
                        <a href="<?php echo esc_url( $full_url ); ?>" class="gallery-item-link" data-lightbox="acumen-gallery" data-title="<?php the_title_attribute(); ?>">
                            <img src="<?php echo esc_url( $img_url ); ?>"
                                 alt="<?php the_title_attribute(); ?>"
                                 loading="lazy">
                            <div class="gallery-item-overlay">
                                <span><?php the_title(); ?></span>
                            </div>
                        </a>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                echo '</div>';
            else :
                // Bundled placeholder images
                $plant_imgs = array( 'plant-image-1.jpg', 'plant-image-2.jpg', 'plant-image-3.jpg', 'plant-image-4.jpg' );
                echo '<div class="acumen-gallery-grid">';
                foreach ( $plant_imgs as $img ) {
                    $url = ACUMEN_THEME_URI . '/assets/images/' . $img;
                    echo '<div class="gallery-item">';
                    echo '<a href="' . esc_url( $url ) . '" class="gallery-item-link">';
                    echo '<img src="' . esc_url( $url ) . '" alt="' . esc_attr__( 'Acumen Engineers Project', 'acumen-theme' ) . '" loading="lazy">';
                    echo '<div class="gallery-item-overlay"><span>' . esc_html__( 'Industrial Project', 'acumen-theme' ) . '</span></div>';
                    echo '</a></div>';
                }
                echo '</div>';
                echo '<p style="text-align:center;color:var(--acumen-muted);margin-top:20px;">' . esc_html__( 'Add gallery items from the WordPress admin under Gallery menu.', 'acumen-theme' ) . '</p>';
            endif;
            ?>
        </div>
    </section>

    <?php get_template_part( 'template-parts/home/cta-section' ); ?>

</main>

<?php get_footer(); ?>
