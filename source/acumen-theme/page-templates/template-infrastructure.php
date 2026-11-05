<?php
/**
 * Template Name: Infrastructure
 * Template Post Type: page
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <div class="page-hero-banner">
        <div class="container">
            <h1 class="page-hero-title"><?php esc_html_e( 'Our Infrastructure', 'acumen-theme' ); ?></h1>
            <p class="page-hero-subtitle"><?php esc_html_e( 'State-of-the-art fabrication facility and equipment — the backbone of our quality EPC delivery.', 'acumen-theme' ); ?></p>
            <?php acumen_breadcrumb(); ?>
        </div>
    </div>

    <!-- Facility Overview -->
    <section class="section-padding bg-white">
        <div class="container">
            <div class="intro-grid">
                <div class="intro-content">
                    <div class="section-header">
                        <span class="section-badge"><?php esc_html_e( 'Fabrication Shop', 'acumen-theme' ); ?></span>
                        <h2 class="section-title"><?php esc_html_e( '6,000 Sq.Ft. In-House Fabrication Shop', 'acumen-theme' ); ?></h2>
                    </div>
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        if ( '' !== trim( get_the_content() ) ) :
                            echo '<div class="entry-content acumen-page-content">';
                            the_content();
                            echo '</div>';
                        else :
                    ?>
                    <p style="color:var(--acumen-slate);line-height:1.75;"><?php esc_html_e( 'Our fabrication facility in Pune spans 6,000 sq.ft. and is equipped with modern machinery for precision fabrication of pressure vessels, heat exchangers, piping spools, structural steel and storage tanks.', 'acumen-theme' ); ?></p>
                    <p style="color:var(--acumen-slate);line-height:1.75;"><?php esc_html_e( 'In-house fabrication gives us complete control over material quality, dimensional accuracy, welding procedures and inspection before dispatch to site — eliminating third-party delays and quality risks.', 'acumen-theme' ); ?></p>
                    <?php
                        endif;
                    endwhile;
                    ?>
                    <ul class="infra-feature-list">
                        <li>&#10003; <?php esc_html_e( 'Overhead Crane — Material Handling', 'acumen-theme' ); ?></li>
                        <li>&#10003; <?php esc_html_e( 'Plasma & Gas Cutting Equipment', 'acumen-theme' ); ?></li>
                        <li>&#10003; <?php esc_html_e( 'MIG, TIG & Arc Welding Sets', 'acumen-theme' ); ?></li>
                        <li>&#10003; <?php esc_html_e( 'Hydraulic Press & Bending Machines', 'acumen-theme' ); ?></li>
                        <li>&#10003; <?php esc_html_e( 'Pipe Bending & Forming Equipment', 'acumen-theme' ); ?></li>
                        <li>&#10003; <?php esc_html_e( 'NDT Testing Facilities (DP, RT Arrangement)', 'acumen-theme' ); ?></li>
                        <li>&#10003; <?php esc_html_e( 'Shot Blasting & Surface Preparation', 'acumen-theme' ); ?></li>
                    </ul>
                </div>
                <div class="intro-value-props" style="align-content:start;">
                    <img src="<?php echo esc_url( ACUMEN_THEME_URI . '/assets/images/plant-image-2.jpg' ); ?>"
                         alt="<?php esc_attr_e( 'Acumen Engineers Fabrication Shop', 'acumen-theme' ); ?>"
                         style="width:100%;border-radius:var(--acumen-radius);box-shadow:var(--acumen-shadow-lg);">
                    <img src="<?php echo esc_url( ACUMEN_THEME_URI . '/assets/images/plant-image-3.jpg' ); ?>"
                         alt="<?php esc_attr_e( 'Acumen Engineers Site Work', 'acumen-theme' ); ?>"
                         style="width:100%;border-radius:var(--acumen-radius);box-shadow:var(--acumen-shadow-lg);margin-top:16px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="acumen-stats-section section-padding">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <strong class="stat-number">6,000</strong>
                    <span class="stat-label"><?php esc_html_e( 'Sq.Ft. Workshop Area', 'acumen-theme' ); ?></span>
                </div>
                <div class="stat-item">
                    <strong class="stat-number">25+</strong>
                    <span class="stat-label"><?php esc_html_e( 'Years in Operation', 'acumen-theme' ); ?></span>
                </div>
                <div class="stat-item">
                    <strong class="stat-number">200+</strong>
                    <span class="stat-label"><?php esc_html_e( 'Projects Fabricated', 'acumen-theme' ); ?></span>
                </div>
                <div class="stat-item">
                    <strong class="stat-number">IBR</strong>
                    <span class="stat-label"><?php esc_html_e( 'Certified Welders', 'acumen-theme' ); ?></span>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part( 'template-parts/home/cta-section' ); ?>

</main>

<?php get_footer(); ?>
