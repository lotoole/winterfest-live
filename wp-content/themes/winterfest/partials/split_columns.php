<?php

$image = get_sub_field('image');
$src = wp_get_attachment_image_src($image, 'square');
$image_class = 'left' == get_sub_field('alignment') ? 'push-left' : '';
$content_class = 'left' == get_sub_field('alignment') ? 'pull-left' : '';

?>

<section class="split-columns" style="background-color: <?php the_sub_field('color'); ?>;">
    <div class="row no-gutters">
      <div class="<?php echo $content_class; ?> col-md-6">
        <div class="content">
          <?php the_sub_field('content'); ?>
        </div>
      </div>
      <div class="<?php echo $image_class; ?> col-md-6">
        <div class="image" style="background-image: url(<?php echo $src[0]; ?>)">
        </div>
      </div>
    </div>
</section>
