<?php
/**
 * Single Industry template
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

    <div class="page-hero-banner">
        <div class="container">
            <h1 class="page-hero-title"><?php the_title(); ?></h1>
            <?php
            $subtitle = get_post_meta( get_the_ID(), '_acumen_industry_subtitle', true );
            if ( $subtitle ) {
                echo '<p class="page-hero-subtitle">' . esc_html( $subtitle ) . '</p>';
            }
            ?>
            <?php acumen_breadcrumb(); ?>
        </div>
    </div>

    <div class="section-padding">
        <div class="container">
            <div class="single-cpt-layout">
                <div class="single-cpt-content">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div style="margin-bottom:32px;">
                            <?php the_post_thumbnail( 'acumen-hero-banner', array( 'style' => 'width:100%;border-radius:var(--acumen-radius);', 'alt' => esc_attr( get_the_title() ) ) ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-content acumen-page-content"><?php the_content(); ?></div>

                    <!-- Related Projects in this sector -->
                    <?php
                    $sector_terms = get_the_terms( get_the_ID(), 'acumen_sector' );
                    if ( $sector_terms && ! is_wp_error( $sector_terms ) ) :
                        $sector_ids = wp_list_pluck( $sector_terms, 'term_id' );
                        $related_proj = new WP_Query( array(
                            'post_type'      => 'acumen_project',
                            'posts_per_page' => 3,
                            'tax_query'      => array( array( 'taxonomy' => 'acumen_sector', 'field' => 'term_id', 'terms' => $sector_ids ) ),
                            'post_status'    => 'publish',
                        ) );
                        if ( $related_proj->have_posts() ) :
                    ?>
                    <div style="margin-top:40px;">
                        <h3><?php esc_html_e( 'Related Projects', 'acumen-theme' ); ?></h3>
                        <div class="acumen-projects-grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr));">
                            <?php while ( $related_proj->have_posts() ) : $related_proj->the_post(); ?>
                                <div class="project-card">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="project-card-img" style="background-image:url(<?php echo esc_url( get_the_post_thumbnail_url( null, 'acumen-card-thumb' ) ); ?>)"></div>
                                    <?php endif; ?>
                                    <div class="project-card-body">
                                        <h4 class="project-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary"><?php esc_html_e( 'View Project', 'acumen-theme' ); ?></a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php
                        wp_reset_postdata();
                        endif;
                    endif;
                    ?>
                </div>

                <aside class="single-cpt-sidebar">
                    <div class="sidebar-cta-card">
                        <h4><?php esc_html_e( 'Operating in This Sector?', 'acumen-theme' ); ?></h4>
                        <p><?php esc_html_e( 'Tell us about your project and we will provide a tailored EPC solution.', 'acumen-theme' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary" style="width:100%;justify-content:center;"><?php esc_html_e( 'Request a Quote', 'acumen-theme' ); ?></a>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <?php endwhile; ?>

    <?php get_template_part( 'template-parts/home/cta-section' ); ?>

</main>

<?php get_footer(); ?>
