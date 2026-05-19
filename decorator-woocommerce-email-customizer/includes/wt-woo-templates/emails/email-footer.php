<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.4.0
 */

defined( 'ABSPATH' ) || exit;

  $rp_decorator_social_icons =  array(
                 'fa-facebook'=> 'facebook.png',
                  'fa-twitter' =>'twitter.png',
                  'fa-instagram' => 'instagram.png',
                  'fa-youtube' => 'youtube.png',
                  'fa-linkedin' => 'linkedin.png',
                  'fa-vimeo' => 'vimeo.png'
                );
		$rp_decorator_social_enable = get_option( 'footer_social_enable' );
		$rp_decorator_social_links  = get_option( 'footer_social_repeater' );
                $rp_decorator_social_position  = get_option( 'social_links_enable' );
                $rp_decorator_social_folder  = get_option( 'social_links_icon_color' );
		$rp_decorator_social_links  = isset($rp_decorator_social_links) && !empty($rp_decorator_social_links) ? json_decode( $rp_decorator_social_links ):'';
?>
															</div>
														</td>
													</tr>
												</table>
												<!-- End Content -->
											</td>
										</tr>
									</table>
									<!-- End Body -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr id="wt_template_footer">
					<td align="center" valign="top">
                                            <div id="wt_template_footers">
						<!-- Footer -->
                                                <table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer" style="background-color: #efefef">
							<tr>
								<td valign="top">
									<table border="0" cellpadding="10" cellspacing="0" width="100%">
										<tr>
                                                                                    <td colspan="2" valign="middle" id="credits" style="padding: 24px 0px">
											 <?php 
                                                                                         if(!empty($rp_decorator_social_links) && $rp_decorator_social_position == 'above'){
                                                                                              $rp_decorator_items = count($rp_decorator_social_links);
                                                                                            ?>
                                                                                            <table style="margin-left: auto; margin-right: auto;" id="wt_social_footer"><tr> <?php
                                                                                            foreach ($rp_decorator_social_links as $rp_decorator_social_link) {
                                                                                                ?>
                                                                                               <td> <div style="display: inline-block;">
                                                                                                    <a href="<?php echo esc_url($rp_decorator_social_link->link); ?>" class="wt-footer-social-links" style=" text-decoration: none;">
                                                                                                        <?php
                                                                                                            if (isset($rp_decorator_social_link->icon_color) && !empty($rp_decorator_social_link->icon_color)) {
                                                                                                                $rp_decorator_color = $rp_decorator_social_link->icon_color;
                                                                                                            } else {
                                                                                                                $rp_decorator_color = 'default';
                                                                                                            }
                                                                                                               if(array_key_exists($rp_decorator_social_link->choice, $rp_decorator_social_icons)){
                                                                                                                   if(isset($rp_decorator_social_folder) && !empty($rp_decorator_social_folder)){
                                                                                                                       $rp_decorator_base = RP_DECORATOR_PLUGIN_URL . '/assets/images/'.$rp_decorator_social_folder.'/';
                                                                                                                   }else{
                                                                                                                       $rp_decorator_base = RP_DECORATOR_PLUGIN_URL . '/assets/images/default/';
                                                                                                                   }
                                                                                                                   $rp_decorator_img_link = $rp_decorator_base . $rp_decorator_social_icons[$rp_decorator_social_link->choice];
                                                                                                                   printf( 
                                                                                                                        '<span class="wt-social-link-icon" style="font-size: 20px;"><img src="%s" width="20" ></img></span>',
                                                                                                                        esc_url( $rp_decorator_img_link )
                                                                                                                   );
                                                                                                               }
                                                                                                            
                                                                                                        ?>
                                                                                                        <span class="wt-social-link-title" ><?php echo esc_html($rp_decorator_social_link->title); ?></span>
                                                                                                    </a>
                                                                                                </div></td>
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                          </tr>
           
									                    </table>
                                                                                                   <?php
                                                                                                   }?><div id="credit" style="padding:0px;"><?php
                                                                                            echo wp_kses_post( wpautop( wptexturize( apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) ) ) ) ); 
                                                                                           ?></div> <?php 
                                                                                            if(!empty($rp_decorator_social_links) && $rp_decorator_social_position == 'bellow'){
                                                                                            $rp_decorator_items = count($rp_decorator_social_links);
                                                                                            ?>
                                                                                            <table style="margin-left: auto; margin-right: auto;" id="wt_social_footer"><tr> <?php
                                                                                            foreach ($rp_decorator_social_links as $rp_decorator_social_link) {
                                                                                                ?>
                                                                                               <td> <div style="display: inline-block;">
                                                                                                    <a href="<?php echo esc_url($rp_decorator_social_link->link); ?>" class="wt-footer-social-links" style=" text-decoration: none;">
                                                                                                        <?php
                                                                                                            if (isset($rp_decorator_social_link->icon_color) && !empty($rp_decorator_social_link->icon_color)) {
                                                                                                                $rp_decorator_color = $rp_decorator_social_link->icon_color;
                                                                                                            } else {
                                                                                                                $rp_decorator_color = 'black';
                                                                                                            }
                                                                                                            if(array_key_exists($rp_decorator_social_link->choice, $rp_decorator_social_icons)){
                                                                                                                   if(isset($rp_decorator_social_folder) && !empty($rp_decorator_social_folder)){
                                                                                                                       $rp_decorator_base = RP_DECORATOR_PLUGIN_URL . '/assets/images/'.$rp_decorator_social_folder.'/';
                                                                                                                   }else{
                                                                                                                       $rp_decorator_base = RP_DECORATOR_PLUGIN_URL . '/assets/images/black/';
                                                                                                                   }
                                                                                                                   $rp_decorator_img_link = $rp_decorator_base . $rp_decorator_social_icons[$rp_decorator_social_link->choice];
                                                                                                                   printf( 
                                                                                                                        '<span class="wt-social-link-icon" style="font-size: 20px;"><img src="%s" width="20" ></img></span>',
                                                                                                                        esc_url( $rp_decorator_img_link )
                                                                                                                   );
                                                                                                               }
                                                                                                        ?>
                                                                                                        <span class="wt-social-link-title" ><?php echo esc_html($rp_decorator_social_link->title); ?></span>
                                                                                                    </a>
                                                                                                </div></td>
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                          </tr>
           
									                    </table>
                                                                                                   <?php
                                                                                         }
                                                                                            ?>
								</td>
							</tr>
						</table>
						<!-- End Footer -->
					</td>
				</tr>
			 </table>
                        <div>
                      </table>                          
		</div>
	</body>
</html>
