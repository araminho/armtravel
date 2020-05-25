<?php
/**
 * Template Name: Tours list Template
 * Template Post Type: page
 *
 */
get_header();

$allTours = new WP_Query( [
    'post_type' => 'tour',
    // 'meta_key'		=> 'is_featured',
    'meta_value'	=> true
]);

?>

	<main>
		<div class="img-bg-container">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/img_bg.png" alt="">
			<div class="shadow"></div>
		</div>
		<div class="horizontal-line"></div>
		<div class="tour-container">
			<div class="container-with-bg container-padding container-title">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="description">
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php endwhile; // end of the loop. ?>
			<div class="container-with-bg container-padding search-block-container">
				<div class="search-block">
					<form class="search" action="">
						<div class="price">
							<div>
								<input type="number" placeholder="1000" id="price-start" name="price-start">
							</div>
							<div>
								<input type="number" placeholder="3000" id="price-to" name="price-to">
							</div>
						</div>
						<div class="custom-select">
							<select>
								<option value="0">select option</option>
								<option value="1" selected>check in-out</option>
								<option value="2">Test</option>
								<option value="3">Test</option>
								<option value="4">Test</option>
								<option value="5">Test</option>
							</select>
						</div>
						<button class="btn-hover" type="submit">Search</button>
					</form>
				</div>
			</div>




			<div class="container-padding">
				<div class="tours">
                    <?php while($allTours->have_posts()): $allTours->the_post(); ?>
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
						<div class="more-info hide-md">
							<div class="title">
								<span class="name"><?php the_title(); ?></span>
								<span class="days"><?php the_field('duration')?></span>
							</div>
							<div class="description">
								<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</span>
							</div>
						</div>
					</div>
                    <?php endwhile; ?>

				</div>
			</div>
		</div>
	</main>


<?php
get_footer();