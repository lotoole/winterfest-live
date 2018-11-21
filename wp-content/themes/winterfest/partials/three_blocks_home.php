<section class="three_blocks">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2><?php the_sub_field('title'); ?></h2>
      </div>
      <?php if( have_rows('blocks') ):  while ( have_rows('blocks') ) : the_row(); ?>
      <div class="col-md-4">
        <a href="#">
          <?php the_sub_field('icon'); ?>
          <h5><?php the_sub_field('title'); ?></h5>
          <p><?php the_sub_field('description'); ?></p>
        </a>
      </div>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>
