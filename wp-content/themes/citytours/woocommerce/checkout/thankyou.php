<?php
/**
 * Thankyou page
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( $order ) : ?>

    <div class="order-detailed-info">

        <?php if ( $order->has_status( 'failed' ) ) : ?>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'citytours' ); ?></p>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'citytours' ) ?></a>
                <?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'citytours' ); ?></a>
                <?php endif; ?>
            </p>

        <?php else : ?>

            <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'citytours' ), $order ); ?></p>

            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                <li class="woocommerce-order-overview__order order">
                    <?php _e( 'Order number:', 'citytours' ); ?>
                    <strong><?php echo $order->get_order_number(); ?></strong>
                </li>

                <li class="woocommerce-order-overview__date date">
                    <?php _e( 'Date:', 'citytours' ); ?>
                    <strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
                </li>

                <?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                    <li class="woocommerce-order-overview__email email">
                        <?php _e( 'Email:', 'citytours' ); ?>
                        <strong><?php echo $order->get_billing_email(); ?></strong>
                    </li>
                <?php endif; ?>

                <li class="woocommerce-order-overview__total total">
                    <?php _e( 'Total:', 'citytours' ); ?>
                    <strong><?php echo $order->get_formatted_order_total(); ?></strong>
                </li>

                <?php if ( $order->get_payment_method_title() ) : ?>
                <li class="woocommerce-order-overview__payment-method method">
                    <?php _e( 'Payment method:', 'citytours' ); ?>
                    <strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
                </li>
                <?php endif; ?>
            </ul>

            <div class="clear"></div>

        <?php endif; ?>

        <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>

    </div>

    <div class="order-detailed-info">

        <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
        
    </div>

<?php else : ?>

    <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'citytours' ), null ); ?></p>

<?php endif; ?>
