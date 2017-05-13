<?php
/**
 * Order details table shown in emails.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email );

echo strtoupper( sprintf( __( 'Order number: %s', 'woocommerce' ), $order->get_order_number() ) ) . "\n";
echo date_i18n( __( 'jS F Y', 'woocommerce' ), strtotime( $order->order_date ) ) . "\n";
echo "\n" . $order->email_order_items_table( array(
    'show_sku'    => $sent_to_admin,
    'show_image'  => false,
    'image_size'  => array( 32, 32 ),
    'plain_text'  => true
) );

echo "==========\n\n";

if ( $totals = $order->get_order_item_totals() ) {
    foreach ( $totals as $total ) {
        echo $total['label'] . "\t " . $total['value'] . "\n";
    }
}

if ( $sent_to_admin ) {
    echo "\n" . sprintf( __( 'View order: %s', 'woocommerce'), admin_url( 'post.php?post=' . $order->id . '&action=edit' ) ) . "\n";
}

if ( ! $sent_to_admin ) { 
    global $wpdb;

    echo "\n\n" . __( 'Additional Information', 'citytours' ) . "\n\n";

    foreach ( $order->get_items() as $order_item ) {

        $product_id = $order_item['product_id'];
        $hotel_tour_id = get_post_meta( $product_id, '_ct_post_id', true );

        if ( $hotel_tour_id ) { 
            $booking_info = $wpdb->get_row( 'SELECT booking_no, pin_code FROM ' . CT_ORDER_TABLE . ' WHERE other = ' . $order->get_order_number(), ARRAY_A );

            echo ' --- ' $order_item['name'] . " --- \n" ;
            echo __( 'Booking No : ', 'citytours' ) . $booking_info['booking_no'] . "\n";
            echo __( 'Pin Code : ', 'citytours' ) . $booking_info['pin_code'] . "\n";
        }
    }
}

do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email );
