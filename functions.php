<?php

wp_enqueue_style( 'style', get_stylesheet_uri() );

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

add_post_type_support( 'page', 'excerpt' );

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

add_image_size( 'header-phone', 768, 300, true );
add_image_size( 'header-desktop', 1440, 300, true );
add_image_size( 'album-preview', 663, 442, true );
?>