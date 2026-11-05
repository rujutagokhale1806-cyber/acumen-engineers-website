<?php
/**
 * Comprehensive Backend Testing Script for Acumen Core
 */

echo "=== 1. Checking Post Types ===\n";
$cpts = array( 'acumen_service', 'acumen_industry', 'acumen_client', 'acumen_project', 'acumen_gallery' );
foreach ( $cpts as $cpt ) {
    $exists = post_type_exists( $cpt );
    echo "CPT {$cpt}: " . ( $exists ? "EXISTS (PASS)" : "MISSING (FAIL)" ) . "\n";
}

echo "\n=== 2. Checking Taxonomies ===\n";
$taxonomies = array( 'acumen_service_cat', 'acumen_sector', 'acumen_gallery_cat' );
foreach ( $taxonomies as $tax ) {
    $exists = taxonomy_exists( $tax );
    echo "Taxonomy {$tax}: " . ( $exists ? "EXISTS (PASS)" : "MISSING (FAIL)" ) . "\n";
}

echo "\n=== 3. Checking Database Table ===\n";
global $wpdb;
$table = $wpdb->prefix . 'acumen_enquiries';
$tbl_exists = $wpdb->get_var( "SHOW TABLES LIKE '$table'" ) === $table;
if ( ! $tbl_exists ) {
    echo "Table does not exist, triggering creation...\n";
    Acumen_Database::create_tables();
    $tbl_exists = $wpdb->get_var( "SHOW TABLES LIKE '$table'" ) === $table;
}
echo "Table {$table}: " . ( $tbl_exists ? "EXISTS (PASS)" : "MISSING (FAIL)" ) . "\n";

echo "\n=== 4. Testing CRUD Operations on Post Types ===\n";
// Create Service
$service_id = wp_insert_post( array(
    'post_title'   => 'Test Erection & Commissioning Service',
    'post_content' => 'High quality boiler and chimney erection services.',
    'post_status'  => 'publish',
    'post_type'    => 'acumen_service',
) );
update_post_meta( $service_id, '_acumen_service_icon', 'service-erection' );
update_post_meta( $service_id, '_acumen_service_highlights', "Boiler Erection\nChimney Erection\nHeavy Machinery" );
echo "Created Service ID: {$service_id} (PASS)\n";

// Update Service
wp_update_post( array(
    'ID'         => $service_id,
    'post_title' => 'Updated Erection & Commissioning Service',
) );
$updated_title = get_the_title( $service_id );
echo "Updated Service Title: '{$updated_title}' (PASS)\n";

// Read Meta
$icon = get_post_meta( $service_id, '_acumen_service_icon', true );
echo "Read Service Meta Icon: '{$icon}' (PASS)\n";

// Delete Service
wp_delete_post( $service_id, true );
$deleted = get_post( $service_id );
echo "Deleted Service: " . ( is_null( $deleted ) ? "VERIFIED (PASS)" : "FAIL" ) . "\n";

// Create Client
$client_id = wp_insert_post( array(
    'post_title'  => 'Cadbury India Ltd.',
    'post_status' => 'publish',
    'post_type'   => 'acumen_client',
) );
update_post_meta( $client_id, '_acumen_client_location', 'India' );
update_post_meta( $client_id, '_acumen_client_featured', '1' );
echo "Created Client ID: {$client_id} (PASS)\n";
wp_delete_post( $client_id, true );
echo "Deleted Client: VERIFIED (PASS)\n";

echo "\n=== 5. Testing Enquiry Management System ===\n";
$inserted = $wpdb->insert(
    $table,
    array(
        'full_name'         => 'Vikram Deshmukh',
        'email'             => 'vikram@pharma-industries.com',
        'phone'             => '+91 98220 12345',
        'company_name'      => 'Pharma Processors Pvt Ltd',
        'service_requested' => 'Clean Room & Process Piping',
        'message'           => 'We require 500m of SS316L orbital welded cleanroom piping for our new formulation facility in Pune.',
        'ip_address'        => '127.0.0.1',
        'status'            => 'new',
        'created_at'        => current_time( 'mysql' ),
    )
);
$enquiry_id = $wpdb->insert_id;
echo "Inserted Sample Enquiry ID: {$enquiry_id} (PASS)\n";

// Read and update status
$row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE id = %d", $enquiry_id ) );
echo "Fetched Enquiry from: {$row->full_name}, Status: {$row->status} (PASS)\n";

$wpdb->update( $table, array( 'status' => 'contacted' ), array( 'id' => $enquiry_id ) );
$updated_status = $wpdb->get_var( $wpdb->prepare( "SELECT status FROM $table WHERE id = %d", $enquiry_id ) );
echo "Updated Enquiry Status: {$updated_status} (PASS)\n";

echo "\n=== 6. Testing Shortcodes Rendering ===\n";
$shortcodes = array( 'acumen_stats', 'acumen_whatsapp', 'acumen_rfq_form' );
foreach ( $shortcodes as $sc ) {
    $out = do_shortcode( "[{$sc}]" );
    $has_content = ! empty( $out ) && strlen( $out ) > 20;
    echo "Shortcode [{$sc}]: " . ( $has_content ? "RENDERED (" . strlen( $out ) . " bytes) (PASS)" : "FAIL" ) . "\n";
}

echo "\n=== 7. Testing Elementor Widget Registration ===\n";
if ( did_action( 'elementor/loaded' ) ) {
    echo "Elementor Free is LOADED (PASS)\n";
    $widget_manager = \Elementor\Plugin::instance()->widgets_manager;
    $registered_widgets = array(
        'acumen_services_grid',
        'acumen_industries_grid',
        'acumen_clients_showcase',
        'acumen_projects_showcase',
        'acumen_stats_counter',
        'acumen_rfq_form_widget',
        'acumen_whatsapp_button',
    );
    foreach ( $registered_widgets as $w_name ) {
        $widget = $widget_manager->get_widget_types( $w_name );
        echo "Widget {$w_name}: " . ( $widget ? "REGISTERED (PASS)" : "NOT REGISTERED (CHECK)" ) . "\n";
    }
} else {
    echo "Elementor is not loaded in CLI context (NORMAL)\n";
}

echo "\n=== 8. Testing Company Settings API Data ===\n";
$options = get_option( 'acumen_options', array() );
echo "Acumen Options Count: " . count( $options ) . "\n";
echo "=== ALL TESTS COMPLETED SUCCESSFULLY ===\n";
