<?php
/*
Plugin Name: Blogger To Wordpress Redirection
Plugin URI: http://bloggertowp.org/blogger-to-wordpress-redirection-plugin/
Description: This plugin is useful for setting up 1-to-1 mapping between Blogger.com blog posts and WordPress blog posts. This works nicely for blogs with old subdomain address (e.g. xyz.blogspot.com) which are moved to new custom domain (e.g. xyz.com)
Version: 2.0.2
Author: rtCamp
Author URI: http://bloggertowp.org
*/
?>
<?php
define('RT_B2WR_PLUGIN_URL', WP_PLUGIN_URL .'/'. basename(dirname(__FILE__)));

/* Add option to Tools Menu - Begin (RT) */
add_action('admin_menu', 'rt_Blogger_to_Wordpress_add_option');
function rt_Blogger_to_Wordpress_add_option() {
	add_management_page('Blogger To Wordpress Redirection', 'Blogger To WordPress Redirection', 8, 'rt-blogger-to-wordpress-redirection', 'rt_Blogger_to_Wordpress_Administrative_Page');
        wp_enqueue_script('rt-blogger-to-wordpress-redirection-js', (RT_B2WR_PLUGIN_URL .'/js/b2w-redirection-ajax.js'), array('jquery','postbox'), '', true );
	wp_enqueue_script('rt-fb-share', ('http://static.ak.fbcdn.net/connect.php/js/FB.Share'),'', '', true );
wp_enqueue_style('rt-blogger-to-wordpress-redirection-css', (RT_B2WR_PLUGIN_URL.'/css/b2w-redirection.css'));
if ($_GET['page'] == 'rt-blogger-to-wordpress-redirection'){ wp_enqueue_script('dashboard'); wp_enqueue_style('dashboard');}
}
/* Add option to Tools Menu - End (RT) */


/* Administrative Page - Begin (RT) */
function rt_Blogger_to_Wordpress_Administrative_Page() {
	?>
        <div class="wrap">
            <img id="btowp_img" alt="B2W-Redirection" src="<?php echo RT_B2WR_PLUGIN_URL; ?>/images/btowp_img.png" />
            <h2 id="btowp_h2"><?php _e('Blogger to Wordpress Redirection'); ?></h2>
            <p class="clear"></p>

            <div id="content_block" class="align_left">
                <p class="description">This plugin is useful for setting up 1-to-1 mapping between Blogger.com blog posts and WordPress blog posts. This works nicely for blogs with old subdomain address <code>(e.g. xyz.blogspot.com)</code> which are moved to new custom domain <code>(e.g. xyz.com)</code></p>
                <h3><u>Start Configuration</u></h3>
                <h4>Press "Start Configuration" button to generate code for Blogger.com blog</h4>
                <p>Plugin will automatically detect Blogger.com blog from where you have imported.</p>
                <input type="submit" class="button-primary" name="start" id ="start_config" value="Start Configuration" onclick="rt_start_config()" />
                <p id ="get_config" class="clear"></p>
            </div>


            <div id="ads_block" class="metabox-holder align_left">
                <div class="postbox-container">
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox" id="social">
                            <div title="Click to toggle" class="handlediv"><br></div>
                            <h3 class="hndle"><span><strong class="red">Getting Social is Good</strong></span></h3>
                            <div class="inside" style="text-align:center;">
                                <a href="http://www.facebook.com/BloggertoWordpress" target="_blank" title="Become a fan on Facebook"><img src="<?php echo RT_B2WR_PLUGIN_URL; ?>/images/facebook.png" alt="Twitter" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="http://twitter.com/bloggertowp" target="_blank" title="Follow us on Twitter"><img src="<?php echo RT_B2WR_PLUGIN_URL; ?>/images/twitter.png" alt="Facebook" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="http://feeds.feedburner.com/Blogger-to-Wordpress" target="_blank" title="Subscribe to our feeds"><img src="<?php echo RT_B2WR_PLUGIN_URL; ?>/images/rss.png" alt="RSS Feeds" /></a>
                            </div>
                        </div>

                        <div class="postbox" id="donations">
                            <div title="Click to toggle" class="handlediv"><br></div>
                            <h3 class="hndle"><span><strong class="red">Promote, Donate, Share...</strong></span></h3>
                            <div class="inside">
                                A lot of time and effort goes into the development of this plugin. If you find it useful, please consider making a donation, or a review on your blog or sharing this with your friends to help us.<br/><br/>
                                <div class="rt-paypal" style="text-align:center">
	                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	                                <input type="hidden" name="cmd" value="_donations">
	                                <input type="hidden" name="business" value="paypal@rtcamp.com">
	                                <input type="hidden" name="lc" value="US">
	                                <input type="hidden" name="item_name" value="Blogger To WordPress Migration">
	                                <input type="hidden" name="no_note" value="0">
	                                <input type="hidden" name="currency_code" value="USD">
	                                <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
	                                <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	                                <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
	                                </form>                                                                          
                                </div>
                                <div class="rt-social-share" style="text-align:center; width: 127px; margin: 2px auto">
	    		                	<div class="rt-facebook" style="float:left; margin-right:5px;">	
		                                <a style=" text-align:center;" name="fb_share" type="box_count" share_url="http://bloggertowp.org/blogger-to-wordpress-redirection-plugin/"></a>
	                            	</div>
	    		                	<div class="rt-twitter" style="">	
										<a href="http://twitter.com/share"  class="twitter-share-button" data-text="Blogger to WordPress Redirection Plugin"  data-url="http://bloggertowp.org/blogger-to-wordpress-redirection-plugin/" data-count="vertical" data-via="bloggertowp">Tweet</a> 
										<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
									</div>
									<div class="clear"></div>							
								</div>	
                            </div><!-- end of .inside -->
                        </div>

                        <div class="postbox" id="support">
                            <div title="Click to toggle" class="handlediv"><br></div>
                            <h3 class="hndle"><span><strong class="red">Free Support</strong></span></h3>
                            <div class="inside">
                            If you have any problems with this plugin or good ideas for improvements, please talk about them in the <a href="http://forum.bloggertowp.org/" target="_blank">Support forums</a>.
                            </div>
                        </div>

                        <div class="postbox" id="latest_news">
                            <div title="Click to toggle" class="handlediv"><br></div>
                            <h3 class="hndle"><span><strong class="red">Latest News from Our Blog</strong></span></h3>
                            <div class="inside">
                            <?php rt_Get_Feeds_From_Blogger2WP(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php
}
/* Administrative Page - End (RT) */


/* Get Configuration, called via AJAX - Begin (RT) */
add_action('wp_ajax_rt_b2wr_get_config', 'rt_b2wr_get_config');
function rt_b2wr_get_config(){
	global $wpdb;

	//get all blogger domains, if avaliable
	$sql = "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} where meta_key = 'blogger_blog'";
	$results = $wpdb->get_results($sql);
	
	if(!$results){
		$err_str = '<p id="error_msg">Sorry… No posts found that were imported from a Blogger.com blog</p>';
                $err_str .= '<strong><a href="'. get_bloginfo('url').'/wp-admin/admin.php?import=blogger">Import from Blogger.com</a></strong> first and then "Start Configuration"';

                echo $err_str;
		die();
	}

	$html = '<br/>';
        $html .= '<h3><u>List of Blogs</u></h3>';
	$html .= 'We found posts from following Blogger Blog(s) in your current WordPress installation. Click on <b>Get Code</b> button to generate the redirection code for the chosen Blogger blog<br /><br />';
        $html .= '<table width="350px">';
	$i=1;
	foreach($results as $result){
                $html .= '<tr>';
		$html .= '<td width="15px">'.$i.'</td>';
                $html .= '<td><b>'.$result->meta_value.'</b></td>';
                $html .= '<td align="left" width="75px"><input type="submit" class="button" onclick = "generate_code(\''.$i.'\',\''.$result->meta_value.'\', \''.get_bloginfo('url').'\');" name="start" value="Get Code"/></td>';
                $html .= '</tr>';
                $i++;
	}
        $html .= '</table>';
        $html .= '<div id ="code_here"></div>';
	die($html);
}
/* Get Configuration, called via AJAX - End (RT) */


/* Redirection Function (!important) - Begin (RT) */
add_action('init','rt_Blogger_To_Wordpress_Redirection');
function rt_Blogger_To_Wordpress_Redirection() {
	$b2w = (isset($_GET['b2w']))?$_GET['b2w']:false;

	if ($b2w) {
		global $wpdb;
		$sql = "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} where meta_key = 'blogger_blog'";
		$results = $wpdb->get_results($sql);

		foreach ($results as $result){
			if (strstr($b2w, $result->meta_value) !== false) {
				$b2w_temp = explode($result->meta_value, $b2w);
				$b2w = $b2w_temp[1];
			}

			$sqlstr = "SELECT wposts.ID, wposts.guid
				  FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
				  WHERE wposts.ID = wpostmeta.post_id
				  AND wpostmeta.meta_key = 'blogger_permalink'
				  AND wpostmeta.meta_value = '".$b2w."'";
			$wpurl = $wpdb->get_results($sqlstr, ARRAY_N);
			if ($wpurl){
				header( 'Location: '.get_permalink($wpurl[0][0]).' ') ;
				die();
			} else {
                            header("Status: 301 Moved Permanently");
                            header("Location:".home_url());
                        }
		}
	}
}
/* Redirection Function (!important) - End (RT) */


/* Verify Configuration - Begin (RT) */
add_action('wp_ajax_rt_b2wr_verify_config', 'rt_b2wr_verify_config');
function rt_b2wr_verify_config() {
	global $wpdb;
	$domain_name = $_POST['dname'];
	$sql = "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = 'blogger_blog' AND meta_value = '{$domain_name}' ORDER BY rand() LIMIT 1";

	$rand_col = $wpdb->get_results($sql);
	$rand_post_id = $rand_col[0]->post_id;
	$sql1 = "SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE post_id = {$rand_post_id} AND meta_key = 'blogger_permalink' ORDER BY rand() LIMIT 1";
	$rand_col2 = $wpdb->get_results($sql1);

	$blogger_url = 'http://'.$domain_name.$rand_col2[0]->meta_value;
	$blogger_link = '<a href = "'.$blogger_url.'" target = "_blank">'.$blogger_url.'</a> ';
	$local_url = get_permalink($rand_post_id);
	$local_link = '<a href = "'.$local_url.'" target = "_blank">'.$local_url.'</a> ';

	echo '<h3><u>Test Case</u></h3><pre>Clicking this link &raquo; <b>'.$blogger_link.'</b><br/>Should redirect to &raquo; <b>'.$local_link.'</b></pre>';
	die('<p><b>If you are stuck, you can use our <a href="http://forum.bloggertowp.org/" target="_blank">free support forum</a> or <a href="http://bloggertowp.org/contact/" target="_blank">hire us</a>.<br /><br />');
}
/* Verify Configuration - End (RT) */

/* Get Latest Feeds from bloggertowp.org - Begin (RT) */
function rt_Get_Feeds_From_Blogger2WP() {
	// Get RSS Feed(s)
	include_once(ABSPATH . WPINC . '/feed.php');

	// Get a SimplePie feed object from the specified feed source.
	$rss = fetch_feed('http://feeds.feedburner.com/Blogger-to-Wordpress');
	if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
	    // Figure out how many total items there are, but limit it to 5. 
	    $maxitems = $rss->get_item_quantity(5); 

	    // Build an array of all the items, starting with element 0 (first element).
	    $rss_items = $rss->get_items(0, $maxitems); 
	endif;
	?>

	<ul>
	    <?php if ($maxitems == 0) echo '<li>No items.</li>';
	    else
	    // Loop through each feed item and display each item as a hyperlink.
	    foreach ( $rss_items as $item ) : ?>
	    <li>
		<a href='<?php echo $item->get_permalink(); ?>'
		title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
		<?php echo $item->get_title(); ?></a>
	    </li>
	    <?php endforeach; ?>
	</ul>
	<?php
}
/* Get Latest Feeds from bloggertowp.org - End (RT) */
?>
