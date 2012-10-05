<div id="messages" class="optionTab">
	<h3>Output messages</h3>
	<p>Here you can set the generated messages.</p>
	<table class="form-table">
		<tr>
			<th><label for="textNoComment">Error message, missing comment:</label></th>
			<td><input type="text" name="textNoComment" id="textNoComment" value="<?php echo $settings['textNoComment'] ?>" class="regular-text code" /></td>
		</tr>
		<tr>
			<th><label for="textAddingComment">Message while adding comment:</label></th>
			<td><input type="text" name="textAddingComment" id="textAddingComment" value="<?php echo $settings['textAddingComment'] ?>" class="regular-text code" /></td>
		</tr>
		<tr>
			<th><label for="textCommentAdded">Message when comment has been added:</label></th>
			<td><input type="text" name="textCommentAdded" id="textCommentAdded" value="<?php echo $settings['textCommentAdded'] ?>" class="regular-text code" /></td>
		</tr>
	</table>
</div>
