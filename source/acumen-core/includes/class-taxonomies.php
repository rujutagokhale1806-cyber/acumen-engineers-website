<?php
/**
 * Custom Taxonomies Registration Class
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Acumen_Taxonomies {

    /**
     * Initialize hooks
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_taxonomies' ) );
    }

    /**
     * Register all Custom Taxonomies
     */
    public function register_taxonomies() {
        $this->register_service_category();
        $this->register_sector_taxonomy();
        $this->register_gallery_category();
    }

    /**
     * Service Category Taxonomy
     */
    private function register_service_category() {
        $labels = array(
            'name'              => _x( 'Service Categories', 'taxonomy general name', 'acumen-core' ),
            'singular_name'     => _x( 'Service Category', 'taxonomy singular name', 'acumen-core' ),
            'search_items'      => __( 'Search Service Categories', 'acumen-core' ),
            'all_items'         => __( 'All Service Categories', 'acumen-core' ),
            'parent_item'       => __( 'Parent Service Category', 'acumen-core' ),
            'parent_item_colon' => __( 'Parent Service Category:', 'acumen-core' ),
            'edit_item'         => __( 'Edit Service Category', 'acumen-core' ),
            'update_item'       => __( 'Update Service Category', 'acumen-core' ),
            'add_new_item'      => __( 'Add New Service Category', 'acumen-core' ),
            'new_item_name'     => __( 'New Service Category Name', 'acumen-core' ),
            'menu_name'         => __( 'Categories', 'acumen-core' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'service-category' ),
            'show_in_rest'      => true,
        );

        register_taxonomy( 'acumen_service_cat', array( 'acumen_service', 'acumen_project' ), $args );
    }

    /**
     * Sector / Industry Taxonomy
     */
    private function register_sector_taxonomy() {
        $labels = array(
            'name'              => _x( 'Industrial Sectors', 'taxonomy general name', 'acumen-core' ),
            'singular_name'     => _x( 'Industrial Sector', 'taxonomy singular name', 'acumen-core' ),
            'search_items'      => __( 'Search Industrial Sectors', 'acumen-core' ),
            'all_items'         => __( 'All Industrial Sectors', 'acumen-core' ),
            'parent_item'       => __( 'Parent Sector', 'acumen-core' ),
            'parent_item_colon' => __( 'Parent Sector:', 'acumen-core' ),
            'edit_item'         => __( 'Edit Sector', 'acumen-core' ),
            'update_item'       => __( 'Update Sector', 'acumen-core' ),
            'add_new_item'      => __( 'Add New Sector', 'acumen-core' ),
            'new_item_name'     => __( 'New Sector Name', 'acumen-core' ),
            'menu_name'         => __( 'Sectors', 'acumen-core' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'sector' ),
            'show_in_rest'      => true,
        );

        register_taxonomy( 'acumen_sector', array( 'acumen_client', 'acumen_project', 'acumen_industry' ), $args );
    }

    /**
     * Gallery Category Taxonomy
     */
    private function register_gallery_category() {
        $labels = array(
            'name'              => _x( 'Gallery Categories', 'taxonomy general name', 'acumen-core' ),
            'singular_name'     => _x( 'Gallery Category', 'taxonomy singular name', 'acumen-core' ),
            'search_items'      => __( 'Search Gallery Categories', 'acumen-core' ),
            'all_items'         => __( 'All Gallery Categories', 'acumen-core' ),
            'parent_item'       => __( 'Parent Gallery Category', 'acumen-core' ),
            'parent_item_colon' => __( 'Parent Gallery Category:', 'acumen-core' ),
            'edit_item'         => __( 'Edit Gallery Category', 'acumen-core' ),
            'update_item'       => __( 'Update Gallery Category', 'acumen-core' ),
            'add_new_item'      => __( 'Add New Gallery Category', 'acumen-core' ),
            'new_item_name'     => __( 'New Gallery Category Name', 'acumen-core' ),
            'menu_name'         => __( 'Categories', 'acumen-core' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'gallery-category' ),
            'show_in_rest'      => true,
        );

        register_taxonomy( 'acumen_gallery_cat', array( 'acumen_gallery' ), $args );
    }
}
