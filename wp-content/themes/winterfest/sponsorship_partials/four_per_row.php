<div class="col-md-12">
  <h4><?php the_sub_field('title'); ?></h4>
</div>
<?php if( have_rows('sponsor') ): while( have_rows('sponsor') ) : the_row(); ?>
  <?php $image = get_sub_field('sponsor_image'); ?>
  <?php $link = get_sub_field('sponsor_link');
        $link_url = $link['url'];
  ?>
  <div class="col-md-3 four-per">
    <a href="<?php echo esc_url($link_url); ?>">
      <img src="<?php echo $image['url']; ?>" width="300px" height="300px" alt="">
    </a>
  </div>
<?php endwhile; endif; ?>
