<?php
/**
 * The header for our theme
 *
 * @package Acumen_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'acumen-theme' ); ?></a>

    <?php get_template_part( 'template-parts/header/top-bar' ); ?>
    <?php get_template_part( 'template-parts/header/navbar' ); ?>

    <div id="content" class="site-content">
