<?php
/*
Plugin Name: Blogger To Wordpress Redirection
Plugin URI: http://www.devilsworkshop.org/blogger-to-wordpress-traffic-permalinks-redirection-plugin/
Description: If you have imported your blog from blogspot then you might be redirecting visitors from your old blogspot blog to your new wordpress blogs HOMEPAGE. This plugin detect all such redirections and find one-to-one mapping between blogspot post and wordpress post. Then it redirect users to the same post on new wordpress blog for which they actually came looking for!
Version: 1.1.3
Author: rahul286, rtcamp
Author URI: http://www.bloggertowp.org
*/
?>
<?php
function rbBloggerToWordpress(){
/*
IMPORTANT: Replace rb286.blogspot.com with your blogspot blogs address
DO NOT remove quotes i.e " and "
*/

$oldBlogURL = "rb286.blogspot.com";
global $wpdb;
//echo $oldBlogURL;
//following is to avoid infinite redirection problem
if( strcmp( $_SERVER['REQUEST_URI'] , "/" ) == 0 ){
   //We are on Home Page
	$ref = $_SERVER['HTTP_REFERER'];
	$refarr = explode("/", $ref);

	if ($refarr[2] == $oldBlogURL ){
		$bloggerurl = '\/'.$refarr[3].'\/'.$refarr[4].'\/'.$refarr[5];
		$sqlstr = "
			    SELECT wposts.guid
			    FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
			    WHERE wposts.ID = wpostmeta.post_id
			    AND wpostmeta.meta_key = 'blogger_permalink'
			    AND wpostmeta.meta_value = '".$bloggerurl."'
			 ";
		$wpurl = $wpdb->get_results($sqlstr, ARRAY_N);
		if ($wpurl){
			header( 'Location: '.$wpurl[0][0].' ') ;
                        exit;
		}
	}
  }
}
?>
<?php
	add_action('init','rbBloggerToWordpress', '1');
?>