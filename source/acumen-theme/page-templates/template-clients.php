<?php
/**
 * Template Name: Clients
 * Template Post Type: page
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <div class="page-hero-banner">
        <div class="container">
            <h1 class="page-hero-title"><?php esc_html_e( 'Our Clients', 'acumen-theme' ); ?></h1>
            <p class="page-hero-subtitle"><?php esc_html_e( 'Trusted by 25+ marquee companies across India\'s leading industrial sectors.', 'acumen-theme' ); ?></p>
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
            <div class="section-header text-center">
                <span class="section-badge"><?php esc_html_e( 'Trusted Partners', 'acumen-theme' ); ?></span>
                <h2 class="section-title"><?php esc_html_e( 'Companies That Trust Acumen', 'acumen-theme' ); ?></h2>
            </div>
            <?php
            if ( shortcode_exists( 'acumen_clients' ) ) {
                echo do_shortcode( '[acumen_clients layout="grid"]' );
            } else {
                $clients = array(
                    'Bharat Forge Ltd', 'Thermax Ltd', 'Forbes Marshall', 'Praj Industries',
                    'Serum Institute of India', 'Lupin Pharmaceuticals', 'Wockhardt Ltd',
                    'IOCL', 'BPCL', 'Tata Chemicals', 'UPL Limited', 'Pidilite Industries',
                    'Kirloskar Brothers', 'Alfa Laval', 'Pentair',
                    'Godrej & Boyce', 'Bajaj Auto', 'Mahindra & Mahindra', 'Bharat Electronics',
                    'Sandvik Asia', 'ISRO', 'DRDO', 'Nuclear Power Corporation', 'HPCL', 'CPCL',
                );
                echo '<div class="clients-grid">';
                foreach ( $clients as $c ) {
                    echo '<div class="client-name-card">' . esc_html( $c ) . '</div>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <?php get_template_part( 'template-parts/home/cta-section' ); ?>

</main>

<?php get_footer(); ?>
