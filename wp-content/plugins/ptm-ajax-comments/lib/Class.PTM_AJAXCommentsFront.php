<?php
/**
 * 		  File : Class.PTM_AJAXCommentsFront.php
 *     Version : 1.0.0
 * 		Author : Peter 'Toxane' Michael
 * 	Author URI : http://tacocode.com/
 *
 */

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You don\'t want to do this. Really.'); }

class PTM_AJAXCommentsFront extends PTM_AJAXComments
{
	private $response_type;
	private $response_message;
	
	function __construct()
	{
		add_action( 'wp', array( $this, 'wpWP' ), 10 );
		add_action( 'wp_head', array( $this, 'wpHead' ), 10 );
		add_action( 'comment_post_redirect', array( $this, 'commentPostRedirect' ), 10, 2 );
		add_action( 'pre_comment_on_post', array( $this, 'preCommentOnPost' ), 10 );
		# Add comment error actions
		if($_POST && isset($_POST['comment_post_ID']))
		{
			add_action('comment_flood_trigger', array( $this, 'errorFloodTrigger' ) );
			add_action('comment_id_not_found', array( $this, 'errorIDNotFound' ) );
			add_action('comment_closed', array( $this, 'errorCommentClosed' ) );
			add_action('comment_on_draft', array( $this, 'errorCommentOnDraft' ) );
			add_action('comment_duplicate_trigger', array( $this, 'errorCommentDuplicate' ) );
		}
	}
	
	function wpWP()
	{
		$currentSettings = $this->_getSettings();
		if ( is_single() || is_page() )
		{
			if(isset($currentSettings['compatAntispamBee']) && $currentSettings['compatAntispamBee'] == 'checked')
			{
				wp_enqueue_script('jquery_md5', PTM_AJAX_COMMENTS_PLUGINURL.'js/jquery.md5.js', array('jquery'), '1.0', true );
			}
			$js_file = $currentSettings['js_dev_enabled'] == 0 ? 'ptm-ajax-comments.js' : 'ptm-ajax-comments.dev.js';
			wp_enqueue_script('ptm-ajax-comments', PTM_AJAX_COMMENTS_PLUGINURL.'js/'.$js_file, array('jquery', 'jquery-form'), '1.0.0', true );
		}
	}
	
	function wpHead()
	{
		$currentSettings = $this->_getSettings();
		if ( is_single() || is_page() )
		{
			$head_out = '<script type="text/javascript">'."\n".
						'var ajaxurl = "'.admin_url('admin-ajax.php').'";'."\n".
						'var ptm_ajax_comments_defaults = {showForm : "'.$currentSettings['showForm'].'",'.
						'disableForm : "'.$currentSettings['disableForm'].'",'.
						'activityImagePath : "'.$currentSettings['activityImagePath'].'",'.
						'activeColor : "'.$currentSettings['activeColor'].'",'.
						'inactiveColor : "'.$currentSettings['inactiveColor'].'",'.
						'css_comment : "'.$currentSettings['css_comment'].'",'.
						'css_commentform : "'.$currentSettings['css_commentform'].'",'.
						'css_commentlist : "'.$currentSettings['css_commentlist'].'",'.
						'css_respond : "'.$currentSettings['css_respond'].'",'.
						'textNoComment : "'.$currentSettings['textNoComment'].'",'.
						'textAddingComment : "'.$currentSettings['textAddingComment'].'",'.
						'textCommentAdded : "'.$currentSettings['textCommentAdded'].'",'.
						'compatContentPress : "'.$currentSettings['compatContentPress'].'",'.
						'compatAntispamBee : "'.$currentSettings['compatAntispamBee'].'",'.
						'commentPosition : "'.$currentSettings['commentPosition'].''.
						'"};'."\n".
						'var thread_comments_depth = '.get_option('thread_comments_depth').';'."\n".
						'</script>'."\n".
						'<style type="text/css">'."\n". 
						$currentSettings['css_style'] ."\n".
						'.ptm-reply-hidden{display:none;}'."\n".
						'</style>'."\n";
						echo $head_out;
		}
	}
	
	function commentPostRedirect($location, $comment)
	{
		$currentSettings = $this->_getSettings();
		$_callback = $currentSettings['callback_name'];
		$_comments = array();
		$_comments[] = $comment;
		wp_list_comments('type=comment&callback='.$_callback, $_comments);
	}
	
	function preCommentOnPost()
	{
		define('DOING_AJAX', true);
	}
	
	function errorCommentDuplicate()
	{
		$this->response_type = 'error';
		$this->response_message = __('Duplicate comment detected; it looks as though you&#8217;ve already said that!', 'ptm-ajax-comments');
		echo $this->response_type.'|'.$this->response_message;
		die();
	}

	function errorFloodTrigger()
	{
		$this->response_type = 'error';
		$this->response_message = __('Slow down, you post too fast!', 'ptm-ajax-comments');
		echo $this->response_type.'|'.$this->response_message;
		die();
	}
	
	function errorIDNotFound()
	{
		$this->response_type = 'error';
		$this->response_message = __('Could not find the reply ID.', 'ptm-ajax-comments');
		echo $this->response_type.'|'.$this->response_message;
		die();
	}
	
	function errorCommentClosed()
	{
		$this->response_type = 'error';
		$this->response_message = __('Comments are closed. You cannot add a reply to this post.', 'ptm-ajax-comments');
		echo $this->response_type.'|'.$this->response_message;
		die();
	}
	
	function errorCommentOnDraft()
	{
		$this->response_type = 'error';
		$this->response_message = __('This post is a draft. Therefore, you cannot add a reply.', 'ptm-ajax-comments');
		echo $this->response_type.'|'.$this->response_message;
		die();
	}
}

# Initiate the plugin
function PTM_AJAXCommentsFront_Init()
{
	global $ptm_ajax_comments_front;
	$ptm_ajax_comments_front = new PTM_AJAXCommentsFront();
}
add_action("init", "PTM_AJAXCommentsFront_Init");
?>