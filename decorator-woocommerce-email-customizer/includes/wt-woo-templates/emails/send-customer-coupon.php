<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php do_action( 'wt_decorator_email_body_content', $coupon, $sent_to_admin, $plain_text, $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility. ?>

<p>
	<?php 
	echo Wt_Smart_Coupon_Public::get_coupon_html( $coupon, Wt_Smart_Coupon_Public::get_coupon_meta_data( $coupon ), 'email_coupon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
</p>
<?php do_action( 'woocommerce_email_footer', $email ); ?>
