<?php
/**
 * Smart Coupon Store Credit Coupon Template
 *
 * @package    Wt_Smart_Coupon
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php

	/**
	 * Action hook to trigger before coupon email
	 *
	 * @since 1.0.0
	 */
	do_action( 'woocommerce_email_header', $email_heading, $email );

	$rp_decorator_credit_amount   = 0;
	$rp_decorator_coupon_html     = array();
	$rp_decorator_currency_symbol = get_woocommerce_currency_symbol();


	$rp_decorator_coupons = isset( $credit_email_args['coupon_id'] ) ? $credit_email_args['coupon_id'] : 0;
	$rp_decorator_coupons = maybe_unserialize( $rp_decorator_coupons );
	$rp_decorator_from    = isset( $credit_email_args['from_name'] ) ? $credit_email_args['from_name'] : '';
if ( '' === $rp_decorator_from ) {
	$rp_decorator_from = get_bloginfo( 'name' );
}
	$rp_decorator_template = isset( $credit_email_args['template'] ) ? $credit_email_args['template'] : 'general';

	$rp_decorator_store_credit_templates = Wt_Smart_Coupon_Customisable_Gift_Card::get_template_image( $rp_decorator_template );

	/* custom caption */
	$rp_decorator_caption = isset( $credit_email_args['caption'] ) ? $credit_email_args['caption'] : Wt_Smart_Coupon_Store_Credit::get_gift_card_caption( $rp_decorator_template );

	$rp_decorator_coupon_message = isset( $credit_email_args['message'] ) ? $credit_email_args['message'] : Wt_Smart_Coupon_Store_Credit::get_gift_card_message( $rp_decorator_template );

	$rp_decorator_top_background    = $rp_decorator_store_credit_templates['top_bg_color'];
	$rp_decorator_bottom_background = $rp_decorator_store_credit_templates['bottom_bg_color'];

if ( is_array( $rp_decorator_coupons ) ) {
	$rp_decorator_coupons = $rp_decorator_coupons[0];
}
	$rp_decorator_coupon_obj   = new WC_Coupon( $rp_decorator_coupons );
	$rp_decorator_coupon_title = $rp_decorator_coupon_obj->get_code();
	/**
	 * Filter to alter the gift card email price
	 *
	 * @since 1.0.0
	 */
	$rp_decorator_credit_amount = apply_filters( 'wt_sc_alter_giftcard_email_price', $rp_decorator_coupon_obj->get_amount(), $rp_decorator_coupon_obj ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility.

if ( ! $rp_decorator_coupon_title ) {
	$rp_decorator_coupon_title = 'XXX-XXX-XXX';
}
?>
	<div class="wt_store_credit_email_wrapper">
		<div class="store_credit_preview" >
			<div class="wt_gift_coupon_preview_caption <?php echo esc_attr( $rp_decorator_template ); ?>" style="background-color:<?php echo esc_attr( $rp_decorator_top_background ); ?>">
				<?php echo esc_html( $rp_decorator_caption ); ?>
			</div>
			<div class="wt_gift_coupon_preview_image">
				<img src="<?php echo esc_url( $rp_decorator_store_credit_templates['image_url'] ); ?>" alt="<?php echo esc_attr( $rp_decorator_template ); ?>">
			</div>
			<table class="wt_coupon-code-block" style="width:100%; background:#ffffff;">
				<tr>
					<td class="coupon-code-td">
						<div class="coupon-code" style="text-align:left;">
							<span style="background:#0e0b0d; padding:10px; color:#fff; border-radius:6px;">
								<?php echo esc_html( $rp_decorator_coupon_title ); ?>
							</span>
						</div>
						
					</td>
					<?php
					/**
					 * Action hook to trigger after coupon code
					 *
					 * @since 1.0.0
					 */
					do_action( 'wt_sc_giftcard_email_after_coupon_code', $rp_decorator_coupon_obj ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility.
					?>
					<td class="coupon_price" style="text-align:right; font-size:32px; font-weight:700; color:#0e0b0d;">
						<?php
						$rp_decorator_currency_position = get_option( 'woocommerce_currency_pos' );
						if ( 'left' === $rp_decorator_currency_position ) {
							echo esc_html( $rp_decorator_currency_symbol );
							?>
							<span><?php echo esc_html( $rp_decorator_credit_amount ); ?></span>
							<?php
						} else {
							?>
							<span><?php echo esc_html( $rp_decorator_credit_amount ); ?></span>
							<?php
							echo esc_html( $rp_decorator_currency_symbol );
						}
						?>
					</td>
				</tr>
			</table>

			<table class="coupon-message-block <?php echo esc_attr( $rp_decorator_template ); ?>" style="background-color:<?php echo esc_attr( $rp_decorator_bottom_background ); ?>; width:100%;">
				<tr>
					<td class="coupon-message" style="text-align:left; padding:20px;"><?php echo esc_html( $rp_decorator_coupon_message ); ?></td>
					<?php if ( $rp_decorator_from ) { ?>
						<td class="coupon-from" style="text-align:right; padding:20px;"><?php esc_html_e( 'FROM:', 'decorator-woocommerce-email-customizer' ); ?> <span><?php echo esc_html( $rp_decorator_from ); ?></span></td>
					<?php } ?>
				</tr>
			</table>

			<div class="wt_gift_coupon_additional_content">
				<?php
					/**
					 * Show user-defined additional content - this is set in each email's settings.
					 */
				if ( $additional_content ) {
					echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
				}
				?>
			</div>

		</div>
	</div>


<?php

/**
 * Action hook to trigger after coupon email
 *
 * @since 1.0.0
 */
do_action( 'woocommerce_email_footer', $email );
?>