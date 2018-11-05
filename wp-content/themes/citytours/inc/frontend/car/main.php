<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( CT_INC_DIR . '/frontend/car/functions.php');
require_once( CT_INC_DIR . '/frontend/car/templates.php');
require_once( CT_INC_DIR . '/frontend/car/ajax.php');

add_action( 'ct_car_booking_wrong_data', 'ct_redirect_home' );
add_action( 'ct_car_thankyou_wrong_data', 'ct_redirect_home' );
add_action( 'wp_ajax_ct_car_update_cart', 'ct_car_update_cart' );
add_action( 'wp_ajax_nopriv_ct_car_update_cart', 'ct_car_update_cart' );
add_action( 'wp_ajax_ct_car_submit_booking', 'ct_car_submit_booking' );
add_action( 'wp_ajax_nopriv_ct_car_submit_booking', 'ct_car_submit_booking' );

add_action( 'wp_ajax_ct_add_car_to_woo_cart', 'ct_add_car_to_woo_cart' );
add_action( 'wp_ajax_nopriv_ct_add_car_to_woo_cart', 'ct_add_car_to_woo_cart' );
