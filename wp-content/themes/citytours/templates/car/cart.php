<?php
/* Car Cart Page Template */
if ( ! defined( 'ABSPATH' ) ) { 
	exit; 
}

// validation
$required_params = array( 'car_id' );
foreach ( $required_params as $param ) {
	if ( ! isset( $_REQUEST[ $param ] ) ) {
		do_action( 'ct_car_booking_wrong_data' ); // ct_redirect_home() - if data is not valid return to home
		exit;
	}
}

// init variables
$car_id      = $_REQUEST['car_id'];
$is_repeated  = get_post_meta( $car_id, '_car_repeated', true );
$car_date    = get_post_meta( $car_id, '_car_date', true );
$charge_child = get_post_meta( $car_id, '_car_charge_child', true );
$deposit_rate = get_post_meta( $car_id, '_car_security_deposit', true );
$deposit_rate = empty( $deposit_rate ) ? 0 : $deposit_rate;
$add_services = ct_get_add_services_by_postid( $car_id );

$date = '';
if ( ! empty( $is_repeated ) ) {
	if ( empty( $_REQUEST['date'] ) ) {
		do_action( 'ct_car_booking_wrong_data' ); // ct_redirect_home() - if data is not valid return to home
		exit;
	}
	$date = $_REQUEST['date'];
	$time = ( isset( $_REQUEST['time'] ) ) ? $_REQUEST['time'] : "";
	$pickup_location = ( isset( $_REQUEST['pickup_location'] ) ) ? $_REQUEST['pickup_location'] : "";
	$dropoff_location = ( isset( $_REQUEST['dropoff_location'] ) ) ? $_REQUEST['dropoff_location'] : "";
} else if ( ! empty( $car_date ) ) {
	$date = $car_date;
}

$uid = $car_id . $date;
if ( $cart_data = CT_Hotel_Cart::get( $uid ) ) {
	// init booking info if cart is not empty
	$adults      = $cart_data['car']['adults'];
	$kids        = $cart_data['car']['kids'];
	$total_price = $cart_data['car']['total'];
	$time 		 = $cart_data['time'];
	$pickup_location = $cart_data['pickup_location'];
	$dropoff_location = $cart_data['dropoff_location'];
} else {
	// init cart if it is empty
	$adults      = ( isset( $_REQUEST['adults'] ) ) ? $_REQUEST['adults'] : 1;
	$kids        = ( isset( $_REQUEST['kids'] ) ) ? $_REQUEST['kids'] : 0;
	
	$total_price = ct_car_calc_car_price( $car_id, $date, $adults, $kids );
	$cart_data   = array(
		'car'          => array(
			'adults'    => $adults, 
			'kids'      => $kids, 
			'total'     => $total_price,
		),
		'car_id'       => $car_id,
		'date'          => $date,
		'time'			=> $time,
		'pickup_location' => $pickup_location,
		'dropoff_location' => $dropoff_location,
		'total_adults'  => $adults,
		'total_kids'    => $kids,
		'total_price'   => $total_price,
	);
	CT_Hotel_Cart::set( $uid, $cart_data );
}

$cart = new CT_Hotel_Cart();
$cart_service = $cart->get_field( $uid, 'add_service' );
$ct_car_checkout_page_url = apply_filters( 'ct_get_woocommerce_cart_url', ct_get_car_checkout_page() );

// main function
if ( ! $ct_car_checkout_page_url ) { 
	?>

	<h5 class="alert alert-warning"><?php echo esc_html__( 'Please set checkout page in theme options panel.', 'citytours' ) ?></h5>

	<?php 
} else {
	// function
	$is_available = ct_car_check_availability( $car_id, $date, $time, $adults, $kids );
	if ( true === $is_available ) : ?>

	<form id="car-cart" action="<?php echo esc_url( add_query_arg( array( 'uid' => $uid ), $ct_car_checkout_page_url ) ); ?>">

		<div class="row">

			<div class="col-md-8">

				<?php do_action( 'car_cart_main_before' ); ?>

				<table class="table table-striped cart-list car add_bottom_30">
					<thead>
						<tr>
							<th><?php echo esc_html__( 'Item', 'citytours' ) ?></th>
							<th><?php echo esc_html__( 'Adults', 'citytours' ) ?></th>
							<th><?php echo esc_html__( 'Children', 'citytours' ) ?></th>
							<th><?php echo esc_html__( 'Total', 'citytours' ) ?></th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td data-title="<?php esc_attr_e( 'Item', 'citytours' ) ?>">
								<div class="thumb_cart">
									<a href="#" data-toggle="modal" data-target="#car-<?php echo esc_attr( $car_id ) ?>"><?php echo get_the_post_thumbnail( $car_id, 'thumbnail' ); ?></a>
								</div>
								 <span class="item_cart"><a href="#" data-toggle="modal" data-target="#car-<?php echo esc_attr( $car_id ) ?>"><?php echo esc_html( get_the_title( $car_id ) ); ?></a></span>
							</td>
							<td data-title="<?php esc_attr_e( 'Adults', 'citytours' ) ?>">
								<div class="numbers-row" data-min="1">
									<input type="text" class="qty2 form-control car-adults" name="adults" value="<?php echo esc_attr( $adults ) ?>">
									
									<div class="inc button_inc">+</div>
									<div class="dec button_inc">-</div>
								</div>
							</td>
							<td data-title="<?php esc_attr_e( 'Children', 'citytours' ) ?>">
								<div class="numbers-row" data-min="0">
									<input type="text" class="qty2 form-control car-kids" name="kids" value="<?php echo esc_attr( $kids ) ?>" <?php if ( empty( $charge_child ) ) echo 'disabled'; ?>>
									
									<div class="inc button_inc">+</div>
									<div class="dec button_inc">-</div>
								</div>
							</td>
							<td data-title="<?php esc_attr_e( 'Total', 'citytours' ) ?>">
								<strong><?php if ( ! empty( $total_price ) ) echo ct_price( $total_price ) ?></strong>
							</td>
						</tr>
					</tbody>
				</table>

				<?php if ( ! empty( $add_services ) ) : ?>
					<table class="table table-striped options_cart">
						<thead>
							<tr>
								<th colspan="4"><?php echo esc_html__( 'Add options / Services', 'citytours' ) ?></th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ( $add_services as $service ) : ?>
								<tr>
									<td>
										<i class="<?php echo esc_attr( $service->icon_class ); ?>"></i>
									</td>
									<td>
										<?php echo esc_attr( $service->title ); ?> 
										<strong>+<?php echo ct_price( $service->price ); ?></strong>
									</td>
									<td>
										<?php
										$field_name = 'add_service_' . esc_attr( $service->id );

										if ( ! empty( $cart_service ) && ! empty( $cart_service[ $service->id ] ) ) {
											$temp_value = isset( $cart_service[$service->id]['qty'] ) ? $cart_service[$service->id]['qty'] : 1;
										} else {
											$temp_value = isset( $_REQUEST[ $field_name ] ) ? $_REQUEST[ $field_name ] : 1;
										}
										?>
										
										<div class="numbers-row post-right <?php if ( empty( $cart_service ) || empty( $cart_service[ $service->id ] ) ) echo 'hide-row';  ?>" data-min="1">
											<input type="text" class="qty2 form-control <?php echo esc_attr( $field_name ); ?>" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $temp_value ); ?>">
										
											<div class="inc button_inc">+</div>
											<div class="dec button_inc">-</div>
										</div>
									</td>
									<td>
										<label class="switch-light switch-ios pull-right">
										<input type="checkbox" name="add_service[<?php echo esc_attr( $service->id ); ?>]" value="1"<?php if ( ! empty( $cart_service ) && ! empty( $cart_service[ $service->id ] ) ) echo ' checked="checked"' ?>>
										<span>
										<span><?php echo esc_html__( 'No', 'citytours' ) ?></span>
										<span><?php echo esc_html__( 'Yes', 'citytours' ) ?></span>
										</span>
										<a></a>
										</label>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				<?php endif; ?>

				<?php do_action( 'car_cart_main_after' ); ?>

			</div><!-- End col-md-8 -->

			<aside class="col-md-4">

				<?php do_action( 'car_cart_sidebar_before' ); ?>

				<div class="box_style_1">
					<h3 class="inner"><?php echo esc_html__( '- Summary -', 'citytours' ) ?></h3>

					<table class="table table_summary">
						<tbody>
							<?php if ( ! empty( $date ) ) : ?>
							<tr>
								<td><?php echo esc_html__( 'Date', 'citytours' ) ?></td>
								<td class="text-right"><?php echo date_i18n( 'j F Y', ct_strtotime( $date ) ); ?></td>
							</tr>
							<?php endif; ?>
							<?php if ( ! empty( $time ) ) : ?>
							<tr>
								<td><?php echo esc_html__( 'Time', 'citytours' ) ?></td>
								<td class="text-right"><?php echo esc_html( $time ); ?></td>
							</tr>
							<?php endif; ?>
							<tr>
								<td><?php echo esc_html__( 'Adults', 'citytours' ) ?></td>
								<td class="text-right"><?php echo esc_html( $adults ) ?></td>
							</tr>
							<tr>
								<td><?php echo esc_html__( 'Children', 'citytours' ) ?></td>
								<td class="text-right"><?php echo esc_html( $kids ) ?></td>
							</tr>
							<tr>
								<td><?php echo esc_html__( 'From', 'citytours' ) ?></td>
								<td class="text-right"><?php echo esc_html( $pickup_location ) ?></td>
							</tr>
							<tr>
								<td><?php echo esc_html__( 'To', 'citytours' ) ?></td>
								<td class="text-right"><?php echo esc_html( $dropoff_location ) ?></td>
							</tr>
							<?php if ( ! empty( $cart_service ) ) {
								foreach ( $cart_service as $key => $service ) { ?>
									<tr>
										<td><?php echo esc_html( $service['title'] ) ?></td>
										<td class="text-right"><?php echo ct_price( $service['total'] ); ?></td>
									</tr>
							<?php }} ?>
							<tr class="total">
								<td><?php echo esc_html__( 'Total cost', 'citytours' ) ?></td>
								<td class="text-right"><?php $total_price = $cart->get_field( $uid, 'total_price' ); if ( ! empty( $total_price ) ) echo ct_price( $total_price ) ?></td>
							</tr>
							<tr>
								<td><?php echo sprintf( esc_html__( 'Security Deposit (%d%%)', 'citytours' ), $deposit_rate ) ?></td>
								<td class="text-right"><?php if ( ! empty( $total_price ) ) echo ct_price( $total_price * $deposit_rate / 100 ) ?></td>
							</tr>
						</tbody>
					</table>

					<a class="btn_full book-now-btn" href="#"><?php echo esc_html__( 'Book now', 'citytours' ) ?></a>
					<a class="btn_full update-cart-btn" href="#"><?php echo esc_html__( 'Update Cart', 'citytours' ) ?></a>
					<a class="btn_full_outline" href="<?php echo esc_url( get_permalink( $car_id ) ) ?>"><i class="icon-right"></i> <?php echo esc_html__( 'Modify your search', 'citytours' ) ?></a>

					<input type="hidden" name="action" value="ct_car_book">
					<input type="hidden" name="car_id" value="<?php echo esc_attr( $car_id ) ?>">
					<input type="hidden" name="date" value="<?php echo esc_attr( $date ) ?>">
					<input type="hidden" name="time" value="<?php echo esc_attr( $time ) ?>">
					<input type="hidden" name="pickup_location" value="<?php echo esc_attr( $pickup_location ) ?>">
					<input type="hidden" name="dropoff_location" value="<?php echo esc_attr( $dropoff_location ) ?>">
					<?php wp_nonce_field( 'car_update_cart' ); ?>
				</div>

				<?php do_action( 'car_cart_sidebar_after' ); ?>

			</aside><!-- End aside -->

		</div><!--End row -->

	</form>

	<script>
		var ajaxurl = '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ) ?>';
		var is_woocommerce_enabled = '<?php if ( ct_is_woocommerce_integration_enabled() ) echo "true"; else echo "false" ?>';

		jQuery(document).ready( function($){ 
			$('#car-cart input').change(function(){
				$('.update-cart-btn').css('display', 'inline-block');
				$('.book-now-btn').hide();
			});

			$('.update-cart-btn').click(function(e){
				e.preventDefault();

				$('input[name="action"]').val('ct_car_update_cart');
				$('#overlay').fadeIn();

				$.ajax({
					url: ajaxurl,
					type: "POST",
					data: $('#car-cart').serialize(),
					success: function(response){
						if (response.success == 1) {
							location.reload();
						} else {
							alert(response.message);
							$('#overlay').fadeOut();
						}
					}
				});

				return false;
			});

			$('.options_cart input[type="checkbox"]').change(function(){
				var qty_display = $(this).parent().parent().parent().find('.numbers-row');

				if ( qty_display.hasClass("hide-row") ) {
					qty_display.removeClass("hide-row");
				} else { 
					qty_display.addClass("hide-row");
				}
			});

			$('.book-now-btn').click(function(e){
				e.preventDefault();

				if ( is_woocommerce_enabled == "true" ) { 
					$('#overlay').fadeIn();
					$('input[name="action"]').val('ct_add_car_to_woo_cart');

					$.ajax({
						url: ajaxurl,
						type: "POST",
						data: $('#car-cart').serialize(),
						success: function(response){
							$('#overlay').fadeOut();
							if (response.success == 1) {
								document.location.href=$("#car-cart").attr('action');
							} else {
								alert(response.message);
							}
						}
					});
				} else { 
					document.location.href=$("#car-cart").attr('action');
				}
			})
		} );
	</script>

	<?php else : ?>
		<h5 class="alert alert-warning"><?php echo esc_html( $is_available ); ?></h5>
	<?php endif;
}