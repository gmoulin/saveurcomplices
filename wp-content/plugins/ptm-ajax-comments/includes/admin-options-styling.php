<div id="styling" class="optionTab">
	<h3>Activity Image</h3>
	<table class="form-table">
		<tr>
			<th><label for="custom_activity_image">Custom image URL:</label></th>
			<td><input type="text" name="custom_activity_image" id="custom_activity_image" value="<?php echo $settings['activityImagePath'] ?>" class="large-text code" /> <span class="description">e.g. http://www.mydomain.com/myimage.gif</span></td>
		</tr>
		<tr>
			<th><label for="activity_image">Default activity images:</label></th>
			<td>
			<?php
			$imagePath = PTM_AJAX_COMMENTS_PLUGINURL.'images';
			for($i = 1; $i < 8; $i++)
			{
				$currentImage = $imagePath.'/activity'.$i.'.gif';
				echo '<input type="radio" name="activity_image" id="activity_image'.$i.'" value="'.$imagePath.'/activity'.$i.'.gif'.'"';
				if($currentImage == $settings['activityImagePath']) { echo ' checked="checked"'; }
				echo 'onchange="setImage(\''.$imagePath.'/activity'.$i.'.gif\')" />';
				echo '<label for="activity_image'.$i.'">&nbsp;<img src="'.$imagePath.'/activity'.$i.'.gif" align="absmiddle" /></label><br />'."\n";
			}
			?>
			<p><span class="description">Get more preloader images at <a href="http://www.preloaders.net/" target="_blank">http://www.preloaders.net/</a></span></p>
			</td>
		</tr>
	</table>
	<div class="divider">&nbsp;</div>
	<h3>Field colors</h3>
	<table class="form-table">
		<tr>
			<th><label for="activeColor">Active field background color:</label></th>
			<td><input type="text" name="activeColor" id="activeColor" value="<?php echo $settings['activeColor'] ?>" class="small-text code" size="10" maxlength="6" /> <span class="description">The background color of the current focused field</span></td>
		</tr>
		<tr>
			<th><label for="inactiveColor">Inactive field background color:</label></th>
			<td><input type="text" name="inactiveColor" id="inactiveColor" value="<?php echo $settings['inactiveColor'] ?>" class="small-text code" size="10" maxlength="6" /> <span class="description">The background color of the inactive fields</span></td>
		</tr>
	</table>
	<div class="divider">&nbsp;</div>
	<h3>Custom CSS</h3>
	<p>You can provide your own CSS to style the output of the plugin</p>
	<table class="form-table">
		<tr>
			<th><label for="css_style">CSS:</label></th>
			<td><textarea name="css_style" id="css_style" cols="80" rows="6" class="regular-text code"><?php echo $settings['css_style'] ?></textarea></td>
		</tr>
	</table>	
</div>