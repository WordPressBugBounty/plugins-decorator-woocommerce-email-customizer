<?php
/**
 * Cart abandonment reminder email template (without coupon).
 *
 * @package Wt_Smart_Coupon
 * @since 2.0.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Action hook to trigger before coupon email
 *
 * @since 2.0.7
 */
do_action( 'woocommerce_email_header', $email_heading, $email );

/**
 * Action hook to execute the email body content
 *
 * @since 2.0.7
 */
do_action( 'wt_decorator_email_body_content', $cart_data, $sent_to_admin, $plain_text, $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility.
?>

<?php
if ( ! empty( $cart_data['cart'] ) ) :
	?>
	<table cellspacing="0" style="width: 100%; border: 1px solid #e5e5e5; font-size: 13px;">
		<thead>
			<tr style="background-color: #f8f8f8">
				<th style="text-align: left; border-bottom: 1px solid #e5e5e5; padding: 12px;"><?php esc_html_e( 'Image', 'decorator-woocommerce-email-customizer' ); ?></th>
				<th style="text-align: left; border-bottom: 1px solid #e5e5e5; padding: 12px;"><?php esc_html_e( 'Product', 'decorator-woocommerce-email-customizer' ); ?></th>
				<th style="text-align: left; border-bottom: 1px solid #e5e5e5; padding: 12px;"><?php esc_html_e( 'Price', 'decorator-woocommerce-email-customizer' ); ?></th>
				<th style="text-align: left; border-bottom: 1px solid #e5e5e5; padding: 12px;"><?php esc_html_e( 'Quantity', 'decorator-woocommerce-email-customizer' ); ?></th>
				<th style="text-align: right; border-bottom: 1px solid #e5e5e5; padding: 12px;"><?php esc_html_e( 'Subtotal', 'decorator-woocommerce-email-customizer' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$rp_decorator_cart_total = 0;
			$rp_decorator_tax_total  = 0;
			foreach ( $cart_data['cart'] as $rp_decorator_cart_item_key => $rp_decorator_cart_item ) :
				$rp_decorator_product = wc_get_product( $rp_decorator_cart_item['product_id'] );

				/**
				 * Filter to alter the product object
				 *
				 * @since 2.0.7
				 */
				$rp_decorator_product = apply_filters( 'woocommerce_cart_item_product', $rp_decorator_product, $rp_decorator_cart_item, $rp_decorator_cart_item_key );
				/**
				 * Filter to alter the product ID
				 *
				 * @since 2.0.7
				 */
				$rp_decorator_product_id = apply_filters( 'woocommerce_cart_item_product_id', $rp_decorator_cart_item['product_id'], $rp_decorator_cart_item, $rp_decorator_cart_item_key );
				/**
				 * Filter to alter the product name
				 *
				 * @since 2.0.7
				 */
				$rp_decorator_product_name = apply_filters( 'woocommerce_cart_item_name', $rp_decorator_product->get_name(), $rp_decorator_cart_item, $rp_decorator_cart_item_key );

				/**
				 * Filter to alter the product visibility
				 *
				 * @since 2.0.7
				 */
				if ( $rp_decorator_product && $rp_decorator_product->exists() && $rp_decorator_cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $rp_decorator_cart_item, $rp_decorator_cart_item_key ) ) :
					$rp_decorator_unit_price  = $rp_decorator_cart_item['line_subtotal'] / $rp_decorator_cart_item['quantity'];
					$rp_decorator_cart_total += $rp_decorator_cart_item['line_total'];
					$rp_decorator_tax_total  += $rp_decorator_cart_item['line_tax'];
					?>
					<tr>
						<td style="border-bottom: 1px solid #e5e5e5; padding: 12px;">
							<?php
							/**
							 * Filter to alter the product thumbnail
							 *
							 * @since 2.0.7
							 */
							echo apply_filters( 'woocommerce_cart_item_thumbnail', $rp_decorator_product->get_image( array( 80, 80 ) ), $rp_decorator_cart_item, $rp_decorator_cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?>
						</td>
						<td style="border-bottom: 1px solid #e5e5e5; padding: 12px;">
							<?php echo wp_kses_post( $rp_decorator_product_name ); ?>
						</td>
						<td style="border-bottom: 1px solid #e5e5e5; padding: 12px;">
							<?php echo wp_kses_post( wc_price( $rp_decorator_unit_price ) ); ?>
						</td>
						<td style="border-bottom: 1px solid #e5e5e5; padding: 12px;">
							<?php echo esc_html( $rp_decorator_cart_item['quantity'] ); ?>
						</td>
						<td style="border-bottom: 1px solid #e5e5e5; padding: 12px;">
							<?php echo wp_kses_post( wc_price( $rp_decorator_cart_item['line_subtotal'] ) ); ?>
						</td>
					</tr>
					<?php
				endif;
			endforeach;
			$rp_decorator_grand_total = $rp_decorator_cart_total + $rp_decorator_tax_total;
			?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" style="text-align: right; border-top: 1px solid #e5e5e5; padding: 12px;">
					<strong>
					<?php
					if ( $rp_decorator_tax_total > 0 ) {
						esc_html_e( 'Total (including tax):', 'decorator-woocommerce-email-customizer' );
					} else {
						esc_html_e( 'Total:', 'decorator-woocommerce-email-customizer' );
					}
					?>
					</strong>
				</td>
				<td style="text-align: left; border-top: 1px solid #e5e5e5; padding: 12px 12px 12px 0;">
					<?php echo wp_kses_post( wc_price( $rp_decorator_grand_total ) ); ?>
				</td>
			</tr>
		</tfoot>
	</table>
	<?php
endif;
?>

<div style="margin: 16px 0;" class="wbte_decorator_button_container">
	<?php
	$rp_decorator_style = 'display: inline-block; background: #3175A6; border-radius: 4px; color:#ffffff; text-decoration:none; padding: 8px 12px; text-align:center; font-weight: 500; font-size: 14px; font-family: Inter, sans-serif; border: 0px solid #3175A6';
	/**
	 * Filter to alter the abandonment reminder email button style
	 *
	 * @since 2.0.7
	 */
	$rp_decorator_style = apply_filters( 'wt_sc_alter_abandonment_reminder_email_button_style', $rp_decorator_style ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility.
	?>
	<span>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
			<button type="button" class="button" style="<?php echo esc_attr( $rp_decorator_style ); ?>"><?php esc_html_e( 'Complete My Purchase', 'decorator-woocommerce-email-customizer' ); ?></button>
		</a>
	</span>
</div>

<p>
	<?php
	printf(
		/* translators: %s: site name */
		esc_html__( 'Thank you for choosing %s! We look forward to serving you again.', 'decorator-woocommerce-email-customizer' ),
		esc_html( get_bloginfo( 'name' ) )
	);
	?>
</p>

<p>
	<?php
	esc_html_e( "If you've already checked out or no longer want these items, you can ignore this email (but we hope you don't!).", 'decorator-woocommerce-email-customizer' );
	?>
</p>

<?php
if ( $additional_content ) :
	?>
	<p>
		<?php
		echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
		?>
	</p>
	<?php
endif;

/**
 * Action hook to trigger after coupon email
 *
 * @since 2.0.7
 */
do_action( 'woocommerce_email_footer', $email );
?>