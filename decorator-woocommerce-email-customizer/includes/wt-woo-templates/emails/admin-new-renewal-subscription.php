<?php
/**
 * Admin new renewal order email
 *
 * @author  Brent Shepherd
 * @package WooCommerce_Subscriptions/Templates/Emails
 * @version 2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


do_action( 'woocommerce_email_header', $email_heading, $email ); 


do_action( 'wt_decorator_email_body_content', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Subscriptions_Email::order_details() Shows the order details table.
 * @since 2.1.0
 */
do_action( 'woocommerce_subscriptions_email_order_details', $order, $sent_to_admin, $plain_text, $email );

do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

do_action( 'woocommerce_email_footer', $email );
?>
