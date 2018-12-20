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
      <?php if( have_rows('event') ): while( have_rows('event') ) : the_row(); ?>
        <div class="col-md-4">
          <div class="content">
            <h4><?php the_sub_field('name'); ?></h4>
            <span><?php the_sub_field('price'); ?></span>
            <span><?php the_sub_field('day_of_week'); ?></span>
            <span><?php the_sub_field('date'); ?></span>
              <a href="<?php the_sub_field('button_link'); ?>" class="btn btn-primary">Tickets</a>
          </div>
        </div>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>

<section class="schedule-promo">
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h2><?php the_field('promo_title'); ?></h2>
      </div>
      <div class="col-sm-4">
        <div class="btn-wrap">
            <a href="<?php the_field('promo_link'); ?>" class="btn btn-primary"><?php the_field('promo_button_text'); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>
