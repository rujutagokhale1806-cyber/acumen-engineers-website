<?php
/**
 * Single Project template
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

                    <!-- Project Meta -->
                    <?php
                    $client_name  = get_post_meta( get_the_ID(), '_acumen_project_client', true );
                    $proj_loc     = get_post_meta( get_the_ID(), '_acumen_project_location', true );
                    $proj_year    = get_post_meta( get_the_ID(), '_acumen_project_year', true );
                    $proj_scope   = get_post_meta( get_the_ID(), '_acumen_project_scope', true );
                    if ( $client_name || $proj_loc || $proj_year ) :
                    ?>
                    <div class="project-meta-bar">
                        <?php if ( $client_name ) : ?>
                            <div class="project-meta-item">
                                <strong><?php esc_html_e( 'Client', 'acumen-theme' ); ?></strong>
                                <span><?php echo esc_html( $client_name ); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ( $proj_loc ) : ?>
                            <div class="project-meta-item">
                                <strong><?php esc_html_e( 'Location', 'acumen-theme' ); ?></strong>
                                <span><?php echo esc_html( $proj_loc ); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ( $proj_year ) : ?>
                            <div class="project-meta-item">
                                <strong><?php esc_html_e( 'Year', 'acumen-theme' ); ?></strong>
                                <span><?php echo esc_html( $proj_year ); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <div class="entry-content acumen-page-content"><?php the_content(); ?></div>

                    <?php if ( $proj_scope ) : ?>
                        <div class="service-highlights-box" style="margin-top:28px;">
                            <h3><?php esc_html_e( 'Project Scope', 'acumen-theme' ); ?></h3>
                            <div><?php echo wp_kses_post( nl2br( $proj_scope ) ); ?></div>
                        </div>
                    <?php endif; ?>

                    <!-- Gallery Images -->
                    <?php
                    $gallery_ids = get_post_meta( get_the_ID(), '_acumen_project_gallery', true );
                    if ( ! empty( $gallery_ids ) ) :
                        $ids = array_filter( array_map( 'intval', explode( ',', $gallery_ids ) ) );
                        if ( ! empty( $ids ) ) :
                    ?>
                    <div style="margin-top:32px;">
                        <h3><?php esc_html_e( 'Project Gallery', 'acumen-theme' ); ?></h3>
                        <div class="acumen-gallery-grid" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr));">
                            <?php foreach ( $ids as $img_id ) : ?>
                                <div class="gallery-item">
                                    <a href="<?php echo esc_url( wp_get_attachment_url( $img_id ) ); ?>" class="gallery-item-link">
                                        <?php echo wp_get_attachment_image( $img_id, 'acumen-card-thumb', false, array( 'loading' => 'lazy' ) ); ?>
                                        <div class="gallery-item-overlay"><span><?php esc_html_e( 'View', 'acumen-theme' ); ?></span></div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php
                        endif;
                    endif;
                    ?>
                </div>

                <aside class="single-cpt-sidebar">
                    <div class="sidebar-cta-card">
                        <h4><?php esc_html_e( 'Similar Project?', 'acumen-theme' ); ?></h4>
                        <p><?php esc_html_e( 'Talk to our project team about your requirements.', 'acumen-theme' ); ?></p>
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
