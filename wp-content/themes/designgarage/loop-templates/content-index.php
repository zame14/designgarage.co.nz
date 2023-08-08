<?php

?>
    <div class="col-12 col-sm-6 col-md-4 blog-panel-wrapper">
        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <a href="<?=get_permalink()?>">
                <div class="blog-image-wrapper">
                    <?=get_the_post_thumbnail( $post->ID, 'feature' )?>
                </div>
                <div class="blog-content-wrapper">
                    <h2><?=the_title()?></h2>
                    <?=the_excerpt()?>
                </div>
            </a>
        </article>
    </div>
