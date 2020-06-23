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

<?php $featuredTours = new WP_Query(
	[
		'post_type' => 'tour',
		'meta_key'		=> 'is_featured',
		'meta_value'	=> true
	]
);

?>

<div class="tour-container">
    <div class="container-padding tours">
	    <?php while($featuredTours->have_posts()): $featuredTours->the_post(); ?>
        <div class="tour">
            <a class="main-content" href="<?php the_permalink() ?>">
                <div class="image">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                    <div class="shadow"></div>
                    <div class="info">
                        <div>
                            <span class="title"><?php the_title(); ?></span>
                            <span class="description"><?php the_field('price')?> <?php the_field('duration')?> days</span>
                        </div>
                        <div>
                            <button class="go">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="14" viewBox="0 0 21 14"><g><g><path fill="#fff" d="M.366 6.181h15.733L12.11 2.292 13.662.78l6.647 6.48-6.647 6.483-1.552-1.512 3.99-3.889H.365z"/></g></g></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endwhile; ?>
    </div>
    <div class="horizontal-line hide-md"></div>
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
