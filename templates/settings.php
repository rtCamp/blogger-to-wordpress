<?php
/**
 * Admin page template file
 *
 * @package Blogger_To_WordPress
 */

?>
<div class="wrap">

	<div>
		<img id="btowp_img" alt="<?php esc_attr_e( 'B2W-Redirection', 'blogger-to-wordpress' ); ?>" src="<?php echo esc_url( RT_B2WR_PLUGIN_URL ); ?>images/btowp_img.png" />
		<h1 id="btowp_h2"><?php esc_html_e( 'Blogger to WordPress Redirection', 'blogger-to-wp' ); ?></h1>
	</div>

	<div class="clear"></div>

	<div id="content_block" class="align_left">
		<p class="description">
			<?php
			echo wp_kses(
				'This plugin is useful for setting up 1-to-1 mapping between Blogger.com blog posts and WordPress blog posts. This works nicely for blogs with old subdomain address <code>(e.g. xyz.blogspot.com)</code> which are moved to new custom domain <code>(e.g. xyz.com)</code>',
				array(
					'code' => array(),
				)
			);
			?>
		</p>

		<div id="message" class="error">
			<p>
				<?php
				echo wp_kses(
					__( 'Please keep this plugin <strong>activated</strong> for redirection to work.', 'blogger-to-wordpress' ),
					array(
						'strong' => array(),
					)
				);
				?>
			</p>
		</div>

		<h3>
			<u>
				<?php esc_html_e( 'Start Configuration', 'blogger-to-wordpress' ); ?>
			</u>
		</h3>

		<h4>
			<?php esc_html_e( 'Press "Start Configuration" button to generate code for Blogger.com blog', 'blogger-to-wordpress' ); ?>
		</h4>

		<p>
			<?php esc_html_e( 'Plugin will automatically detect Blogger.com blog from where you have imported.', 'blogger-to-wordpress' ); ?>
		</p>

		<input type="submit" class="button-primary" name="start" id ="start_config" value="<?php esc_attr_e( 'Start Configuration', 'blogger-to-wordpress' ); ?>" onclick="rt_start_config('<?php echo esc_js( wp_create_nonce( 'b2w_admin_nonce' ) ); ?>')" />

		<p id="get_config" class="clear"></p>
	</div>

	<div id="ads_block" class="metabox-holder align_left">
		<div class="postbox-container">
			<div class="meta-box-sortables ui-sortable">
				<div class="postbox" id="social">
					<div title="<?php esc_attr_e( 'Click to toggle', 'blogger-to-wordpress' ); ?>" class="handlediv"><br></div>

					<h3 class="hndle"><span><strong><?php esc_html_e( 'Getting Social is Good', 'blogger-to-wordpress' ); ?></strong></span></h3>

					<div class="inside" style="text-align:center;">
						<a href="https://www.facebook.com/rtCamp.solutions" target="_blank" title="<?php esc_attr_e( 'Become a fan on Facebook', 'blogger-to-wordpress' ); ?>"><img src="<?php echo esc_url( RT_B2WR_PLUGIN_URL ); ?>images/facebook.png" alt="<?php esc_attr_e( 'Twitter', 'blogger-to-wordpress' ); ?>" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="https://twitter.com/rtcamp" target="_blank" title="<?php esc_attr_e( 'Follow us on Twitter', 'blogger-to-wordpress' ); ?>"><img src="<?php echo esc_url( RT_B2WR_PLUGIN_URL ); ?>images/twitter.png" alt="<?php esc_attr_e( 'Facebook', 'blogger-to-wordpress' ); ?>" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="https://feeds.feedburner.com/rtcamp" target="_blank" title=" <?php esc_attr_e( 'Subscribe to our feeds', 'blogger-to-wordpress' ); ?>"><img src="<?php echo esc_url( RT_B2WR_PLUGIN_URL ); ?>images/rss.png" alt="<?php esc_attr_e( 'RSS Feeds', 'blogger-to-wordpress' ); ?>" /></a>
					</div>
				</div>

				<div class="postbox" id="joinfb">
					<div title="<?php esc_attr_e( 'Click to Toggle', 'blogger-to-wordpress' ); ?>" class="handlediv"><br></div>

					<h3 class="hndle"><span><strong><?php esc_html_e( 'Join Us on Facebook', 'blogger-to-wordpress' ); ?></strong></span></h3>

					<div class="inside" style="text-align:center;">
						<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FrtCamp.solutions&amp;width=242&amp;height=182&amp;connections=4&amp;stream=false&amp;header=false" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:242px; height:182px"></iframe>
					</div>
				</div>

				<div class="postbox" id="donations">
					<div title="<?php esc_attr_e( 'Click to Toggle', 'blogger-to-wordpress' ); ?>" class="handlediv"><br></div>

					<h3 class="hndle"><span><strong> <?php esc_html_e( 'Promote, Donate, Share...', 'blogger-to-wordpress' ); ?></strong></span></h3>

					<div class="inside">

						<?php esc_html_e( 'A lot of time and effort goes into the development of this plugin. If you find it useful, please consider making a donation, or a review on your blog or sharing this with your friends to help us.', 'blogger-to-wordpress' ); ?><br/><br/>

						<div class="rt-paypal" style="text-align:center">
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_donations">
								<input type="hidden" name="business" value="paypal@rtcamp.com">
								<input type="hidden" name="lc" value="US">
								<input type="hidden" name="item_name" value="Blogger To WordPress Migration">
								<input type="hidden" name="no_note" value="0">
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
								<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="<?php esc_attr_e( 'PayPal - The safer, easier way to pay online!', 'blogger-to-wordpress' ); ?>">
								<img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
						</div>

						<div class="rt-social-share" style="text-align:center; width: 127px; margin: 2px auto">
							<div class="rt-facebook" style="float:left; margin-right:5px;">
								<a style=" text-align:center;" name="fb_share" type="box_count" share_url="https://bloggertowp.org/tutorials/blogger-to-wordpress-redirection-plugin/"></a>
							</div>

							<div class="rt-twitter" style="">
								<a href="https://twitter.com/share"  class="twitter-share-button" data-text="<?php esc_attr_e( 'Blogger to WordPress Redirection Plugin', 'blogger-to-wordpress' ); ?>"  data-url="https://bloggertowp.org/tutorials/blogger-to-wordpress-redirection-plugin/" data-count="vertical" data-via="bloggertowp"><?php esc_html_e( 'Tweet', 'blogger-to-wordpress' ); ?></a>
							</div>

							<div class="clear"></div>
						</div>

					</div><!-- end of .inside -->
				</div>

				<div class="postbox" id="support">
					<div title="<?php esc_attr_e( 'Click to Toggle', 'blogger-to-wordpress' ); ?>" class="handlediv"><br></div>

					<h3 class="hndle"><span><strong><?php esc_html_e( 'Free Support', 'blogger-to-wordpress' ); ?></strong></span></h3>

					<div class="inside">
						<?php
						echo wp_kses(
							__( 'If you have any problems with this plugin or good ideas for improvements, please talk about them in the <a href="https://wordpress.org/support/plugin/blogger-to-wordpress-redirection/" target="_blank" title="Blogger to WordPress Support Forum">support forums</a>.', 'blogger-to-wordpress' ),
							array(
								'a' => array(
									'href'  => array(),
									'title' => array(),
								),
							)
						);
						?>
					</div>
				</div>

				<div class="postbox" id="latest_news">
					<div title="<?php esc_attr_e( 'Click to Toggle', 'blogger-to-wordpress' ); ?>" class="handlediv"><br></div>

					<h3 class="hndle"><span><strong><?php esc_html_e( 'Latest News from Our Blog', 'blogger-to-wordpress' ); ?></strong></span></h3>

					<div class="inside">
						<?php rt_get_feeds_from_blogger_to_wp(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
