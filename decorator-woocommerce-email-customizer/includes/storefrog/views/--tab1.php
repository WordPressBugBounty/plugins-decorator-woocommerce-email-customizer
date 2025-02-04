<?php
/**
 * StoreFrog connector page tab 1 template.
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
			<h1><?php esc_html_e( 'Elevate Your Email Campaigns with WebToffee Marketing', 'decorator-woocommerce-email-customizer' ); ?></h1>
			<p class="wbte-sf-subtitle"><?php esc_html_e( 'From advanced automations to powerful insights—level up today.', 'decorator-woocommerce-email-customizer' ); ?></p>
		</div>

		<div class="wbte-sf-features-grid">
			<!-- Feature Card 1 -->
			<div class="wbte-sf-feature-card">
				<div class="wbte-sf-icon wbte-sf-icon-campaigns">
					<img src="<?php echo esc_url( $asset_url . 'images/magic-wand.svg' ); ?>" alt="<?php esc_attr_e( 'Create Campaigns That Convert!', 'decorator-woocommerce-email-customizer' ); ?>">
				</div>
				<h3><?php esc_html_e( 'Create Campaigns That Convert!', 'decorator-woocommerce-email-customizer' ); ?></h3>
				<p><?php esc_html_e( 'Create attention-grabbing popups, banners, and special offers that attract and retain visitors.', 'decorator-woocommerce-email-customizer' ); ?></p>
			</div>

			<!-- Feature Card 2 -->
			<div class="wbte-sf-feature-card">
				<div class="wbte-sf-icon wbte-sf-icon-automate">
					<img src="<?php echo esc_url( $asset_url . 'images/line-segments.svg' ); ?>" alt="<?php esc_attr_e( 'Automate & Elevate Your Strategy!', 'decorator-woocommerce-email-customizer' ); ?>">
				</div>
				<h3><?php esc_html_e( 'Automate & Elevate Your Strategy!', 'decorator-woocommerce-email-customizer' ); ?></h3>
				<p><?php esc_html_e( 'Trigger emails based on customer actions, from abandoned carts to re-engagement.', 'decorator-woocommerce-email-customizer' ); ?></p>
			</div>

			<!-- Feature Card 3 -->
			<div class="wbte-sf-feature-card">
				<div class="wbte-sf-icon wbte-sf-icon-revenue">
					<img src="<?php echo esc_url( $asset_url . 'images/chart-bar.svg' ); ?>" alt="<?php esc_attr_e( 'Turn Data into Revenue!', 'decorator-woocommerce-email-customizer' ); ?>">
				</div>
				<h3><?php esc_html_e( 'Turn Data into Revenue!', 'decorator-woocommerce-email-customizer' ); ?></h3>
				<p><?php esc_html_e( 'Track email performance and user engagement with analytics to refine and improve.', 'decorator-woocommerce-email-customizer' ); ?></p>
			</div>
		</div>

		<div class="wbte-sf-cta">
			<a href="<?php echo esc_url( $tab2_url ); ?>" class="wbte-sf-button wbte-sf-button-primary">
				<?php esc_html_e( 'Explore WebToffee Marketing', 'decorator-woocommerce-email-customizer' ); ?> 
				<span class="dashicons dashicons-arrow-right-alt2"></span>
			</a>
		</div>
	</div>
	

	<div class="wbte-sf-alternative">
		<h2><?php esc_html_e( 'Want to stick with just email editing?', 'decorator-woocommerce-email-customizer' ); ?></h2>
		<p><?php esc_html_e( 'No problem! Continue with Decorator and enjoy simple and seamless email customisation.', 'decorator-woocommerce-email-customizer' ); ?></p>
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=decorator-woocommerce-email-customizer' ) ); ?>" class="wbte-sf-button wbte-sf-button-secondary">
			<?php esc_html_e( 'Continue with Email Editor', 'decorator-woocommerce-email-customizer' ); ?>
		</a>
	</div>
</div>
<style>
body{ background:#ffffff; }
.wbte-sf-subtitle {
	font-size: 1.2rem;
	color:#2d2d2d;
	margin-top: 0.5rem; font-size:18px; font-weight:300;
}

.wbte-sf-features-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
	gap: 2rem;
	margin: 3rem auto; max-width:1100px;
}

.wbte-sf-feature-card {
	background: #fff;
	padding: 20px;
	border-radius: 10px;
	text-align: center;
	box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.wbte-sf-feature-card h3{ color:#132e5a; font-weight:500; font-size:1.1rem; line-height:1.8rem; min-height:55px; margin:0px; display:inline-flex; align-items:center; }
.wbte-sf-feature-card p{ color:#444444; font-size:.95rem; font-weight:300; line-height:1.5rem; }
.wbte-sf-icon {
	width:32px;
	height:32px;
	margin: 0 auto 1.5rem;
	padding: 1rem;
	border-radius:15px;
	display: flex;
	align-items: center;
	justify-content: center;
}

.wbte-sf-icon img {
	width:90%;
	height: auto;
}

.wbte-sf-icon-campaigns { background: #FFE8E8; }
.wbte-sf-icon-automate { background: #E8F5F0; }
.wbte-sf-icon-revenue { background: #E8F0FF; }

.wbte-sf-cta,
.wbte-sf-alternative {
	text-align: center;
	margin:3.5rem 0;
}

.wbte-sf-button {
	display: inline-flex;
	align-items: center;    
	border-radius: 5px;
	text-decoration: none;
	font-weight:500;
	transition: all 0.3s ease; justify-content: center;
}
.wbte-sf-cta a{ width:100%; max-width:300px; }

.wbte-sf-button-primary {
	background: #1763DC;
	color: #fff; padding: 1rem 2rem; font-size:16px;
}

.wbte-sf-button-secondary {
	background: #fff;
	color: #3157a6;
	border: 1px solid #3157a6; padding:.6rem 2rem; font-size:14px;
}

.wbte-sf-button:hover {
	opacity: 0.9;
	transform: translateY(-2px);
}

.wbte-sf-alternative h2{ font-size:22px; margin-bottom:0px; }
.wbte-sf-alternative p{ font-size:16px; font-weight:300; margin-top:5px; }

.wbte-sf-button .dashicons {
	margin-left: 0.5rem;
}

/* Responsive Styles */
@media screen and (max-width: 782px) {
	.wbte-sf-features-grid {
		grid-template-columns: 1fr;
	}
	
	.wbte-sf-header h1 {
		font-size: 1.8rem;
	}
	
	.wbte-sf-subtitle {
		font-size: 1rem;
	}
	
	.wbte-sf-feature-card {
		padding: 1.5rem;
	}
}
</style>