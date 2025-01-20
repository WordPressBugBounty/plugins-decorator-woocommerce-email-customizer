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

?>
<div class="wrap wbte-sf-connector">
	<div class="wbte-sf-top-box">
		<div class="wbte-sf-header">
            <img src="<?php echo esc_url( RP_DECORATOR_PLUGIN_URL . '/assets/images/webtoffee-logo_small.svg' ); ?>" width="180" alt="Webtoffee Logo">
		</div>
		<div class="wbte-sf-banner-box">
			<div class="wbte-sf-item wbte-sf-item-left">
				<h1>
					<?php
					if ( $is_connected ) {
						esc_html_e( 'Welcome Back!', 'decorator-woocommerce-email-customizer' );
					} else {
						esc_html_e( 'Welcome to Webtoffee Marketing', 'decorator-woocommerce-email-customizer' );
					}
					?>
				</h1>
				<p><?php esc_html_e( 'Power e-commerce growth with smart product recommendations, web campaigns, and automated marketing tools.', 'decorator-woocommerce-email-customizer' ); ?></p>
				<div class="wbte-sf-btnbox">
					<?php
					if ( $is_connected ) { // $connected_email
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
						<?php
					}
					?>
				</div>
			</div>
			<div class="wbte-sf-item wbte-sf-item-right">
				<img src="<?php echo esc_url( $asset_url . 'images/banner.png' ); ?>">
			</div>
		</div>
	</div>
</div>
<style type="text/css">
body{ background:#F1F8FE; }
.wbte-sf-banner-box{ margin:3rem auto; padding:1rem 3.5rem; padding-left:5rem; padding-right:1rem; box-sizing:border-box; max-width:1100px; background:#ffffff; border-radius:10px; display:flex; justify-content: space-between; flex-wrap:wrap; gap:2rem 0px; }
.wbte-sf-banner-box h1{ font-size:26px; font-weight:700; color:#2d2d2d; margin-bottom:5px; margin-top:2rem; }
.wbte-sf-banner-box p{ font-size:14px; font-weight:300; margin-top:0px; }
.wbte-sf-banner-box .wbte-sf-item{ flex:0 0 45%; box-sizing:border-box; }
.wbte-sf-banner-box .wbte-sf-item-left{ padding-right:80px; position:relative; }
.wbte-sf-banner-box .wbte-sf-item-right{ text-align:right; }
.wbte-sf-banner-box .wbte-sf-item-right img{ display:inline-block; max-width:352px; }
.wbte-sf-banner-box .wbte-sf-btnbox{ position:absolute; bottom:40px; width:100%;}
.wbte-sf-banner-box .wbte-sf-btn{ background-color:#1763DC; color:white; display:inline-block; text-align:center; padding:.7rem 2rem; min-width: 280px; width:auto; box-sizing:border-box; border: none; border-radius:4px; font-size:.9rem; cursor: pointer; transition: background-color 0.3s; text-decoration:none; margin-top: 5px; }
.wbte-sf-banner-box .wbte-sf-disconnect{ color:#2f79b6; cursor: pointer; text-decoration:underline; }
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
	});
</script>