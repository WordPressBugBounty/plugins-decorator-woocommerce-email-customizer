<?php
/**
 * Customer completed subscription change email
 *
 * @author  Brent Shepherd
 * @package WooCommerce_Subscriptions/Templates/Emails
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php 
do_action( 'wt_decorator_email_body_content', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_subscriptions_email_order_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email ); ?>

<h2><?php echo esc_html__( 'New Subscription Details', 'decorator-woocommerce-email-customizer' ); ?></h2>
<?php foreach ( $subscriptions as $subscription ) : ?>
	<?php do_action( 'woocommerce_subscriptions_email_order_details', $subscription, $sent_to_admin, $plain_text, $email ); ?>
<?php endforeach; ?>

<?php
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additonal content - this is set in each email's settings.
 */
if ( isset( $additional_content ) && ! empty( $additional_content ) ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );
?>
