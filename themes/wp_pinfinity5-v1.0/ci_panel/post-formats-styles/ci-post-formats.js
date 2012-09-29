jQuery(document).ready(function($) {

  // Colorize post formats 
  $('#post-formats-select').prepend('<br>');
  $('#post-formats-select br').each( function(){ 		
  		var pft_id = $(this).next().attr('id');
  		$(this).nextUntil("br").wrapAll('<fieldset class="ci-post-format"><p></p></fieldset>').end().children('input').attr('id','test');  		
  		$(this).next().attr('id', 'ci-' + pft_id);
  });   
  $('#post-formats-select br').remove();
  
    
});