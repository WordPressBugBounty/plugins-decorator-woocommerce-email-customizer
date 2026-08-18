<?php
/**
 * Email Order Items
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-items.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 11.0.0
 */

use Automattic\WooCommerce\Utilities\FeaturesUtil;

defined( 'ABSPATH' ) || exit;

$rp_decorator_text_align  = is_rtl() ? 'right' : 'left';
$rp_decorator_margin_side = is_rtl() ? 'left' : 'right';

$rp_decorator_email_improvements_enabled = FeaturesUtil::feature_is_enabled( 'email_improvements' );

foreach ( $items as $rp_decorator_item_id => $rp_decorator_item ) :
	$rp_decorator_product       = $rp_decorator_item->get_product();
	$rp_decorator_sku           = '';
	$rp_decorator_purchase_note = '';
	$rp_decorator_image         = '';
        $rp_decorator_name = $rp_decorator_item->get_name();

	if ( ! apply_filters( 'woocommerce_order_item_visible', true, $rp_decorator_item ) ) {
		continue;
	}

	if ( is_object( $rp_decorator_product ) ) {
		$rp_decorator_sku           = $rp_decorator_product->get_sku();
		$rp_decorator_purchase_note = $rp_decorator_product->get_purchase_note();
		$rp_decorator_image         = $rp_decorator_product->get_image( $image_size );
        }else{
            if($rp_decorator_name == 'A Study in Scarlet'){
              $rp_decorator_sku           ='sample_sku';
            }
            if($rp_decorator_name == 'The Hound of the Baskervilles'){
              $rp_decorator_sku           ='hound';
            }
        }

	?>
	<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $rp_decorator_item, $order ) ); ?>">
		<td class="td" style="text-align:<?php echo esc_attr( $rp_decorator_text_align ); ?>; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;">
		<?php
		// Show title/image etc.
		if ( $show_image ) {
			echo wp_kses_post( apply_filters( 'woocommerce_order_item_thumbnail', $rp_decorator_image, $rp_decorator_item ) );
		}
                
                if ($show_image && ($rp_decorator_name == 'A Study in Scarlet' ||$rp_decorator_name == 'The Hound of the Baskervilles')) {
                    echo wp_kses_post('<img width="50" height="50" src="'.RP_DECORATOR_PLUGIN_URL.'/assets/images/wc-placeholder.png"/>');
                }

		// Product name.
		echo "<div style='display: inline-block;max-width: 175px;vertical-align: middle;'>" . wp_kses_post( apply_filters( 'woocommerce_order_item_name', $rp_decorator_item->get_name(), $rp_decorator_item, false ) );

		// SKU.
		if ( $show_sku && $rp_decorator_sku ) {
			echo wp_kses_post( ' (#' . $rp_decorator_sku . ')' );
		}
                echo "</div>";
		// allow other plugins to add additional product information here.
		do_action( 'woocommerce_order_item_meta_start', $rp_decorator_item_id, $rp_decorator_item, $order, $plain_text );

		wc_display_item_meta(
			$rp_decorator_item,
			array(
				'label_before' => '<strong class="wc-item-meta-label" style="float: ' . esc_attr( $rp_decorator_text_align ) . '; margin-' . esc_attr( $rp_decorator_margin_side ) . ': .25em; clear: both">',
			)
		);

		// allow other plugins to add additional product information here.
		do_action( 'woocommerce_order_item_meta_end', $rp_decorator_item_id, $rp_decorator_item, $order, $plain_text );

		?>
		</td>
		<td class="td" style="text-align:<?php echo esc_attr( $rp_decorator_text_align ); ?>; vertical-align:middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
			<?php
			$rp_decorator_qty          = $rp_decorator_item->get_quantity();
			$rp_decorator_refunded_qty = $order->get_qty_refunded_for_item( $rp_decorator_item_id );

			if ( $rp_decorator_refunded_qty ) {
				$rp_decorator_qty_display = '<del>' . esc_html( $rp_decorator_qty ) . '</del> <ins>' . esc_html( $rp_decorator_qty - ( $rp_decorator_refunded_qty * -1 ) ) . '</ins>';
			} else {
				$rp_decorator_qty_display = esc_html( $rp_decorator_qty );
			}
			/** This filter is documented in woocommerce/templates/emails/email-order-items.php */
			$rp_decorator_quantity = apply_filters( 'woocommerce_email_order_item_quantity', $rp_decorator_qty_display, $rp_decorator_item );
			if ( '' !== $rp_decorator_quantity ) {
				$rp_decorator_quantity_prefix = $rp_decorator_email_improvements_enabled ? '&times;' : '';
				echo wp_kses_post( $rp_decorator_quantity_prefix . $rp_decorator_quantity );
			}
			?>
		</td>
		<td class="td" style="text-align:<?php echo esc_attr( $rp_decorator_text_align ); ?>; vertical-align:middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
			<?php echo wp_kses_post( $order->get_formatted_line_subtotal( $rp_decorator_item ) ); ?>
		</td>
	</tr>
	<?php

	if ( $show_purchase_note && $rp_decorator_purchase_note ) {
		?>
		<tr>
			<td colspan="3" style="text-align:<?php echo esc_attr( $rp_decorator_text_align ); ?>; vertical-align:middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
				<?php
				echo wp_kses_post( wpautop( do_shortcode( $rp_decorator_purchase_note ) ) );
				?>
			</td>
		</tr>
		<?php
	}
	?>

<?php endforeach; ?>
