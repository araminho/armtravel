<?php
/**
 * The template for displaying product search form
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
    <label class="screen-reader-text" for="woocommerce-product-search-field" style="display: none"><?php _e( 'Search for:', 'woocommerce' ); ?></label>
    <div class="input-group"> 
        <input type="search" id="woocommerce-product-search-field" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit" style="margin-left: 0"><i class="icon-search"></i></button>
        </span>
    </div>
    <input type="hidden" name="post_type" value="product" />
</form>
