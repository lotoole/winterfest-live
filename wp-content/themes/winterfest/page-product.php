<?php
// Template Name: Product Page
the_post();

get_header();

?>
<div class="container">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; endif; ?>
</div>


<?php get_footer(); ?>
