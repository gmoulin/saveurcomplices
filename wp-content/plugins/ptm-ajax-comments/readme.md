# PTM AJAX Comments

	Contributors: swisswp, pmichael
	Tags: jquery, ajax, comments
	Requires at least: 3.0.1
	Tested up to: 3.3.1
	Stable tag: trunk

This plugin will enable AJAX commenting in your WordPress blog.

## Description

AJAX enabled commenting based on the jQuery framework. This plugin will hook into the comments form and posts the user comment the AJAX way without reloading the whole page.

## Installation

 1. Unzip the downloaded file 'ptm-ajax-comments.zip'
 2. Upload the unzipped folder 'ptm-ajax-comments' and its contents into your wp-content/plugins directory
 3. Activate the plugin on the Plugins page
 4. Open the settings page at Comments -> AJAX Comments to set the default options (initial options are set automatic) or further customize the look & feel of the plugin.

## Frequently Asked Questions

**Note**: the following is a little outdated stuff.

**I've tried everything, the plugin does not work**

Try the plugin with the default 'twentyten' theme. If it works, your theme is missing one or more of the following tags:

	<ol class="**commentlist**">
	<h3 id="**respond**">
	<div id="**respond**">
	<form action="wp-comments-post.php" method="post" id="**commentform**">
	<textarea name="comment" id="**comment**" title="Your comment" title="Please enter a comment">

**Note**: pay attention to the id & class names. Also make sure that you set the [callback function name](http://codex.wordpress.org/Function_Reference/wp_list_comments#Comments_Only_With_A_Custom_Comment_Display "callback function name") if used by your theme.

**I've tried to run the plugin with the 'twentyten' theme, still no luck**

Do you have other plugins activated? Try to deactivate another plugin, and run the test again. If my plugin works after deactivating a certain plugin,
you have just found an incompatability between my plugin and the one you deactivated. Please [inform me about this](https://github.com/pmichael/ptm-ajax-comments/issues), thanks!

**Tried with the 'twentyten' theme and deactivated all other plugins. Still doesn't work.**

Please [open a new thread](http://wordpress.org/tags/ptm-ajax-comments?forum_id=10) in the support forums and include a link to your website on which the plugin is not working.
Please leave the plugin activated. I will have a look at your site and will let you know about the next steps.

If you are absolutely certain that you found a bug, [please report it here](https://github.com/pmichael/ptm-ajax-comments/issues).

**Where can I get more information?**

Please visit [the official website](https://github.com/pmichael/ptm-ajax-comments) for the latest information on this plugin.

## Known Issues

* So far no known issues

## Changelog

**Version 1.0.4 - April 4, 2012**

 * Fixed depth level CSS bug for threaded comments
 * Removed reply link when current depth = thread_comments_depth
 * Special thanks to [fusse](http://wordpress.org/support/profile/fusse)

**Version 1.0.3 - October 28, 2011**

 * Small bug fixes
 * Added developer option to admin

**Version 1.0.2 - April 11, 2011**

 * Fixed Authors & outdated links

**Version 1.0.1 - December 23, 2010**

 * Updated README
 * Fixed settings update bug when upgrading plugin
 * Admin: edited notice messages
 * Admin: fixed unclosed DIV
 * Admin: prevent frontend class from load while in /wp-admin
 * Admin: added missing CSS
 * Admin: added 'Support' tab

**Version 1.0.0 - December 14, 2010**

 * Initial release
