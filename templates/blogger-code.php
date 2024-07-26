<?php
/**
 * Blogger code template file
 *
 * @package Blogger_To_WordPress
 */

?>

<br/>

<h3>
	<u><?php esc_html_e( 'Generated Code', 'blogger-to-wordpress-redirection' ); ?></u>
</h3>

<strong><?php esc_html_e( 'Redirection code for', 'blogger-to-wordpress-redirection' ); ?> <a id="redirection-domain-name-1" href=""></a></strong>

<br/>

<?php esc_html_e( 'Copy template code generated below and paste them in your Blogger.com template.', 'blogger-to-wordpress-redirection' ); ?> (<a href="https://bloggertowp.org/tutorials/blogger-to-wordpress-redirection-plugin/" target="_blank"><?php esc_html_e( 'How to do this?', 'blogger-to-wordpress-redirection' ); ?></a>)<br/>

<span class="description">
	(<strong><?php esc_html_e( 'Important:', 'blogger-to-wordpress-redirection' ); ?></strong><?php esc_html_e( 'Do NOT forget to take a backup of old template code.', 'blogger-to-wordpress-redirection' ); ?>)
</span>

<p>

	<textarea id="blogger-code-textarea" onclick="this.select()" cols="55" rows="12">
		<!DOCTYPE HTML>

		<html b:render='false' b:version='2' class='v2' expr:dir='data:blog.languageDirection' xmlns='http://www.w3.org/1999/xhtml' xmlns:b='http://www.google.com/2005/gml/b' xmlns:data='http://www.google.com/2005/gml/data' xmlns:expr='http://www.google.com/2005/gml/expr'>

		<head>

		<b:include data='blog' name='all-head-content'/>

		<title><data:blog.pageTitle&#47;></title>

		<b:if cond='data:blog.pageType == &quot;item&quot;'>

		<link expr:href='&quot;{{curr_domain}}?b2w=&quot;+data:blog.url' rel='canonical'/>

		<meta expr:content='&quot;0;url={{curr_domain}}?b2w=&quot;+data:blog.url' http-equiv='refresh'/>

		<b:else/>

		<link href='{{curr_domain}}' rel='canonical'/>

		<meta content='0;url={{curr_domain}}' http-equiv='refresh'/>

		</b:if>

		<b:skin>

		<![CDATA[/*-----------------------------------------------

		Blogger Template Style

		Name: B2W

		----------------------------------------------- */

		]]>

		</b:skin>

		</head>

		<body>

		<b:section class='main' id='main' showaddelement='no'>

		<b:widget id='Blog1' locked='false' title='Blog Posts' type='Blog'/>

		</b:section>

		<b:if cond='data:blog.pageType == &quot;item&quot;'>

		<script type="text/javascript">

		window.location.replace(&quot;{{curr_domain}}/?b2w=&quot;+encodeURI(window.location.protocol + "//" + window.location.host+window.location.pathname));

		</script>

		<b:else/>

		<script type="text/javascript">

		window.location.replace(&quot;{{curr_domain}}&quot;+window.location.pathname);

		</script>

		</b:if>

		<div style='margin: 0 auto;text-align:center;'> <h1>This Page</h1>

		<p>has moved to a new address:</p>

		<b:if cond='data:blog.pageType == &quot;item&quot;'>

		<a expr:href='&quot;{{curr_domain}}?b2w=&quot;+data:blog.url'> <data:blog.pageTitle&#47;> </a>

		<b:else/>

		<a href='{{curr_domain}}'>{{curr_domain}}</a>

		</b:if>

		<p>Sorry for the inconvenience&hellip; </p>

		Redirection provided by <a href="http://rtcamp.com/" title="Blogger to WordPress Migration Service">Blogger to WordPress Migration Service</a></div>

		</body>

		</html>
	</textarea>

</p>

<?php esc_html_e( 'After the redirection setup press', 'blogger-to-wordpress-redirection' ); ?> <b><?php esc_html_e( 'Verify Configuration', 'blogger-to-wordpress-redirection' ); ?></b> <?php esc_html_e( 'button below to test your configuration.', 'blogger-to-wordpress-redirection' ); ?> <br /><?php esc_html_e( 'When you press the button it will generate a random link for a post on', 'blogger-to-wordpress-redirection' ); ?> <b id="redirection-domain-name-2"></b>

<div class="submit" style="padding-bottom: 0.5em !important">

	<input type="submit" class="button-primary" onclick = "" name="start" id ="check_config" value="<?php esc_attr_e( 'Verify Configuration', 'blogger-to-wordpress-redirection' ); ?>"/><br />

</div>

<div id ="verify_config" hidden>
	<?php 
		require_once RT_B2WR_PLUGIN_DIR . 'templates/verify-config.php';
	?>
</div>
