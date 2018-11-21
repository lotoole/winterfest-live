<section class="block-columns">
  <div class="row gutter-2">
    <div class="col-sm-12">
      <div class="block">
        <h1><?php the_sub_field( 'title' ); ?></h1>
      </div>
    </div>

    <?php if ( $columns = get_sub_field( 'columns' ) ) : foreach ( $columns as $column ) : ?>
    <div class="col-md-<?php echo 12 / count($columns); ?> d-md-flex align-items-md-stretch">
      <div class="block">
        <div class="block-content">
          <?php echo $column['content']; ?>
        </div>
      </div>
    </div>
    <?php endforeach; endif; ?>
  </div>
</section>
