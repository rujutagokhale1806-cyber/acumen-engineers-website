<?php
/**
 * Homepage: Projects Section
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="section-padding bg-white" aria-label="<?php esc_attr_e( 'Featured Projects', 'acumen-theme' ); ?>">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge"><?php esc_html_e( 'Our Work', 'acumen-theme' ); ?></span>
            <h2 class="section-title"><?php esc_html_e( 'Featured Projects', 'acumen-theme' ); ?></h2>
            <p class="section-desc"><?php esc_html_e( 'A selection of turnkey EPC projects we have delivered across industrial sectors in India.', 'acumen-theme' ); ?></p>
        </div>

        <?php
        if ( shortcode_exists( 'acumen_projects' ) ) {
            echo do_shortcode( '[acumen_projects count="6" columns="3"]' );
        } else {
            $args = array(
                'post_type'      => 'acumen_project',
                'posts_per_page' => 6,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'post_status'    => 'publish',
            );
            $projects = new WP_Query( $args );
            if ( $projects->have_posts() ) {
                echo '<div class="acumen-projects-grid">';
                while ( $projects->have_posts() ) {
                    $projects->the_post();
                    $thumb = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'acumen-card-thumb' ) : '';
                    echo '<div class="project-card">';
                    if ( $thumb ) {
                        echo '<div class="project-card-img" style="background-image:url(' . esc_url( $thumb ) . ')"></div>';
                    }
                    echo '<div class="project-card-body">';
                    echo '<h3 class="project-card-title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3>';
                    echo '<p class="project-card-excerpt">' . esc_html( wp_trim_words( get_the_excerpt(), 15 ) ) . '</p>';
                    echo '<a href="' . esc_url( get_permalink() ) . '" class="btn btn-sm btn-primary">' . esc_html__( 'View Project', 'acumen-theme' ) . '</a>';
                    echo '</div></div>';
                }
                wp_reset_postdata();
                echo '</div>';
            } else {
                // Image-based placeholder grid using bundled images
                $imgs = array(
                    ACUMEN_THEME_URI . '/assets/images/plant-image-1.jpg',
                    ACUMEN_THEME_URI . '/assets/images/plant-image-2.jpg',
                    ACUMEN_THEME_URI . '/assets/images/plant-image-3.jpg',
                    ACUMEN_THEME_URI . '/assets/images/plant-image-4.jpg',
                );
                $placeholders = array(
                    array( 'title' => 'Pharmaceutical Plant Piping', 'desc' => 'Complete process piping for a Pune-based pharma facility.' ),
                    array( 'title' => 'Chemical Plant Erection',     'desc' => 'Structural erection and commissioning for a Gujarat chemical plant.' ),
                    array( 'title' => 'Distillery EPC Project',      'desc' => 'Turnkey distillery piping and equipment installation.' ),
                    array( 'title' => 'Refinery Maintenance',        'desc' => 'Planned shutdown and maintenance of refinery equipment.' ),
                );
                echo '<div class="acumen-projects-grid">';
                foreach ( $placeholders as $i => $ph ) {
                    $img = $imgs[ $i % count( $imgs ) ];
                    echo '<div class="project-card">';
                    echo '<div class="project-card-img" style="background-image:url(' . esc_url( $img ) . ')"></div>';
                    echo '<div class="project-card-body">';
                    echo '<h3 class="project-card-title">' . esc_html( $ph['title'] ) . '</h3>';
                    echo '<p class="project-card-excerpt">' . esc_html( $ph['desc'] ) . '</p>';
                    echo '<a href="' . esc_url( home_url( '/gallery/' ) ) . '" class="btn btn-sm btn-primary">' . esc_html__( 'View Gallery', 'acumen-theme' ) . '</a>';
                    echo '</div></div>';
                }
                echo '</div>';
            }
        }
        ?>

        <div style="text-align:center;margin-top:40px;">
            <a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn-primary btn-lg">
                <?php esc_html_e( 'View All Projects', 'acumen-theme' ); ?>
            </a>
        </div>
    </div>
</section>
