<?php

the_post();

get_header();
?>

<section class="page">
  <div class="d-flex justify-content-start">
    <div class="sidebar d-none d-md-block"></div>
    <div class="content-wrap">
      <div class="header-wrap">
        <div class="custom-container">
          <h1><?php the_title(); ?></h1>
          <?php if(get_field('optional_sub_heading')) : ?>
            <p><?php the_field('optional_sub_heading'); ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="page">
        <div class="custom-container">
          <div class="row">
            <div class="col-md-12">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>
