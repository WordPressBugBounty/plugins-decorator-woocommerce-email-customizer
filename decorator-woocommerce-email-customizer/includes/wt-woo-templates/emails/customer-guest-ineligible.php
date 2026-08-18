<?php
/**
 * Guest order ineligible for withdrawal email (HTML).
 *
 * @package Wbte_Eu_Withdrawal_Button
 * @since   1.1.0
 *
 * @var WC_Order $order
 * @var string   $email_heading
 * @var bool     $sent_to_admin
 * @var bool     $plain_text
 * @var WC_Email $email
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- Template locals keep the source plugin's wbte_ewb_ prefix so this override stays diffable against upstream.

// Decorator override of EU Withdrawal Button v1.0.9.
if ( ! class_exists( 'Wbte_Ewb_Settings' ) ) {
	return;
}

// @hooked WC_Emails::email_header() Output the email header.
do_action( 'woocommerce_email_header', $email_heading, $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
?>

<p>
	<?php do_action( 'wt_decorator_email_body_content', $order, $sent_to_admin, $plain_text, $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility. ?>
</p>

<p>
	<?php esc_html_e( 'This may be because:', 'decorator-woocommerce-email-customizer' ); ?>
</p>

<ul>
	<li><?php esc_html_e( 'The withdrawal period for this order has expired.', 'decorator-woocommerce-email-customizer' ); ?></li>
	<li><?php esc_html_e( 'A withdrawal has already been processed for this order.', 'decorator-woocommerce-email-customizer' ); ?></li>
	<li><?php esc_html_e( 'There are no remaining items eligible for withdrawal.', 'decorator-woocommerce-email-customizer' ); ?></li>
</ul>

<?php
$wbte_ewb_contact_emails = Wbte_Ewb_Settings::get_customer_contact_emails( null, $order );
if ( ! empty( $wbte_ewb_contact_emails ) ) :
?>
<p>
	<?php
	printf(
		/* translators: %s: store contact email */
		esc_html__( 'If you believe this is an error or have questions, please contact us at %s.', 'decorator-woocommerce-email-customizer' ),
		'<a href="mailto:' . esc_attr( $wbte_ewb_contact_emails[0] ) . '">' . esc_html( $wbte_ewb_contact_emails[0] ) . '</a>'
	);
	?>
</p>
<?php endif; ?>

<?php
$wbte_ewb_additional_content = method_exists( $email, 'get_additional_content' ) ? $email->get_additional_content() : '';

if ( $wbte_ewb_additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $wbte_ewb_additional_content ) ) );
}

// @hooked WC_Emails::email_footer() Output the email footer.
do_action( 'woocommerce_email_footer', $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
