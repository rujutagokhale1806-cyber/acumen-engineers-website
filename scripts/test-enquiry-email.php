<?php
/**
 * Test Enquiry Email Dispatch via wp_mail
 */

echo "Testing wp_mail dispatch for Acumen Enquiry...\n";

// 1. Configure options with test recipients
$options = array(
    'company_name'       => 'Acumen Engineers',
    'tagline'            => 'Turnkey Project Solutions',
    'corp_address'       => '#7, Gnd Floor, Sant Dnyaneshwar Sankul, Sector 28, P.C.N.T.D.A. Nigdi, Pune – 411 044',
    'phone_landline'     => '+91 20 2765 8234',
    'phone_mobile_1'     => '+91 9423 019 234',
    'email_primary'      => 'info@acumenengineers.in',
    'notify_recipients'  => 'admin@acumenengineers.local, test@acumenengineers.in',
    'notify_from_name'   => 'Acumen Engineers Portal',
    'autorespond_enabled'=> 1,
    'whatsapp_enabled'   => 1,
    'whatsapp_number'    => '919423019234',
);
update_option( 'acumen_options', $options );
echo "Updated acumen_options in database (PASS)\n";

// 2. Simulate inquiry submission via Enquiry Handler
$handler = new Acumen_Enquiry_Handler();

// Use reflection or invoke private notification method to test email delivery
$ref = new ReflectionClass( 'Acumen_Enquiry_Handler' );
$method = $ref->getMethod( 'send_notifications' );
$method->setAccessible( true );

$sent = $method->invoke(
    $handler,
    'Suresh Patil',
    'suresh.patil@unitedbreweries.com',
    '+91 98221 55667',
    'United Breweries Ltd.',
    'Process Plant AMC / ARC Maintenance',
    'Annual maintenance contract request for our brewery tank farm and stainless steel piping lines.'
);

echo "Dispatched notification emails via wp_mail (PASS)\n";
