<?php
// 		  File : if-ajax-comments-admin.php
// Description : iF AJAX Comments for Wordpress - Settings Page
//     Version : 1.6
// 		Author : Peter 'Toxane' Michael
// 	Author URI : http://www.flowdrops.com

if(!empty($_SERVER['SCRIPT_FILENAME']) && 'if-ajax-comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
{
	die ('The thing\'s hollow — it goes on forever — and — oh my God — it\'s full of stars!');
}

class PTM_AJAXCommentsAdmin extends PTM_AJAXComments
{
	function __construct()
	{
		# Add a settings link to our plugin on the plugins page
		add_filter('plugin_action_links', array($this, '_addSettingsLink'), 10, 2);
		# Add our settings page to the wp admin
		add_action('admin_menu', array($this, '_addAdminPage'), 10);
		# Add our JS & CSS to the header
		$this->_adminHead();
		# Save settings & show a message
		if($_POST && isset($_POST['reqAction']) && $_POST['reqAction'] == 'saveSettings')
		{
			$this->_saveSettings();
			add_action('admin_notices', create_function('', 'echo \'<div id="message" class="updated fade"><p><b>' . __('PTM AJAX Comments : Settings saved', 'ptm-ajax-comments') . '</b></p></div>\';'));
		}
		# Reset settings & show a message
		if($_POST && isset($_POST['reqAction']) && $_POST['reqAction'] == 'resetSettings')
		{
			$this->_resetSettings();
			add_action('admin_notices', create_function('', 'echo \'<div id="message" class="updated fade"><p><b>' . __('PTM AJAX Comments : Default settings loaded', 'ptm-ajax-comments') . '</b></p></div>\';'));
		}
	}
	
	function _addAdminPage()
	{
		add_comments_page( 'PTM AJAX Comments', 'AJAX Comments', 'administrator', 'ptm-ajax-comments', array( $this, '_displayAdminPage' ) );
	}
	
	function _addSettingsLink( $links, $file )
	{
		static $this_plugin;
		if ( ! $this_plugin )
		{
			$this_plugin = 'ptm-ajax-comments/ptm-ajax-comments.php';
		}
		if ( $file == $this_plugin )
		{
			$settings_link = '<a href="edit-comments.php?page=ptm-ajax-comments">' . __('Settings', 'ptm-ajax-comments') . '</a>';
			array_unshift( $links, $settings_link );
		}
		return $links;
	}
	
	function _adminHead()
	{
		wp_enqueue_style( 'ptm-ajax-comments-admin', PTM_AJAX_COMMENTS_PLUGINURL.'css/ptm-ajax-comments-admin.css', '', '1.0.0', 'screen, projection' );
		wp_enqueue_script('ptm-ajax-comments-admin', PTM_AJAX_COMMENTS_PLUGINURL.'js/ptm-ajax-comments-admin.js', array('jquery'), '1.0.0' );
	}
	
	function _displayAdminPage()
	{				
		$settings = $this->_getSettings();
		?>
        <div class="wrap">
            <div id="icon-edit-comments" class="icon32"></div><h2>PTM AJAX Comments : <?php _e('Settings', 'ptm-ajax-comments'); ?></h2>
            <form id="ptm-admin-options" name="ptm-admin-options" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                
				
            	<p><?php _e('By default this plugin requires no adjustments. However, this page offers you the ability to set custom preferences. This can improve the asthetics, usability and compatibility of this plugin on your beloved WordPress Blog', 'ptm-ajax-comments'); ?></p>
                
                <div class="divider">&nbsp;</div>
				
				<div class="optionsTabs">
					<?php require_once( PTM_AJAX_COMMENTS_PLUGINPATH.'/includes/admin-options-nav.php' ); ?>
				</div>
					
				<div class="divider">&nbsp;</div>
				
				<?php require_once( PTM_AJAX_COMMENTS_PLUGINPATH.'/includes/admin-options-general.php' ); ?>
				<?php require_once( PTM_AJAX_COMMENTS_PLUGINPATH.'/includes/admin-options-styling.php' ); ?>
				<?php require_once( PTM_AJAX_COMMENTS_PLUGINPATH.'/includes/admin-options-messages.php' ); ?>
				<?php require_once( PTM_AJAX_COMMENTS_PLUGINPATH.'/includes/admin-options-support.php' ); ?>
                    
				<div class="divider">&nbsp;</div>
				
				<p class="submit" id="ptm-submit-line">
					<input type="submit" name="Submit" value="<?php _e('Save Settings', 'ptm-ajax-comments'); ?>" class="button-primary" />&nbsp;&nbsp;<input type="button" name="reset" id="reset" value="<?php _e('Reset all settings', 'ptm-ajax-comments'); ?>" class="button-secondary" />&nbsp;<span class="description"><?php _e('(This will revert all changes you have made and load the default settings)', 'ptm-ajax-comments'); ?></span>
					<input type="hidden" name="reqAction" id="reqAction" value="saveSettings" />
				</p>
            	<?php wp_nonce_field('ptm-save-options'); ?>
			</form>
            
        </div>
		<?php
	}
}

# Initiate the plugin admin
function PTM_AJAXCommentsAdmin_Init()
{
	global $ptm_ajax_comments_admin;
	$ptm_ajax_comments_admin = new PTM_AJAXCommentsAdmin();
}
add_action("init", "PTM_AJAXCommentsAdmin_Init");
?>