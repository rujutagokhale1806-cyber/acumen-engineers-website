<?php
/**
 * Main Navigation & Branding Component
 *
 * @package Acumen_Theme
 */

$quote_url = home_url( '/contact-us/' );
?>
<header id="masthead" class="site-header">
    <div class="container">
        <!-- Site Logo -->
        <div class="site-branding">
            <?php acumen_the_logo(); ?>
        </div>

        <!-- Mobile Hamburger Toggle -->
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'acumen-theme' ); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
            <span><?php esc_html_e( 'Menu', 'acumen-theme' ); ?></span>
        </button>

        <!-- Main Navigation Menu -->
        <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'acumen-theme' ); ?>">
            <?php
            if ( has_nav_menu( 'primary-menu' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary-menu',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ) );
            } else {
                // Default fallback navigation links
                ?>
                <ul id="primary-menu">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'acumen-theme' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"><?php esc_html_e( 'About Us', 'acumen-theme' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'acumen-theme' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>"><?php esc_html_e( 'Industries', 'acumen-theme' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Projects', 'acumen-theme' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"><?php esc_html_e( 'Gallery', 'acumen-theme' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/clients/' ) ); ?>"><?php esc_html_e( 'Clients', 'acumen-theme' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'acumen-theme' ); ?></a></li>
                </ul>
                <?php
            }
            ?>
            <div class="mobile-drawer-cta">
                <a href="<?php echo esc_url( $quote_url ); ?>" class="btn btn-accent btn-sm" style="width:100%; justify-content:center;">
                    <?php esc_html_e( 'Request a Quote', 'acumen-theme' ); ?>
                </a>
            </div>
        </nav>

        <!-- Header Action Button (Desktop) -->
        <div class="header-action">
            <a href="<?php echo esc_url( $quote_url ); ?>" class="btn btn-accent btn-sm">
                <span><?php esc_html_e( 'Request a Quote', 'acumen-theme' ); ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</header>
