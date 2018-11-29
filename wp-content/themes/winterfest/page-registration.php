<?php
//Template Name: Registration Page
the_post();

get_header();
?>

<?php
  if ( have_rows( 'flexible_content' ) ) {
      while ( have_rows( 'flexible_content' ) ) {
          the_row();
          get_template_part( 'partials/' . get_row_layout() );
      }
  }
?>
<section class="registration-promo">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2><?php the_field('section_title'); ?></h2>
        <p class="intro"><?php the_field('section_intro'); ?></p>
      </div>
      <?php if( have_rows('event') ): $count=1; while( have_rows('event') ) : the_row(); ?>
        <div class="col-md-4">
          <?php if($count === 2): ?>
            <div class="content cards">
              <h4><?php the_sub_field('name'); ?></h4>
              <span><?php the_sub_field('price'); ?></span>
              <span><?php the_sub_field('day_of_week'); ?></span>
              <span><?php the_sub_field('date'); ?></span>
              <!-- <img src="<?php bloginfo('stylesheet_directory'); ?>/static/images/credit-cards.png" width="150" height="20px" alt=""> -->
                <!-- <a href="<?php the_sub_field('button_link'); ?>" class="btn btn-primary">Register</a> -->
            </div>
          <?php else: ?>
            <div class="content">
              <h4><?php the_sub_field('name'); ?></h4>
              <span><?php the_sub_field('price'); ?></span>
              <span><?php the_sub_field('day_of_week'); ?></span>
              <span><?php the_sub_field('date'); ?></span>
                <!-- <a href="<?php the_sub_field('button_link'); ?>" class="btn btn-primary">Register</a> -->
            </div>
          <?php endif; ?>
        </div>
        <?php $count++; ?>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>

<section class="schedule-promo">
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h2>Need More Info?</h2>
      </div>
      <div class="col-sm-4">
        <div class="btn-wrap">
            <a href="http://winterfest-live.localhost/?page_id=159" class="btn btn-primary">Contact</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="square-payment">
  <div class="container">
    <div class="row">
      <div class="col-md-6 order-2 order-md-1">
        <div class="content">
          <h4>Our Payment Processor</h4>
          <p class="intro">Laborum ipsum et amet irure culpa in veniam id officia commodo velit in. Do dolor velit veniam ipsum elit consequat proident magna. Excepteur eiusmod magna sint ipsum irure reprehenderit mollit.</p>
            <a href="https://squareup.com/" class="btn btn-primary">More On Square</a>
        </div>
      </div>
      <div class="col-md-6 order-1 order-md-2">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/static/images/square-payment.jpg" width="500" height="200" alt="">
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>
