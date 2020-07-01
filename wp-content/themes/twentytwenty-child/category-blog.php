<?php
/**
 * Template Name: Sightseeings list Template
 * Template Post Type: page
 *
 */
//var_dump(get_the_post_thumbnail_url($post)); exit;
get_header();

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$query = new WP_Query( [
	'post_type'      => 'post',
	// 'meta_key'		=> 'is_featured',
	// 'meta_value'	=> true
	'posts_per_page' => 2,
	'paged'          => $paged
] );

?>
<main>
    <div class="img-bg-container">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/img_bg2.png" alt="">
        <div class="shadow"></div>
    </div>
    <div class="horizontal-line"></div>
    <!--<div class="blog-filter">
        <div class="calendar">
            <input placeholder="2020-05-16" type="text" id="ele1"/>
        </div>
        <div class="calendar">
            <input placeholder="2020-05-30" type="text" id="ele2"/>
        </div>
        <button class="submit btn-hover">Search</button>
    </div>-->
	<?php if (have_posts()):  ?>



    <div class="container-padding blog-container">
        <div class="news">
	        <?php  while (have_posts()) : the_post(); ?>

                <div class="news-item">
                    <div class="blog-image">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                    </div>
                    <div class="container-with-bg blog-content">
                        <div class="date">
                            <span><?php the_date(); ?></span>
                        </div>
                        <div class="more-info">
                            <div class="left-content">
                                <span class="title"><?php the_title(); ?></span>
	                            <?php the_excerpt(); ?>
                            </div>
                            <div class="right-content">
                                <a href="<?php the_permalink(); ?>" class="see-more btn-hover">See more</a>
                            </div>
                        </div>
                    </div>
                </div>

	        <?php endwhile; ?>

        </div>


        <div class="container-padding pagination-container">
            <div class="pagination-items">
                <ul>
				    <?php
				    $leftArrow = '<div class="arrow arrow-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="27" viewBox="0 0 13 27"><g><g><path fill="#868686" d="M.004 13.383c0-.217.107-.542.322-.76L11.093.699a1.149 1.149 0 0 1 1.508-.108c.43.434.43 1.084.107 1.518L2.587 13.383l10.121 11.166c.431.434.323 1.085-.107 1.517-.43.434-1.077.326-1.508-.108L.326 14.034c-.215-.11-.322-.434-.322-.651z"/></g></g></svg>
                        </div>';
				    $rightArrow = '<div class="arrow arrow-right">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="27" viewBox="0 0 13 27"><g><g><path fill="#868686" d="M13 13.383c0-.217-.11-.542-.33-.76L1.91.699A1.152 1.152 0 0 0 .4.591a1.172 1.172 0 0 0-.11 1.518l10.12 11.274L.29 24.549c-.43.434-.32 1.085.11 1.517.43.434 1.08.326 1.51-.108l10.76-11.924c.22-.11.33-.434.33-.651z"/></g></g></svg>
                        </div>';
				    echo paginate_links( [
					    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
					    'total'        => $query->max_num_pages,
					    'current'      => max( 1, get_query_var( 'paged' ) ),
					    'format'       => '?paged=%#%',
					    'show_all'     => true,
					    'type'         => 'plain',
					    'end_size'     => 2,
					    'mid_size'     => 1,
					    'prev_next'    => true,
					    'prev_text'    => sprintf( '<i></i> %1$s', $leftArrow ),
					    'next_text'    => sprintf( '%1$s <i></i>', $rightArrow ),
					    'add_args'     => false,
					    'add_fragment' => '',
					    'before_page_number' => '<li>',
					    'after_page_number' => '</li>',
				    ] );
				    ?>
                </ul>
            </div>
        </div>
    </div>
	<?php endif; ?>
</main>


<?php
get_footer();
?>
