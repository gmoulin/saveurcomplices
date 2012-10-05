<?php
/*
Plugin Name: PTM AJAX Comments
Plugin URI: https://github.com/pmichael/ptm-ajax-comments
Description: AJAX enabled comments, no more page reloads
Author: Peter Michael
Author URI: http://petermichael.me
Version: 1.0.4
License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
Text Domain: ptm-ajax-comments

WordPress plugin PTM AJAX Comments - AJAX enabled commenting based on the jQuery framework.
Copyright (C) 2010 Peter Michael

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/ 

if(!empty($_SERVER['SCRIPT_FILENAME']) && 'ptm-ajax-comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
	die ('The thing\'s hollow — it goes on forever — and — oh my God — it\'s full of stars!');
}

# ABSPATH returns the root path
# Replace backslashes with slashes, Win/XAMPP compatibility
$ptm_ajax_comments_abspath = str_replace("\\","/",ABSPATH );

# Define constants
define( 'PTM_AJAX_COMMENTS_VERSION', '1.0.4' );
define( 'PTM_AJAX_COMMENTS_ABSPATH', $ptm_ajax_comments_abspath );
define( 'PTM_AJAX_COMMENTS_PLUGINPATH', str_replace("\\","/",dirname( __FILE__)) );
define( 'PTM_AJAX_COMMENTS_PLUGINURL', WP_PLUGIN_URL.'/'.str_replace( basename( __FILE__), "", plugin_basename(__FILE__) ) );

# Instantiate our base class
require_once( dirname(__FILE__) . '/lib/Class.PTM_AJAXComments.php' );

# Cleanup our stuff when plugin is deactivated
register_deactivation_hook( __FILE__, array( &$ptm_ajax_comments, 'doUninstall' ) );

# Add settings to admin
if (is_admin())
{
	require_once( dirname(__FILE__) . '/lib/Class.PTM_AJAXCommentsAdmin.php' );
}

# Instantiate our front end class
if (!is_admin())
{
	require_once( dirname(__FILE__) . '/lib/Class.PTM_AJAXCommentsFront.php' );
}
?>