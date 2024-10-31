// JavaScript Document
/*!
 * PP v1.0.0 (http://aruljayaraj.com) 
*/
jQuery(document).ready(function($){
	// Show Media Upload	
	jQuery('#pp_button').click(function() { 
		tbframe_interval = setInterval(function() {
          jQuery('#TB_iframeContent').contents().find('.savesend input[type="submit"]').val('Set as my Profile Picture!');
    }, 2000);		
		tb_show('', ppvars.adminurl+'media-upload.php?type=image&amp&TB_iframe=1');
		return false;
	});
	//Get the editor results
	window.send_to_editor = function(html) { 
		var imgf_url = $('img',html).attr('src'); 
		var img_url = imgf_url.split("uploads"); 
		jQuery("#pp_url").val(img_url[1]);
		jQuery(".pp_url").attr('src',imgf_url);
		jQuery('.pp-picture').show();
		jQuery('#pp_button').val("Change Profile Picture");
		tb_remove();
	}
	
	// Remove Image
	jQuery('.pp_delete').on('click', function(){			
		jQuery('#pp_url').val("");
		jQuery('.pp_url').attr('src', '');
		jQuery('#pp_button').val("Add Profile Picture");
		jQuery('.pp-picture').hide();
	});
});