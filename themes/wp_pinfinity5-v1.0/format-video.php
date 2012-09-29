<?php $url = get_post_meta($post->ID, 'ci_format_video_url', true); ?>

<?php if(!empty($url)): ?>
<div class="entry-image">
  <?php
  $width = 610;
  $height = 293;

  if(substr($url, 0, 7)=='http://')
  {
    // It's a URL. Let's try oEmbed.
    echo wp_oembed_get($url, array('width'=>$width));
  }
  else
  {
    // It's not a URL. Adjust width and height and spit out whatever they wrote.
    $count_width = 0;
    $count_height = 0;

    // Replace width
    $replacement_width = 'width="'.$width.'"';
    $url = preg_replace('/width=["|\']?\d*["|\']?/', $replacement_width, $url, -1, $count_width);

    // Replace height
    $replacement_height = 'height="'.$height.'"';
    $url = preg_replace('/height=["|\']?\d*["|\']?/', $replacement_height, $url, -1, $count_height);

    // No width? Let's add it
    if($count_width==0)
    {
      $url = str_replace('<iframe ', '<iframe '.$replacement_width.' ', $url);
      $url = str_replace('<object ', '<object '.$replacement_width.' ', $url);
      $url = str_replace('<embed ', '<embed '.$replacement_width.' ', $url);
    }

    // No height? Let's add it
    if($count_height==0)
    {
      $url = str_replace('<iframe ', '<iframe '.$replacement_height.' ', $url);
      $url = str_replace('<object ', '<object '.$replacement_height.' ', $url);
      $url = str_replace('<embed ', '<embed '.$replacement_height.' ', $url);
    }

    echo $url;
  }

  ?>
</div>
<?php endif; ?>


<div class="entry-content group">

  <?php ci_e_content(); ?>

</div>
