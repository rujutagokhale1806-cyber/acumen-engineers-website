<?php
/**
 * Single Service template
 *
 * @package Acumen_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

    <div class="page-hero-banner">
        <div class="container">
            <?php
            $icon_name = get_post_meta( get_the_ID(), '_acumen_service_icon', true );
            if ( $icon_name ) {
                $svg = acumen_get_svg_icon( $icon_name, 'services' );
                if ( $svg ) {
                    echo '<div style="margin-bottom:16px;width:56px;height:56px;background:rgba(245,158,11,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--acumen-accent);">' . $svg . '</div>'; // phpcs:ignore
                }
            }
            ?>
            <h1 class="page-hero-title"><?php the_title(); ?></h1>
            <?php
            $subtitle = get_post_meta( get_the_ID(), '_acumen_service_subtitle', true );
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
                <!-- Main Content -->
                <div class="single-cpt-content">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div style="margin-bottom:32px;">
                            <?php the_post_thumbnail( 'acumen-hero-banner', array( 'style' => 'width:100%;border-radius:var(--acumen-radius);', 'alt' => esc_attr( get_the_title() ) ) ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content acumen-page-content">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    $highlights = get_post_meta( get_the_ID(), '_acumen_service_highlights', true );
                    if ( $highlights ) :
                        $items = array_filter( array_map( 'trim', explode( "\n", $highlights ) ) );
                        if ( ! empty( $items ) ) :
                    ?>
                    <div class="service-highlights-box" style="margin-top:32px;">
                        <h3><?php esc_html_e( 'Key Highlights', 'acumen-theme' ); ?></h3>
                        <ul class="infra-feature-list">
                            <?php foreach ( $items as $item ) : ?>
                                <li>&#10003; <?php echo esc_html( $item ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php
                        endif;
                    endif;
                    ?>
                </div>

                <!-- Sidebar: Contact CTA -->
                <aside class="single-cpt-sidebar">
                    <div class="sidebar-cta-card">
                        <h4><?php esc_html_e( 'Need This Service?', 'acumen-theme' ); ?></h4>
                        <p><?php esc_html_e( 'Our team is ready to discuss your project requirements and provide a competitive quotation.', 'acumen-theme' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:12px;"><?php esc_html_e( 'Request a Quote', 'acumen-theme' ); ?></a>
                        <?php
                        $wa = acumen_get_option( 'whatsapp_number', '919423019234' );
                        if ( $wa ) :
                        ?>
                        <a href="https://wa.me/<?php echo esc_attr( $wa ); ?>?text=<?php echo esc_attr( urlencode( 'Hello, I need a quote for: ' . get_the_title() ) ); ?>"
                           class="btn"
                           style="width:100%;justify-content:center;background:#25D366;color:#fff;border-color:#25D366;"
                           target="_blank" rel="noopener noreferrer">
                           <?php esc_html_e( 'WhatsApp Enquiry', 'acumen-theme' ); ?>
                        </a>
                        <?php endif; ?>
                    </div>

                    <!-- Related Services -->
                    <?php
                    $related = new WP_Query( array(
                        'post_type'      => 'acumen_service',
                        'posts_per_page' => 5,
                        'post__not_in'   => array( get_the_ID() ),
                        'orderby'        => 'rand',
                        'post_status'    => 'publish',
                    ) );
                    if ( $related->have_posts() ) :
                    ?>
                    <div class="sidebar-related" style="margin-top:24px;">
                        <h4 style="color:var(--acumen-navy);margin-bottom:16px;"><?php esc_html_e( 'Other Services', 'acumen-theme' ); ?></h4>
                        <ul style="list-style:none;padding:0;margin:0;">
                            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                                <li style="margin-bottom:10px;">
                                    <a href="<?php the_permalink(); ?>" style="color:var(--acumen-blue);text-decoration:none;font-weight:600;">&#8250; <?php the_title(); ?></a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <?php
                    wp_reset_postdata();
                    endif;
                    ?>
                </aside>
            </div>
        </div>
    </div>

    <?php endwhile; ?>

    <?php get_template_part( 'template-parts/home/cta-section' ); ?>

</main>

<?php get_footer(); ?>
