<?php
//Template Name: Home Page
the_post();

get_header();

$hero_image = get_field('hero_image');
$hero_src = wp_get_attachment_image_src($hero_image, 'hero');
?>
<?php
  if ( have_rows( 'flexible_content' ) ) {
      while ( have_rows( 'flexible_content' ) ) {
          the_row();
          get_template_part( 'partials/' . get_row_layout() );
      }
  }
?>

<section class="home-video">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h5>Not sure what this event is about? Check out this video from last year!</h5>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/qUfixOH2fwQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>
