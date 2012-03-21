function rt_start_config(){ 
	if(jQuery('#get_config').html()!=''){ jQuery('#get_config').html(''); }

	jQuery.ajax({
		url:'admin-ajax.php',
		type: 'POST',
		data: 'action=rt_b2wr_get_config',
		success: function(result){
			jQuery('#get_config').append(result);
		}
	});
}

function generate_code(num, domain_name, curr_domain){
	jQuery('#re_code').remove();
	jQuery('#code_here').html('<br/><h3><u>Generated Code</u></h3><div id ="re_code"><strong>Redirection code for <a href="http://'+domain_name+ '">'+domain_name+ '</a></strong><br/>\n\
        Copy template code generated below and paste them in your Blogger.com template. (<a href="http://bloggertowp.org/blogger-to-wordpress-redirection-plugin/" target="_blank">How to do this?</a>)<br/>\n\
        <span class="description">(<strong>Important:</strong> Do NOT forget to take a backup of old template code.)</span>\n\
        <p><textarea onclick="this.select()" cols="55" rows="12">\n\
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\n\
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="<$BlogLanguageDirection$>">\n\
<head>\n\
<title><$BlogPageTitle$></title>\n\
<script type="text/javascript">\n\
<!--\n\
	<MainOrArchivePage>window.location.replace("'+curr_domain+'/");</MainOrArchivePage>\n\
	<Blogger><ItemPage>window.location.replace("'+curr_domain+'/?b2w=<$BlogItemPermalinkURL$>");<\/ItemPage><\/Blogger>\n\
-->\n\
<\/script>\n\
<MainPage><link rel="canonical" href="'+ curr_domain +'/" /><meta http-equiv="refresh" content="0;url='+ curr_domain +'/" ></MainPage>\n\
<Blogger><ItemPage><link rel="canonical" href="'+ curr_domain +'/?b2w=<$BlogItemPermalinkURL$>" /><meta http-equiv="refresh" content="0;url='+ curr_domain +'/?b2w=<$BlogItemPermalinkURL$>" ></ItemPage></Blogger>\n\
</head>\n\
<body>\n\
<div style="text-align:center">\n\
<h1>This Page</h1>\n\
<p>has been moved to new address</p>\n\
<MainOrArchivePage><a href="'+ curr_domain +'/"><$BlogTitle$></a></MainOrArchivePage>\n\
<Blogger><ItemPage><a href="'+ curr_domain +'/?b2w=<$BlogItemPermalinkURL$>"><$BlogItemTitle$></a>\n\
</ItemPage></Blogger>\n\
<p>Sorry for inconvenience... </p>\n\
Redirection provided by <a href="http://bloggertowp.org/" title="Blogger to WordPress Migration Service">Blogger to WordPress Migration Service</a>\n\
</div>\n\
</body>\n\
</html></textarea></p>\n\
	After the redirection setup press <b>"Verify Configuration"</b> button below to test your configuration. <br />When you press the button it will generate a random link for a post on <b>'+ domain_name +'</b><div class="submit" style="padding-bottom: 0.5em !important"><input type="submit" class="button-primary" onclick = "check_configuration(\''+domain_name+'\')" name="start" id ="check_config" value="Verify Configuration"/><br /></div><div id ="verify_config"></div>');
}

function check_configuration(domain_name){
	if(jQuery('#verify_config').html()!=''){ jQuery('#verify_config').html(''); }
	jQuery.ajax({
		url:'admin-ajax.php',
		type: 'POST',
		data: 'action=rt_b2wr_verify_config&dname='+domain_name,
		success: function(result){
			jQuery('#verify_config').append(result);
		}
	});
}
