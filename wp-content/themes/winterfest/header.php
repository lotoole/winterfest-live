<!doctype html>
<html class="no-js" lang="">
    <head>
        <?php get_template_part( 'partials/gtm' ); ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php wp_title(); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
        <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    </head>

    <body <?php body_class(); ?> id="top">
      <header>
        <a class="logo" href="<?php echo site_url( '/' ); ?>">
            <img src="<?php bloginfo('stylesheet_directory'); ?>/static/images/logo-trans.png" alt="">
        </a>

        <div class="social-links">
          <a target="_blank" href="https://www.facebook.com/WaterburyWinterfest/"><i class="fab fa-facebook-square"></i></a>
          <a target="_blank" href="https://www.instagram.com/waterbury.winterfest/"><i class="fab fa-instagram"></i></a>
          <a href="http://kxf.dc8.myftpupload.com/cart/"><i class="fas fa-shopping-cart"></i></a>
        </div>

          <nav class="primary">
              <div class="primary-nav-wrap">
                  <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
              </div>
          </nav>
          <nav class="mobile">
            <div class="mobile-track">
              <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
              <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container' => false ) ); ?>
            </div>
          </nav>
        <a href="#" class="mobile-nav-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
      </header>
