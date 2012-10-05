<?php $ptm_pp_target = 'Y21kPV9kb25hdGlvbnMmYnVzaW5lc3M9YmlsbGluZ0BmbG93ZHJvcHMuY29tJml0ZW1fbmFtZT1Eb25hdGlvbiBmb3IgUFRNIEFKQVggQ29tbWVudHMgcGx1Z2luJm5vX3NoaXBwaW5nPTEmbm9fbm90ZT0xJmN1cnJlbmN5X2NvZGU9VVNEJnRheD0wJmJuPVBQLURvbmF0aW9uc0JGJmFtb3VudD0='; ?>
<script type="text/javascript" language="javascript">
jQuery(document).ready(function($)
{
	$('#ptm-donate-submit').bind('click', function()
	{
		var _amount = $('#ptm-donate').val();
		if (_amount > null)
		{
			if (_amount < 1.35)
			{
				$('#ptm-no-amount').hide();
				$('#ptm-more-amount').fadeIn();
			}
			else
			{
				$('#ptm-more-amount').hide();
				$('#ptm-no-amount').hide();
				window.open('https://www.paypal.com/cgi-bin/webscr?<?php echo base64_decode($ptm_pp_target); ?>'+_amount,'_blank');
			}
		}
		else
		{
			$('#ptm-more-amount').hide();
			$('#ptm-no-amount').fadeIn();
		}
	});
});
</script>
<div id="support" class="optionTab">
	<h3>Plugin Support</h3>
	<p>Support is available in the official WordPress <a href="http://wordpress.org/tags/ptm-ajax-comments?forum_id=10" target="_blank">plugin support forums</a>.</p>
	<?php
	$limit = 5;
	$ptm_lfp = NULL;
	require_once(ABSPATH . WPINC . '/feed.php');
	$ptm_rss_feed = fetch_feed('http://wordpress.org/support/rss/tags/ptm-ajax-comments');
	if (!is_wp_error( $ptm_rss_feed ) )
	{
		$maxitems = $ptm_rss_feed->get_item_quantity($limit);
		if($maxitems > 0)
		{
			$ptm_lfp = $ptm_rss_feed->get_items(0, $maxitems);
		}
	}
	if(!is_null($ptm_lfp)) :
	?>
	<h4>Latest Forum Posts:</h4>
	<ul class="ptm_lfp">
		<?php foreach ( $ptm_lfp as $item ) : ?>
		<li><?php echo $item->get_date(); ?>: <a href="<?php echo $item->get_permalink(); ?>" title="<?php echo 'Bookmarked '.$item->get_date('j F Y | g:i a'); ?>" target="_blank"><?php echo $item->get_title(); ?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	<div class="divider">&nbsp;</div>
	<h3>Developer Mode</h3>
	<p>Check options below to enable debug & developer files</p>
	<table class="form-table">
		<tr>
			<th><label for="js_dev">Developer JS</label></th>
			<td><label for="js_dev_enabled"><input type="checkbox" name="js_dev_enabled" id="js_dev_enabled" value="1" <?php echo $settings['js_dev_enabled'] == 1 ? 'checked="checked"' : '' ?> /> Enable ptm-ajax-comments.dev.js</label></td>
		</tr>
	</table>
	<div class="divider">&nbsp;</div>
	<h3>Support the work</h3>
	<p>I'm spending quite some time on building, debugging &amp; maintaining this plugin. If you use &amp; like my work, please consider making a donation. Donations of any size are gratefully accepted. Thank you!</p>
	<table class="form-table">
		<tr>
			<th><label for="callback_name">Make a donation via PayPal:</label></th>
			<td>
				<input type="text" name="ptm-donate" id="ptm-donate" value="5" class="small-text code" maxlength="4" />&nbsp;<input type="button" name="ptm-donate-submit" id="ptm-donate-submit" value="Donate &rarr;" class="button-secondary" />&nbsp;<span class="description">This will open PayPal in a new window, please make sure it doesn't get blocked.</span>
				<div id="ptm-more-amount" class="icon-warning bold description" style="display:none;">PayPal takes USD 0.35 commission for a USD 1 donation. Please enter at least USD 1.35 , thank you!</div>
				<div id="ptm-no-amount" class="icon-warning bold description" style="display:none;">Please enter the amount you wish to donate and try again.</div>
			</td>
		</tr>
	</table>
</div>