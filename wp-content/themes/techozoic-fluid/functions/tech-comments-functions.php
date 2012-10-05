<?php
/******************************************
This File Contains callback functions for comment loops
******************************************/
	 
	 // credit to yoast.com
function delete_comment_link($id,$post_name) {
	  if (current_user_can('edit_post')) {
                echo ' | <a href="'.admin_url("comment.php?action=cdc&amp;c=$id&redirect_to=/".$post_name."/").'">'. __("Delete" ,'techozoic').'</a> ';
                echo '| <a href="'.admin_url("comment.php?action=cdc&amp;dt=spam&amp;c=$id&amp;redirect_to=/".$post_name."/").'">'.__("Spam" ,'techozoic').'</a>';
	  }
}
add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
        global $id;
        $get_comments= get_comments('post_id=' . $id);
        $comments_by_type = &separate_comments($get_comments);
        return count($comments_by_type['comment']);
}
function techozoic_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
                global $post;
?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID( ); ?>">
        <div id="comment-<?php comment_ID( ); ?>">
        <div class="avatar_cont"><?php echo get_avatar( $comment, '50' ); ?></div>
        <?php printf(__('Comment by %s','techozoic'),'<em>'.get_comment_author_link().'</em>'); ?>:
<?php 			if ($comment->comment_approved == '0') { 
?>				<em><?php _e('Your comment is awaiting moderation.' ,'techozoic') ?></em>
<?php			}
?>
        <br />
        <small class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('l, F jS Y') ?> at <?php comment_time() ?></a>&nbsp;|&nbsp;<?php edit_comment_link(__('Edit' ,'techozoic'),'','');
        if($post->post_type == 'post'){
                delete_comment_link($comment->comment_ID,$post->post_name);
                }
        ?>
        </small>

<?php 			comment_text() 
?>
        <div class="reply">
<?php 			echo comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth']));  
?>
        </div>
        </div>
<?php
} // End function techozoic_comment

function techozoic_ping($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>"><?php printf(__('Ping from %s' ,'techozoic'),  get_comment_author_link()); ?>
    </li>
    <?php 
} // End function techozoic_ping

function techozoic_gravatar() {
        if (function_exists('get_avatar')) { 
                echo '<div class="avatar_cont">';
                global $comment;
                if (! empty($comment->comment_author_url) ){ 
                        // Did they leave a link 
?>	       			<a rel="external nofollow" href="<?php comment_author_url(); ?>" title="<?php comment_author(); ?> ">
<?php				echo get_avatar( $comment , '50' )
?>				</a>
<?php 			} else { 
                         echo get_avatar( $comment , '50' ); 
                }
?>	      		</div>
<?php
        } 
}//End techozoic_gravatar
?>