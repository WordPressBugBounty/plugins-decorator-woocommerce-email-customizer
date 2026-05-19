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

$rp_decorator_show_warning = isset( $this->show_warning ) ? $this->show_warning : false;
$rp_decorator_store_name   = get_bloginfo( 'name', 'display' );
?>
<div class="wrap wbte-sf-connector">
	<div class="wbte-sf-top-box">
		<div class="wbte-sf-header">
			<h1><?php esc_html_e( 'Unlock Automated Growth for ', 'decorator-woocommerce-email-customizer' ); ?><span style="color: #1763DC;"><?php echo esc_html( $rp_decorator_store_name ); ?></span></h1>
			<p class="wbte-sf-subtitle"><?php esc_html_e( 'Connect your store to start recovering abandoned carts, collecting leads through popups, and engaging customers in minutes.', 'decorator-woocommerce-email-customizer' ); ?></p>
		</div>
		<div class="wbte-sf-auth-denied-warning">
			<img style="width: 24px;" src="<?php echo esc_url( RP_DECORATOR_PLUGIN_URL . '/includes/storefrog/assets/images/warning.svg' ); ?>" alt="<?php esc_html_e( 'Warning', 'decorator-woocommerce-email-customizer' ); ?>">
			<div class="wbte-sf-auth-denied-warning-content">
				<p class="wbte-sf-auth-denied-warning-content-title"><?php esc_html_e( 'Access to your store is pending authorization', 'decorator-woocommerce-email-customizer' ); ?></p>
				<span><?php esc_html_e( 'Some features may be limited until permission is granted.', 'decorator-woocommerce-email-customizer' ); ?> <a href="<?php echo esc_url( $auth_url ); ?>" class="wbte-sf-auth-link"><?php esc_html_e( 'Authorize access', 'decorator-woocommerce-email-customizer' ); ?></a></span>
			</div>
			<span class="wbte-sf-auth-denied-warning-close">×</span>
		</div>
       <div class="wbte-sf-banner-box-container">
		<div class="wbte-sf-banner-box<?php echo $is_connected ? ' wbte-sf-connected' : ''; ?>">
			<div class="wbte-sf-item wbte-sf-item-left">
				<?php
                if ($is_connected) {
				?>
				<h3><?php esc_html_e( 'You’re All Set! — You’ve successfully connected your store:', 'decorator-woocommerce-email-customizer' ); ?></h3>
					<div style="margin: 20px 0;">
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
					<h3><?php esc_html_e( 'Let’s connect your store in just a few simple steps:', 'decorator-woocommerce-email-customizer' ); ?></h3>
					<div>
						<div class="wbte-sf-tab-steps-container">
							<div class="wbte-sf-tab-step-number">1</div>
							<span>
								<p class="wbte-sf-tab-bold-text"><?php esc_html_e( 'Login or Signup.', 'decorator-woocommerce-email-customizer' ); ?></p>
								<span style="font-size: 13px; font-weight: 400; color: #0C1C37;"><?php esc_html_e( 'Create a new account or log in to your existing account.', 'decorator-woocommerce-email-customizer' ); ?></span>
							</span>
						</div>
						<div class="wbte-sf-tab-steps-container">
							<div class="wbte-sf-tab-step-number">2</div>
							<span>
								<p class="wbte-sf-tab-bold-text"><?php esc_html_e( 'Approve the authentication request.', 'decorator-woocommerce-email-customizer' ); ?></p>
								<span style="font-size: 13px; font-weight: 400; color: #0C1C37;"><?php esc_html_e( 'This grants WebToffee permission to access your store data needed for web campaigns and automation.', 'decorator-woocommerce-email-customizer' ); ?></span>
							</span>
						</div>

						<div class="wbte-sf-access-info-box">
							<span class="wbte-sf-access-info-icon" style="color:#36bc77; display:inline-flex;" aria-hidden="true"><img style="width: 20px; height: 20px;" src="<?php echo esc_url( RP_DECORATOR_PLUGIN_URL . '/includes/storefrog/assets/images/safe.svg' ); ?>" alt="" role="presentation"></span>
							<div class="wbte-sf-access-info-content">
								<p class="wbte-sf-access-info-title"><?php esc_html_e( 'Why do we need this access?', 'decorator-woocommerce-email-customizer' ); ?></p>
								<p class="wbte-sf-access-info-text"><?php
									echo wp_kses_post(
										sprintf(
											/* translators: %s: bold list of access types (orders, customers, coupons, products, manage webhooks) */
											__( 'We need access to %s to power your cart recovery automation, recommend products and reward customers in real time.', 'decorator-woocommerce-email-customizer' ),
											'<strong>' . esc_html__( 'orders, customers, coupons, products, and manage webhooks', 'decorator-woocommerce-email-customizer' ) . '</strong>'
										)
									);
								?></p>
							</div>
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
						<span class="wbte-sf-disconnect"><?php esc_html_e( 'Disconnect', 'decorator-woocommerce-email-customizer' ); ?></span> </p>
						<a href="<?php echo esc_url( $dashboard_url ); ?>" class="wbte-sf-btn" target="_blank"><?php esc_html_e( 'Go to Web app', 'decorator-woocommerce-email-customizer' ); ?> <span class="dashicons dashicons-external"></span></a>
						<?php
					} else {
						?>
						<a href="<?php echo esc_url( $auth_url ); ?>" class="wbte-sf-btn" id="wbte-sf-connect-btn" data-auth-url="<?php echo esc_url( $auth_url ); ?>"><img src="<?php echo esc_url( RP_DECORATOR_PLUGIN_URL . '/includes/storefrog/assets/images/lock.svg' ); ?>" alt="" role="presentation" class="wbte-sf-btn-icon wbte-sf-btn-icon-lock"><?php esc_html_e( 'Connect now', 'decorator-woocommerce-email-customizer' ); ?><img src="<?php echo esc_url( RP_DECORATOR_PLUGIN_URL . '/includes/storefrog/assets/images/right-chevron.svg' ); ?>" alt="" role="presentation" class="wbte-sf-btn-icon wbte-sf-btn-icon-chevron"></a>
						<br><span style="font-size: 12px; font-style: italic; font-weight: 400; color: #0C1C37;"><img src="<?php echo esc_url( RP_DECORATOR_PLUGIN_URL . '/includes/storefrog/assets/images/safe.svg' ); ?>" alt="" role="presentation" style="width: 14px; height: 14px; vertical-align: middle; margin-right: 4px;"><?php esc_html_e( 'Uses secure WooCommerce API connection. Revoke anytime.', 'decorator-woocommerce-email-customizer' ); ?></span>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="wbte-sf-banner-box-container-right">
			<div class="wbte-sf-image-slider">
				<div class="wbte-sf-slider-wrapper">
					<div class="wbte-sf-slide active">
						<div class="wbte-sf-slide-image">
							<img src="<?php echo esc_url( $asset_url . 'images/block1_bg.webp' ); ?>" alt="<?php esc_attr_e( 'Slide 1', 'decorator-woocommerce-email-customizer' ); ?>">
						</div>
						<div class="wbte-sf-slide-content">
							<h4 class="wbte-sf-slide-title"><?php esc_html_e( 'Up to 40% More Conversion with Popups', 'decorator-woocommerce-email-customizer' ); ?></h4>
							<p class="wbte-sf-slide-description"><?php esc_html_e( 'Boost conversion by up to 40% using dynamic popups for Welcome Campaigns, Exit Intent, and Cart Abandonment Recovery.', 'decorator-woocommerce-email-customizer' ); ?></p>
						</div>
					</div>
					<div class="wbte-sf-slide">
						<div class="wbte-sf-slide-image">
							<img src="<?php echo esc_url( $asset_url . 'images/block2_bg.webp' ); ?>" alt="<?php esc_attr_e( 'Slide 2', 'decorator-woocommerce-email-customizer' ); ?>">
						</div>
						<div class="wbte-sf-slide-content">
							<h4 class="wbte-sf-slide-title"><?php esc_html_e( 'Automated Email Campaigns', 'decorator-woocommerce-email-customizer' ); ?></h4>
							<p class="wbte-sf-slide-description"><?php esc_html_e( 'Create powerful automated email workflows to engage customers, recover abandoned carts, and drive repeat purchases.', 'decorator-woocommerce-email-customizer' ); ?></p>
						</div>
					</div>
					<div class="wbte-sf-slide">
						<div class="wbte-sf-slide-image">
							<img src="<?php echo esc_url( $asset_url . 'images/block3_bg.webp' ); ?>" alt="<?php esc_attr_e( 'Slide 3', 'decorator-woocommerce-email-customizer' ); ?>">
						</div>
						<div class="wbte-sf-slide-content">
							<h4 class="wbte-sf-slide-title"><?php esc_html_e( 'Advanced Analytics & Insights', 'decorator-woocommerce-email-customizer' ); ?></h4>
							<p class="wbte-sf-slide-description"><?php esc_html_e( 'Track performance with detailed analytics, monitor engagement rates, and optimize your marketing strategies for maximum ROI.', 'decorator-woocommerce-email-customizer' ); ?></p>
						</div>
					</div>
				</div>
				<div class="wbte-sf-slider-dots">
					<button class="wbte-sf-slider-arrow wbte-sf-slider-arrow-left" aria-label="<?php esc_attr_e( 'Previous slide', 'decorator-woocommerce-email-customizer' ); ?>">
						&lt;
					</button>
					<span class="wbte-sf-dot active" data-slide="0"></span>
					<span class="wbte-sf-dot" data-slide="1"></span>
					<span class="wbte-sf-dot" data-slide="2"></span>
					<button class="wbte-sf-slider-arrow wbte-sf-slider-arrow-right" aria-label="<?php esc_attr_e( 'Next slide', 'decorator-woocommerce-email-customizer' ); ?>">
						&gt;
					</button>
				</div>
			</div>
		</div>
	   </div>
	   	<div class="wbte-sf-trusted-by-banner">
		<div class="wbte-sf-trusted-by-content">
			<span class="wbte-sf-trusted-by-label"><?php esc_html_e( 'TRUSTED BY', 'decorator-woocommerce-email-customizer' ); ?></span>
			<h3 class="wbte-sf-trusted-by-heading"><?php echo wp_kses_post( esc_html__( 'Over ', 'decorator-woocommerce-email-customizer' ) . '<span style="color: #1763DC;">' . esc_html__( '1.8 Million', 'decorator-woocommerce-email-customizer' ) . '</span>' . esc_html__( ' WooCommerce stores worldwide', 'decorator-woocommerce-email-customizer' ) ); ?></h3>
			<p class="wbte-sf-trusted-by-description"><?php esc_html_e( 'WebToffee plugins power businesses in 100+ countries. Join thousands of store owners who rely on our reliable WordPress & WooCommerce solutions.', 'decorator-woocommerce-email-customizer' ); ?></p>
		</div>
		<div class="wbte-sf-trusted-by-cards">
			<div class="wbte-sf-trusted-by-card">
				<span class="wbte-sf-trusted-by-card-label"><?php esc_html_e( 'WooCommerce.com', 'decorator-woocommerce-email-customizer' ); ?></span>
				<div class="wbte-sf-trusted-by-card-value">
					<svg class="wbte-sf-trusted-by-star" width="20" height="20" viewBox="0 0 24 24" fill="#EAB308" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
					<span class="wbte-sf-trusted-by-rating">4.3/5</span>
				</div>
			</div>
			<div class="wbte-sf-trusted-by-card">
				<span class="wbte-sf-trusted-by-card-label"><?php esc_html_e( 'WordPress reviews', 'decorator-woocommerce-email-customizer' ); ?></span>
				<div class="wbte-sf-trusted-by-card-value wbte-sf-trusted-by-count">3300+</div>
			</div>
		</div>
	</div>
	</div>
</div>
<style type="text/css">
body{ background:#F1F8FE; }
.wbte-sf-subtitle {font-size: 16px;color: #2d2d2d;margin: 0 auto;margin-top: 0.5rem;font-weight: 300;max-width: 750px;line-height: 1.4;text-align: center;}
.wbte-sf-banner-box-container{ display: flex; align-items: stretch; max-width: 95%; margin: 1.5rem auto; background: #ffffff; border-radius: 12px; border: 1px solid#E5E7EB;}
.wbte-sf-banner-box{ width: 61%; padding: 2rem; box-sizing: border-box; background: #ffffff; border-radius: 10px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem 0px; }
.wbte-sf-banner-box-container-right{ width: 32%; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative; border-radius: 15px; padding: 30px;}
.wbte-sf-banner-box h1{ font-size: 22px; font-weight: 700; color: #2d2d2d; }
.wbte-sf-banner-box .wbte-sf-tab-description{ font-size: 14px; font-weight: 300; }
.wbte-sf-banner-box .wbte-sf-item-left{ position: relative; }
.wbte-sf-banner-box.wbte-sf-connected .wbte-sf-item-left{ position: relative; flex: 1; display: flex; flex-direction: column; justify-content: center; }
.wbte-sf-banner-box .wbte-sf-item-left h3{ font-weight: 600; font-size: 18px; }
.wbte-sf-banner-box .wbte-sf-item-right{ text-align:right; }
.wbte-sf-banner-box .wbte-sf-item-right img{ display:inline-block; max-width:352px; }
.wbte-sf-banner-box .wbte-sf-btnbox{ width:100%;}
.wbte-sf-banner-box .wbte-sf-btn{ background-color:#1763DC; color:white; display:inline-flex; align-items:center; justify-content:center; gap:8px; text-align:center; padding:.7rem 2rem; min-width: 326px; width:auto; box-sizing:border-box; border: none; border-radius:4px; font-size:.9rem; cursor: pointer; transition: background-color 0.3s; text-decoration:none; margin-top: 5px; }
.wbte-sf-banner-box .wbte-sf-btn .wbte-sf-btn-icon{ width:16px; height:16px; vertical-align:middle; }
.wbte-sf-banner-box .wbte-sf-disconnect{ color:#2f79b6; cursor: pointer; text-decoration:underline; }

/* Trusted by banner */
.wbte-sf-trusted-by-banner { display: flex; align-items: stretch; justify-content: space-between; gap: 1.5rem; max-width: 95%; margin: 2rem auto; padding: 1.5rem 2rem; background: #ffffff; border: 1px solid #E5E7EB; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06); box-sizing: border-box; flex-wrap: wrap; }
.wbte-sf-trusted-by-content { flex: 1; min-width: 280px; max-width: 60%;}
.wbte-sf-trusted-by-label { display: block; font-size: 11px; font-weight: 400; color: #6B7280; letter-spacing: 0.05em; margin-bottom: 8px; text-transform: uppercase; }
.wbte-sf-trusted-by-heading { font-size: 18px; font-weight: 700; color: #0C1C37; margin: 0 0 10px 0; line-height: 1.3; }
.wbte-sf-trusted-by-heading .wbte-sf-trusted-by-heading-highlight { font-size: 24px; font-weight: 700; color: #0C1C37; }
.wbte-sf-trusted-by-description { font-size: 14px; font-weight: 400; color: #374151; margin: 0; line-height: 1.5; }
.wbte-sf-trusted-by-cards { display: flex; flex-direction: row; flex-wrap: wrap; gap: 12px; flex-shrink: 0; align-items: stretch; }
.wbte-sf-trusted-by-card { background: #E9F2FF; border: 1px solid #B8D4F0; border-radius: 20px; padding: 20px 24px; box-sizing: border-box; min-width: 225px; flex: 1; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04); text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; }
.wbte-sf-trusted-by-card-label { display: block; font-size: 14px; font-weight: 500; color: #333333; margin-bottom: 10px; }
.wbte-sf-trusted-by-card-value { display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 20px; font-weight: 500; color: #1A1A1A; }
.wbte-sf-trusted-by-star { flex-shrink: 0; }
.wbte-sf-trusted-by-rating { line-height: 1; }
.wbte-sf-trusted-by-count { font-size: 20px; font-weight: 500; color: #1A1A1A; }

.wbte-sf-tab-steps-container { display: flex; align-items: center; font-family: 'Poppins', sans-serif; margin-bottom: 20px; }
.wbte-sf-tab-step-number { background-color: #E0EBF5;  color: #1763DC;  width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; margin-right: 16px; }
.wbte-sf-tab-bold-text { font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600; color: #0C1C37; margin: 0; }

/* Why do we need this access - info box */
.wbte-sf-access-info-box { display: flex; align-items: flex-start; gap: 16px; background: #ECF7FF; border-radius: 12px; padding: 16px 5px; margin-top: 8px; margin-bottom: 8px; box-sizing: border-box; }
.wbte-sf-access-info-box .wbte-sf-access-info-icon { font-size: 24px; width: 24px; height: 24px; flex-shrink: 0; margin-top: 2px; }
.wbte-sf-access-info-box .wbte-sf-access-info-content { flex: 1; font-size: 14px; line-height: 1.5; color: #0C1C37; }
.wbte-sf-access-info-box .wbte-sf-access-info-title { font-size: 14px; font-weight: 600; color: #0C1C37; margin: 0 0 8px 0; }
.wbte-sf-access-info-box .wbte-sf-access-info-text { font-size: 12px; font-weight: 400; margin: 0; }

/* Authorization Denied warning */
.wbte-sf-auth-denied-warning { align-items: flex-start; justify-content: space-between; background-color: #FCEAED; border: 0.5px solid #D63638; border-radius: 12px; padding: 16px 20px; color: #DF284C; font-family: Arial, sans-serif; max-width: 1100px; margin: 20px auto; position: relative; box-sizing: border-box; gap: 15px; display: <?php echo $rp_decorator_show_warning ? 'flex' : 'none'; ?>; }
.wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-content { flex: 1; font-size: 14px; line-height: 20px; font-weight: 400; }
.wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-content-title { font-size: 16px; margin: 0; margin-bottom: 8px; }
.wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-content span strong, .wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-content-title { font-weight: 700; }
.wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-close { color: #D63638; font-size: 25px; cursor: pointer; }

/* Image Slider Styles */
.wbte-sf-image-slider { border-radius: 10px; border: 1px solid #E0EBF5; box-shadow: 0.61px 0.61px 1.52px 0px #132E5A1A, 1.82px 2.13px 2.74px 0px #132E5A17, 4.26px 4.56px 3.65px 0px #132E5A0D, 7.3px 8.21px 4.56px 0px #132E5A03, 11.55px 13.08px 4.87px 0px #132E5A0D; position: relative; width: 100%; display: flex; flex-direction: column; background: #FFF; }
.wbte-sf-slider-wrapper { position: relative; width: 100%; overflow: hidden; border-radius: 10px; }
.wbte-sf-slide { position: absolute; top: 0; left: 0; width: 100%; opacity: 0; transition: opacity 0.5s ease-in-out; display: flex; flex-direction: column; }
.wbte-sf-slide.active { opacity: 1; position: relative; }
.wbte-sf-slide-image { width: 100%; position: relative; }
.wbte-sf-slide img { width: 100%; height: 200px; }
.wbte-sf-slide-content { padding: 20px 0 0 0; width: 100%; text-align: center; }
.wbte-sf-slide-title { font-size: 16px; font-weight: 600; color: #2d2d2d; margin: 0 0 10px 0; line-height: 1.3; }
.wbte-sf-slide-description { font-size: 13px; font-weight: 400; color: #2d2d2d; margin: 0 12px; line-height: 1.8; }
.wbte-sf-slider-dots { position: relative; margin-top: 20px; display: flex; gap: 15px; justify-content: center; align-items: center; width: 100%; margin-bottom: 20px; }
.wbte-sf-slider-arrow { position: absolute; background: transparent; border: none; color: #2d2d2d; font-size: 18px; font-weight: 300; cursor: pointer; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; transition: color 0.3s ease; line-height: 1; padding: 50px; top: 50%; transform: translateY(-50%); }
.wbte-sf-slider-arrow:hover { color: #1763DC; }
.wbte-sf-slider-arrow-left { left: 0; }
.wbte-sf-slider-arrow-right { right: 0; }
.wbte-sf-dot { width: 6px; height: 6px; border-radius: 50%; background: #9CA3AF; cursor: pointer; transition: all 0.3s ease; border: none; padding: 0; }
.wbte-sf-dot.active { background: #2d2d2d; width: 8px; height: 8px; }
.wbte-sf-dot:hover { background: #6B7280; }


@media screen and (max-width: 1100px) {
	.wbte-sf-banner-box-container { flex-direction: column; align-items: center; margin: 1rem auto; }
	.wbte-sf-banner-box { width: 100%; max-width: 100%; padding: 1.5rem; }
	.wbte-sf-banner-box-container-right { width: 100%; max-width: 100%; padding: 20px; }
	.wbte-sf-banner-box .wbte-sf-btnbox { position: relative; bottom: 0; margin-top: 20px; }
	.wbte-sf-banner-box .wbte-sf-item img { max-width: 100%; }
	.wbte-sf-trusted-by-banner { flex-direction: column; padding: 1.25rem; margin: 1.5rem auto; }
	.wbte-sf-trusted-by-content { max-width: 100%; }
	.wbte-sf-trusted-by-cards { justify-content: center; }
}
@media screen and (max-width: 800px) {
	.wbte-sf-banner-box .wbte-sf-item { flex: 1 1 100%; }
	.wbte-sf-banner-box .wbte-sf-item-left { padding-right: 1rem; padding-left: 1rem; position: relative; text-align: center; }
	.wbte-sf-banner-box .wbte-sf-item-right { text-align: center; margin-top: 20px; }
	.wbte-sf-banner-box .wbte-sf-item-right img { max-width: 96%; }
	.wbte-sf-header h1 { font-size: 20px; line-height: 1.3; padding: 0 0.5rem; }
	.wbte-sf-subtitle { font-size: 14px; padding: 0 0.5rem; }
	.wbte-sf-auth-denied-warning { flex-direction: column; padding: 12px 16px; margin: 1rem auto; text-align: left; }
	.wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-content-title { font-size: 14px; }
	.wbte-sf-auth-denied-warning .wbte-sf-auth-denied-warning-content { font-size: 13px; }
	.wbte-sf-slider-arrow { padding: 24px; width: 44px; height: 44px; min-width: 44px; min-height: 44px; }
}
@media screen and (max-width: 600px) {
	.wbte-sf-top-box { padding: 0 0.5rem; }
	.wbte-sf-banner-box-container { max-width: 100%; margin: 0.75rem 0; border-radius: 8px; }
	.wbte-sf-banner-box { padding: 1.25rem 1rem; border-radius: 8px; }
	.wbte-sf-banner-box .wbte-sf-item-left h3 { font-size: 16px; }
	.wbte-sf-banner-box .wbte-sf-btn { min-width: 100%; width: 100%; padding: 0.75rem 1rem; font-size: 0.875rem; }
	.wbte-sf-tab-steps-container { flex-direction: row; margin-bottom: 16px; text-align: left; }
	.wbte-sf-tab-step-number { width: 28px; height: 28px; font-size: 14px; margin-right: 12px; flex-shrink: 0; }
	.wbte-sf-tab-bold-text { font-size: 13px; }
	.wbte-sf-access-info-box { padding: 12px 10px; flex-direction: row; gap: 12px; }
	.wbte-sf-access-info-box .wbte-sf-access-info-title { font-size: 13px; }
	.wbte-sf-access-info-box .wbte-sf-access-info-text { font-size: 11px; }
	.wbte-sf-trusted-by-banner { flex-direction: column; padding: 1rem; margin: 1rem 0; gap: 1rem; }
	.wbte-sf-trusted-by-heading { font-size: 16px; }
	.wbte-sf-trusted-by-description { font-size: 13px; }
	.wbte-sf-trusted-by-cards { flex-direction: column; gap: 10px; width: 100%; }
	.wbte-sf-trusted-by-card { min-width: 0; width: 100%; padding: 16px; border-radius: 16px; }
	.wbte-sf-trusted-by-card-value { font-size: 18px; }
	.wbte-sf-slide img { height: 160px; object-fit: cover; }
	.wbte-sf-slide-title { font-size: 14px; }
	.wbte-sf-slide-description { font-size: 12px; margin: 0 8px; }
	.wbte-sf-slider-dots { margin-top: 12px; margin-bottom: 12px; gap: 10px; }
	.wbte-sf-dot { width: 8px; height: 8px; }
	.wbte-sf-dot.active { width: 10px; height: 10px; }
}
@media screen and (max-width: 480px) {
	.wbte-sf-header h1 { font-size: 18px; }
	.wbte-sf-subtitle { font-size: 13px; }
	.wbte-sf-banner-box { padding: 1rem 0.75rem; }
	.wbte-sf-banner-box .wbte-sf-item-left { padding-left: 0.5rem; padding-right: 0.5rem; }
	.wbte-sf-banner-box .wbte-sf-item-left h3 { font-size: 15px; }
	.wbte-sf-banner-box .wbte-sf-btn { padding: 0.7rem 0.75rem; font-size: 0.85rem; }
	.wbte-sf-tab-step-number { width: 26px; height: 26px; font-size: 13px; margin-right: 10px; }
	.wbte-sf-trusted-by-label { font-size: 10px; }
	.wbte-sf-trusted-by-heading { font-size: 15px; }
	.wbte-sf-trusted-by-card-label { font-size: 13px; }
	.wbte-sf-trusted-by-card-value { font-size: 16px; }
	.wbte-sf-slide img { height: 140px; }
	.wbte-sf-slider-arrow { padding: 16px; width: 40px; height: 40px; min-width: 40px; min-height: 40px; font-size: 16px; }
}
</style>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#wbte-sf-connect-btn').on('click', function(e){
			e.preventDefault();
			var $btn = $(this);
			var authUrl = $btn.data('auth-url') || $btn.attr('href');			
			$.ajax({
				url: '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>',
				type: 'POST',
				data: { 
					action: 'wbte_sf_set_first_time_connect', 
					nonce: '<?php echo esc_html( wp_create_nonce( 'wbte_sf_set_first_time_connect' ) ); ?>' 
				},
				dataType: 'json',
				async: true
			});
			if(authUrl){
				window.location.href = authUrl;
			}
		});

		var disconnection_in_progress = false;
		$('.wbte-sf-disconnect').on('click', function(){
			if(disconnection_in_progress){
				return;
			}
			disconnection_in_progress = true;

			var $disconnectBtn = $(this);
			if(confirm('<?php esc_html_e( 'Are you sure you want to disconnect?', 'decorator-woocommerce-email-customizer' ); ?>')){
				$disconnectBtn.html('<?php esc_html_e( 'Disconnecting...', 'decorator-woocommerce-email-customizer' ); ?>');
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
							$disconnectBtn.html('<?php esc_html_e( 'Disconnect', 'decorator-woocommerce-email-customizer' ); ?>');
						}
					},
					error: function(xhr, status, error){
						disconnection_in_progress = false;
						alert('<?php esc_html_e( 'Failed to disconnect.', 'decorator-woocommerce-email-customizer' ); ?>');
						$disconnectBtn.html('<?php esc_html_e( 'Disconnect', 'decorator-woocommerce-email-customizer' ); ?>');
					}
				});
			} else {
				disconnection_in_progress = false;
			}
		});

		$('.wbte-sf-auth-denied-warning-close').on('click', function(){
			$('.wbte-sf-auth-denied-warning').hide();
		});

		// Image Slider Functionality
		var currentSlide = 0;
		var slides = $('.wbte-sf-slide');
		var dots = $('.wbte-sf-dot');
		var totalSlides = slides.length;
		var autoSlideInterval;

		function showSlide(index) {
			// Remove active class from all slides and dots
			slides.removeClass('active');
			dots.removeClass('active');
			
			// Add active class to current slide and dot
			slides.eq(index).addClass('active');
			dots.eq(index).addClass('active');
			
			currentSlide = index;
		}

		function nextSlide() {
			var next = (currentSlide + 1) % totalSlides;
			showSlide(next);
		}

		function prevSlide() {
			var prev = (currentSlide - 1 + totalSlides) % totalSlides;
			showSlide(prev);
		}

		function startAutoSlide() {
			autoSlideInterval = setInterval(nextSlide, 4000); // Change slide every 4 seconds
		}

		function stopAutoSlide() {
			clearInterval(autoSlideInterval);
		}

		// Arrow navigation
		$('.wbte-sf-slider-arrow-right').on('click', function() {
			stopAutoSlide();
			nextSlide();
			startAutoSlide();
		});

		$('.wbte-sf-slider-arrow-left').on('click', function() {
			stopAutoSlide();
			prevSlide();
			startAutoSlide();
		});

		// Dot navigation
		$('.wbte-sf-dot').on('click', function() {
			var slideIndex = $(this).data('slide');
			stopAutoSlide();
			showSlide(slideIndex);
			startAutoSlide();
		});

		// Pause auto-slide on hover
		$('.wbte-sf-image-slider').on('mouseenter', function() {
			stopAutoSlide();
		}).on('mouseleave', function() {
			startAutoSlide();
		});

		// Initialize slider
		if (totalSlides > 0) {
			showSlide(0);
			startAutoSlide();
		}
	});
</script>