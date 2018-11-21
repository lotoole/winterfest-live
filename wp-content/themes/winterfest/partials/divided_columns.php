<section class="divided-columns">
    <div class="container">
        <div class="row">
            <?php if ( $columns = get_sub_field( 'columns' ) ) : foreach ( $columns as $column ) : ?>
            <div class="col-md-<?php echo 12 / count($columns); ?> d-flex flex-column justify-content-center">
                <?php echo $column['content']; ?>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
