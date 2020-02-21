<?php
/**
 * Template Name: Home Page Template
 * Template Post Type: page
 *
 */

get_header();

if ( function_exists( 'cyclone_slider' ) ) {
	cyclone_slider( 'homepage-slider' );
}

// get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
