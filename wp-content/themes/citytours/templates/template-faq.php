<?php
 /*
 Template Name: FAQs Page Template
 */
get_header();

if ( have_posts() ) {
	while ( have_posts() ) : the_post();
		$post_id = get_the_ID();
		$content_class = 'post-content';
		$slider_active = get_post_meta( $post_id, '_rev_slider', true );
		$slider        = ( $slider_active == '' ) ? 'Deactivated' : $slider_active;
		if ( class_exists( 'RevSlider' ) && $slider != 'Deactivated' ) {
			echo '<div id="slideshow">';
			putRevSlider( $slider );
			echo '</div>';
		} else {
			$header_img_scr = ct_get_header_image_src( $post_id );
			if ( ! empty( $header_img_scr ) ) {
				$header_content = get_post_meta( $post_id, '_header_content', true );
				?>

				<section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url( $header_img_scr ) ?>" data-natural-width="1400" data-natural-height="470">
					<div class="parallax-content-1">
						<div class="animated fadeInDown">
						<h1 class="page-title"><?php the_title(); ?></h1>
						<?php echo balancetags( $header_content ); ?>
						</div>
					</div>
				</section><!-- End section -->
			<?php } ?>

			<?php if ( ! is_front_page() ) : ?>
				<div id="position" <?php if ( empty( $header_img_scr ) ) echo 'class="blank-parallax"' ?>>
					<div class="container"><?php ct_breadcrumbs(); ?></div>
				</div><!-- End Position -->
			<?php endif; ?>
		<?php } 

		$content_class = apply_filters( 'ct_add_custom_content_class', $content_class ); 
		?>

		<div class="container margin_60 <?php echo esc_attr( $content_class ); ?>">
			<div class="post nopadding clearfix">
				<?php 
				if ( has_post_thumbnail() ) { 
					the_post_thumbnail( 'full', array('class' => 'img-responsive') ); 
				}

				echo do_shortcode('[faqs show_filter=true]');
				// the_content();

				wp_link_pages('before=<div class="page-links">&after=</div>');
				?>
			</div><!-- end post -->
		</div>

		<script type="text/javascript"> 
			$ = jQuery.noConflict();
            $('#sidebar').theiaStickySidebar({
                additionalMarginTop: 80
            });
		</script>

<?php endwhile;
}
get_footer();