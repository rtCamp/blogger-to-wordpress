<?php
/**
 * Update notice template file
 *
 * @package blogger-to-wordpress
 */

?>

<div id="b2wr_notice_block" class="error">
	<p>
		<?php esc_html_e( 'Due to recent updates on blogger.com, Blogger to WordPress Redirection plugin has been rewritten. The process has also changed completely. Please refer the updated instructions here:', 'blogger-to-wordpress' ); ?>
		<a class="blue_color" href="https://bloggertowp.org/tutorials/blogger-to-wordpress-redirection-plugin/" target="_blank" title="Read more details about this update at Our Blog">(Read More…)</a>
		<span>
		<input type="hidden" id="b2wr_nonce_field" value="<?php echo esc_attr( wp_create_nonce( 'b2w_update_nonce' ) ); ?>">
		<input type="button" id="hide_b2wr_notice_block" value="Hide this message!" class="button">
		</span>
	</p>
</div>';