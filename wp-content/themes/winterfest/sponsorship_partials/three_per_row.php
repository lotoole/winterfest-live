<div class="col-md-12">
  <h3><?php the_sub_field('title'); ?></h3>
</div>
<?php if( have_rows('sponsor') ): while( have_rows('sponsor') ) : the_row(); ?>
  <?php $image = get_sub_field('sponsor_image'); ?>
  <div class="col-md-4">
    <a href="<?php the_sub_field('link'); ?>">
      <img src="<?php echo $image['url']; ?>" width="400px" height="400px" alt="">
      <!-- <img src="<?php //bloginfo('stylesheet_directory'); ?>/static/images/benandjerrys.png" width="400px" height="400px" alt=""> -->
    </a>
  </div>
<?php endwhile; endif; ?>
