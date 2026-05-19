<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<?php do_action('woocommerce_email_header', $email_heading, $email); ?>
<p><?php do_action( 'wt_decorator_email_body_content', $order , $sent_to_admin, $plain_text, $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility. ?></p>
    <?php
    $rp_decorator_coupon_message = Wt_Smart_Coupon_Common::get_order_meta($order->get_id(), 'wt_coupon_send_to_message'); 
    if($rp_decorator_coupon_message)
    {
        ?>
        </p><?php echo esc_html( $rp_decorator_coupon_message ); ?></p>
        <?php
    }else 
    {   
        ?>
        <p><?php esc_html_e("You've got a gift!", 'decorator-woocommerce-email-customizer'); ?></p>
        <?php
    }
    
    $rp_decorator_coupons = Wt_Smart_Coupon_Common::get_order_meta($order->get_id(), 'wt_coupons');
    $rp_decorator_coupons = maybe_unserialize($rp_decorator_coupons);
    
    if(!empty($rp_decorator_coupons))
    {
        foreach($rp_decorator_coupons as $rp_decorator_coupon_id)
        {       
            $rp_decorator_coupon_title = get_the_title( $rp_decorator_coupon_id );
            $rp_decorator_coupon = new WC_Coupon( $rp_decorator_coupon_title );
            $rp_decorator_coupon_data  = Wt_Smart_Coupon_Public::get_coupon_meta_data($rp_decorator_coupon);                  
            ?>
            <p>
                <?php 
                echo Wt_Smart_Coupon_Public::get_coupon_html($rp_decorator_coupon, $rp_decorator_coupon_data, 'email_coupon'); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                ?>
            </p>
            <?php
        }
    }
    ?>
<?php do_action( 'woocommerce_email_footer', $email ); ?>