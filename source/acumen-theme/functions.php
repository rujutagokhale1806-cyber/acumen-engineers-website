<?php
/**
 * Acumen Theme Functions & Definitions
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ACUMEN_THEME_VERSION', '1.0.0' );
define( 'ACUMEN_THEME_URI', get_template_directory_uri() );
define( 'ACUMEN_THEME_DIR', get_template_directory() );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function acumen_theme_setup() {
    load_theme_textdomain( 'acumen-theme', ACUMEN_THEME_DIR . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'acumen-card-thumb', 640, 420, true );
    add_image_size( 'acumen-hero-banner', 1400, 650, true );

    // Register primary navigation menus.
    register_nav_menus( array(
        'primary-menu' => esc_html__( 'Primary Navigation', 'acumen-theme' ),
        'footer-menu'  => esc_html__( 'Footer Menu', 'acumen-theme' ),
    ) );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Set up the WordPress core custom logo feature.
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 260,
        'flex-width'  => true,
        'flex-height' => true,
    ) );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for responsive embedded content.
    add_theme_support( 'responsive-embeds' );

    // Add support for Elementor Free full-width template handling.
    add_theme_support( 'elementor' );
}
add_action( 'after_setup_theme', 'acumen_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function acumen_theme_scripts() {
    // Core stylesheet
    wp_enqueue_style( 'acumen-theme-style', get_stylesheet_uri(), array(), ACUMEN_THEME_VERSION );

    // Layout, Components, Responsive stylesheets
    wp_enqueue_style( 'acumen-theme-layout', ACUMEN_THEME_URI . '/assets/css/theme-layout.css', array( 'acumen-theme-style' ), ACUMEN_THEME_VERSION );
    wp_enqueue_style( 'acumen-theme-components', ACUMEN_THEME_URI . '/assets/css/theme-components.css', array( 'acumen-theme-layout' ), ACUMEN_THEME_VERSION );
    wp_enqueue_style( 'acumen-theme-responsive', ACUMEN_THEME_URI . '/assets/css/theme-responsive.css', array( 'acumen-theme-components' ), ACUMEN_THEME_VERSION );
    wp_enqueue_style( 'acumen-theme-sections', ACUMEN_THEME_URI . '/assets/css/theme-sections.css', array( 'acumen-theme-responsive' ), ACUMEN_THEME_VERSION );
    // Accessible Navigation Script
    wp_enqueue_script( 'acumen-navigation', ACUMEN_THEME_URI . '/assets/js/navigation.js', array(), ACUMEN_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'acumen_theme_scripts' );

/**
 * Helper: Retrieve company option from acumen_options with fallback
 */
function acumen_get_option( $key, $default = '' ) {
    $options = get_option( 'acumen_options', array() );
    if ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) {
        return $options[ $key ];
    }

    // Default corporate values based on company profile
    $fallbacks = array(
        'company_name'       => 'Acumen Engineers',
        'tagline'            => 'Turnkey Project Solutions',
        'phone_landline'     => '+91 20 2765 8234',
        'phone_mobile_1'     => '+91 9423 019 234',
        'phone_mobile_2'     => '+91 98509 57425',
        'email_primary'      => 'info@acumenengineers.in',
        'corp_address'       => '#7, Gnd Floor, Sant Dnyaneshwar Sankul, Sector 28, P.C.N.T.D.A. Nigdi, Pune – 411 044, Maharashtra, INDIA',
        'regd_address'       => 'Shreeram Niwas, Plot No. 124, Sr. No. 35/7, Dattawadi, Akurdi, Pune - 411 035, Maharashtra, INDIA',
        'stat_workshop_sqft' => '6,000 Sq. Ft.',
        'whatsapp_number'    => '919423019234',
    );

    return isset( $fallbacks[ $key ] ) ? $fallbacks[ $key ] : $default;
}

/**
 * Helper: Output Primary Logo (custom-logo or bundled vector SVG)
 */
function acumen_the_logo() {
    if ( has_custom_logo() ) {
        the_custom_logo();
        return;
    }

    $logo_url = ACUMEN_THEME_URI . '/assets/images/acumen-logo.svg';
    ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home">
        <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> — Turnkey Project Solutions" class="site-logo-img" />
    </a>
    <?php
}

/**
 * Helper: Output Inverted White Logo for Dark Footer
 */
function acumen_the_footer_logo() {
    $logo_white = ACUMEN_THEME_URI . '/assets/images/acumen-logo-white.svg';
    ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" style="display:inline-block; margin-bottom:14px;">
        <img src="<?php echo esc_url( $logo_white ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" style="height:48px; width:auto;" />
    </a>
    <?php
}

/**
 * Helper: Clean phone string for tel: link
 */
function acumen_phone_clean( $phone ) {
    return preg_replace( '/[^0-9+]/', '', $phone );
}

/**
 * Helper: Inline SVG Icon Renderer
 */
function acumen_get_svg_icon( $name, $folder = 'services' ) {
    $path = ACUMEN_THEME_DIR . '/assets/icons/' . $folder . '/' . $name . '.svg';
    if ( file_exists( $path ) ) {
        return file_get_contents( $path ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
    return '';
}

/**
 * Helper: Breadcrumbs for subpages
 */
function acumen_breadcrumb() {
    if ( is_front_page() ) {
        return;
    }

    echo '<nav class="breadcrumb-nav" aria-label="' . esc_attr__( 'Breadcrumbs', 'acumen-theme' ) . '">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'acumen-theme' ) . '</a>';

    if ( is_page() ) {
        echo '<span>&rsaquo;</span>' . esc_html( get_the_title() );
    } elseif ( is_singular( 'acumen_service' ) ) {
        echo '<span>&rsaquo;</span><a href="' . esc_url( home_url( '/services/' ) ) . '">' . esc_html__( 'Services', 'acumen-theme' ) . '</a>';
        echo '<span>&rsaquo;</span>' . esc_html( get_the_title() );
    } elseif ( is_singular( 'acumen_industry' ) ) {
        echo '<span>&rsaquo;</span><a href="' . esc_url( home_url( '/industries/' ) ) . '">' . esc_html__( 'Industries', 'acumen-theme' ) . '</a>';
        echo '<span>&rsaquo;</span>' . esc_html( get_the_title() );
    } elseif ( is_singular( 'acumen_project' ) ) {
        echo '<span>&rsaquo;</span><a href="' . esc_url( home_url( '/projects/' ) ) . '">' . esc_html__( 'Projects', 'acumen-theme' ) . '</a>';
        echo '<span>&rsaquo;</span>' . esc_html( get_the_title() );
    } elseif ( is_post_type_archive() ) {
        echo '<span>&rsaquo;</span>' . esc_html( post_type_archive_title( '', false ) );
    } elseif ( is_archive() ) {
        echo '<span>&rsaquo;</span>' . esc_html( get_the_archive_title() );
    } elseif ( is_404() ) {
        echo '<span>&rsaquo;</span>' . esc_html__( 'Page Not Found', 'acumen-theme' );
    }

    echo '</nav>';
}
