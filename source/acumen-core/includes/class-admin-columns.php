<?php
/**
 * Admin Columns Customization Class
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Acumen_Admin_Columns {

    public function __construct() {
        // Services
        add_filter( 'manage_acumen_service_posts_columns', array( $this, 'service_columns' ) );
        add_action( 'manage_acumen_service_posts_custom_column', array( $this, 'service_column_content' ), 10, 2 );

        // Clients
        add_filter( 'manage_acumen_client_posts_columns', array( $this, 'client_columns' ) );
        add_action( 'manage_acumen_client_posts_custom_column', array( $this, 'client_column_content' ), 10, 2 );

        // Projects
        add_filter( 'manage_acumen_project_posts_columns', array( $this, 'project_columns' ) );
        add_action( 'manage_acumen_project_posts_custom_column', array( $this, 'project_column_content' ), 10, 2 );

        // Gallery
        add_filter( 'manage_acumen_gallery_posts_columns', array( $this, 'gallery_columns' ) );
        add_action( 'manage_acumen_gallery_posts_custom_column', array( $this, 'gallery_column_content' ), 10, 2 );
    }

    /**
     * Service columns
     */
    public function service_columns( $columns ) {
        $new = array();
        foreach ( $columns as $k => $v ) {
            $new[ $k ] = $v;
            if ( 'title' === $k ) {
                $new['service_icon'] = __( 'Icon', 'acumen-core' );
            }
        }
        return $new;
    }

    public function service_column_content( $column, $post_id ) {
        if ( 'service_icon' === $column ) {
            $icon = get_post_meta( $post_id, '_acumen_service_icon', true );
            echo esc_html( $icon ? $icon : '—' );
        }
    }

    /**
     * Client columns
     */
    public function client_columns( $columns ) {
        $new = array();
        $new['cb']        = $columns['cb'];
        $new['logo']      = __( 'Logo', 'acumen-core' );
        $new['title']     = $columns['title'];
        $new['location']  = __( 'Location', 'acumen-core' );
        $new['featured']  = __( 'Featured Ticker', 'acumen-core' );
        $new['date']      = $columns['date'];
        return $new;
    }

    public function client_column_content( $column, $post_id ) {
        if ( 'logo' === $column ) {
            if ( has_post_thumbnail( $post_id ) ) {
                echo get_the_post_thumbnail( $post_id, array( 50, 50 ), array( 'style' => 'max-height:40px; width:auto;' ) );
            } else {
                echo '<span style="color:#999;">' . esc_html__( 'No Logo', 'acumen-core' ) . '</span>';
            }
        } elseif ( 'location' === $column ) {
            $loc = get_post_meta( $post_id, '_acumen_client_location', true );
            echo esc_html( $loc ? $loc : '—' );
        } elseif ( 'featured' === $column ) {
            $feat = get_post_meta( $post_id, '_acumen_client_featured', true );
            echo '1' === $feat ? '<strong style="color:#0a850a;">' . esc_html__( 'Yes', 'acumen-core' ) . '</strong>' : '<span style="color:#999;">' . esc_html__( 'No', 'acumen-core' ) . '</span>';
        }
    }

    /**
     * Project columns
     */
    public function project_columns( $columns ) {
        $new = array();
        $new['cb']        = $columns['cb'];
        $new['thumb']     = __( 'Image', 'acumen-core' );
        $new['title']     = $columns['title'];
        $new['client']    = __( 'Client', 'acumen-core' );
        $new['year']      = __( 'Year / Status', 'acumen-core' );
        $new['date']      = $columns['date'];
        return $new;
    }

    public function project_column_content( $column, $post_id ) {
        if ( 'thumb' === $column ) {
            if ( has_post_thumbnail( $post_id ) ) {
                echo get_the_post_thumbnail( $post_id, array( 60, 40 ), array( 'style' => 'max-height:40px; border-radius:3px;' ) );
            } else {
                echo '<span style="color:#999;">—</span>';
            }
        } elseif ( 'client' === $column ) {
            $client = get_post_meta( $post_id, '_acumen_project_client', true );
            echo esc_html( $client ? $client : '—' );
        } elseif ( 'year' === $column ) {
            $year = get_post_meta( $post_id, '_acumen_project_year', true );
            echo esc_html( $year ? $year : '—' );
        }
    }

    /**
     * Gallery columns
     */
    public function gallery_columns( $columns ) {
        $new = array();
        $new['cb']       = $columns['cb'];
        $new['thumb']    = __( 'Image', 'acumen-core' );
        $new['title']    = $columns['title'];
        $new['caption']  = __( 'Caption', 'acumen-core' );
        $new['date']     = $columns['date'];
        return $new;
    }

    public function gallery_column_content( $column, $post_id ) {
        if ( 'thumb' === $column ) {
            if ( has_post_thumbnail( $post_id ) ) {
                echo get_the_post_thumbnail( $post_id, array( 60, 60 ), array( 'style' => 'max-height:50px; border-radius:3px;' ) );
            } else {
                echo '<span style="color:#999;">—</span>';
            }
        } elseif ( 'caption' === $column ) {
            $cap = get_post_meta( $post_id, '_acumen_gallery_caption', true );
            echo esc_html( $cap ? $cap : '—' );
        }
    }
}
