<?php
/**
 * Customer email: Withdrawal request submitted (HTML).
 *
 * This template can be overridden by copying it to:
 * yourtheme/woocommerce/wbte-eu-withdrawal-button/emails/customer-withdrawal-submitted.php
 *
 * @package Wbte_Eu_Withdrawal_Button
 * @since   1.0.0
 *
 * @var Wbte_Ewb_Request              $request       The withdrawal request.
 * @var WC_Order                     $order         The WooCommerce order.
 * @var string                       $email_heading Email heading.
 * @var bool                         $sent_to_admin Whether this is an admin email.
 * @var bool                         $plain_text    Whether this is plain text.
 * @var Wbte_Ewb_Email_Request_Submitted_Customer $email The email object.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- Template locals keep the source plugin's wbte_ewb_ prefix so this override stays diffable against upstream.

// Decorator override of EU Withdrawal Button v1.0.9.
if ( ! class_exists( 'Wbte_Ewb_Email_Template' ) ) {
	return;
}

// @hooked WC_Emails::email_header() Output the email header.
do_action( 'woocommerce_email_header', $email_heading, $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WooCommerce hook. ?>

<p>
	<?php do_action( 'wt_decorator_email_body_content', $order, $sent_to_admin, $plain_text, $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility. ?>
</p>

<h2>
	<?php esc_html_e( 'Request Details', 'decorator-woocommerce-email-customizer' ); ?>
</h2>

<table cellspacing="0" cellpadding="6" border="1" style="<?php echo esc_attr( Wbte_Ewb_Email_Template::details_table_style() ); ?>">
	<?php Wbte_Ewb_Email_Template::render_details_colgroup(); ?>
	<tbody>
		<tr>
			<th scope="row" style="<?php echo esc_attr( Wbte_Ewb_Email_Template::details_th_style() ); ?>">
				<?php esc_html_e( 'Order Number', 'decorator-woocommerce-email-customizer' ); ?>
			</th>
			<td style="<?php echo esc_attr( Wbte_Ewb_Email_Template::details_td_style() ); ?>">
				<?php echo esc_html( $order->get_order_number() ); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" style="<?php echo esc_attr( Wbte_Ewb_Email_Template::details_th_style() ); ?>">
				<?php esc_html_e( 'Request Type', 'decorator-woocommerce-email-customizer' ); ?>
			</th>
			<td style="<?php echo esc_attr( Wbte_Ewb_Email_Template::details_td_style() ); ?>">
				<?php echo esc_html( $request->get_request_type_label() ); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" style="<?php echo esc_attr( Wbte_Ewb_Email_Template::details_th_style() ); ?>">
				<?php esc_html_e( 'Date Submitted', 'decorator-woocommerce-email-customizer' ); ?>
			</th>
			<td style="<?php echo esc_attr( Wbte_Ewb_Email_Template::details_td_style() ); ?>">
				<?php echo esc_html( $request->get_created_at_formatted() ); ?>
			</td>
		</tr>
		<?php
		wc_get_template(
			'emails/parts/withdrawal-verification-code-row.php',
			array( 'request' => $request ),
			'',
			WBTE_EWB_PLUGIN_DIR . 'templates/'
		);
		?>
	</tbody>
</table>

<?php
// Show items: use request items for partial, order items for full.
$wbte_ewb_request_items = $request->get_items();
$wbte_ewb_display_items = array();

if ( ! empty( $wbte_ewb_request_items ) ) {
	$wbte_ewb_display_items = $wbte_ewb_request_items;
} else {
	// Full withdrawal — list all order items.
	foreach ( $order->get_items() as $wbte_ewb_line_item ) {
		// Skip bundled child items — they are part of the parent bundle.
		if ( $wbte_ewb_line_item->get_meta( '_bundled_by', true ) ) {
			continue;
		}
		$wbte_ewb_display_items[] = array(
			'name' => $wbte_ewb_line_item->get_name(),
			'qty'  => $wbte_ewb_line_item->get_quantity(),
		);
	}
}

if ( ! empty( $wbte_ewb_display_items ) ) :
	?>
	<h2>
		<?php esc_html_e( 'Items', 'decorator-woocommerce-email-customizer' ); ?>
	</h2>
	<table cellspacing="0" cellpadding="6" border="1" style="<?php echo esc_attr( Wbte_Ewb_Email_Template::items_table_style() ); ?>">
		<thead>
			<tr>
				<th style="<?php echo esc_attr( Wbte_Ewb_Email_Template::items_th_style() ); ?>">
					<?php esc_html_e( 'Product', 'decorator-woocommerce-email-customizer' ); ?>
				</th>
				<th style="<?php echo esc_attr( Wbte_Ewb_Email_Template::items_th_style() ); ?>">
					<?php esc_html_e( 'Quantity', 'decorator-woocommerce-email-customizer' ); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $wbte_ewb_display_items as $wbte_ewb_item ) : ?>
				<tr>
					<td style="<?php echo esc_attr( Wbte_Ewb_Email_Template::items_td_style() ); ?>">
						<?php echo esc_html( isset( $wbte_ewb_item['name'] ) ? $wbte_ewb_item['name'] : __( 'Unknown item', 'decorator-woocommerce-email-customizer' ) ); ?>
					</td>
					<td style="<?php echo esc_attr( Wbte_Ewb_Email_Template::items_td_style() ); ?>">
						<?php echo esc_html( isset( $wbte_ewb_item['qty'] ) ? $wbte_ewb_item['qty'] : '1' ); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>

<h2>
	<?php esc_html_e( 'What Happens Next?', 'decorator-woocommerce-email-customizer' ); ?>
</h2>

<p>
	<?php esc_html_e( 'Our team will review your request and get back to you as soon as possible. You will receive another email once a decision has been made.', 'decorator-woocommerce-email-customizer' ); ?>
</p>

<p>
	<?php esc_html_e( 'If you have any questions in the meantime, please do not hesitate to contact us.', 'decorator-woocommerce-email-customizer' ); ?>
</p>

<?php
$wbte_ewb_additional_content = method_exists( $email, 'get_additional_content' ) ? $email->get_additional_content() : '';

if ( $wbte_ewb_additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $wbte_ewb_additional_content ) ) );
}

// @hooked WC_Emails::email_footer() Output the email footer.
do_action( 'woocommerce_email_footer', $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WooCommerce hook.
