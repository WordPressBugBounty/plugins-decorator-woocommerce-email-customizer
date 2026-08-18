<?php
/**
 * Guest withdrawal verification email (HTML).
 *
 * @package Wbte_Eu_Withdrawal_Button
 * @since   1.1.0
 *
 * @var Wbte_Ewb_Pending_Request $pending
 * @var string                   $verification_url
 * @var string                   $email_heading
 * @var bool                     $sent_to_admin
 * @var bool                     $plain_text
 * @var WC_Email                 $email
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
do_action( 'woocommerce_email_header', $email_heading, $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WooCommerce hook.
?>

<p>
	<?php
	$wbte_ewb_body_order = isset( $email->object ) ? $email->object : null;
	do_action( 'wt_decorator_email_body_content', $wbte_ewb_body_order, $sent_to_admin, $plain_text, $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hook name retained for backward compatibility.
	?>
</p>

<p>
	<strong><?php esc_html_e( 'Order number:', 'decorator-woocommerce-email-customizer' ); ?></strong>
	<?php echo esc_html( $pending->order_number ); ?>
</p>

<?php if ( ! empty( $pending->reason ) ) : ?>
	<p>
		<strong><?php esc_html_e( 'Reason:', 'decorator-woocommerce-email-customizer' ); ?></strong>
		<?php echo esc_html( $pending->reason ); ?>
	</p>
<?php endif; ?>

<?php
if ( empty( $verification_url ) && ! empty( $pending->verify_token ) ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- wc_get_template variable.
	$verification_url            = add_query_arg( // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- wc_get_template variable.
		array(
			'wbte_ewb_verify' => rawurlencode( $pending->verify_token ),
		),
		Wbte_Ewb_Settings::get_withdrawal_page_url() ?: home_url( '/' )
	);
}

// sanitize_hex_color() is the right escaper for a CSS context; esc_* would not make a bad value safe here.
$wbte_ewb_base_color = sanitize_hex_color( get_option( 'woocommerce_email_base_color', '#96588a' ) );

if ( ! $wbte_ewb_base_color ) {
	$wbte_ewb_base_color = '#96588a';
}

$wbte_ewb_button_text = get_option( 'rp_decorator_wbte_ewb_guest_verification_button_text' );

if ( isset( $_POST['customized'] ) && ! empty( $_POST['customized'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$wbte_ewb_customized = json_decode( wc_clean( wp_unslash( $_POST['customized'] ) ), true ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.NonceVerification.Missing -- Already sanitized.

	if ( is_array( $wbte_ewb_customized ) && array_key_exists( 'rp_decorator_wbte_ewb_guest_verification_button_text', $wbte_ewb_customized ) ) {
		$wbte_ewb_button_text = $wbte_ewb_customized['rp_decorator_wbte_ewb_guest_verification_button_text'];
	}
}

$wbte_ewb_button_text = is_scalar( $wbte_ewb_button_text ) ? trim( (string) $wbte_ewb_button_text ) : '';

if ( '' === $wbte_ewb_button_text ) {
	// Guarded: this template is reachable via the locate_template filter even in a degraded state
	// where Decorator's own classes were never loaded.
	$wbte_ewb_button_text = class_exists( 'RP_Decorator_Settings' )
		? RP_Decorator_Settings::get_default_value( 'wbte_ewb_guest_verification_button_text' )
		: __( 'Verify withdrawal request', 'decorator-woocommerce-email-customizer' );
}
?>

<style>
	a.wt_ewb_verify_button {
		background-color: <?php echo esc_html( $wbte_ewb_base_color ); ?>;
		border: 1px solid <?php echo esc_html( $wbte_ewb_base_color ); ?>;
		color: #ffffff;
		display: inline-block;
		font-size: 16px;
		font-weight: bold;
		line-height: 1;
		padding: 12px 24px;
		text-decoration: none;
		border-radius: 3px;
	}
</style>

<?php if ( ! empty( $verification_url ) ) : ?>
	<p class="btn-container wbte_decorator_button_container" style="margin: 24px 0; text-align: center;">
		<a class="button wt_template_button wt_ewb_verify_button" href="<?php echo esc_url( $verification_url ); ?>">
			<?php echo esc_html( $wbte_ewb_button_text ); ?>
		</a>
	</p>
<?php endif; ?>

<p>
	<?php esc_html_e( 'If you did not request a withdrawal, you can ignore this email.', 'decorator-woocommerce-email-customizer' ); ?>
</p>

<?php
$wbte_ewb_additional_content = method_exists( $email, 'get_additional_content' ) ? $email->get_additional_content() : '';

if ( $wbte_ewb_additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $wbte_ewb_additional_content ) ) );
}

// @hooked WC_Emails::email_footer() Output the email footer.
do_action( 'woocommerce_email_footer', $email ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WooCommerce hook.
