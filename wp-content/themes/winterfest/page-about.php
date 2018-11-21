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
        <div class="grid">
          <div class="grid-sizer"></div>
          <div class="grid-item">
            <img src="https://fillmurray.com/300/300" alt="">
          </div>
          <div class="grid-item grid-item--width2">
            <img src="https://fillmurray.com/300/300" alt="">
          </div>
          <div class="grid-item">
            <img src="https://fillmurray.com/300/300" alt="">
          </div>
          <div class="grid-item grid-item--width2">
            <img src="https://fillmurray.com/300/300" alt="">
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="content">
          <?php the_field('mission_intro'); ?>
          <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
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
        <ul>
          <?php if( have_rows('list') ): $count=1; while( have_rows('list') ) : the_row(); ?>
            <li><?php the_sub_field('interest'); ?></li>
          <?php endwhile; endif; ?>
        </ul>
        <?php $image = get_field('contact_image'); $size = 'square_four'; ?>
        <?php echo wp_get_attachment_image( $image, $size ); ?>
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
        <?php if($count === 1): ?>
          <div class="col-md-6 beg-grant">
            <img src="https://fillmurray.com/300/100" alt="">
          </div>
        <?php else: ?>
          <div class="col-md-6 beg-grant">
            <img src="https://fillmurray.com/300/100" alt="">
          </div>
        <?php endif; ?>
      <div class="col-md-6">
        <div class="name-wrap">
          <h3><?php the_sub_field('company_name'); ?></h3>
        </div>
      </div>
      <div class="col-md-12">
        <h3 class="award">Awarded:<span>$<?php the_sub_field('award_amount'); ?></span></h3>
      </div>
      <div class="col-md-12 end-grant">
        <p><?php the_sub_field('company_intro'); ?></p>
        <a href="<?php the_sub_field('company_linnk'); ?>" class="btn btn-primary">More</a>
      </div>
        <?php $count++; ?>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
