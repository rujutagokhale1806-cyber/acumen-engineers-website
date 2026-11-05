<?php
/**
 * Header Top Bar Component
 *
 * @package Acumen_Theme
 */

$landline = acumen_get_option( 'phone_landline', '+91 20 2765 8234' );
$mobile1  = acumen_get_option( 'phone_mobile_1', '+91 9423 019 234' );
$email    = acumen_get_option( 'email_primary', 'info@acumenengineers.in' );
?>
<div class="acumen-top-bar">
    <div class="container">
        <div class="top-bar-left">
            <span class="top-bar-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                <a href="tel:<?php echo esc_attr( acumen_phone_clean( $landline ) ); ?>"><?php echo esc_html( $landline ); ?></a>
            </span>
            <span class="top-bar-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                <a href="tel:<?php echo esc_attr( acumen_phone_clean( $mobile1 ) ); ?>"><?php echo esc_html( $mobile1 ); ?></a>
            </span>
            <span class="top-bar-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
            </span>
        </div>
        <div class="top-bar-right">
            <span class="top-bar-badge"><?php esc_html_e( 'JUST-IN-TIME + QUALITY', 'acumen-theme' ); ?></span>
            <span class="top-bar-item" style="color:#94A3B8;"><?php esc_html_e( 'Pune &bull; Maharashtra &bull; India', 'acumen-theme' ); ?></span>
        </div>
    </div>
</div>
