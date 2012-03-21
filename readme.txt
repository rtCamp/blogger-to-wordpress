=== Plugin Name ===
Contributors: rahul286, rtcamp 
Plugin Name: Blogger To Wordpress Redirection
Tags: Wordpress, Blogger, Traffic, Redirection, Blogspot, Permalink, SEO
Requires at least: 2.0.2
Tested up to: 3.0.1
Stable tag: 1.1.3

This plugin manages 1-2-1 mapping between old blogspot blog and this Wordpress blog transparently.

== Description ==

If you have imported your blog from blogger (blogspot.com) then you might be redirecting visitors from your old blogspot blog to your new wordpress blogs HOMEPAGE. While this approach ensures you get all the traffic redirected from your old blog to new blog, a visitor may feel lost! What if a person is referred to your old blog via search engine or other link listings?

So this plugin just takes care of this part. It checks for which post people were looking on old blog and then redirect them to same post but on new blog! All this is so  transparent that a visitor will never get confused!

DO NOT forget to read Installation section. Its simple but slightly different.

If you stuck somewhere you can [visit plugin homepage](http://www.devilsworkshop.org/blogger-to-wordpress-traffic-permalinks-redirection-plugin/) to leave comment or buzz me! :-)

OR you can simply go for our [Blogger to WordPress Migration Service](http://bloggertowp.org/)

Special Thanks to [Charles](http://charles.gagalac.us/). He helped me a lot while debugging code on #wordpress IRC channel.


== Installation ==

**This plugin assumes following things:**

* You used wordpress blog importer while importing your blogspot beta blog.
* You put javascript or static link on your old blog to redirect visitors to your new blog. META tag redirect may not work.
* You have imported only one blog. In next version I will remove this restriction.

**Finally Installation:**

1. Download & Unzip this plugin - `rbBloggerToWordpress.zip`. 
1. It will contain a file - `rbBloggerToWordpress.php`. Open it in any text editor.
1. Put your old blogspot blog address next to '$oldBlogURL' variable! OR search for 'rb286.blogspot.com' and replace it with your blogspot address.
1. Save changes to `rbBloggerToWordpress.php` and upload it to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Thats All! All traffic will start redirecting automatically!

**Extra Note:**

* In case you are interested in redirection code I used on my old blog, its [here](http://pub.rtcamp.net/redirect.txt)! Trust me its one of the best! :-)


In case you need more help, [visit plugin homepage](http://www.devilsworkshop.org/blogger-to-wordpress-traffic-permalinks-redirection-plugin/)!


== Frequently Asked Questions ==
= Known Issue =
The plugin have some conflict with Windows Live Writer. But there is temporory work around posted [here](http://www.devilsworkshop.org/blogger-to-wordpress-traffic-permalinks-redirection-plugin/)
 
= Changelog =
-v 1.2
* Removed some whitespace to fix error : "Cannot modify header information - headers already sent by"

-v 1.1

* A bug earlier prevented this plugin to work for wordpress blogs in subdirectories like http://www.anilwadghule.com/blog

* Added priority value to fix header already sent error message. Hope this will work now.

== Screenshots ==

1. Above screenshot shows the difference in traffic movement redirection after this plugin has been installed.