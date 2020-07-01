<?php

get_header();

$tags = get_the_terms( $id, 'post_tag' );
//echo "<pre>"; print_r($tags); exit;
?>
    <main>
        <div class="img-bg-container">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/img_bg2.png" alt="">
            <div class="shadow"></div>
        </div>
        <div class="horizontal-line"></div>
		<?php if ( ! empty( $tags ) ) { ?>
            <div class="container-with-bg container-padding tags-container">
                <form>
					<?php foreach ( $tags as $tag ) { ?>
                        <div class="formrow">
                            <input class="checkbox" type="checkbox" name="check1" id="check1">
                            <label class="checklabel" for="check1"><?php echo $tag->name ?></label>
                        </div>
					<?php } ?>
                </form>
            </div>
		<?php } ?>
		<?php while ( have_posts() ) : the_post(); ?>
            <div class="container-padding single-container">
                <div class="image">
                    <img src="<?php the_post_thumbnail_url($post->ID); ?>" alt="">
                </div>
                <div class="container-with-bg single-content">
                    <!--<div class="date">
						<a class="btn-hover">See more</a>
					</div>-->
                    <div class="more-info">
                        <span class="title"><?php the_title(); ?></span>
                        <span class="description">
                            <?php the_content(); ?>
                        </span>
                    </div>
                </div>
            </div>
		<?php endwhile; // end of the loop. ?>

    </main>


<?php
get_footer();
