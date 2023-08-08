<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */
$page_title = get_post_meta($post->ID, 'wpcf-page-slogan', true);
if($page_title == "") $page_title = get_the_title();
get_header(); ?>

    <div class="wrapper" id="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title">
                        <h1><?=$page_title?></h1>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(is_front_page())
        {
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 nopadding">
                        <?=do_shortcode('[banner_video]')?>
                    </div>
                </div>
            </div>
            <?php
        } else {
            if (has_post_thumbnail()) {
                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 nopadding">
                            <div class="page-banner-wrapper test">
                                <?= get_the_post_thumbnail($post->ID, 'full') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
            ?>
        <div id="content" class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'loop-templates/content', 'page' ); ?>
                                <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                                ?>
                            <?php endwhile; // end of the loop. ?>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>