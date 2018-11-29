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



<?php get_footer(); ?>
