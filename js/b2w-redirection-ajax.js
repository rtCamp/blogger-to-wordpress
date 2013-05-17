function rt_start_config(){ 
    if(jQuery('#get_config').html()!=''){
        jQuery('#get_config').html('');
    }

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
        Copy template code generated below and paste them in your Blogger.com template. (<a href="http://rtcamp.com/tutorials/blogger-to-wordpress-redirection-plugin/" target="_blank">How to do this?</a>)<br/>\n\
        <span class="description">(<strong>Important:</strong> Do NOT forget to take a backup of old template code.)</span>\n\
        <p><textarea onclick="this.select()" cols="55" rows="12">\n\
<?xml version="1.0" encoding="UTF-8" ?>\n\
<!DOCTYPE HTML>\n\
<html b:render=\'false\' b:version=\'2\' class=\'v2\' expr:dir=\'data:blog.languageDirection\' xmlns=\'http://www.w3.org/1999/xhtml\' xmlns:b=\'http://www.google.com/2005/gml/b\' xmlns:data=\'http://www.google.com/2005/gml/data\' xmlns:expr=\'http://www.google.com/2005/gml/expr\'>\n\
<head>\n\
<b:include data=\'blog\' name=\'all-head-content\'/>\n\
<title><data:blog.pageTitle&#47;></title>\n\
<b:if cond=\'data:blog.pageType == &quot;item&quot;\'>\n\
<link expr:href=\'&quot;'+curr_domain+'?b2w=&quot;+data:blog.url\' rel=\'canonical\'/>\n\
<meta expr:content=\'&quot;0;url='+curr_domain+'?b2w=&quot;+data:blog.url\' http-equiv=\'refresh\'/>\n\
<b:else/>\n\
<link href=\''+curr_domain+'\' rel=\'canonical\'/>\n\
<meta content=\'0;url='+curr_domain+'\' http-equiv=\'refresh\'/>\n\
</b:if>\n\
<b:skin>\n\
<![CDATA[/*-----------------------------------------------\n\
Blogger Template Style\n\
Name: B2W\n\
----------------------------------------------- */\n\
]]>\n\
</b:skin>\n\
</head>\n\
<body>\n\
<b:section class=\'main\' id=\'main\' showaddelement=\'no\'>\n\
<b:widget id=\'Blog1\' locked=\'false\' title=\'Blog Posts\' type=\'Blog\'/>\n\
</b:section>\n\
<b:if cond=\'data:blog.pageType == &quot;item&quot;\'>\n\
<script type="text/javascript">\n\
window.location.replace(&quot;'+curr_domain+'/?b2w=&quot;+encodeURI(window.location.protocol + "//" + window.location.host+window.location.pathname));\n\
</script>\n\
<b:else/>\n\
<script type="text/javascript">\n\
window.location.replace(&quot;'+curr_domain+'&quot;+window.location.pathname);\n\
</script>\n\
</b:if>\n\
<div style=\'margin: 0 auto;text-align:center;\'> <h1>This Page</h1>\n\
<p>has moved to a new address:</p>\n\
<b:if cond=\'data:blog.pageType == &quot;item&quot;\'>\n\
<a expr:href=\'&quot;'+curr_domain+'?b2w=&quot;+data:blog.url\'><data:blog.pageTitle&#47;></a>\n\
<b:else/>\n\
<a href=\''+curr_domain+'\'>'+curr_domain+'</a>\n\
</b:if>\n\
<p>Sorry for the inconvenience&hellip; </p>\n\
Redirection provided by <a href="http://rtcamp.com/" title="Blogger to WordPress Migration Service">Blogger to WordPress Migration Service</a></div>\n\
</body>\n\
</html>\
</textarea></p>\n\
	After the redirection setup press <b>"Verify Configuration"</b> button below to test your configuration. <br />When you press the button it will generate a random link for a post on <b>'+ domain_name +'</b><div class="submit" style="padding-bottom: 0.5em !important"><input type="submit" class="button-primary" onclick = "check_configuration(\''+domain_name+'\')" name="start" id ="check_config" value="Verify Configuration"/><br /></div><div id ="verify_config"></div>');
}

function check_configuration(domain_name){
    if(jQuery('#verify_config').html()!=''){
        jQuery('#verify_config').html('');
    }
    jQuery.ajax({
        url:'admin-ajax.php',
        type: 'POST',
        data: 'action=rt_b2wr_verify_config&dname='+domain_name,
        success: function(result){
            jQuery('#verify_config').append(result);
        }
    });
}

jQuery('#hide_b2wr_notice_block').click(function() {
    jQuery.ajax({
        url:'admin-ajax.php',
        type: 'POST',
        data: 'action=rt_b2wr_hide_notice_block',
        success: function(result){
            jQuery('#b2wr_notice_block').slideUp('slow','linear');
        }
    });
});
