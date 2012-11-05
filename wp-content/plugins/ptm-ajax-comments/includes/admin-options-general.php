<div id="general" class="optionTab">
	<h3>Callback Function</h3>
	<p>If your theme uses a callback function for the comments, enter the function name here</p>
	<table class="form-table">
		<tr>
			<th><label for="callback_name">Callback function name:</label></th>
			<td><input type="text" name="callback_name" id="callback_name" value="<?php echo $settings['callback_name'] ?>" class="regular-text code" />&nbsp;<span class="description">wp_list_comments('type=comment&amp;callback=<span class="highlight">twentyeleven_comment</span>) &rarr; see your theme's comments.php file</span></td>
		</tr>
	</table>
	<div class="divider">&nbsp;</div>
	<h3>Form ID's &amp; Classes</h3>
	<p>The following values are the standard ID's & Classes from the 'Default' / 'Twentyten' Wordpress theme.<br />
	<span class="description">NOTE: If you changed the default classes & ID's in your comment template (comments.php) or you use a customised theme, you <b>must</b> apply/reflect the changes here, otherwise the plugin will <b>not</b> work.</span></p>
	<table class="form-table">
		<tr>
			<th><label for="css_commentlist">Class 'commentlist':</label></th>
			<td><input type="text" name="css_commentlist" id="css_commentlist" value="<?php echo $settings['css_commentlist'] ?>" class="regular-text code" />&nbsp;<span class="description">&lt;ol class=&quot;<span class="highlight">commentlist</span>&quot;&gt;</span></td>
		</tr>
		<tr>
			<th><label for="css_respond">ID 'respond':</label></th>
			<td><input type="text" name="css_respond" id="css_respond" value="<?php echo $settings['css_respond'] ?>" class="regular-text code" />&nbsp;<span class="description">&lt;h3 id=&quot;<span class="highlight">respond</span>&quot;&gt;</span></td>
		</tr>
		<tr>
			<th><label for="css_commentform">ID 'commentform':</label></th>
			<td><input type="text" name="css_commentform" id="css_commentform" value="<?php echo $settings['css_commentform'] ?>" class="regular-text code" />&nbsp;<span class="description">&lt;form action=&quot;wp-comments-post.php&quot; method=&quot;post&quot; id=&quot;<span class="highlight">commentform</span>&quot;&gt;</span></td>
		</tr>
		<tr>
			<th><label for="css_comment">ID 'comment':</label></th>
			<td><input type="text" name="css_comment" id="css_comment" value="<?php echo $settings['css_comment'] ?>" class="regular-text code" />&nbsp;<span class="description">&lt;textarea name=&quot;comment&quot; id=&quot;<span class="highlight">comment</span>&quot; title=&quot;Your comment&quot; title=&quot;Please enter a comment&quot;&gt;</span></td>
		</tr>
	</table>
	<div class="divider">&nbsp;</div>
	<h3>Comment position</h3>
	<table class="form-table">
		<tr valign="top">
			<th scope="row">Add new comment at:</th>
			<td>
				<fieldset><legend class="screen-reader-text"><span>Add new comment at:</span></legend>
					<label><input type="radio" name="commentPosition" id="commentPositionBottom" value="bottom" <?php echo ($settings['commentPosition'] == 'bottom') ? 'checked="checked"' : ''; ?> /> Bottom of comment list<br />
					<label><input type="radio" name="commentPosition" id="commentPositionTop" value="top" <?php echo ($settings['commentPosition'] == 'top') ? 'checked="checked"' : ''; ?> /> Top of comment list</label>
				</fieldset>
			</td>
		</tr>
	</table>
	<div class="divider">&nbsp;</div>
	<h3>Compatibility</h3>
	<table class="form-table">
		<tr valign="top">
			<th scope="row">Make plugin compatible with:</th>
			<td>
				<fieldset><legend class="screen-reader-text"><span>Make plugin compatible with:</span></legend>
					<label for="compatContentPress"><input type="checkbox" name="compatContentPress" id="compatContentPress" value="checked" <?php echo $settings['compatContentPress'] ?> /> Content Press Theme<br />
					<label for="compatAntispamBee"><input type="checkbox" name="compatAntispamBee" id="compatAntispamBee" value="checked" <?php echo $settings['compatAntispamBee'] ?> /> Antispam Bee Plugin</label>
				</fieldset>
			</td>
		</tr>
	</table>
	<div class="divider">&nbsp;</div>
	<h3>Comment Form</h3>
	<table class="form-table">
		<tr valign="top">
			<th scope="row">Comment form behaviour:</th>
			<td>
				<fieldset><legend class="screen-reader-text"><span>Comment form behaviour</span></legend>
					<label for="disableForm"><input type="checkbox" name="disableForm" id="disableForm" value="checked" <?php echo $settings['disableForm'] ?> /> Just disable the form elements while adding a comment, do not fade out<br />
					<label for="showForm" id="lineShowForm"><input type="checkbox" name="showForm" id="showForm" value="checked" <?php echo $settings['showForm'] ?> /> Show comment form after a comment has been added</label>
				</fieldset>
			</td>
		</tr>
	</table>
</div><!-- #general -->