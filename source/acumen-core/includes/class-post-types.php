<?php
/**
 * Custom Post Types Registration Class
 *
 * @package Acumen_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Acumen_Post_Types {

    /**
     * Initialize hooks
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_post_types' ) );
    }

    /**
     * Register all Custom Post Types
     */
    public function register_post_types() {
        $this->register_service_cpt();
        $this->register_industry_cpt();
        $this->register_client_cpt();
        $this->register_project_cpt();
        $this->register_gallery_cpt();
    }

    /**
     * Services CPT
     */
    private function register_service_cpt() {
        $labels = array(
            'name'                  => _x( 'Services', 'Post type general name', 'acumen-core' ),
            'singular_name'         => _x( 'Service', 'Post type singular name', 'acumen-core' ),
            'menu_name'             => _x( 'Services', 'Admin Menu text', 'acumen-core' ),
            'name_admin_bar'        => _x( 'Service', 'Add New on Toolbar', 'acumen-core' ),
            'add_new'               => __( 'Add New Service', 'acumen-core' ),
            'add_new_item'          => __( 'Add New Service', 'acumen-core' ),
            'new_item'              => __( 'New Service', 'acumen-core' ),
            'edit_item'             => __( 'Edit Service', 'acumen-core' ),
            'view_item'             => __( 'View Service', 'acumen-core' ),
            'all_items'             => __( 'All Services', 'acumen-core' ),
            'search_items'          => __( 'Search Services', 'acumen-core' ),
            'not_found'             => __( 'No services found.', 'acumen-core' ),
            'not_found_in_trash'    => __( 'No services found in Trash.', 'acumen-core' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'services', 'with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 21,
            'menu_icon'          => 'dashicons-hammer',
            'show_in_rest'       => true,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        );

        register_post_type( 'acumen_service', $args );
    }

    /**
     * Industries / Sectors CPT
     */
    private function register_industry_cpt() {
        $labels = array(
            'name'                  => _x( 'Industries', 'Post type general name', 'acumen-core' ),
            'singular_name'         => _x( 'Industry', 'Post type singular name', 'acumen-core' ),
            'menu_name'             => _x( 'Industries', 'Admin Menu text', 'acumen-core' ),
            'name_admin_bar'        => _x( 'Industry', 'Add New on Toolbar', 'acumen-core' ),
            'add_new'               => __( 'Add New Industry', 'acumen-core' ),
            'add_new_item'          => __( 'Add New Industry', 'acumen-core' ),
            'new_item'              => __( 'New Industry', 'acumen-core' ),
            'edit_item'             => __( 'Edit Industry', 'acumen-core' ),
            'view_item'             => __( 'View Industry', 'acumen-core' ),
            'all_items'             => __( 'All Industries', 'acumen-core' ),
            'search_items'          => __( 'Search Industries', 'acumen-core' ),
            'not_found'             => __( 'No industries found.', 'acumen-core' ),
            'not_found_in_trash'    => __( 'No industries found in Trash.', 'acumen-core' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'industries', 'with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 22,
            'menu_icon'          => 'dashicons-building',
            'show_in_rest'       => true,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        );

        register_post_type( 'acumen_industry', $args );
    }

    /**
     * Clients CPT
     */
    private function register_client_cpt() {
        $labels = array(
            'name'                  => _x( 'Clients', 'Post type general name', 'acumen-core' ),
            'singular_name'         => _x( 'Client', 'Post type singular name', 'acumen-core' ),
            'menu_name'             => _x( 'Clients', 'Admin Menu text', 'acumen-core' ),
            'name_admin_bar'        => _x( 'Client', 'Add New on Toolbar', 'acumen-core' ),
            'add_new'               => __( 'Add New Client', 'acumen-core' ),
            'add_new_item'          => __( 'Add New Client', 'acumen-core' ),
            'new_item'              => __( 'New Client', 'acumen-core' ),
            'edit_item'             => __( 'Edit Client', 'acumen-core' ),
            'view_item'             => __( 'View Client', 'acumen-core' ),
            'all_items'             => __( 'All Clients', 'acumen-core' ),
            'search_items'          => __( 'Search Clients', 'acumen-core' ),
            'not_found'             => __( 'No clients found.', 'acumen-core' ),
            'not_found_in_trash'    => __( 'No clients found in Trash.', 'acumen-core' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'clients', 'with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 23,
            'menu_icon'          => 'dashicons-groups',
            'show_in_rest'       => true,
            'supports'           => array( 'title', 'thumbnail', 'page-attributes' ),
        );

        register_post_type( 'acumen_client', $args );
    }

    /**
     * Projects CPT
     */
    private function register_project_cpt() {
        $labels = array(
            'name'                  => _x( 'Projects', 'Post type general name', 'acumen-core' ),
            'singular_name'         => _x( 'Project', 'Post type singular name', 'acumen-core' ),
            'menu_name'             => _x( 'Projects', 'Admin Menu text', 'acumen-core' ),
            'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'acumen-core' ),
            'add_new'               => __( 'Add New Project', 'acumen-core' ),
            'add_new_item'          => __( 'Add New Project', 'acumen-core' ),
            'new_item'              => __( 'New Project', 'acumen-core' ),
            'edit_item'             => __( 'Edit Project', 'acumen-core' ),
            'view_item'             => __( 'View Project', 'acumen-core' ),
            'all_items'             => __( 'All Projects', 'acumen-core' ),
            'search_items'          => __( 'Search Projects', 'acumen-core' ),
            'not_found'             => __( 'No projects found.', 'acumen-core' ),
            'not_found_in_trash'    => __( 'No projects found in Trash.', 'acumen-core' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'projects', 'with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 24,
            'menu_icon'          => 'dashicons-portfolio',
            'show_in_rest'       => true,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        );

        register_post_type( 'acumen_project', $args );
    }

    /**
     * Gallery CPT
     */
    private function register_gallery_cpt() {
        $labels = array(
            'name'                  => _x( 'Gallery', 'Post type general name', 'acumen-core' ),
            'singular_name'         => _x( 'Gallery Item', 'Post type singular name', 'acumen-core' ),
            'menu_name'             => _x( 'Gallery', 'Admin Menu text', 'acumen-core' ),
            'name_admin_bar'        => _x( 'Gallery Item', 'Add New on Toolbar', 'acumen-core' ),
            'add_new'               => __( 'Add New Item', 'acumen-core' ),
            'add_new_item'          => __( 'Add New Gallery Item', 'acumen-core' ),
            'new_item'              => __( 'New Gallery Item', 'acumen-core' ),
            'edit_item'             => __( 'Edit Gallery Item', 'acumen-core' ),
            'view_item'             => __( 'View Gallery Item', 'acumen-core' ),
            'all_items'             => __( 'All Gallery Items', 'acumen-core' ),
            'search_items'          => __( 'Search Gallery', 'acumen-core' ),
            'not_found'             => __( 'No gallery items found.', 'acumen-core' ),
            'not_found_in_trash'    => __( 'No gallery items found in Trash.', 'acumen-core' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'gallery', 'with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 25,
            'menu_icon'          => 'dashicons-format-gallery',
            'show_in_rest'       => true,
            'supports'           => array( 'title', 'thumbnail', 'page-attributes' ),
        );

        register_post_type( 'acumen_gallery', $args );
    }
}
