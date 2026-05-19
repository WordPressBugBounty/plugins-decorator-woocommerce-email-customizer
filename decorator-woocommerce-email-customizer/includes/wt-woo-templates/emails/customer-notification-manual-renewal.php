<?php
/**
 * Customer notification: manual renewal (Decorator body hook).
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
		<strong>
		<?php esc_html_e( 'This subscription will not renew automatically.', 'decorator-woocommerce-email-customizer' ); ?>
		</strong>
		<?php
		if ( ! empty( $can_renew_early ) ) {
			echo wp_kses(
				__( 'You can <strong>renew it manually</strong> in a few short steps via the <em>Subscriptions</em> tab in your account dashboard.', 'decorator-woocommerce-email-customizer' ),
				array(
					'strong' => array(),
					'em'     => array(),
				)
			);
		}
		?>
	</p>
	<table role="presentation" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
		<tr>
			<td>
			<?php
			if ( ! empty( $can_renew_early ) ) {
				$rp_decorator_link_text = __( 'Renew Subscription', 'decorator-woocommerce-email-customizer' );
			} else {
				$rp_decorator_link_text = __( 'Manage Subscription', 'decorator-woocommerce-email-customizer' );
			}
			echo wp_kses(
				'<a href="' . esc_url( $url_for_renewal ) . '">' . esc_html( $rp_decorator_link_text ) . '</a>',
				array( 'a' => array( 'href' => true ) )
			);
			?>
			</td>
		</tr>
	</table>
	<br>
<?php

\WC_Subscriptions_Email::subscription_details( $subscription, $order, $sent_to_admin, $plain_text );

do_action( 'woocommerce_subscriptions_email_order_details', $subscription, $sent_to_admin, $plain_text, $email );

if ( $additional_content ) {
	echo $rp_decorator_email_improvements_enabled ? '<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td class="email-additional-content">' : '';
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
	echo $rp_decorator_email_improvements_enabled ? '</td></tr></table>' : '';
}

do_action( 'woocommerce_email_footer', $email );
