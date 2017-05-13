<?php
/**
 * Loop Add to Cart
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

$html_start = '<span class="icon-basket"></span><div class="tool-tip">';
$html_end = '</div>';

if ( isset( $class ) ) { 
    $class_array = explode( ' ', $class );

    $key = array_search( 'button' , $class_array );
    $class_array[$key] = 'btn_shop';

    $class = join( ' ', $class_array );
}

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
    sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( isset( $quantity ) ? $quantity : 1 ),
        esc_attr( $product->get_id() ),
        esc_attr( $product->get_sku() ),
        esc_attr( isset( $class ) ? $class : 'btn_shop' ),
        $html_start . esc_html( $product->add_to_cart_text() ) . $html_end
    ),
$product );
