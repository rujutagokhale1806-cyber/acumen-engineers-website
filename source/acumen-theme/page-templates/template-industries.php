<?php
/**
 * Template Name: Industries Hub
 * Template Post Type: page
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <div class="page-hero-banner">
        <div class="container">
            <h1 class="page-hero-title"><?php esc_html_e( 'Industries We Serve', 'acumen-theme' ); ?></h1>
            <p class="page-hero-subtitle"><?php esc_html_e( 'From pharmaceutical to oil & gas, we bring specialised EPC expertise to 10+ industrial sectors across India.', 'acumen-theme' ); ?></p>
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
            <?php
            if ( shortcode_exists( 'acumen_industries' ) ) {
                echo do_shortcode( '[acumen_industries columns="4"]' );
            } else {
                echo '<p style="color:var(--acumen-muted)">' . esc_html__( 'Industries listing coming soon.', 'acumen-theme' ) . '</p>';
            }
            ?>
        </div>
    </section>

    <?php get_template_part( 'template-parts/home/cta-section' ); ?>

</main>

<?php get_footer(); ?>
