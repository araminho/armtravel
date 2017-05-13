<?php
/**
 * Order details table shown in emails.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates/Emails
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$text_align = is_rtl() ? 'right' : 'left';

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php if ( ! $sent_to_admin ) : ?>
    <h2><?php printf( __( 'Order #%s', 'woocommerce' ), $order->get_order_number() ); ?></h2>
<?php else : ?>
    <h2><a class="link" href="<?php echo esc_url( admin_url( 'post.php?post=' . $order->get_id() . '&action=edit' ) ); ?>"><?php printf( __( 'Order #%s', 'woocommerce'), $order->get_order_number() ); ?></a> (<?php printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order->get_date_created() ) ), date_i18n( wc_date_format(), strtotime( $order->get_date_created() ) ) ); ?>)</h2>
<?php endif; ?>

<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
    <thead>
        <tr>
            <th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php _e( 'Product', 'woocommerce' ); ?></th>
            <th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
            <th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php _e( 'Price', 'woocommerce' ); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php echo wc_get_email_order_items( $order, array(
            'show_sku'      => $sent_to_admin,
            'show_image'    => false,
            'image_size'    => array( 32, 32 ),
            'plain_text'    => $plain_text,
            'sent_to_admin' => $sent_to_admin,
        ) ); ?>
    </tbody>
    <tfoot>
        <?php
            if ( $totals = $order->get_order_item_totals() ) {
                $i = 0;
                foreach ( $totals as $total ) {
                    $i++;
                    ?><tr>
                        <th class="td" scope="row" colspan="2" style="text-align:<?php echo $text_align; ?>; <?php if ( $i === 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
                        <td class="td" style="text-align:<?php echo $text_align; ?>; <?php if ( $i === 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['value']; ?></td>
                    </tr><?php
                }
            }
        ?>
    </tfoot>
</table>

<?php if ( ! $sent_to_admin ) : ?>

<h3 style="margin: 20px 0;"><?php _e( 'Additional Information', 'citytours' ) ?></h3>

<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
    <thead>
        <tr>
            <th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php _e( 'Product', 'woocommerce' ) ?></th>
            <th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php echo esc_html__( 'Booking No', 'citytours' ) ?></th>
            <th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php echo esc_html__( 'Pin Code', 'citytours' ) ?></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        global $wpdb;
        $items = $order->get_items(); 

        foreach ( $items as $item ) {
            $product_id = $item['product_id'];
            $hotel_tour_id = get_post_meta( $product_id, '_ct_post_id', true );

            if ( $hotel_tour_id ) { 
                $booking_info = $wpdb->get_row( 'SELECT booking_no, pin_code FROM ' . CT_ORDER_TABLE . ' WHERE other = ' . $order->get_order_number(), ARRAY_A );
                ?>
                <tr>
                    <th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php echo $item['name'] ?></th>
                    <td class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php echo $booking_info['booking_no'] ?></td>
                    <td class="td" scope="col" style="text-align:<?php echo $text_align; ?>;"><?php echo $booking_info['pin_code'] ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>

</table>

<?php endif; ?>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>
