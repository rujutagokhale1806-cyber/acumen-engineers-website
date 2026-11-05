<?php
/**
 * Custom Meta Boxes Class
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Acumen_Meta_Boxes {

    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_boxes' ), 10, 2 );
    }

    /**
     * Register meta boxes for all custom post types
     */
    public function register_meta_boxes() {
        // Service details
        add_meta_box(
            'acumen_service_details',
            __( 'Service Details & Specifications', 'acumen-core' ),
            array( $this, 'render_service_meta_box' ),
            'acumen_service',
            'normal',
            'high'
        );

        // Industry details
        add_meta_box(
            'acumen_industry_details',
            __( 'Industry Sector Details', 'acumen-core' ),
            array( $this, 'render_industry_meta_box' ),
            'acumen_industry',
            'normal',
            'high'
        );

        // Client details
        add_meta_box(
            'acumen_client_details',
            __( 'Client Information', 'acumen-core' ),
            array( $this, 'render_client_meta_box' ),
            'acumen_client',
            'normal',
            'high'
        );

        // Project details
        add_meta_box(
            'acumen_project_details',
            __( 'Project Execution Details', 'acumen-core' ),
            array( $this, 'render_project_meta_box' ),
            'acumen_project',
            'normal',
            'high'
        );

        // Gallery details
        add_meta_box(
            'acumen_gallery_details',
            __( 'Gallery Information', 'acumen-core' ),
            array( $this, 'render_gallery_meta_box' ),
            'acumen_gallery',
            'normal',
            'high'
        );
    }

    /**
     * Render Service Meta Box
     */
    public function render_service_meta_box( $post ) {
        wp_nonce_field( 'acumen_meta_box_nonce_action', 'acumen_meta_box_nonce' );

        $icon       = get_post_meta( $post->ID, '_acumen_service_icon', true );
        $highlights = get_post_meta( $post->ID, '_acumen_service_highlights', true );
        $specs      = get_post_meta( $post->ID, '_acumen_service_specs', true );
        ?>
        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_service_icon" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Service Icon (SVG name or Dashicon class, e.g. service-piping or dashicons-admin-tools):', 'acumen-core' ); ?>
            </label>
            <input type="text" id="acumen_service_icon" name="acumen_service_icon" value="<?php echo esc_attr( $icon ); ?>" style="width:100%; max-width:400px;" />
        </div>

        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_service_highlights" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Key Highlights (One bullet point per line):', 'acumen-core' ); ?>
            </label>
            <textarea id="acumen_service_highlights" name="acumen_service_highlights" rows="5" style="width:100%;"><?php echo esc_textarea( $highlights ); ?></textarea>
            <p class="description"><?php esc_html_e( 'Enter key service points (e.g. "Timeline management", "Validation services").', 'acumen-core' ); ?></p>
        </div>

        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_service_specs" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Technical Specifications / Deliverables (One item per line):', 'acumen-core' ); ?>
            </label>
            <textarea id="acumen_service_specs" name="acumen_service_specs" rows="5" style="width:100%;"><?php echo esc_textarea( $specs ); ?></textarea>
        </div>
        <?php
    }

    /**
     * Render Industry Meta Box
     */
    public function render_industry_meta_box( $post ) {
        wp_nonce_field( 'acumen_meta_box_nonce_action', 'acumen_meta_box_nonce' );

        $icon      = get_post_meta( $post->ID, '_acumen_industry_icon', true );
        $standards = get_post_meta( $post->ID, '_acumen_industry_standards', true );
        ?>
        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_industry_icon" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Industry Icon (SVG name or Dashicon, e.g. sector-pharma):', 'acumen-core' ); ?>
            </label>
            <input type="text" id="acumen_industry_icon" name="acumen_industry_icon" value="<?php echo esc_attr( $icon ); ?>" style="width:100%; max-width:400px;" />
        </div>

        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_industry_standards" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Compliance Standards & Key Systems (e.g. "IBR Certified, Cleanroom SS316L, cGMP"):', 'acumen-core' ); ?>
            </label>
            <input type="text" id="acumen_industry_standards" name="acumen_industry_standards" value="<?php echo esc_attr( $standards ); ?>" style="width:100%;" />
        </div>
        <?php
    }

    /**
     * Render Client Meta Box
     */
    public function render_client_meta_box( $post ) {
        wp_nonce_field( 'acumen_meta_box_nonce_action', 'acumen_meta_box_nonce' );

        $location = get_post_meta( $post->ID, '_acumen_client_location', true );
        $website  = get_post_meta( $post->ID, '_acumen_client_website', true );
        $featured = get_post_meta( $post->ID, '_acumen_client_featured', true );
        ?>
        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_client_location" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Client Location / Region (e.g. Pune, India or Saudi Arabia):', 'acumen-core' ); ?>
            </label>
            <input type="text" id="acumen_client_location" name="acumen_client_location" value="<?php echo esc_attr( $location ); ?>" style="width:100%; max-width:400px;" />
        </div>

        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_client_website" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Website URL (Optional):', 'acumen-core' ); ?>
            </label>
            <input type="url" id="acumen_client_website" name="acumen_client_website" value="<?php echo esc_url( $website ); ?>" style="width:100%; max-width:400px;" />
        </div>

        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label>
                <input type="checkbox" name="acumen_client_featured" value="1" <?php checked( $featured, '1' ); ?> />
                <strong><?php esc_html_e( 'Feature in Marquee / Homepage Ticker', 'acumen-core' ); ?></strong>
            </label>
        </div>
        <?php
    }

    /**
     * Render Project Meta Box
     */
    public function render_project_meta_box( $post ) {
        wp_nonce_field( 'acumen_meta_box_nonce_action', 'acumen_meta_box_nonce' );

        $client   = get_post_meta( $post->ID, '_acumen_project_client', true );
        $location = get_post_meta( $post->ID, '_acumen_project_location', true );
        $year     = get_post_meta( $post->ID, '_acumen_project_year', true );
        $scope    = get_post_meta( $post->ID, '_acumen_project_scope', true );
        ?>
        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_project_client" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Client Name:', 'acumen-core' ); ?>
            </label>
            <input type="text" id="acumen_project_client" name="acumen_project_client" value="<?php echo esc_attr( $client ); ?>" style="width:100%; max-width:400px;" />
        </div>

        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_project_location" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Site / Plant Location:', 'acumen-core' ); ?>
            </label>
            <input type="text" id="acumen_project_location" name="acumen_project_location" value="<?php echo esc_attr( $location ); ?>" style="width:100%; max-width:400px;" />
        </div>

        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_project_year" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Year / Status (e.g. 2024, Completed, Ongoing):', 'acumen-core' ); ?>
            </label>
            <input type="text" id="acumen_project_year" name="acumen_project_year" value="<?php echo esc_attr( $year ); ?>" style="width:100%; max-width:200px;" />
        </div>

        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_project_scope" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Scope of Work & Technical Highlights:', 'acumen-core' ); ?>
            </label>
            <textarea id="acumen_project_scope" name="acumen_project_scope" rows="4" style="width:100%;"><?php echo esc_textarea( $scope ); ?></textarea>
        </div>
        <?php
    }

    /**
     * Render Gallery Meta Box
     */
    public function render_gallery_meta_box( $post ) {
        wp_nonce_field( 'acumen_meta_box_nonce_action', 'acumen_meta_box_nonce' );

        $caption  = get_post_meta( $post->ID, '_acumen_gallery_caption', true );
        $location = get_post_meta( $post->ID, '_acumen_gallery_location', true );
        ?>
        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_gallery_caption" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Photo Caption / Equipment Description:', 'acumen-core' ); ?>
            </label>
            <input type="text" id="acumen_gallery_caption" name="acumen_gallery_caption" value="<?php echo esc_attr( $caption ); ?>" style="width:100%;" />
        </div>

        <div class="acumen-meta-field" style="margin-bottom: 15px;">
            <label for="acumen_gallery_location" style="display:block; font-weight:600; margin-bottom:5px;">
                <?php esc_html_e( 'Facility / Location (e.g. Pune Fabrication Shop or Client Plant):', 'acumen-core' ); ?>
            </label>
            <input type="text" id="acumen_gallery_location" name="acumen_gallery_location" value="<?php echo esc_attr( $location ); ?>" style="width:100%;" />
        </div>
        <?php
    }

    /**
     * Save Meta Box Data
     */
    public function save_meta_boxes( $post_id, $post ) {
        // Verify nonce
        if ( ! isset( $_POST['acumen_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['acumen_meta_box_nonce'] ) ), 'acumen_meta_box_nonce_action' ) ) {
            return;
        }

        // Check autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Check user permissions
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Save Service Meta
        if ( 'acumen_service' === $post->post_type ) {
            if ( isset( $_POST['acumen_service_icon'] ) ) {
                update_post_meta( $post_id, '_acumen_service_icon', sanitize_text_field( wp_unslash( $_POST['acumen_service_icon'] ) ) );
            }
            if ( isset( $_POST['acumen_service_highlights'] ) ) {
                update_post_meta( $post_id, '_acumen_service_highlights', sanitize_textarea_field( wp_unslash( $_POST['acumen_service_highlights'] ) ) );
            }
            if ( isset( $_POST['acumen_service_specs'] ) ) {
                update_post_meta( $post_id, '_acumen_service_specs', sanitize_textarea_field( wp_unslash( $_POST['acumen_service_specs'] ) ) );
            }
        }

        // Save Industry Meta
        if ( 'acumen_industry' === $post->post_type ) {
            if ( isset( $_POST['acumen_industry_icon'] ) ) {
                update_post_meta( $post_id, '_acumen_industry_icon', sanitize_text_field( wp_unslash( $_POST['acumen_industry_icon'] ) ) );
            }
            if ( isset( $_POST['acumen_industry_standards'] ) ) {
                update_post_meta( $post_id, '_acumen_industry_standards', sanitize_text_field( wp_unslash( $_POST['acumen_industry_standards'] ) ) );
            }
        }

        // Save Client Meta
        if ( 'acumen_client' === $post->post_type ) {
            if ( isset( $_POST['acumen_client_location'] ) ) {
                update_post_meta( $post_id, '_acumen_client_location', sanitize_text_field( wp_unslash( $_POST['acumen_client_location'] ) ) );
            }
            if ( isset( $_POST['acumen_client_website'] ) ) {
                update_post_meta( $post_id, '_acumen_client_website', esc_url_raw( wp_unslash( $_POST['acumen_client_website'] ) ) );
            }
            $featured = isset( $_POST['acumen_client_featured'] ) ? '1' : '0';
            update_post_meta( $post_id, '_acumen_client_featured', $featured );
        }

        // Save Project Meta
        if ( 'acumen_project' === $post->post_type ) {
            if ( isset( $_POST['acumen_project_client'] ) ) {
                update_post_meta( $post_id, '_acumen_project_client', sanitize_text_field( wp_unslash( $_POST['acumen_project_client'] ) ) );
            }
            if ( isset( $_POST['acumen_project_location'] ) ) {
                update_post_meta( $post_id, '_acumen_project_location', sanitize_text_field( wp_unslash( $_POST['acumen_project_location'] ) ) );
            }
            if ( isset( $_POST['acumen_project_year'] ) ) {
                update_post_meta( $post_id, '_acumen_project_year', sanitize_text_field( wp_unslash( $_POST['acumen_project_year'] ) ) );
            }
            if ( isset( $_POST['acumen_project_scope'] ) ) {
                update_post_meta( $post_id, '_acumen_project_scope', sanitize_textarea_field( wp_unslash( $_POST['acumen_project_scope'] ) ) );
            }
        }

        // Save Gallery Meta
        if ( 'acumen_gallery' === $post->post_type ) {
            if ( isset( $_POST['acumen_gallery_caption'] ) ) {
                update_post_meta( $post_id, '_acumen_gallery_caption', sanitize_text_field( wp_unslash( $_POST['acumen_gallery_caption'] ) ) );
            }
            if ( isset( $_POST['acumen_gallery_location'] ) ) {
                update_post_meta( $post_id, '_acumen_gallery_location', sanitize_text_field( wp_unslash( $_POST['acumen_gallery_location'] ) ) );
            }
        }
    }
}
