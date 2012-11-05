<?php
/**
 * 		  File : Class.PTM_AJAXComments.php
 *     Version : 1.0.0
 * 		Author : Peter 'Toxane' Michael
 * 	Author URI : http://tacocode.com/
 *
 */

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You don\'t want to do this. Really.'); }

class PTM_AJAXComments
{
	function __construct()
	{
		$this->_checkVersion();
		add_action( 'init', array( $this, '_wpInit' ) );
	}
	
	function _wpInit()
	{
		load_plugin_textdomain( 'ptm-ajax-comments', false, PTM_AJAX_COMMENTS_PLUGINPATH . '/languages/' );
	}

	function _stripslashes_deep($value)
	{
		return is_array($value) ? array_map(array($this, '_stripslashes_deep'), $value) : stripslashes($value);
	}

	function _checkVersion()
	{
		$currentSettings = $this->_getSettings();
		
		if( !$currentSettings )
		{
			$this->_resetSettings();
			add_action('admin_notices', create_function('', 'echo \'<div id="message" class="updated fade"><p><b>' . __('PTM AJAX Comments : Initial settings have been loaded', 'ptm-ajax-comments') . '</b></p></div>\';'));
		}
		else
		{
			$installedVersion = $currentSettings['PTM_AJAX_COMMENTS_VERSION'];
			$thisVersion = PTM_AJAX_COMMENTS_VERSION;
			if( version_compare($installedVersion, $thisVersion, '<') )
			{
				$newSettings = $this->_defaultSettings();
				$newOptions = array_merge($newSettings, $currentSettings);
				$newOptions['PTM_AJAX_COMMENTS_VERSION'] = $thisVersion;
				update_option('ptm-ajax-comments-settings', $newOptions);
				add_action('admin_notices', create_function('', 'echo \'<div id="message" class="updated fade"><p><b>' . __('PTM AJAX Comments : Settings merged to new version', 'ptm-ajax-comments') . '</b></p></div>\';'));
			}
			elseif( version_compare($installedVersion, $thisVersion, '>') )
			{
				$newSettings = $this->_defaultSettings();
				$newOptions = array_merge($currentSettings, $newSettings);
				$newOptions['PTM_AJAX_COMMENTS_VERSION'] = $thisVersion;
				update_option('ptm-ajax-comments-settings', $newOptions);
				add_action('admin_notices', create_function('', 'echo \'<div id="message" class="updated fade"><p><b>' . __('PTM AJAX Comments : Settings downgraded to old version', 'ptm-ajax-comments') . '</b></p></div>\';'));
			}
		}
	}
	
	function _getSettings()
	{
		return get_option('ptm-ajax-comments-settings');
	}
		
	function _saveSettings()
	{
		$_POST = $this->_stripslashes_deep($_POST);
		$showForm = isset($_POST['showForm']) ? $_POST['showForm'] : '';
		$disableForm = $_POST['disableForm'];
		$compatContentPress = isset($_POST['compatContentPress']) ? $_POST['compatContentPress'] : '';
		$compatAntispamBee = isset($_POST['compatAntispamBee']) ? $_POST['compatAntispamBee'] : '';
		$activity_image = $this->_selectActivityImage($_POST['custom_activity_image'], $_POST['activity_image']);
		$activeColor = $_POST['activeColor'];
		$inactiveColor = $_POST['inactiveColor'];
		$css_style = $_POST['css_style'];
		$css_comment = $_POST['css_comment'];
		$css_commentform = $_POST['css_commentform'];
		$css_commentlist = $_POST['css_commentlist'];
		$css_respond = $_POST['css_respond'];
		$textNoComment = $_POST['textNoComment'];
		$textAddingComment = $_POST['textAddingComment'];
		$textCommentAdded = $_POST['textCommentAdded'];
		$callback_name = $_POST['callback_name'];
		$commentPosition = $_POST['commentPosition'];
		$js_dev_enabled = isset($_POST['js_dev_enabled']) ? $_POST['js_dev_enabled'] : 0;
		
		$settings = array
		(
			'PTM_AJAX_COMMENTS_VERSION' => PTM_AJAX_COMMENTS_VERSION,
			'showForm' => $showForm,
			'disableForm' => $disableForm,
			'compatContentPress' => $compatContentPress,
			'compatAntispamBee' => $compatAntispamBee,
			'activityImagePath' => $activity_image,
			'activeColor' => $activeColor,
			'inactiveColor' => $inactiveColor,
			'css_style' => $css_style,
			'css_comment' => $css_comment,
			'css_commentform' => $css_commentform,
			'css_commentlist' => $css_commentlist,
			'css_respond' => $css_respond,
			'textNoComment' => $textNoComment,
			'textAddingComment' => $textAddingComment,
			'textCommentAdded' => $textCommentAdded,
			'callback_name' => $callback_name,
			'commentPosition' => $commentPosition,
			'js_dev_enabled' => $js_dev_enabled
		);
		return update_option('ptm-ajax-comments-settings', $settings);
	}
	
	function _defaultSettings()
	{
		$settings_default = array
		(
			'PTM_AJAX_COMMENTS_VERSION' => PTM_AJAX_COMMENTS_VERSION,
			'showForm' => '',
			'disableForm' => 'checked',
			'compatContentPress' => '',
			'compatAntispamBee' => '',
			'activityImagePath' => PTM_AJAX_COMMENTS_PLUGINURL.'images/activity1.gif',
			'activeColor' => 'EEEEEE',
			'inactiveColor' => 'FFFFFF',
			'css_style' => '#ptm-ac-response{}'."\n".'.ptm-ac-success > span{color:green;}'."\n".'.ptm-ac-error > span{font-weight:bold;color:red;}'."\n".'#ptm-ac-loader{display:inline-block;}'."\n".'#ptm-ac-loader > img{margin-left:15px;}',
			'css_commentform' => 'commentform',
			'css_comment' => 'comment',
			'css_commentlist' => 'commentlist',
			'css_respond' => 'respond',
			'textNoComment' => 'Please write a comment',
			'textAddingComment' => 'Adding your comment, please wait...',
			'textCommentAdded' => 'Your comment has been added, thank you!',
			'callback_name' => '',
			'commentPosition' => 'bottom',
			'js_dev_enabled' => 0
		);
		return $settings_default;
	}
	
	function _resetSettings()
	{
		return update_option( 'ptm-ajax-comments-settings', $this->_defaultSettings() ) ;
	}
	
	function _selectActivityImage( $image_c, $image )
	{
		if ($image_c != '')
		{
			$activity_image = $image_c;
		}
		else
		{
			$activity_image = $image;
		}
		return $activity_image;
	}
		
	function doUninstall()
	{
		delete_option( 'ptm-ajax-comments-settings' );
	}

}

# Initiate the plugin
function PTM_AJAXComments_Init()
{
	global $ptm_ajax_comments;
	$ptm_ajax_comments = new PTM_AJAXComments();
}
add_action("init", "PTM_AJAXComments_Init");
?>