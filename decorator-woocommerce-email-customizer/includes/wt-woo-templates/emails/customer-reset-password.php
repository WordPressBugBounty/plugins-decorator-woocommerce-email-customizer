<?php
/**
 * Customer Reset Password email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.4.0
 */

use Automattic\WooCommerce\Utilities\FeaturesUtil;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$rp_decorator_email_improvements_enabled = FeaturesUtil::feature_is_enabled( 'email_improvements' );
?>
<style>

    .wt_template_button{
        text-decoration: none;
         border-style: solid;
         font-weight: 600;
         background: #96588a;
         border-color: #dedede;
         color: #ffffff;
         font-size: 16px;
         padding-top: 10px;
         padding-bottom: 10px;
         padding-left: 8px;
         padding-right: 8px;
         border-width: 1px;
         border-radius: 4px;

    }</style>
<?php
$rp_decorator_custom_style = RP_Decorator_Customizer::$wt_template_type;

if (empty($rp_decorator_custom_style)) {
    $rp_decorator_custom_style = RP_Decorator_Customizer::wt_get_current_template();
}
$rp_decorator_button_check = get_option('rp_decorator_customer_reset_password_btn_switch');
if (isset($_POST['customized']) && !empty($_POST['customized'])) { //phpcs:ignore WordPress.Security.NonceVerification.Missing
    $rp_decorator_data = json_decode(wc_clean( wp_unslash( $_POST['customized'] ) ), true); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.NonceVerification.Missing -- Already sanitized.
    if (array_key_exists('rp_decorator_customer_reset_password_btn_switch', $rp_decorator_data)) {
        if ($rp_decorator_button_check != $rp_decorator_data['rp_decorator_customer_reset_password_btn_switch']) {
            $rp_decorator_button_check = $rp_decorator_data['rp_decorator_customer_reset_password_btn_switch'];
        }
    }
}

do_action('woocommerce_email_header', $email_heading, $email);

echo $rp_decorator_email_improvements_enabled ? '<div class="email-introduction">' : '';

do_action('wt_decorator_email_body_content_text', $email); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility.

if (true == $rp_decorator_button_check) {
    echo '<p class="btn-container"><a href="' . esc_url(add_query_arg(array('key' => $reset_key, 'id' => $user_id), wc_get_endpoint_url('lost-password', '', wc_get_page_permalink('myaccount')))) . '" class="wt_template_button">' . esc_html__('Reset Password', 'decorator-woocommerce-email-customizer') . '</a></p>';
} else {
    ?>
    <p>
        <a class="link" href="<?php echo esc_url(add_query_arg(array('key' => $reset_key, 'id' => $user_id), wc_get_endpoint_url('lost-password', '', wc_get_page_permalink('myaccount')))); ?>">
    <?php esc_html_e('Click here to reset your password', 'decorator-woocommerce-email-customizer'); ?></a>
    </p>
            <?php
        }

echo $rp_decorator_email_improvements_enabled ? '</div>' : '';
?>
<p></p>
<?php
/**
 * Show user-defined additonal content - this is set in each email's settings.
 */
if ($additional_content) {
    echo $rp_decorator_email_improvements_enabled ? '<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation"><tr><td class="email-additional-content email-additional-content-aligned">' : '';
    echo wp_kses_post(wpautop(wptexturize($additional_content)));
    echo $rp_decorator_email_improvements_enabled ? '</td></tr></table>' : '';
}

do_action('woocommerce_email_footer', $email);
?>
