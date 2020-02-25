<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}


// Remove parent styles
function wp_remove_scripts() {
	wp_dequeue_style( 'twentytwenty-style' );
	wp_deregister_style( 'twentytwenty-style' );

	// Now register your styles and scripts here

}
add_action( 'wp_enqueue_scripts', 'wp_remove_scripts', 999 );


// Add own styles
function add_theme_scripts() {
	wp_enqueue_style( 'twentytwenty-child-style', get_stylesheet_uri() );

	wp_enqueue_style( 'normalize', get_stylesheet_directory_uri() . '/css/normalize.css', array(), '1.1', 'all');

	//wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array ( 'jquery' ), 1.1, true);

}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

