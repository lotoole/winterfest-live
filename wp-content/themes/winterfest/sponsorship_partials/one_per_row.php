<?php $image = get_sub_field('sponsor_image'); ?>
<div class="col-12">
  <a href="<?php the_sub_field('link'); ?>">
    <h1><?php the_sub_field('title'); ?></h1>
    <?php //echo wp_get_attachment_image( $image, $size ); ?>
    <img src="<?php echo $image['url']; ?>" width="640px" height="640px" alt="">
  </a>
</div>
