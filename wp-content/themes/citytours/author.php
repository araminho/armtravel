<?php
get_header();
global $ct_options;
$header_img_scr = ct_get_header_image_src('blog');
if ( ! empty( $header_img_scr ) ) {
	$sidebar_position = ct_get_sidebar_position('blog');
	$content_class = '';
	if ( 'no' != $sidebar_position ) $content_class = 'col-md-9';
	$header_content = '';
	if ( ! empty( $ct_options['blog_header_content'] ) ) $header_content = $ct_options['blog_header_content'];
	?>

	<section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url( $header_img_scr ) ?>" data-natural-width="1400" data-natural-height="470">
		<div class="parallax-content-1">
			<?php echo balancetags( $header_content ); ?>
		</div>
	</section><!-- End section -->
	<div id="position">

<?php } else { ?>
	<div id="position" class="blank-parallax">
<?php } ?>

	<div class="container"><?php ct_breadcrumbs(); ?></div>
</div><!-- End Position -->

<div class="container margin_60">
	<div class="row">
		<?php if ( 'left' == $sidebar_position && is_active_sidebar( 'sidebar-post' ) ) : ?>
			<aside class="col-md-3 add_bottom_30"><?php dynamic_sidebar( 'sidebar-post' ); ?></aside><!-- End aside -->
		<?php endif; ?>

		<div class="<?php echo esc_attr( $content_class ); ?>">
			<div class="box_style_1">
				<?php 
				$desc = '';
				if ( is_tag() ) { $desc = tag_description(); }
				if ( is_category() ) { $desc = category_description(); }
				if ( ! empty( $desc ) ) { ?>
					<h5 class="description box">
						<?php echo ( $desc ); ?>
					</h5>
				<?php } ?>

				<?php if ( have_posts() ) : ?>
					<?php $index = 0; ?>
					<?php while(have_posts()): the_post(); ?>
						<?php if ( 0 != $index ) { ?>
							<hr>
						<?php } $index++; ?>
						<?php ct_get_template( 'loop-blog.php', '/templates' ); ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php esc_html_e( 'No posts found', 'citytours' ); ?>
				<?php endif; ?>
			</div><!-- end box_style_1 -->
			<hr>

			<div class="text-center">
				<?php echo paginate_links( array( 'type' => 'list','prev_text' => esc_html__( 'Prev', 'citytours' ), 'next_text' => esc_html__('Next', 'citytours'), ) ); ?>
			</div>

		</div><!-- End col-md-9-->
		<?php wp_link_pages('before=<div class="page-links">&after=</div>'); ?>

		<?php if ( 'right' == $sidebar_position && is_active_sidebar( 'sidebar-post' ) ) : ?>
			<aside class="col-md-3 add_bottom_30"><?php dynamic_sidebar( 'sidebar-post' ); ?></aside><!-- End aside -->
		<?php endif; ?>

	</div><!-- End row-->
</div><!-- End container -->

<?php get_footer();