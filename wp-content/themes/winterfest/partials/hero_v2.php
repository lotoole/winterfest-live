<?php

$hero_image = get_sub_field('hero_image');
$hero_src = wp_get_attachment_image_src($hero_image, 'hero');

?>
<section class="hero-v2" style="background-image: url(<?php echo $hero_src[0]; ?>)">
  <div class="hero-background"></div>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><?php the_sub_field('hero_title'); ?></h1>
        </div>
      </div>
    </div>
  </div>
</section>
