<?php $image = get_sub_field('sponsor_image'); ?>
<div class="col-12 one-per">
  <a href="<?php the_sub_field('sponsor_link'); ?>">
    <h1><?php the_sub_field('title'); ?></h1>
    <img src="<?php echo $image['url']; ?>" width="640px" height="640px" alt="">
  </a>
</div>
