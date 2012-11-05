function setImage(imageValue)
{
	document.getElementById('custom_activity_image').value = imageValue;
};
var PTM_AJAXCommentsAdmin = 
{
	init: function()
	{
		PTM_AJAXCommentsAdmin.createTabs();
		PTM_AJAXCommentsAdmin.setInputs();
		PTM_AJAXCommentsAdmin.confirmReset();
	},
	createTabs: function()
	{
		var tabContainers = jQuery('div.optionTab');
		jQuery('div.optionsTabs ul.optionsTabsNav a').click(function()
		{	
			jQuery('#ptm-admin-options-reset').show()
			jQuery('#ptm-submit-line').show()
			var _clicked = jQuery(this).attr('href');
			if(_clicked == '#support')
			{
				// jQuery('#ptm-admin-options-reset').hide()
				// jQuery('#ptm-submit-line').hide()
			}
			jQuery('div.optionsTabs ul.optionsTabsNav a').removeClass('selected');
			jQuery(this).addClass('selected');
			tabContainers.hide().filter(this.hash).show();
			return false;
		}).filter(':first').click();
	},
	setInputs: function()
	{
		jQuery("#disableForm").attr('checked') ? jQuery("#lineShowForm").hide() : jQuery("#lineShowForm").show();
		jQuery("#disableForm").change( function()
		{
			jQuery(this).attr('checked') ? jQuery("#lineShowForm").hide() : jQuery("#lineShowForm").show();
		});
	},
	confirmReset: function()
	{
		jQuery('#reset').click(function()
		{
			if(confirm('Are You Sure ?'))
			{
				jQuery('#reqAction').val('resetSettings');
				jQuery('#ptm-admin-options').submit();
			}
			return false;
		});
	}
};
jQuery(document).ready(PTM_AJAXCommentsAdmin.init);