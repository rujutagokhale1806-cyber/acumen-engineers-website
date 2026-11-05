<?php
/**
 * Test render of Enquiries table in admin context
 */

$table = new Acumen_Enquiry_Table();

ob_start();
$table->render_enquiry_page();
$output = ob_get_clean();

echo "=== Testing Enquiries Table Output ===\n";
echo "Output length: " . strlen( $output ) . " bytes\n";

$checks = array(
    'acumen-table-container' => strpos( $output, 'acumen-table-container' ) !== false,
    'min-width:1200px'       => strpos( $output, 'min-width:1200px' ) !== false,
    'col-message'            => strpos( $output, 'col-message' ) !== false,
    'overflow-x:auto'        => strpos( $output, 'overflow-x:auto' ) !== false,
    'min-width:280px'        => strpos( $output, 'min-width:280px' ) !== false,
    'Export to CSV'          => strpos( $output, 'Export to CSV' ) !== false,
);

foreach ( $checks as $label => $pass ) {
    echo "Check '{$label}': " . ( $pass ? "PASS" : "FAIL" ) . "\n";
}
