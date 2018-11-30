<?php

$hero_image = get_sub_field('hero_image');
$hero_src = wp_get_attachment_image_src($hero_image, 'hero');

?>
<section class="hero-v1" style="background-image: url(<?php echo $hero_src[0]; ?>)">
  <div class="hero-background"></div>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><?php the_sub_field('hero_title'); ?></h1>
          <p class="intro"><?php the_sub_field('hero_desc'); ?></p>
        </div>
        <?php $file = get_sub_field('file'); ?>
        <div class="col-12">
          <a href="<?php echo $file['url']; ?>" class="btn btn-primary"><?php the_sub_field('file_text'); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>
