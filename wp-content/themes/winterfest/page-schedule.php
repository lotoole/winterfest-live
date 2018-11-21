<?php
//Template Name: Schedule Page
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

<section class="skip-to">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Scroll To Day:</h2>
        <ul>
          <?php if( have_rows('days_buttons') ): while( have_rows('days_buttons') ): the_row(); ?>
              <?php $ID = strtolower(get_sub_field('text')); ?>
              <li><a href="#<?php echo preg_replace('/\s+/', '', $ID); ?>"><?php the_sub_field('text'); ?></a></li>
            <?php endwhile; endif; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php if( have_rows('day') ): while( have_rows('day') ): the_row(); ?>
  <?php
  $image_class = 'right' == get_sub_field('alignment') ? '' : '';
  $content_class = 'right' == get_sub_field('alignment') ? 'order-last order-md-first' : '';
  $ID = strtolower(get_sub_field('hero_title'));
  $day_image = get_sub_field('hero_image');
  ?>
<section id="<?php echo preg_replace('/\s+/', '', $ID); ?>" class="day">
  <div class="container">
    <div class="row">
      <div class="<?php echo $content_class; ?> col-md-6">
        <h3><?php the_sub_field('title'); ?></h3>
        <?php the_sub_field('events'); ?>
      </div>
      <div class="<?php echo $image_class; ?> order-first col-md-6">
        <div class="day-title" style="background-image: url(<?php echo $day_image['url']; ?>)">
          <h3><?php the_sub_field('hero_title'); ?></h3>
          <span><?php the_sub_field('hero_date'); ?></span>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endwhile; endif; ?>


<?php get_footer(); ?>
