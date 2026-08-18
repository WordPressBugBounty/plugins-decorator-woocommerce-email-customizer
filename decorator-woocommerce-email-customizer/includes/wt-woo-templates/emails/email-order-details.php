<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.8.0
 */

use Automattic\WooCommerce\Utilities\FeaturesUtil;

defined( 'ABSPATH' ) || exit;

$rp_decorator_text_align = is_rtl() ? 'right' : 'left';

$rp_decorator_email_improvements_enabled = FeaturesUtil::feature_is_enabled( 'email_improvements' );

if ( $rp_decorator_email_improvements_enabled ) {
	add_filter( 'woocommerce_order_shipping_to_display_shipped_via', '__return_false' );
}

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

<div id="wt_order_items_table">

<?php
	$rp_decorator_order_details_heading = '';
	if ( $rp_decorator_email_improvements_enabled ) {
		/** This filter is documented in woocommerce/templates/emails/email-order-details.php */
		$rp_decorator_order_details_heading = apply_filters( 'woocommerce_email_order_details_heading', '', $order, $email );
	}

	/** This filter is documented in woocommerce/templates/emails/email-order-details.php */
	$rp_decorator_display_order_number = (bool) apply_filters( 'woocommerce_email_display_order_number', true, $order, $email );

	if ( $rp_decorator_order_details_heading || $rp_decorator_display_order_number ) :
	?>
<h2>
	<?php
	if ( $rp_decorator_order_details_heading ) {
		echo wp_kses_post( $rp_decorator_order_details_heading );
	}
	if ( $rp_decorator_display_order_number ) {
		if ( $sent_to_admin ) {
			$rp_decorator_before = '<a class="link" href="' . esc_url( $order->get_edit_order_url() ) . '">';
			$rp_decorator_after  = '</a>';
		} else {
			$rp_decorator_before = '';
			$rp_decorator_after  = '';
		}
		if ( $rp_decorator_order_details_heading ) {
			echo '<br>';
		}
		/* translators: %s: Order ID. */
		echo wp_kses_post( $rp_decorator_before . sprintf( __( '[Order #%s]', 'decorator-woocommerce-email-customizer' ) . $rp_decorator_after . ' (<time datetime="%s">%s</time>)', $order->get_order_number(), $order->get_date_created()->format( 'c' ), wc_format_datetime( $order->get_date_created() ) ) );
	}
	?>
</h2>
<?php endif; ?>

<div style="margin-bottom: <?php echo $rp_decorator_email_improvements_enabled ? '24px' : '40px'; ?>;">
	<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
		<thead>
			<tr>
				<th class="td" scope="col" style="text-align:<?php echo esc_attr( $rp_decorator_text_align ); ?>;"><?php esc_html_e( 'Product', 'decorator-woocommerce-email-customizer' ); ?></th>
				<th class="td" scope="col" style="text-align:<?php echo esc_attr( $rp_decorator_text_align ); ?>;"><?php esc_html_e( 'Quantity', 'decorator-woocommerce-email-customizer' ); ?></th>
				<th class="td" scope="col" style="text-align:<?php echo esc_attr( $rp_decorator_text_align ); ?>;"><?php esc_html_e( 'Price', 'decorator-woocommerce-email-customizer' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$rp_decorator_image_size = $rp_decorator_email_improvements_enabled ? 48 : 32;
				echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$order,
				array(
					'show_sku'      => $sent_to_admin,
					'show_image'    => $rp_decorator_email_improvements_enabled,
					'image_size'    => array( $rp_decorator_image_size, $rp_decorator_image_size ),
					'plain_text'    => $plain_text,
					'sent_to_admin' => $sent_to_admin,
				)
			);
			?>
		</tbody>
		<tfoot>
			<?php
			$rp_decorator_item_totals = $order->get_order_item_totals();

			if ( $rp_decorator_item_totals ) {
				$rp_decorator_i = 0;
				foreach ( $rp_decorator_item_totals as $rp_decorator_total ) {
					$rp_decorator_i++;
					?>
					<tr>
						<th class="td" scope="row" colspan="2" style="text-align:<?php echo esc_attr( $rp_decorator_text_align ); ?>; <?php echo ( 1 === $rp_decorator_i ) ? 'border-top-width: 4px;' : ''; ?>"><?php echo wp_kses_post( $rp_decorator_total['label'] ); ?></th>
						<td class="td" style="text-align:<?php echo esc_attr( $rp_decorator_text_align ); ?>; <?php echo ( 1 === $rp_decorator_i ) ? 'border-top-width: 4px;' : ''; ?>"><?php echo wp_kses_post( $rp_decorator_total['value'] ); ?></td>
					</tr>
					<?php
				}
			}
			if ( $order->get_customer_note() ) {
				?>
				<tr>
					<th class="td" scope="row" colspan="2" style="text-align:<?php echo esc_attr( $rp_decorator_text_align ); ?>;"><?php esc_html_e( 'Note:', 'decorator-woocommerce-email-customizer' ); ?></th>
					<td class="td" style="text-align:<?php echo esc_attr( $rp_decorator_text_align ); ?>;"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
				</tr>
				<?php
			}
			?>
		</tfoot>
	</table>
    </div>
</div>

<?php
if ( $rp_decorator_email_improvements_enabled ) {
	remove_filter( 'woocommerce_order_shipping_to_display_shipped_via', '__return_false' );
}

do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>
