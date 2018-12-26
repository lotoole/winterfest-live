<div class="col-md-12">
  <h2><?php the_sub_field('title'); ?></h2>
</div>
<?php if( have_rows('sponsor') ): while( have_rows('sponsor') ) : the_row(); ?>
  <?php $image = get_sub_field('sponsor_image'); ?>
  <?php $link = get_sub_field('sponsor_link');
        $link_url = $link['url'];
  ?>
  <div class="col-md-6 two-per">
    <a href="<?php echo esc_url($link_url); ?>">
      <img src="<?php echo $image['url']; ?>" width="500px" height="500px" alt="">
      <!-- <img src="<?php //bloginfo('stylesheet_directory'); ?>/static/images/benandjerrys.png" width="500px" height="500px" alt=""> -->
    </a>
  </div>
<?php endwhile; endif; ?>
