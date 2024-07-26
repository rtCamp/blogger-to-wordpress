<?php
/**
 * Plugin Name: Blogger To WordPress
 * Plugin URI: https://bloggertowp.org/tutorials/blogger-to-wordpress-redirection-plugin/
 * Description: This plugin is useful for setting up 1-to-1 mapping between Blogger.com blog posts and WordPress blog posts. This works nicely for blogs with old subdomain address (e.g. xyz.blogspot.com) which are moved to new custom domain (e.g. xyz.com)
 * Version: 2.3.1
 * Author: rtCamp
 * Author URI: https://rtcamp.com/
 * Requires at least: 3.2
 * Tested up to: 6.6
 * Text Domain: blogger-to-wordpress-redirection
 *
 * @package Blogger_To_WordPress
 */

define( 'RT_B2WR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'RT_B2WR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'RT_B2WR_BLOG_URL', get_bloginfo( 'url' ) );

/**
 * Add option to Tools Menu
 *
 * @return void
 */
function rt_blogger_to_wordpress_add_option(): void {

	add_management_page( __( 'Blogger To WordPress Redirection', 'blogger-to-wordpress-redirection' ), __( 'Blogger To WordPress Redirection', 'blogger-to-wordpress-redirection' ), 'manage_options', 'rt-blogger-to-wordpress-redirection', 'rt_blogger_to_wordpress_administrative_page' );

	wp_enqueue_script( 'rt-blogger-to-wordpress-redirection-js', ( RT_B2WR_PLUGIN_URL . 'js/b2w-redirection-ajax.js' ), array( 'jquery', 'postbox' ), filemtime( RT_B2WR_PLUGIN_DIR . 'js/b2w-redirection-ajax.js' ), true );

	// No need for version in external script.
	wp_enqueue_script( 'rt-twitter-widget-js', ( 'https://platform.twitter.com/widgets.js' ), '', '', true ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion

	wp_enqueue_style( 'rt-blogger-to-wordpress-redirection-css', ( RT_B2WR_PLUGIN_URL . 'css/b2w-redirection.css' ), array(), filemtime( RT_B2WR_PLUGIN_DIR . 'css/b2w-redirection.css' ) );

	$page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );

	if ( ! empty( $page ) && 'rt-blogger-to-wordpress-redirection' === $page ) {

		wp_enqueue_script( 'dashboard' );
		wp_enqueue_style( 'dashboard' );

	}
}

add_action( 'admin_menu', 'rt_blogger_to_wordpress_add_option' );

/**
 * Administrative Page - Begin
 *
 * @return void
 */
function rt_blogger_to_wordpress_administrative_page(): void {
	global $wpdb;

	// get all blogger domains, if avaliable.
	$sql = "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} where meta_key = 'blogger_blog'";

	// unprepared sql ok.
	$results = $wpdb->get_results( $sql ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.NoCaching

	require_once RT_B2WR_PLUGIN_DIR . 'templates/settings.php';
}

/**
 * Redirection Function (!important)
 *
 * @return void
 */
function rt_blogger_to_wordpress_redirection(): void {

	global $wpdb;

	$b2w = filter_input( INPUT_GET, 'b2w', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
	$b2w = ( ! empty( $b2w ) ) ? $b2w : false;

	if ( false === $b2w ) {
		return;
	}

	$sql = "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} where meta_key = 'blogger_blog'";

	// unprepared sql ok.
	$results = $wpdb->get_results( $sql ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.NoCaching

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
			"SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = 'blogger_permalink' AND meta_value = %s",
			$b2w
		);

		// unprepared sql ok.
		$wpurl = $wpdb->get_results( $sqlstr, ARRAY_N ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.NoCaching
		if ( ! empty( $wpurl ) ) {

			// wp redirect ok.
			wp_redirect( get_permalink( $wpurl[0][0] ) ); // phpcs:ignore WordPress.Security.SafeRedirect.wp_redirect_wp_redirect
			exit;
		}
	}
	wp_safe_redirect( home_url(), 301 );
	exit();
}

add_action( 'init', 'rt_blogger_to_wordpress_redirection' );

/**
 * Verify Configuration
 *
 * @return void
 */
function rt_b2wr_verify_config(): void {

	global $wpdb;

	if ( ! isset( $_POST['config_nonce'] )
	|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['config_nonce'] ) ), 'b2w_code_nonce' )
	) {
		return;
	}

	$domain_name = ( isset( $_POST['dname'] ) ) ? sanitize_text_field( wp_unslash( $_POST['dname'] ) ) : '';

	$sql = $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = 'blogger_blog' AND meta_value = %s ORDER BY rand() LIMIT 1", $domain_name );

	// unprepared sql ok.
	$rand_col     = $wpdb->get_results( $sql ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.NoCaching
	$rand_post_id = $rand_col[0]->post_id;

	$sql1 = $wpdb->prepare( "SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE post_id = %d AND meta_key = 'blogger_permalink' ORDER BY rand() LIMIT 1", $rand_post_id );

	// unprepared sql ok.
	$rand_col2 = $wpdb->get_results( $sql1 ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery.NoCaching

	$blogger_url = 'https://' . $domain_name . $rand_col2[0]->meta_value;
	$local_url   = get_permalink( $rand_post_id );

	echo wp_json_encode(
		array(
			'blogger_url' => esc_url( $blogger_url ),
			'local_url'   => esc_url( $local_url ),
		)
	);
	
	die();
}

add_action( 'wp_ajax_rt_b2wr_verify_config', 'rt_b2wr_verify_config' );

/**
 * Get Latest Feeds - Begin
 *
 * @return void
 */
function rt_get_feeds_from_blogger_to_wp(): void {

	require_once ABSPATH . WPINC . '/feed.php';

	$rss = fetch_feed( 'https://bloggertowp.org/feed/' );

	if ( ! is_wp_error( $rss ) ) {
		$maxitems  = $rss->get_item_quantity( 5 );
		$rss_items = $rss->get_items( 0, $maxitems );
	}

	require_once RT_B2WR_PLUGIN_DIR . 'templates/feeds.php';
}

/**
 * Update Notice - Begin
 *
 * @return void
 */
function rt_blogger_to_wordpress_update_notice(): void {

	if ( empty( get_option( 'rtb2wr206' ) ) ) {
		require_once RT_B2WR_PLUGIN_DIR . 'template/update-notice.php';
	}
}

/**
 * Hide Notice block
 *
 * @return void
 */
function rt_b2wr_hide_notice_block(): void {

	if ( ! isset( $_POST['update_nonce'] )
	|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['update_nonce'] ) ), 'b2w_update_nonce' )
	) {
		return;
	}

	update_option( 'rtb2wr206', 'done' );
}

add_action( 'wp_ajax_rt_b2wr_hide_notice_block', 'rt_b2wr_hide_notice_block' );
