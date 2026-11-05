<?php
/**
 * Frontend Shortcodes Class
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Acumen_Shortcodes {

    public function __construct() {
        add_shortcode( 'acumen_services', array( $this, 'render_services' ) );
        add_shortcode( 'acumen_industries', array( $this, 'render_industries' ) );
        add_shortcode( 'acumen_clients', array( $this, 'render_clients' ) );
        add_shortcode( 'acumen_projects', array( $this, 'render_projects' ) );
        add_shortcode( 'acumen_stats', array( $this, 'render_stats' ) );
        add_shortcode( 'acumen_rfq_form', array( $this, 'render_rfq_form' ) );
        add_shortcode( 'acumen_whatsapp', array( $this, 'render_whatsapp' ) );
    }

    /**
     * Services Shortcode: [acumen_services columns="3" count="9"]
     */
    public function render_services( $atts ) {
        $atts = shortcode_atts( array(
            'columns' => 3,
            'count'   => 9,
        ), $atts, 'acumen_services' );

        $query = new WP_Query( array(
            'post_type'      => 'acumen_service',
            'posts_per_page' => intval( $atts['count'] ),
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
        ) );

        if ( ! $query->have_posts() ) {
            return '<p class="acumen-no-items">' . esc_html__( 'No services found.', 'acumen-core' ) . '</p>';
        }

        ob_start();
        ?>
        <div class="acumen-services-grid acumen-cols-<?php echo esc_attr( $atts['columns'] ); ?>">
            <?php while ( $query->have_posts() ) : $query->the_post();
                $icon       = get_post_meta( get_the_ID(), '_acumen_service_icon', true );
                $highlights = get_post_meta( get_the_ID(), '_acumen_service_highlights', true );
                $lines      = array_filter( array_map( 'trim', explode( "\n", $highlights ) ) );
            ?>
                <div class="acumen-service-card">
                    <div class="acumen-service-header">
                        <?php if ( $icon ) : ?>
                            <div class="acumen-service-icon">
                                <?php if ( strpos( $icon, 'service-' ) === 0 ) :
                                    $svg_path = ACUMEN_CORE_PATH . 'assets/icons/services/' . $icon . '.svg';
                                    if ( file_exists( $svg_path ) ) {
                                        echo file_get_contents( $svg_path ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    } else {
                                        echo '<span class="dashicons dashicons-hammer"></span>';
                                    }
                                else : ?>
                                    <span class="dashicons <?php echo esc_attr( $icon ); ?>"></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <h3 class="acumen-service-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </div>
                    <div class="acumen-service-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <?php if ( ! empty( $lines ) ) : ?>
                        <ul class="acumen-service-highlights">
                            <?php foreach ( array_slice( $lines, 0, 3 ) as $item ) : ?>
                                <li><?php echo esc_html( $item ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>" class="acumen-btn-link"><?php esc_html_e( 'Learn More &rarr;', 'acumen-core' ); ?></a>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Industries Shortcode: [acumen_industries columns="4"]
     */
    public function render_industries( $atts ) {
        $atts = shortcode_atts( array(
            'columns' => 4,
            'count'   => -1,
        ), $atts, 'acumen_industries' );

        $query = new WP_Query( array(
            'post_type'      => 'acumen_industry',
            'posts_per_page' => intval( $atts['count'] ),
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
        ) );

        if ( ! $query->have_posts() ) {
            return '<p class="acumen-no-items">' . esc_html__( 'No industries found.', 'acumen-core' ) . '</p>';
        }

        ob_start();
        ?>
        <div class="acumen-industries-grid acumen-cols-<?php echo esc_attr( $atts['columns'] ); ?>">
            <?php while ( $query->have_posts() ) : $query->the_post();
                $icon      = get_post_meta( get_the_ID(), '_acumen_industry_icon', true );
                $standards = get_post_meta( get_the_ID(), '_acumen_industry_standards', true );
            ?>
                <div class="acumen-industry-card">
                    <div class="acumen-industry-icon">
                        <?php if ( $icon && strpos( $icon, 'sector-' ) === 0 ) :
                            $svg_path = ACUMEN_CORE_PATH . 'assets/icons/sectors/' . $icon . '.svg';
                            if ( file_exists( $svg_path ) ) {
                                echo file_get_contents( $svg_path ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            } else {
                                echo '<span class="dashicons dashicons-building"></span>';
                            }
                        else : ?>
                            <span class="dashicons dashicons-building"></span>
                        <?php endif; ?>
                    </div>
                    <h4 class="acumen-industry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php if ( $standards ) : ?>
                        <div class="acumen-industry-standards"><?php echo esc_html( $standards ); ?></div>
                    <?php endif; ?>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Clients Shortcode: [acumen_clients layout="ticker"]
     */
    public function render_clients( $atts ) {
        $atts = shortcode_atts( array(
            'layout' => 'ticker', // 'ticker' or 'grid'
            'count'  => -1,
        ), $atts, 'acumen_clients' );

        $query = new WP_Query( array(
            'post_type'      => 'acumen_client',
            'posts_per_page' => intval( $atts['count'] ),
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
        ) );

        if ( ! $query->have_posts() ) {
            return '<p class="acumen-no-items">' . esc_html__( 'No clients found.', 'acumen-core' ) . '</p>';
        }

        ob_start();
        ?>
        <div class="acumen-clients-wrapper acumen-layout-<?php echo esc_attr( $atts['layout'] ); ?>">
            <div class="acumen-clients-track">
                <?php while ( $query->have_posts() ) : $query->the_post();
                    $loc = get_post_meta( get_the_ID(), '_acumen_client_location', true );
                ?>
                    <div class="acumen-client-badge">
                        <div class="acumen-client-box">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium', array( 'class' => 'acumen-client-logo', 'alt' => get_the_title() ) ); ?>
                            <?php else : ?>
                                <span class="acumen-client-name"><?php the_title(); ?></span>
                            <?php endif; ?>
                            <?php if ( $loc ) : ?>
                                <span class="acumen-client-loc"><?php echo esc_html( $loc ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Projects Shortcode: [acumen_projects count="6"]
     */
    public function render_projects( $atts ) {
        $atts = shortcode_atts( array(
            'count'   => 6,
            'columns' => 3,
        ), $atts, 'acumen_projects' );

        $query = new WP_Query( array(
            'post_type'      => 'acumen_project',
            'posts_per_page' => intval( $atts['count'] ),
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        if ( ! $query->have_posts() ) {
            return '<p class="acumen-no-items">' . esc_html__( 'No projects found.', 'acumen-core' ) . '</p>';
        }

        ob_start();
        ?>
        <div class="acumen-projects-grid acumen-cols-<?php echo esc_attr( $atts['columns'] ); ?>">
            <?php while ( $query->have_posts() ) : $query->the_post();
                $client = get_post_meta( get_the_ID(), '_acumen_project_client', true );
                $year   = get_post_meta( get_the_ID(), '_acumen_project_year', true );
                $loc    = get_post_meta( get_the_ID(), '_acumen_project_location', true );
            ?>
                <div class="acumen-project-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="acumen-project-thumb">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
                            <?php if ( $year ) : ?>
                                <span class="acumen-project-badge"><?php echo esc_html( $year ); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="acumen-project-content">
                        <h3 class="acumen-project-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php if ( $client || $loc ) : ?>
                            <div class="acumen-project-meta">
                                <?php if ( $client ) : ?><span><strong><?php esc_html_e( 'Client:', 'acumen-core' ); ?></strong> <?php echo esc_html( $client ); ?></span><?php endif; ?>
                                <?php if ( $loc ) : ?><span>&bull; <?php echo esc_html( $loc ); ?></span><?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="acumen-project-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="acumen-btn-link"><?php esc_html_e( 'View Details &rarr;', 'acumen-core' ); ?></a>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Stats Counter Shortcode: [acumen_stats]
     */
    public function render_stats( $atts ) {
        $options = get_option( 'acumen_options', array() );
        $sqft    = ! empty( $options['stat_workshop_sqft'] ) ? $options['stat_workshop_sqft'] : '6,000 Sq. Ft.';

        ob_start();
        ?>
        <div class="acumen-stats-grid">
            <div class="acumen-stat-card">
                <div class="acumen-stat-number"><?php echo esc_html( $sqft ); ?></div>
                <div class="acumen-stat-label"><?php esc_html_e( 'Fabrication Facility in Pune', 'acumen-core' ); ?></div>
            </div>
            <div class="acumen-stat-card">
                <div class="acumen-stat-number">25+</div>
                <div class="acumen-stat-label"><?php esc_html_e( 'Marquee Industrial Clients', 'acumen-core' ); ?></div>
            </div>
            <div class="acumen-stat-card">
                <div class="acumen-stat-number">10+</div>
                <div class="acumen-stat-label"><?php esc_html_e( 'Process Sectors Covered', 'acumen-core' ); ?></div>
            </div>
            <div class="acumen-stat-card">
                <div class="acumen-stat-number">100%</div>
                <div class="acumen-stat-label"><?php esc_html_e( 'Just-In-Time & Quality Focus', 'acumen-core' ); ?></div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * RFQ / Enquiry Form Shortcode: [acumen_rfq_form]
     */
    public function render_rfq_form( $atts ) {
        ob_start();
        ?>
        <div class="acumen-rfq-container">
            <form id="acumen-rfq-form" class="acumen-form" method="post">
                <div class="acumen-form-row">
                    <div class="acumen-form-group">
                        <label for="rfq_full_name"><?php esc_html_e( 'Full Name *', 'acumen-core' ); ?></label>
                        <input type="text" id="rfq_full_name" name="full_name" required placeholder="<?php esc_attr_e( 'e.g. Rajesh Sharma', 'acumen-core' ); ?>" />
                    </div>
                    <div class="acumen-form-group">
                        <label for="rfq_email"><?php esc_html_e( 'Email Address *', 'acumen-core' ); ?></label>
                        <input type="email" id="rfq_email" name="email" required placeholder="<?php esc_attr_e( 'e.g. rajesh@company.com', 'acumen-core' ); ?>" />
                    </div>
                </div>

                <div class="acumen-form-row">
                    <div class="acumen-form-group">
                        <label for="rfq_phone"><?php esc_html_e( 'Phone / Mobile *', 'acumen-core' ); ?></label>
                        <input type="tel" id="rfq_phone" name="phone" required placeholder="<?php esc_attr_e( '+91 98XXX XXXXX', 'acumen-core' ); ?>" />
                    </div>
                    <div class="acumen-form-group">
                        <label for="rfq_company"><?php esc_html_e( 'Company / Organization', 'acumen-core' ); ?></label>
                        <input type="text" id="rfq_company" name="company_name" placeholder="<?php esc_attr_e( 'e.g. Apex Biotech Ltd.', 'acumen-core' ); ?>" />
                    </div>
                </div>

                <div class="acumen-form-group">
                    <label for="rfq_service"><?php esc_html_e( 'Service / Solution Required', 'acumen-core' ); ?></label>
                    <select id="rfq_service" name="service_requested">
                        <option value=""><?php esc_html_e( '-- Select Engineering Service --', 'acumen-core' ); ?></option>
                        <option value="Turnkey Project Management"><?php esc_html_e( 'Turnkey Project Management', 'acumen-core' ); ?></option>
                        <option value="Boiler & Chimney Heavy Erection"><?php esc_html_e( 'Boiler & Chimney Heavy Erection', 'acumen-core' ); ?></option>
                        <option value="Clean Room & Process Piping (IBR / Non-IBR)"><?php esc_html_e( 'Clean Room & Process Piping (IBR / Non-IBR)', 'acumen-core' ); ?></option>
                        <option value="Cabling & Instrumentation"><?php esc_html_e( 'Cabling & Instrumentation', 'acumen-core' ); ?></option>
                        <option value="SS / MS Tank & Equipment Fabrication"><?php esc_html_e( 'SS / MS Tank & Equipment Fabrication', 'acumen-core' ); ?></option>
                        <option value="Specialized Welding (Orbital, TIG, ARC)"><?php esc_html_e( 'Specialized Welding (Orbital, TIG, ARC)', 'acumen-core' ); ?></option>
                        <option value="Process Plant AMC / ARC Maintenance"><?php esc_html_e( 'Process Plant AMC / ARC Maintenance', 'acumen-core' ); ?></option>
                        <option value="Equipment & Piping Thermal Insulation"><?php esc_html_e( 'Equipment & Piping Thermal Insulation', 'acumen-core' ); ?></option>
                        <option value="Supply of Engineering Goods"><?php esc_html_e( 'Supply of Engineering Goods', 'acumen-core' ); ?></option>
                    </select>
                </div>

                <div class="acumen-form-group">
                    <label for="rfq_message"><?php esc_html_e( 'Project Scope / Message *', 'acumen-core' ); ?></label>
                    <textarea id="rfq_message" name="message" rows="4" required placeholder="<?php esc_attr_e( 'Please outline your plant location, timeline, and technical requirements...', 'acumen-core' ); ?>"></textarea>
                </div>

                <div class="acumen-form-submit">
                    <button type="submit" id="acumen-rfq-submit-btn" class="acumen-btn-primary">
                        <span><?php esc_html_e( 'Submit Request for Quotation', 'acumen-core' ); ?></span>
                    </button>
                </div>

                <div id="acumen-rfq-feedback" class="acumen-form-alert" style="display:none;"></div>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * WhatsApp Button Shortcode: [acumen_whatsapp text="Chat with us on WhatsApp"]
     */
    public function render_whatsapp( $atts ) {
        $options = get_option( 'acumen_options', array() );
        $number  = ! empty( $options['whatsapp_number'] ) ? $options['whatsapp_number'] : '919423019234';
        $msg     = ! empty( $options['whatsapp_default_msg'] ) ? $options['whatsapp_default_msg'] : 'Hello Acumen Engineers, I would like to inquire about turnkey projects.';

        $atts = shortcode_atts( array(
            'text' => __( 'Chat with us on WhatsApp', 'acumen-core' ),
        ), $atts, 'acumen_whatsapp' );

        $url = 'https://wa.me/' . esc_attr( $number ) . '?text=' . rawurlencode( $msg );

        ob_start();
        ?>
        <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="acumen-whatsapp-cta">
            <svg class="acumen-whatsapp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" fill="currentColor">
                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
            </svg>
            <span><?php echo esc_html( $atts['text'] ); ?></span>
        </a>
        <?php
        return ob_get_clean();
    }
}
