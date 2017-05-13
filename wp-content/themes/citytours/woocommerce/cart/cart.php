<?php
/**
 * Cart Page
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<div class="cart-section"> 

    <?php
    wc_print_notices();

    do_action( 'woocommerce_before_cart' ); ?>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <table class="shop_table shop_table_responsive woocommerce-cart-form__contents cart table table-striped cart-list shopping-cart" cellspacing="0">
            <thead>
                <tr>
                    <th class="product-thumbnail">&nbsp;</th>
                    <th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
                    <th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
                    <th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
                    <th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
                    <th class="product-remove"><?php _e( 'Actions', 'citytours' ); ?>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                <?php
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                    $is_custom_product = false;
                    $hotel_tour_id = get_post_meta( $product_id, '_ct_post_id', true );
                    if ( ! empty( $hotel_tour_id ) ) { 
                        $is_custom_product = true;
                    }

                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        ?>
                        <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                            <td class="product-thumbnail">
                                <?php
                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                    if ( ! $product_permalink ) {
                                        echo $thumbnail;
                                    } else {
                                        printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                    }
                                ?>
                            </td>

                            <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                <?php
                                    if ( ! $product_permalink ) {
                                        echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
                                    } else {
                                        echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
                                    }

                                    // Meta data
                                    echo WC()->cart->get_item_data( $cart_item );

                                    // Backorder notification
                                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                        echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
                                    }
                                ?>
                            </td>

                            <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                <strong>
                                <?php
                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                ?>
                                </strong>
                            </td>

                            <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                <?php
                                    if ( $_product->is_sold_individually() ) {
                                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                    } else {
                                        $product_quantity = woocommerce_quantity_input( array(
                                            'input_name'  => "cart[{$cart_item_key}][qty]",
                                            'input_value' => $cart_item['quantity'],
                                            'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                            'min_value'   => '0',
                                            'is_custom'   => $is_custom_product
                                        ), $_product, false );
                                    }

                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                ?>
                            </td>

                            <td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                                <strong>
                                <?php
                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                                ?>
                                </strong>
                            </td>

                            <td class="product-remove">
                                <?php
                                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                        '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"><i class="icon-trash"></i></a>',
                                        esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                        __( 'Remove this item', 'woocommerce' ),
                                        esc_attr( $product_id ),
                                        esc_attr( $_product->get_sku() )
                                    ), $cart_item_key );
                                ?>
                                <?php 
                                if ( $is_custom_product ) { 
                                    $date_from = get_post_meta( $product_id, '_ct_booking_date_from', true );
                                    $date_to = get_post_meta( $product_id, '_ct_booking_date_to', true );
                                    $ct_hotel_cart_page = esc_url( ct_get_hotel_cart_page() ) . '?hotel_id=' . $hotel_tour_id . '&date_from=' . $date_from . '&date_to=' . $date_to ;
                                ?>
                                    <!-- <span href="<?php echo $ct_hotel_cart_page ?>" class="edit-product"><i class="icon-pencil-1"></i></span> -->
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    }
                }

                do_action( 'woocommerce_cart_contents' );
                ?>
                <tr>
                    <td colspan="6" class="actions">
                        <div class="cart-options clearfix">
                            <div class="pull-left"> 
                                <?php if ( wc_coupons_enabled() ) { ?>
                                    <div class="coupon apply-coupon">
                                        <div class="form-group"> 
                                            <input type="text" name="coupon_code" class="input-text form-control" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
                                        </div>

                                        <div class="form-group"> 
                                            <input type="submit" class="button btn_cart_outine" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>" />
                                            <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="pull-right fix_mobile"> 
                                <input type="submit" class="button btn_cart_outine" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />

                                <?php do_action( 'woocommerce_cart_actions' ); ?>

                                <?php wp_nonce_field( 'woocommerce-cart' ); ?>
                            </div>
                        </div>
                    </td>
                </tr>

                <?php do_action( 'woocommerce_after_cart_contents' ); ?>
            </tbody>
        </table>

        <?php do_action( 'woocommerce_after_cart_table' ); ?>

    </form>

    <div class="cart-collaterals row">

        <?php do_action( 'woocommerce_cart_collaterals' ); ?>

    </div>

    <?php do_action( 'woocommerce_after_cart' ); ?>

</div>