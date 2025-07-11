<?php
/**
 * StoreFrog connector page tab 2 template.
 *
 * @package Storefrog_Connector
 * @since 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$show_warning = $this->show_warning ?? false;
?>
<div class="wrap wbte-sf-connector">
	<div class="wbte-sf-top-box">
		<div class="wbte-sf-header">
            <img src="<?php echo esc_url( RP_DECORATOR_PLUGIN_URL . '/assets/images/webtoffee-logo_small.svg' ); ?>" width="180" alt="Webtoffee Logo">
		</div>
		<div class="wbte-sf-auth-denied-warning">
			<img style="width: 24px;" src="<?php echo esc_url( RP_DECORATOR_PLUGIN_URL . '/includes/storefrog/assets/images/warning.svg' ); ?>" alt="<?php esc_html_e( 'Warning', 'decorator-woocommerce-email-customizer' ); ?>">
			<div class="wbte-sf-auth-denied-warning-content">
				<p class="wbte-sf-auth-denied-warning-content-title"><?php esc_html_e( 'Access to your store is pending authorization', 'decorator-woocommerce-email-customizer' ); ?></p>
				<span><?php esc_html_e( 'Some features may be limited until permission is granted.', 'decorator-woocommerce-email-customizer' ); ?> <a href="<?php echo esc_url( $auth_url ); ?>" class="wbte-sf-auth-link"><?php esc_html_e( 'Authorize access', 'decorator-woocommerce-email-customizer' ); ?></a></span>
			</div>
			<span class="wbte-sf-auth-denied-warning-close">×</span>
		</div>

		<div class="wbte-sf-banner-box">
			<div class="wbte-sf-item wbte-sf-item-left">
				<h3><?php esc_html_e( 'Welcome to WebToffee Marketing', 'decorator-woocommerce-email-customizer' ); ?></h3>
				<?php 
				if( $is_connected ) {
					?>
					<div>
						<p class="wbte-sf-tab-bold-text"><?php esc_html_e( 'You’re All Set! —you’ve successfully connected your store', 'decorator-woocommerce-email-customizer' ); ?></p>
						<p style="font-size: 14px;"><?php esc_html_e( 'Dive in to explore:', 'decorator-woocommerce-email-customizer' ); ?></p>
						<ul style="font-size: 14px; list-style-type: disc; margin-left: 25px;">
							<li><?php esc_html_e( 'Automated email campaigns & drip workflows', 'decorator-woocommerce-email-customizer' ); ?></li>
							<li><?php esc_html_e( 'On‑site pop‑ups and banners', 'decorator-woocommerce-email-customizer' ); ?></li>
							<li><?php esc_html_e( 'Detailed sales & engagement analytics', 'decorator-woocommerce-email-customizer' ); ?></li>
						</ul>
					</div>
					<?php
				} else {
					?>
					<div>
						<p class="wbte-sf-tab-description"><?php esc_html_e( 'Let’s connect your store in just a few simple steps:', 'decorator-woocommerce-email-customizer' ); ?></p>
						<div class="wbte-sf-tab-steps-container">
							<div class="wbte-sf-tab-step-number">1</div>
							<p class="wbte-sf-tab-bold-text"><?php esc_html_e( 'Log in or sign up to your WebToffee Marketing account.', 'decorator-woocommerce-email-customizer' ); ?></p>
						</div>
						<div class="wbte-sf-tab-steps-container">
							<div class="wbte-sf-tab-step-number">2</div>
							<span>
								<p class="wbte-sf-tab-bold-text"><?php esc_html_e( 'Approve the WooCommerce connection request.', 'decorator-woocommerce-email-customizer' ); ?></p>
								<span style="font-size: 12px; font-weight: 400; color: #0C1C37;"><?php esc_html_e( 'When prompted, click ‘Approve’ to grant the app the required permission to view/manage store data', 'decorator-woocommerce-email-customizer' ); ?></span>
							</span>
						</div>
						<div class="wbte-sf-tab-steps-container">
							<div class="wbte-sf-tab-step-number">3</div>
							<p class="wbte-sf-tab-bold-text"><?php esc_html_e( 'Access your marketing dashboard and start growing your sales.', 'decorator-woocommerce-email-customizer' ); ?></p>
						</div>
					</div>
					<?php
				}
				?>
				
				<div class="wbte-sf-btnbox">
					<?php
					if ( $is_connected ) { // $connected_email.
						?>
						<p style="margin-bottom:5px;"><span class="dashicons dashicons-yes-alt" style="color:#36bc77"></span> 
						<?php
						// translators: %s is the connected email address.
						echo esc_html( sprintf( __( 'Connected to %s', 'decorator-woocommerce-email-customizer' ), $connected_email ) );
						?>
						<span class="wbte-sf-disconnect">Disconnect</span> </p>
						<a href="<?php echo esc_url( $dashboard_url ); ?>" class="wbte-sf-btn" target="_blank"><?php esc_html_e( 'Go to Web app', 'decorator-woocommerce-email-customizer' ); ?> <span class="dashicons dashicons-external"></span></a>
						<?php
					} else {
						?>
						<a href="<?php echo esc_url( $auth_url ); ?>" class="wbte-sf-btn"><?php esc_html_e( 'Connect now', 'decorator-woocommerce-email-customizer' ); ?></a>
						<br><span style="font-size: 12px; font-style: italic; font-weight: 400; color: #0C1C37;"><?php esc_html_e( '* Clicking this will redirect you to the WebToffee Marketing app', 'decorator-woocommerce-email-customizer' ); ?></span>
						<?php
					}
					?>
				</div>
			</div>
			<div class="wbte-sf-item wbte-sf-item-right">
				<img src="<?php echo esc_url( $asset_url . 'images/wt-shop-link.svg' ); ?>">
			</div>
		</div>
	</div>
</div>
<style type="text/css">
body{ background:#F1F8FE; }
.wbte-sf-banner-box{ margin: 3rem auto; padding: 2rem; box-sizing: border-box; max-width: 1100px; background: #ffffff; border-radius: 10px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem 0px; }
.wbte-sf-banner-box h1{ font-size: 22px; font-weight: 700; color: #2d2d2d; }
.wbte-sf-banner-box .wbte-sf-tab-description{ font-size: 14px; font-weight: 300; }
.wbte-sf-banner-box .wbte-sf-item-left{ position: relative; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
.wbte-sf-banner-box .wbte-sf-item-left h3{ font-weight: 700; font-size: 22px; }
.wbte-sf-banner-box .wbte-sf-item-right{ text-align:right; }
.wbte-sf-banner-box .wbte-sf-item-right img{ display:inline-block; max-width:352px; }
.wbte-sf-banner-box .wbte-sf-btnbox{ width:100%;}
.wbte-sf-banner-box .wbte-sf-btn{ background-color:#1763DC; color:white; display:inline-block; text-align:center; padding:.7rem 2rem; min-width: 326px; width:auto; box-sizing:border-box; border: none; border-radius:4px; font-size:.9rem; cursor: pointer; transition: background-color 0.3s; text-decoration:none; margin-top: 5px; }
.wbte-sf-banner-box .wbte-sf-disconnect{ color:#2f79b6; cursor: pointer; text-decoration:underline; }

.wbte-sf-tab-steps-container { display: flex; align-items: center; font-family: 'Poppins', sans-serif; margin-bottom: 20px; }
.wbte-sf-tab-step-number { background-color: #E0EBF5;  color: #1763DC;  width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; margin-right: 16px; }
.wbte-sf-tab-bold-text { font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600; color: #0C1C37; margin: 0; }

/* Authorization Denied warning */
.wbte-sf-auth-denied-warning { align-items: flex-start; justify-content: space-between; background-color: #FCEAED; border: 0.5px solid #D63638; border-radius: 12px; padding: 16px 20px; color: #DF284C; font-family: Arial, sans-serif; max-width: 1100px; margin: 20px auto; position: relative; box-sizing: border-box; gap: 15px; display: <?php echo $show_warning ? 'flex' : 'none'; ?>; }
.wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-content { flex: 1; font-size: 14px; line-height: 20px; font-weight: 400; }
.wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-content-title { font-size: 16px; margin: 0; margin-bottom: 8px; }
.wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-content span strong, .wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-content-title { font-weight: 700; }
.wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-close { color: #D63638; font-size: 25px; cursor: pointer; }


@media screen and (max-width: 1100px) {
	.wbte-sf-banner-box .wbte-sf-btnbox{ position:relative; bottom:0px; margin-top:20px; }
	.wbte-sf-banner-box .wbte-sf-item img{ max-width:100%; }
}
@media screen and (max-width:800px) {
	.wbte-sf-banner-box .wbte-sf-item{
	flex:1 1 100%;
	}
	.wbte-sf-banner-box .wbte-sf-item-left{ padding-right:3.5rem; position:relative; text-align:center; }
	.wbte-sf-banner-box .wbte-sf-item-right{ text-align:center; margin-top:20px; }
	.wbte-sf-banner-box .wbte-sf-item-right img{ max-width:96%; }
}
</style>
<script type="text/javascript">
	jQuery(document).ready(function($){
		var disconnection_in_progress = false;
		$('.wbte-sf-disconnect').on('click', function(){
			if(disconnection_in_progress){
				return;
			}
			disconnection_in_progress = true;

			if(confirm('<?php esc_html_e( 'Are you sure you want to disconnect?', 'decorator-woocommerce-email-customizer' ); ?>')){
				$(this).html('<?php esc_html_e( 'Disconnecting...', 'decorator-woocommerce-email-customizer' ); ?>');
				$.ajax({
					url: '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>',
					type: 'POST',
					data: { action: 'wbte_sf_disconnect', nonce: '<?php echo esc_html( wp_create_nonce( 'wbte_sf_disconnect' ) ); ?>' },
					dataType: 'json',
					success: function(response){
						disconnection_in_progress = false;
						if(response.success){
							window.location.reload();
						}else{                   
							alert('<?php esc_html_e( 'Failed to disconnect.', 'decorator-woocommerce-email-customizer' ); ?>');
							$(this).html('<?php esc_html_e( 'Disconnect', 'decorator-woocommerce-email-customizer' ); ?>');                           
						}
					},
					error: function(xhr, status, error){
						disconnection_in_progress = false;
						alert('<?php esc_html_e( 'Failed to disconnect.', 'decorator-woocommerce-email-customizer' ); ?>');
						$(this).html('<?php esc_html_e( 'Disconnect', 'decorator-woocommerce-email-customizer' ); ?>');
					}
				});
			}
		});

		$('.wbte-sf-auth-denied-warning-close').on('click', function(){
			$('.wbte-sf-auth-denied-warning').hide();
		});
	});
</script>