<?php
/**
 * Template Name: Sightseeings list Template
 * Template Post Type: page
 *
 */
//var_dump(get_the_post_thumbnail_url($post)); exit;
get_header();


$allTours = new WP_Query( [
    'post_type' => 'sightseeing',
    // 'meta_key'		=> 'is_featured',
    // 'meta_value'	=> true
]);

?>

    <main>
        <div class="img-bg-container">
            <img src="<?php the_post_thumbnail_url($post->ID); ?>" alt="">
            <div class="shadow"></div>
        </div>
        <div class="horizontal-line"></div>
        <div class="blog-container">
            <div class="sightseeings container-padding">
                <?php while($allTours->have_posts()): $allTours->the_post(); ?>
                    <div class="container-with-bg sightseeing">
                        <div class="sightseeing-image">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                        </div>
                        <div class="sightseeing-content">
                            <span class="title"><?php the_title(); ?></span>
                            <span class="description"><?php the_excerpt(); ?></span>
                            <a class="see-more btn-hover" href="<?php the_permalink() ?>">See more</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="container-padding pagination-container">
                <div class="arrow arrow-left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="27" viewBox="0 0 13 27"><g><g><path fill="#868686" d="M.004 13.383c0-.217.107-.542.322-.76L11.093.699a1.149 1.149 0 0 1 1.508-.108c.43.434.43 1.084.107 1.518L2.587 13.383l10.121 11.166c.431.434.323 1.085-.107 1.517-.43.434-1.077.326-1.508-.108L.326 14.034c-.215-.11-.322-.434-.322-.651z"/></g></g></svg>
                </div>
                <div class="pagination-items">
                    <ul>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a class="active" href="">4</a></li>
                        <li><a href="">5</a></li>
                        <li><a href="">6</a></li>
                    </ul>
                </div>
                <div class="arrow arrow-right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="27" viewBox="0 0 13 27"><g><g><path fill="#868686" d="M13 13.383c0-.217-.11-.542-.33-.76L1.91.699A1.152 1.152 0 0 0 .4.591a1.172 1.172 0 0 0-.11 1.518l10.12 11.274L.29 24.549c-.43.434-.32 1.085.11 1.517.43.434 1.08.326 1.51-.108l10.76-11.924c.22-.11.33-.434.33-.651z"/></g></g></svg>
                </div>
            </div>
        </div>
    </main>


<?php
get_footer();