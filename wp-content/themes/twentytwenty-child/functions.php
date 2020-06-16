<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	// wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
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
	wp_enqueue_style( 'slick-slider', 'http://kenwheeler.github.io/slick/slick/slick.css', array( ), '1.1', 'all' );
	wp_enqueue_style( 'slick-theme', 'http://kenwheeler.github.io/slick/slick/slick-theme.css', array( ), '1.1', 'all' );

	//wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array ( 'jquery' ), 1.1, true);

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/armtravel.js', array( 'jquery' ), '1.1', true );
	wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '3', false);
	wp_enqueue_script('slick-slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '3', false);

}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

