<?php
/**
 * Admin new switch order email (Decorator body hook).
 *
 * @package Decorator_WooCommerce_Email_Customizer
 */

defined( 'ABSPATH' ) || exit;

$rp_decorator_email_improvements_enabled = function_exists( 'wcs_is_wc_feature_enabled' ) && wcs_is_wc_feature_enabled( 'email_improvements' );

do_action( 'woocommerce_email_header', $email_heading, $email );

echo $rp_decorator_email_improvements_enabled ? '<div class="email-introduction">' : '';
do_action( 'wt_decorator_email_body_content', $order, $sent_to_admin, $plain_text, $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility.
echo $rp_decorator_email_improvements_enabled ? '</div>' : '';

?>
<h2><?php esc_html_e( 'Switch Order Details', 'decorator-woocommerce-email-customizer' ); ?></h2>
<?php
do_action( 'woocommerce_subscriptions_email_order_details', $order, $sent_to_admin, $plain_text, $email );

do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );
?>
<h2><?php esc_html_e( 'New subscription details', 'decorator-woocommerce-email-customizer' ); ?></h2>
<?php
if ( ! empty( $subscriptions ) && is_array( $subscriptions ) ) {
	foreach ( $subscriptions as $rp_decorator_subscription ) {
		do_action( 'woocommerce_subscriptions_email_order_details', $rp_decorator_subscription, $sent_to_admin, $plain_text, $email );
	}
}

do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

if ( ! empty( $additional_content ) ) {
	echo $rp_decorator_email_improvements_enabled ? '<div class="email-additional-content">' : '';
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
	echo $rp_decorator_email_improvements_enabled ? '</div>' : '';
}

do_action( 'woocommerce_email_footer', $email );
