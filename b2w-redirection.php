<?php
/*
Plugin Name: Blogger To Wordpress
Plugin URI: http://rtcamp.com/tutorials/blogger-to-wordpress-redirection-plugin/
Description: This plugin is useful for setting up 1-to-1 mapping between Blogger.com blog posts and WordPress blog posts. This works nicely for blogs with old subdomain address (e.g. xyz.blogspot.com) which are moved to new custom domain (e.g. xyz.com)
Version: 2.1
Author: rtCamp
Author URI: http://rtcamp.com/
Requires at least: 3.0
Tested up to: 3.4.2
*/

define('RT_B2WR_PLUGIN_URL', WP_PLUGIN_URL .'/'. basename(dirname(__FILE__)));

/* Add option to Tools Menu */
function rt_Blogger_to_Wordpress_add_option() {
    add_management_page('Blogger To Wordpress Redirection', 'Blogger To WordPress Redirection', 'administrator', 'rt-blogger-to-wordpress-redirection', 'rt_Blogger_to_Wordpress_Administrative_Page');

    wp_enqueue_script('rt-blogger-to-wordpress-redirection-js', (RT_B2WR_PLUGIN_URL . '/js/b2w-redirection-ajax.js'), array('jquery', 'postbox'), '', true);
    wp_enqueue_script('rt-fb-share', ('http://static.ak.fbcdn.net/connect.php/js/FB.Share'), '', '', true);

    wp_enqueue_style('rt-blogger-to-wordpress-redirection-css', (RT_B2WR_PLUGIN_URL . '/css/b2w-redirection.css'));

    if (isset($_GET['page']) && $_GET['page'] == 'rt-blogger-to-wordpress-redirection') {
        wp_enqueue_script('dashboard');
        wp_enqueue_style('dashboard');
    }
}
add_action('admin_menu', 'rt_Blogger_to_Wordpress_add_option');

/* Administrative Page - Begin */
function rt_Blogger_to_Wordpress_Administrative_Page() {
    ?>
    <div class="wrap">
        <div>
            <img id="btowp_img" alt="B2W-Redirection" src="<?php echo RT_B2WR_PLUGIN_URL; ?>/images/btowp_img.png" />
            <h2 id="btowp_h2"><?php _e('Blogger to Wordpress Redirection'); ?></h2>
        </div>
        <div class="clear"></div>
        
        <div id="content_block" class="align_left">
            <p class="description">This plugin is useful for setting up 1-to-1 mapping between Blogger.com blog posts and WordPress blog posts. This works nicely for blogs with old subdomain address <code>(e.g. xyz.blogspot.com)</code> which are moved to new custom domain <code>(e.g. xyz.com)</code></p>
            <h3><u>Start Configuration</u></h3>
            <h4>Press "Start Configuration" button to generate code for Blogger.com blog</h4>
            <p>Plugin will automatically detect Blogger.com blog from where you have imported.</p>
            <input type="submit" class="button-primary" name="start" id ="start_config" value="Start Configuration" onclick="rt_start_config()" />
            <p id="get_config" class="clear"></p>
        </div>
    
        <div id="ads_block" class="metabox-holder align_left">
            <div class="postbox-container">
                <div class="meta-box-sortables ui-sortable">
                    <div class="postbox" id="social">
                        <div title="Click to toggle" class="handlediv"><br></div>
                        <h3 class="hndle"><span><strong>Getting Social is Good</strong></span></h3>
                        <div class="inside" style="text-align:center;">
                            <a href="http://www.facebook.com/rtCamp.solutions" target="_blank" title="Become a fan on Facebook"><img src="<?php echo RT_B2WR_PLUGIN_URL; ?>/images/facebook.png" alt="Twitter" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="http://twitter.com/rtcamp" target="_blank" title="Follow us on Twitter"><img src="<?php echo RT_B2WR_PLUGIN_URL; ?>/images/twitter.png" alt="Facebook" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="http://feeds.feedburner.com/rtcamp" target="_blank" title="Subscribe to our feeds"><img src="<?php echo RT_B2WR_PLUGIN_URL; ?>/images/rss.png" alt="RSS Feeds" /></a>
                        </div>
                    </div>

                    <div class="postbox" id="joinfb">
                        <div title="Click to toggle" class="handlediv"><br></div>
                        <h3 class="hndle"><span><strong>Join Us on Facebook</strong></span></h3>
                        <div class="inside" style="text-align:center;">
                            <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FrtCamp.solutions&amp;width=242&amp;height=182&amp;connections=4&amp;stream=false&amp;header=false" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:242px; height:182px"></iframe> 
                        </div>
                    </div>

                    <div class="postbox" id="donations">
                        <div title="Click to toggle" class="handlediv"><br></div>
                        <h3 class="hndle"><span><strong>Promote, Donate, Share...</strong></span></h3>
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
                                    <a style=" text-align:center;" name="fb_share" type="box_count" share_url="http://rtcamp.com/tutorials/blogger-to-wordpress-redirection-plugin/"></a>
                                </div>
                                <div class="rt-twitter" style="">	
                                    <a href="http://twitter.com/share"  class="twitter-share-button" data-text="Blogger to WordPress Redirection Plugin"  data-url="http://rtcamp.com/tutorials/blogger-to-wordpress-redirection-plugin/" data-count="vertical" data-via="bloggertowp">Tweet</a> 
                                    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                                </div>
                                <div class="clear"></div>							
                            </div>	
                        </div><!-- end of .inside -->
                    </div>

                    <div class="postbox" id="support">
                        <div title="Click to toggle" class="handlediv"><br></div>
                        <h3 class="hndle"><span><strong>Free Support</strong></span></h3>
                        <div class="inside">
                            If you have any problems with this plugin or good ideas for improvements, please talk about them in the <a href="http://rtcamp.com/support/forum/blogger-to-wordpress/" target="_blank" title="Blogger to WordPress Support Forum">support forums</a>.
                        </div>
                    </div>

                    <div class="postbox" id="latest_news">
                        <div title="Click to toggle" class="handlediv"><br></div>
                        <h3 class="hndle"><span><strong>Latest News from Our Blog</strong></span></h3>
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

/* Get Configuration, called via AJAX */
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
add_action('wp_ajax_rt_b2wr_get_config', 'rt_b2wr_get_config');


/* Redirection Function (!important) */
function rt_Blogger_To_Wordpress_Redirection() {
	$b2w = (isset($_GET['b2w']))?$_GET['b2w']:false;

	if ($b2w) {
		global $wpdb;
		$sql = "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} where meta_key = 'blogger_blog'";
		$results = $wpdb->get_results($sql);

		foreach ($results as $result){
			$result->meta_value = substr($result->meta_value, 0, strrpos($result->meta_value,'.'));
                        if (strstr($b2w, $result->meta_value) !== false) {
				$b2w_temp = explode($result->meta_value, $b2w);
				$b2w = substr($b2w_temp[1], strpos($b2w_temp[1], '/'));
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
add_action('init','rt_Blogger_To_Wordpress_Redirection');

/* Verify Configuration */
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
	die('<p><b>If you are stuck, you can use our <a href="http://rtcamp.com/support/forum/blogger-to-wordpress/" target="_blank">free support forum</a> or <a href="http://rtcamp.com/contact/" target="_blank">hire us</a>.<br /><br />');
}
add_action('wp_ajax_rt_b2wr_verify_config', 'rt_b2wr_verify_config');

/* Get Latest Feeds - Begin */
function rt_Get_Feeds_From_Blogger2WP() {
    include_once(ABSPATH . WPINC . '/feed.php');
    $rss = fetch_feed('http://rtcamp.com/tag/blogger-to-wordpress/feed');

    if (!is_wp_error($rss)) {
        $maxitems = $rss->get_item_quantity(5);
        $rss_items = $rss->get_items(0, $maxitems);
    }
    ?>
    <ul>
    <?php
    if ($maxitems == 0) {
        echo '<li>No items.</li>';
    } else {
        foreach ($rss_items as $item) { ?>
            <li>
                <a href="<?php echo $item->get_permalink(); ?>" title="Posted <?php echo $item->get_date('j F Y | g:i a'); ?>"><?php echo $item->get_title(); ?></a>
            </li><?php
        }    
    } ?>
    </ul>
    <?php
}

/* Update Notice - Begin */
function rt_Blogger_to_Wordpress_Update_Notice() {
    if (!get_option('rtb2wr206') || get_option('rtb2wr206') == '') {
        echo '<div id="b2wr_notice_block" class="error"><p>Due to recent updates on blogger.com, Blogger to WordPress Redirection plugin has been rewritten. The process has also changed completely. Please refer the updated instructions here: <a class="blue_color" href="http://rtcamp.com/tutorials/blogger-to-wordpress-redirection-plugin/" target="_blank" title="Read more details about this update at Our Blog">(Read More…)</a><span><input type="button" id="hide_b2wr_notice_block" value="Hide this message!" class="button"></span></p></div>';
    }
}
add_action('admin_notices', 'rt_Blogger_to_Wordpress_Update_Notice', 5);

function rt_b2wr_hide_notice_block() {
    update_option('rtb2wr206', 'done');
}
add_action('wp_ajax_rt_b2wr_hide_notice_block', 'rt_b2wr_hide_notice_block');
?>
