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

<div class="container-with-bg container-padding container-title hide-md">
	<div class="title">
		<h1><?php the_title(); ?></h1>
	</div>
	<div class="description">
		<?php the_excerpt(); ?>
	</div>
</div>
<div class="container-with-bg container-padding download-container">
	<div class="image-block">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/phone.png" alt="">
	</div>
	<div class="download-main">
		<div class="title">
			<span>Download Our Free App!</span>
		</div>
		<div class="description">
                        <span>Download our free app and stay up to date with all our latest discounts, articles and reviews. Take a look at
                            all the world’s top destinations and decide where to spend your perfect vacation.</span>
		</div>
		<div class="buttons">
			<a href="">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/app-store-logo.png" alt="">
			</a>
			<a href="">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/google-play-badge.png" alt="">
			</a>
		</div>
	</div>
</div>
<?php get_footer(); ?>
