<?php
/**
 * Plugin Name: Blogger To WordPress
 * Plugin URI: https://bloggertowp.org/tutorials/blogger-to-wordpress-redirection-plugin/
 * Description: This plugin is useful for setting up 1-to-1 mapping between Blogger.com blog posts and WordPress blog posts. This works nicely for blogs with old subdomain address (e.g. xyz.blogspot.com) which are moved to new custom domain (e.g. xyz.com)
 * Version: 2.2.5
 * Author: rtCamp
 * Author URI: https://rtcamp.com/
 * Requires at least: 3.2
 * Tested up to: 5.1
 * Text Domain: blogger-to-wordpress
 *
 * @package blogger-to-wordpress
 */

define( 'RT_B2WR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'RT_B2WR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 *  Add option to Tools Menu
 */
function rt_blogger_to_wordpress_add_option() {
	add_management_page( 'Blogger To WordPress Redirection', 'Blogger To WordPress Redirection', 'administrator', 'rt-blogger-to-wordpress-redirection', 'rt_blogger_to_wordpress_administrative_page' );

	wp_enqueue_script( 'rt-blogger-to-wordpress-redirection-js', ( RT_B2WR_PLUGIN_URL . 'js/b2w-redirection-ajax.js' ), array( 'jquery', 'postbox' ), filemtime( RT_B2WR_PLUGIN_DIR . 'js/b2w-redirection-ajax.js' ), true );
	// No need for version in external script.
	wp_enqueue_script( 'rt-fb-share', ( 'https://static.ak.fbcdn.net/connect.php/js/FB.Share' ), '', '', true ); //phpcs:ignore 
	wp_enqueue_script( 'rt-twitter-widget-js', ( 'https://platform.twitter.com/widgets.js' ), '', '', true ); //phpcs:ignore

	wp_enqueue_style( 'rt-blogger-to-wordpress-redirection-css', ( RT_B2WR_PLUGIN_URL . 'css/b2w-redirection.css' ), array(), filemtime( RT_B2WR_PLUGIN_DIR . 'css/b2w-redirection.css' ) );
	$page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
	if ( ! empty( $page ) && 'rt-blogger-to-wordpress-redirection' === $page ) {
		wp_enqueue_script( 'dashboard' );
		wp_enqueue_style( 'dashboard' );
	}

}

add_action( 'admin_menu', 'rt_blogger_to_wordpress_add_option' );

/**
 * Administrative Page - Begin
 */
function rt_blogger_to_wordpress_administrative_page() {
	include_once RT_B2WR_PLUGIN_DIR . 'templates/template-admin-page.php';
}

/**
 * Get Configuration, called via AJAX
 */
function rt_b2wr_get_config() {
	global $wpdb;
	if ( ! isset( $_POST['nonce'] )
	|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'admin_nonce' )
	) {
		return;
	}
	// get all blogger domains, if avaliable.
	$sql = "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} where meta_key = 'blogger_blog'";
	// unprepared sql ok.
	$results = $wpdb->get_results( $sql ); //phpcs:ignore

	if ( ! $results ) {
		$err_str  = '<p id="error_msg">Sorry… No posts found that were imported from a Blogger.com blog</p>';
		$err_str .= '<strong><a href="' . get_bloginfo( 'url' ) . '/wp-admin/admin.php?import=blogger">Import from Blogger.com</a></strong> first and then "Start Configuration"';

		echo $err_str;
		die();
	}

		$html  = '<br/>';
		$html .= '<h3><u>List of Blogs</u></h3>';
		$html .= 'We found posts from following Blogger Blog(s) in your current WordPress installation. Click on <b>Get Code</b> button to generate the redirection code for the chosen Blogger blog<br /><br />';
		$html .= '<table width="350px">';

		$i = 1;

	foreach ( $results as $result ) {
		$nonce = wp_create_nonce( 'generate_code_nonce' );

		$html .= '<tr>';
		$html .= '<td width="15px">' . $i . '</td>';
		$html .= '<td><b>' . $result->meta_value . '</b></td>';
		$html .= '<td align="left" width="75px"><input type="submit" class="button" onclick = "generate_code(\'' . $i . '\',\'' . $result->meta_value . '\', \'' . get_bloginfo( 'url' ) . '\',\'' . $nonce . '\');" name="start" value="Get Code"/></td>';
		$html .= '</tr>';

		$i++;
	}

		$html .= '</table>';
		$html .= '<div id ="code_here"></div>';

	// escape safe.
	die( $html ); //phpcs:ignore
}
add_action( 'wp_ajax_rt_b2wr_get_config', 'rt_b2wr_get_config' );


/**
 *  Redirection Function (!important)
 */
function rt_blogger_to_wordpress_redirection() {
	$b2w = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
	$b2w = ( ! empty( $b2w ) ) ? $b2w : false;

	if ( $b2w ) {
		global $wpdb;

		$sql = "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} where meta_key = 'blogger_blog'";
		// unprepared sql ok.
		$results = $wpdb->get_results( $sql ); //phpcs:ignore 

		foreach ( $results as $result ) {
			$result->meta_value = substr( $result->meta_value, 0, strrpos( $result->meta_value, '.' ) );

			if ( strstr( $b2w, $result->meta_value ) !== false ) {
				$b2w_temp = explode( $result->meta_value, $b2w );
				$b2w      = substr( $b2w_temp[1], strpos( $b2w_temp[1], '/' ) );
				if ( strpos( $b2w, '?' ) > 0 ) {
					$b2w = strstr( $b2w, '?', true );
				}
			}

			$sqlstr = $wpdb->prepare(
				"SELECT wposts.ID, wposts.guid
				  FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
				  WHERE wposts.ID = wpostmeta.post_id
				  AND wpostmeta.meta_key = 'blogger_permalink'
				  AND wpostmeta.meta_value = %s",
				$b2w
			);
			// unprepared sql ok.
			$wpurl  = $wpdb->get_results( $sqlstr, ARRAY_N ); //phpcs:ignore

			if ( $wpurl ) {
				// wp redirect ok.
				wp_redirect( get_permalink( $wpurl[0][0] ) ); //phpcs:ignore
				exit;
			} else {
				wp_safe_redirect( home_url(), 301 );
				exit;
			}
		}
	}

}

add_action( 'init', 'rt_blogger_to_wordpress_redirection' );

/**
 *  Verify Configuration
 */
function rt_b2wr_verify_config() {
	global $wpdb;

	if ( ! isset( $_POST['config_nonce'] )
	|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['config_nonce'] ) ), 'generate_code_nonce' )
	) {
		return;
	}

	$domain_name = ( isset( $_POST['dname'] ) ) ? sanitize_text_field( wp_unslash( $_POST['dname'] ) ) : '';

	$sql = $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = 'blogger_blog' AND meta_value = %s ORDER BY rand() LIMIT 1", $domain_name );
	// unprepared sql ok.
	$rand_col     = $wpdb->get_results( $sql ); //phpcs:ignore
	$rand_post_id = $rand_col[0]->post_id;

	$sql1 = $wpdb->prepare( "SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE post_id = %d AND meta_key = 'blogger_permalink' ORDER BY rand() LIMIT 1", $rand_post_id );
	// unprepared sql ok.
	$rand_col2    = $wpdb->get_results( $sql1 ); //phpcs:ignore

	$blogger_url  = 'https://' . $domain_name . $rand_col2[0]->meta_value;
	$blogger_link = '<a href = "' . esc_url( $blogger_url ) . '" target = "_blank">' . $blogger_url . '</a> ';
	$local_url    = get_permalink( $rand_post_id );
	$local_link   = '<a href = "' . esc_url( $local_url ) . '" target = "_blank">' . $local_url . '</a> ';

	// escape safe.
	echo '<h3><u>Test Case</u></h3><pre>Clicking this link &raquo; <b>' . $blogger_link . '</b><br/>Should redirect to &raquo; <b>' . $local_link . '</b></pre>'; //phpcs:ignore 
	die( '<p><b>If you are stuck, you can use our <a href="https://bloggertowp.org/tutorials/blogger-to-wordpress-redirection-plugin/" target="_blank">free support forum</a> or <a href="https://rtcamp.com/contact/" target="_blank">hire us</a>.<br /><br />' );

}

add_action( 'wp_ajax_rt_b2wr_verify_config', 'rt_b2wr_verify_config' );

/**
 * Get Latest Feeds - Begin
 */
function rt_get_feeds_from_blogger_to_wp() {
	include_once ABSPATH . WPINC . '/feed.php';

	$rss = fetch_feed( 'https://bloggertowp.org/feed/' );

	if ( ! is_wp_error( $rss ) ) {
		$maxitems  = $rss->get_item_quantity( 5 );
		$rss_items = $rss->get_items( 0, $maxitems );
	}

	?>
	<ul>
	<?php

	if ( 0 === $maxitems ) {
		echo '<li>No items.</li>';
	} else {
		foreach ( $rss_items as $item ) {
			?>
			<li>
				<a href="<?php echo esc_url( $item->get_permalink() ); ?>" title="Posted <?php echo esc_attr( $item->get_date( 'j F Y | g:i a' ) ); ?>"><?php echo esc_html( $item->get_title() ); ?></a>
			</li>
			<?php
		}
	}
	?>
	</ul>
	<?php

}

/**
 * Update Notice - Begin
 */
function rt_blogger_to_wordpress_update_notice() {

	if ( ! get_option( 'rtb2wr206' ) || '' === get_option( 'rtb2wr206' ) ) {
		echo '<div id="b2wr_notice_block" class="error"><p>Due to recent updates on blogger.com, Blogger to WordPress Redirection plugin has been rewritten. The process has also changed completely. Please refer the updated instructions here: <a class="blue_color" href="https://bloggertowp.org/tutorials/blogger-to-wordpress-redirection-plugin/" target="_blank" title="Read more details about this update at Our Blog">(Read More…)</a><span><input type="button" id="hide_b2wr_notice_block" value="Hide this message!" class="button"></span></p></div>';
	}

}

/**
 * Hide Notice block
 */
function rt_b2wr_hide_notice_block() {

	update_option( 'rtb2wr206', 'done' );

}

add_action( 'wp_ajax_rt_b2wr_hide_notice_block', 'rt_b2wr_hide_notice_block' );
