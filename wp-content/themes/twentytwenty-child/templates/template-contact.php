<?php
/**
 * Template Name: Contact us Template
 * Template Post Type: page
 *
 */

get_header();
 ?>

<main>
    <div class="img-bg-container">
        <img src="<?php the_post_thumbnail_url($post->ID); ?>" alt="">
        <div class="shadow"></div>
    </div>
    <div class="horizontal-line"></div>
    <div class="container-padding container-with-bg contact-container">
        <div class="contact-form">
	        <?php while ( have_posts() ) : the_post(); ?>

                <div class="form-content">
                    <div class="contact-image hide-lg show-xs">
                        <div class="title">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/contact-image.png" alt="">
                    </div>
                    <div class="form">
                        <div class="title hide-xs">
                            <h1><?php the_title(); ?></h1>
                        </div>

                        <?php echo do_shortcode('[contact-form-7 id="78" title="Contact form 1"]'); ?>

                    </div>
                    <div class="contact-image hide-xs">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/contact-image.png" alt="">
                    </div>
                </div>
	        <?php endwhile; // end of the loop. ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>
