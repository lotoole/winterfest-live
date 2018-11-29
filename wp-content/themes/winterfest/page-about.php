<?php
//Template Name: About Page
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
<section class="mission">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="image-wrap">
          <div class="image-1">
            <?php
            $image_1 = get_field('image_1');
            $image_2 = get_field('image_2');
            ?>
            <img src="<?php echo $image_1['url']; ?>" alt="">
          </div>
          <div class="image-2">
            <img src="<?php echo $image_2['url']; ?>" alt="">
          </div>
        </div>
        <!-- <div class="grid">
          <div class="grid-sizer"></div>
          <?php //if( have_rows('mission_images') ): while( have_rows('mission_images') ) : the_row(); ?>
            <?php //$grid_image = get_sub_field('image'); ?>
          <div class="grid-item">
            <img src="<?php //echo $grid_image['url']; ?>" width="300px" height="300px" alt="">
          </div>
          <?php //endwhile; endif; ?>
        </div> -->
      </div>
      <div class="col-md-6">
        <div class="content">
          <?php the_field('mission_intro'); ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="contact">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><?php the_field('title'); ?></h1>
      </div>
      <div class="col-md-6">
        <p class="intro"><?php the_field('interest_promo'); ?></p>
        <?php $image = get_field('contact_image'); ?>
        <img src="<?php echo $image['url']; ?>" width="150px" height="150px" alt="">
      </div>
      <div class="col-md-6">
        <?php echo do_shortcode('[contact-form-7 id="137" title="Main Contact Form"]'); ?>
      </div>
    </div>
  </div>
</section>

<section class="grants">
  <div class="container">
    <div class="row">
      <div class="col-md-12 numero-uno">
        <div class="intro-wrap">
          <h1><?php the_field('grant_title'); ?></h1>
          <p class="intro"><?php the_field('grant_intro'); ?></p>
        </div>
      </div>
      <?php if( have_rows('grant') ): $count=1; while( have_rows('grant') ) : the_row(); ?>
        <?php $image = get_sub_field('image'); ?>
        <?php if($count === 1): ?>
          <div class="col-md-12 beg-grant">
            <img src="<?php echo $image['url']; ?>" width="300" height="100" alt="">
          </div>
        <?php else: ?>
          <div class="col-md-12 beg-grant">
            <img src="<?php echo $image['url']; ?>" width="300" height="100" alt="">
          </div>
        <?php endif; ?>
      <div class="col-md-12">
        <h3><?php the_sub_field('company_name'); ?></h3>
      </div>
      <div class="col-md-12">
        <h5 class="award">Awarded: <span>$<?php the_sub_field('award_amount'); ?></span></h5>
      </div>
      <div class="col-md-12 end-grant">
        <p><?php the_sub_field('company_intro'); ?></p>
      </div>
        <?php $count++; ?>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
