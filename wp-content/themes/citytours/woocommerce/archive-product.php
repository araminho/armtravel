<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $ct_options, $woocommerce_loop;

$sidebar_position = $ct_options['shop_page_layout'];

if ( $sidebar_position == 'no' ) { 
    $wrapper_class = 'col-md-12';
} else if ( $sidebar_position == 'right' ) { 
    $wrapper_class = 'col-md-9';
} else { 
    $wrapper_class = 'col-md-9 left-sidebar';
}

$header_img_scr = ct_get_header_image_src( 'shop' );

$woocommerce_loop['columns'] = $ct_options['shop_product_columns'];

get_header( 'shop' ); ?>

    <?php 

    if ( ! empty( $header_img_scr ) ) { 
        $header_content = ! empty( $ct_options['shop_header_content'] )? $ct_options['shop_header_content'] : '' ;
        ?>

        <section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url( $header_img_scr ) ?>" data-natural-width="1400" data-natural-height="470">
            <div class="parallax-content-1">
                <?php echo balancetags( $header_content ); ?>
            </div>
        </section><!-- End section -->

        <?php 
    }
    ?>

    <div id="position">
        <div class="container"><?php ct_breadcrumbs(); ?></div>
    </div><!-- End Position -->


    <?php
        /**
         * woocommerce_before_main_content hook.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20 : removed
         */
        do_action( 'woocommerce_before_main_content' );
    ?>

    <div class="<?php echo $wrapper_class ?>">
        <div class="shop-section"> 

            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

            <?php endif; ?>

            <?php
                /**
                 * woocommerce_archive_description hook.
                 *
                 * @hooked woocommerce_taxonomy_archive_description - 10
                 * @hooked woocommerce_product_archive_description - 10
                 */
                do_action( 'woocommerce_archive_description' );
            ?>

            <?php if ( have_posts() ) : ?>

                <div class="items-sorting clearfix"> 
                    <?php
                        /**
                         * woocommerce_before_shop_loop hook.
                         *
                         * @hooked woocommerce_result_count - 20
                         * @hooked woocommerce_catalog_ordering - 30
                         */
                        do_action( 'woocommerce_before_shop_loop' );
                    ?>
                </div>

                <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <hr>

                <?php
                    /**
                     * woocommerce_after_shop_loop hook.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                ?>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                <?php wc_get_template( 'loop/no-products-found.php' ); ?>

            <?php endif; ?>

        </div>

    </div>

    <?php
        /**
         * woocommerce_sidebar hook.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action( 'woocommerce_sidebar' );
    ?>

    <?php
        /**
         * woocommerce_after_main_content hook.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );
    ?>

<?php get_footer( 'shop' ); ?>
