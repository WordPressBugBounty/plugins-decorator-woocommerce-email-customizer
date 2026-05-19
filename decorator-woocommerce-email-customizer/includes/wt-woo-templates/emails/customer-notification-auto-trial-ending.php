<?php
/**
 * Customer notification: auto trial expiration (Decorator body hook).
 *
 * @package Decorator_WooCommerce_Email_Customizer
 */

defined( 'ABSPATH' ) || exit;

$rp_decorator_email_improvements_enabled = function_exists( 'wcs_is_wc_feature_enabled' ) && wcs_is_wc_feature_enabled( 'email_improvements' );

do_action( 'woocommerce_email_header', $email_heading, $email );

echo $rp_decorator_email_improvements_enabled ? '<div class="email-introduction">' : '';
do_action( 'wt_decorator_email_body_content', $subscription, $sent_to_admin, $plain_text, $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility.
echo $rp_decorator_email_improvements_enabled ? '</div>' : '';

?>
	<p>
		<?php
		echo wp_kses(
			sprintf(
				// translators: %1$s: link to account dashboard
				__( 'Payment will be deducted using the payment method on file. You can manage this subscription from your %1$s.', 'decorator-woocommerce-email-customizer' ),
				'<a href="' . esc_url( $subscription->get_view_order_url() ) . '">' . esc_html__( 'account dashboard', 'decorator-woocommerce-email-customizer' ) . '</a>'
			),
			array( 'a' => array( 'href' => true ) )
		);
		?>
	</p>
<?php
\WC_Subscriptions_Email::subscription_details( $subscription, $order, $sent_to_admin, $plain_text, true );

do_action( 'woocommerce_subscriptions_email_order_details', $subscription, $sent_to_admin, $plain_text, $email );

if ( $additional_content ) {
	echo $rp_decorator_email_improvements_enabled ? '<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td class="email-additional-content">' : '';
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
	echo $rp_decorator_email_improvements_enabled ? '</td></tr></table>' : '';
}

do_action( 'woocommerce_email_footer', $email );
