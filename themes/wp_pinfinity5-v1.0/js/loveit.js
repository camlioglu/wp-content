jQuery(document).ready(function($) {

  $('.heart-this').live('click', function() {
    if($(this).hasClass('loved')) {
      alert(love_it_vars.already_loved_message);
      return false;
    }
    var post_id = $(this).data('post-id');
    var post_data = {
      action: 'love_it',
      item_id: post_id,
      love_it_nonce: love_it_vars.nonce
    };
    var that = $(this);
    $.post(love_it_vars.ajaxurl, post_data, function(response) {
      if(response == 'loved') {
        if ( $.cookie('ci_love_it_cookie') ) {
          var $ids = new Array();
          $ids.push($.cookie('ci_love_it_cookie'));
          $ids.push(post_id);
          $.cookie('ci_love_it_cookie', $ids, { expires: 14, path: '/' });
        } else {
          $.cookie('ci_love_it_cookie', post_id, { expires: 14, path: '/' });
        }
        that.addClass('loved');
        var count = that.find('.heart-no').text();
        that.find('.heart-no').text(parseInt(count) + 1);
      } else {
        alert(love_it_vars.error_message);
      }
    });
    return false;
  });

});
