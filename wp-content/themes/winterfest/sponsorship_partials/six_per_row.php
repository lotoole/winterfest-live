<div class="col-md-12">
  <h5><?php the_sub_field('title'); ?></h5>
</div>
<?php if( have_rows('sponsor') ): while( have_rows('sponsor') ) : the_row(); ?>
  <?php $image = get_sub_field('sponsor_image'); ?>
  <div class="col-md-2">
    <a href="<?php the_sub_field('link'); ?>">
      <img src="<?php echo $image['url']; ?>" width="200px" height="200px" alt="">
      <!-- <img src="<?php //bloginfo('stylesheet_directory'); ?>/static/images/benandjerrys.png" width="200px" height="200px" alt=""> -->
    </a>
  </div>
<?php endwhile; endif; ?>
