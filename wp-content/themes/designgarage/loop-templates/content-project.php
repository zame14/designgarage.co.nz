<?php
$project = new Project($post);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 project-logo-wrapper">
                    <img src="<?=$project->getLogo()?>" alt="<?=$project->getTitle()?>" />
                </div>
                <div class="col-12 col-sm-6">
                    <h1><?=$project->getTitle()?></h1>
                    <?=$project->getContent()?>
                </div>
            </div>
            <div class="row gallery-wrapper">
                <?php
                $image1_id = getImageID($project->getGalleryImages()[0]);
                $image2_id = getImageID($project->getGalleryImages()[1]);
                $img_1 = wp_get_attachment_image_src($image1_id, 'gallery');
                $img_2 = wp_get_attachment_image_src($image2_id, 'gallery');
                ?>
                <div class="col-12 col-sm-6 image-wrapper">
                    <img src="<?=$img_1[0]?>" alt="" />
                </div>
                <div class="col-12 col-sm-6 image-wrapper">
                    <img src="<?=$img_2[0]?>" alt="" />
                </div>
                <?php
                foreach($project->getGalleryImages() as $key => $image) {
                   if($key < 2) {
                       continue;
                   }
                   echo '<div class="col-xl-12 image-wrapper"><img src="' . $image . '" alt="" /></div>';
                }
                ?>
            </div>
            <div class="row project-navigation">
                <div class="col-xl-12">
                    <?php
                    $previous = $project->previous();
                    if($previous->id() <> "") {
                        echo '<a href="' . $previous->link() . '" class="previous"><span>' . $previous->getTitle() . '</span></a>';
                    }
                    echo '<a href="' . get_page_link(8) . '" class="listing"><span class="fa fa-th"></span></a>';
                    $next = $project->next();
                    if($next->id() <> "") {
                        echo '<a href="' . $next->link() . '" class="next"><span>' . $next->getTitle() . '</span></a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>
