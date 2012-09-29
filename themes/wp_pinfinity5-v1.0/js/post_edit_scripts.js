jQuery(document).ready(function($) {
	// Allow opening of the media gallery, from our own links/buttons
	$('.ci-btn-open-media').click(function() {
		var url = $('#add_image').attr('href');
		if(typeof url === 'undefined') {
			url = $('#content-add_media').attr('href');
		}
		tb_show('', url);
		return false;
	});
	
	// first run.
	var post_format_selected = $('#post-formats-select input.post-format:checked').val();
	$('div[id^="ci_format_box_"]:visible').hide();
	$('div#ci_format_box_'+post_format_selected).show();


	// show only the custom fields we need in the post screen
	$('#post-formats-select input.post-format').click(function(){
		var format = $(this).attr('value');
		$('div[id^="ci_format_box_"]:visible').hide();
		$('div#ci_format_box_'+format).show();
	});





  //Native upload window for Audio
  var target,set_interval,fileurl = "";
  window.ci_opener = { trigger : '' };

  $('.ci-btn-open-media-audio').click(function() {
		
		var trigger = $(this).attr('id');
		trigger == "ci-upload-background" ? window.ci_opener = { trigger : 'ci-upload-background' } : window.ci_opener = { trigger : '' };  
		
		target = $(this).siblings('.uploaded');
		set_interval = setInterval( function() {
			jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use this file');
		}, 2000 );

		postID = $('#post_ID').val();
		tb_show('', 'media-upload.php?post_id='+postID+'&amp;type=image&amp;TB_iframe=true');
		return false;
	});

  window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
		if (target) {
			clearInterval(set_interval);

			//fileurl = $('a', html).attr('href');
			// WTF? jQuery bug on the above line?!?!
			fileurl = $(html).attr('href');
			
			target.val(fileurl);

			tb_remove();
		} else {
			window.original_send_to_editor(html);
		}
	};





}); 
