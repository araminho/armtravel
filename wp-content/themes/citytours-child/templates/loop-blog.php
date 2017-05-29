<?php $post_id = get_the_ID(); ?>

<div id="post-<?php echo esc_attr( $post_id ); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-3">
			<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full', array('class' => 'img-responsive') ); } ?>
		</div>
		<div class="col-md-9">
			<h2><?php the_title(); ?></h2>
			<p><?php the_excerpt(); ?></p>
			<a href="<?php the_permalink(); ?>" class="btn_1"><?php echo esc_html__( 'Read more', 'citytours' ) ?></a>
		</div>
	</div>
</div><!-- end post -->