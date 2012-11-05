//	        File : ptm-ajax-comments.js
//	 Description : JavaScript library for 'PTM AJAX Comments'
//	     Version : 1.0.3
//	Requirements : jQuery, http://jquery.com
//	      Author : Peter 'Toxane' Michael
//	  Author URI : http://tacocode.com

jQuery.noConflict();

var PTM_AJAX_Comments =
{   
	init: function() {
		PTM_AJAX_Comments.assignVars();
	},
    
    assignVars: function() {
		var data = ptm_ajax_comments_defaults;
		btSubmit = jQuery('#submit').attr('value');
		activityImage = data.activityImage;
		showForm = data.showForm;
		disableForm = data.disableForm;
		activityImage = data.activityImagePath;		
		activeColor = data.activeColor;
        inactiveColor = data.inactiveColor;
        css_comment = data.css_comment;
        css_commentform = data.css_commentform;
		css_commentlist = data.css_commentlist;
		css_respond = data.css_respond;
		textNoComment = data.textNoComment;
		textAddingComment = data.textAddingComment;
		textCommentAdded = data.textCommentAdded;
		compatContentPress = data.compatContentPress;
		compatAntispamBee = data.compatAntispamBee;
		commentPosition = data.commentPosition;
		current_depth = 1;
		is_max_level = false;
		PTM_AJAX_Comments.setColors();
		PTM_AJAX_Comments.bindForm();
	},
					
	setColors: function() {
		jQuery('#author').focus(function(){jQuery(this).css('background', '#'+activeColor);}).blur(function(){jQuery(this).css('background', '#'+inactiveColor);});
		jQuery('#email').focus(function(){jQuery(this).css('background', '#'+activeColor);}).blur(function(){jQuery(this).css('background', '#'+inactiveColor);});
		jQuery('#url').focus(function(){jQuery(this).css('background', '#'+activeColor);}).blur(function(){jQuery(this).css('background', '#'+inactiveColor);});
		jQuery('#'+css_comment).focus(function(){jQuery(this).css('background', '#'+activeColor);}).blur(function(){jQuery(this).css('background', '#'+inactiveColor);});
	},
	
	bindForm: function() {
		jQuery('#submit').one("click", function() {
			jQuery('#'+css_commentform).after('<div id="ptm-ac-response" style="display:none;"></div>');
			jQuery(this).after('<div id="ptm-ac-loader" style="display:none;"><img src="'+activityImage+'" alt="'+textAddingComment+'" /></div>');
		});

		jQuery('#'+css_commentform).bind("submit", function() {

			var the_parent_elem_classes = jQuery('#'+css_respond).parent().attr('class');
			if( typeof the_parent_elem_classes != 'undefined' ) {
				var classNames = the_parent_elem_classes.split(' ');
				jQuery(classNames).each(function() {
				    if( this.search(/depth-/i) != -1 ) {
				    	current_depth = parseInt(this.replace( 'depth-', '' )) + 1;
				    	console.log('Current depth:' + current_depth);
				    }
				});
			} else {
				current_depth = 1;
			}

			try {
				// reset message
				jQuery('#ptm-ac-response').removeClass('ptm-ac-error ptm-ac-success').html('').hide();
				
				// Antispam Bee Plugin compatibility
                if(compatAntispamBee == 'checked') {
					var comment_md5 = jQuery.md5(blog_url).substr(0, 5);
					var comment_field = jQuery( "textarea[name='"+css_comment+"-"+comment_md5+"']" );
					if(comment_field.val() === '' || comment_field.val() == this.comment.title) {
						jQuery('#ptm-ac-response').addClass('ptm-ac-error').html('<span>'+textNoComment+'</span>').show();
						comment_field.focus();
						return false;
					}
				} else {
					if(this.comment.value === '' || this.comment.value == this.comment.title) {
						jQuery('#ptm-ac-response').addClass('ptm-ac-error').html('<span>'+textNoComment+'</span>').show();
						this.comment.focus();
						return false;
					}
				}
                
				// all good, make comment
				var ptm_ajax_options = { 
					beforeSubmit: PTM_AJAX_Comments.preSubmit,
					success: PTM_AJAX_Comments.postSubmit,
					error : PTM_AJAX_Comments.ajaxError,
					type: 'post'
				};
				
				jQuery(this).ajaxSubmit(ptm_ajax_options); 
				return false;
			}
			catch(e) {
				// do a normal postback in case of an unexpected error
				console.log(e);
				return true;	
			}
		});
	},
	
	ajaxError: function(XMLHttpRequest, textStatus, errorThrown) {
		PTM_AJAX_Comments.removeActivity();
		var _wpResponse,  _wpBody, _error;
		// check for wp_die
		if(XMLHttpRequest.status == 500) {
			_wpResponse = XMLHttpRequest.responseText;
			_wpBody = jQuery(_wpResponse).contents().filter(function(){return this.nodeType != 1;});
			_error = _wpBody[1].wholeText;
		} else {
			_error = 'An unknown error occured. Please try again.';
		}
		PTM_AJAX_Comments.throwError(_error);
		return;
	},
	
	preSubmit: function(formData, jqForm, ptm_ajax_options) {
		PTM_AJAX_Comments.addActivity();
	},
	
	postSubmit: function(responseText, statusText, xhr, $form) {
		/*
		console.log(responseText);
		console.log(statusText);
		console.log(xhr);
		console.log($form);
		*/
		PTM_AJAX_Comments.removeActivity();
		// check for errors
		var errordata = responseText.split("|");
		is_error = errordata[0]; // If WP returned an error, the value of is_error is now 'error'
		
		if(is_error == 'error') {
			PTM_AJAX_Comments.throwError(errordata[1]);
			return;
		} else if(responseText == -1) { // likely not all fields filled
			PTM_AJAX_Comments.throwError('Please fill in all required fields');
		} else {
			PTM_AJAX_Comments.processComment(responseText);
			PTM_AJAX_Comments.clearInputs();
		}
	},
	
	processComment: function(data) {
		// Make sure we don't overshoot the thread level from the settings -> discussion
		current_depth = (current_depth > thread_comments_depth) ? thread_comments_depth : current_depth;
		is_max_level = (current_depth == thread_comments_depth) ? true : false;

		// TODO: This is crap, make it better!
		tmpComment = data.replace( 'depth-1', 'depth-'+current_depth );
		if(is_max_level) {
			// Remove the reply link
			tmpComment = tmpComment.replace( 'class="reply"', 'class="reply ptm-reply-hidden"' );
		}

		// Reset the depth
		current_depth = 1;
		is_max_level = false;

		console.log(tmpComment);

		// Check where to add the comment
		if(jQuery('.'+css_commentlist).length > 0) { // The commentlist exists i.e. this is not the first comment
			
			// Another ugliest hack that did ever hack ?
			console.log(jQuery('#'+css_respond).parent().attr('class'));

			var the_parent_class = jQuery('#'+css_respond).parent().attr('class');
			if(typeof the_parent_class != "undefined" && the_parent_class.search(/depth-/i) != -1) { //threaded
				// Check if there are already replies, if not, add <ul class="children">
				if(jQuery('#'+css_respond).parent().children('.children').length) {
					// There are replies, add comment to the end of the list
					jQuery('#'+css_respond).parent().children('.children').append(tmpComment);
				} else {
					// First reply
					tmpComment = '<ul class="children">'+tmpComment+'</ul>';
					jQuery('#'+css_respond).parent().append(tmpComment);
				}
			} else {
				// Normal comment
				if(commentPosition == 'bottom') {
					jQuery('.'+css_commentlist).append(tmpComment);
				} else if(commentPosition == 'top') {
					jQuery('.'+css_commentlist).prepend(tmpComment);
				} else {
					jQuery('.'+css_commentlist).append(tmpComment);
				}
			}
		} else {
			// The commentlist doesn't exist, this is the first comment
			
			// Do we need to support the 'Content Press' Theme?
			if(compatContentPress == 'checked') {
				jQuery('div.postbox').before(jQuery(tmpComment).find('div.boxcomments'));
			} else {
				tmpComment = '<ol class="'+css_commentlist+'">'+tmpComment+'</ol>';
				jQuery('#'+css_respond).before(jQuery(tmpComment));
			}
		}
		
		// remove the reply form
		jQuery('#cancel-comment-reply-link').click();
		
		// 'Ajax Edit Comments' plugin compatibility
		if (window.AjaxEditComments) {
   			AjaxEditComments.init();
		}
		jQuery('#ptm-ac-response').addClass('ptm-ac-success').html('<span>'+textCommentAdded+'</span>').show();
	},
		
	addActivity: function() {
		jQuery('#ptm-ac-response').removeClass('ptm-ac-error').html('<span>'+textAddingComment+'</span>').show();
		jQuery('#ptm-ac-loader').show();
		if (disableForm == 'checked') {	
			jQuery('#'+css_commentform+' *').attr("disabled","disabled");
		} else {
			jQuery('#'+css_commentform).fadeOut();
		}
	},
	
	removeActivity: function() {
		jQuery('#ptm-ac-response').removeClass('ptm-ac-error').html('').hide();
		jQuery('#ptm-ac-loader').hide();
		if(showForm == 'checked') {
			jQuery('#'+css_commentform).fadeIn();
		}
		jQuery('#'+css_commentform+' *').removeAttr("disabled");
	},
	
	clearInputs: function() {
		jQuery('#comment').val('');
	},
	
	throwError: function(message) {
		PTM_AJAX_Comments.removeActivity();
		jQuery('#'+css_commentform).fadeIn();
		jQuery('#ptm-ac-response').addClass('ptm-ac-error').html('<span>'+message+'</span>').show();
	}
};
jQuery(document).ready(PTM_AJAX_Comments.init);
