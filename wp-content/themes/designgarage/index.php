<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
    <?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="index-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-title">
                    <h1>Blog</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="content" tabindex="-1">

        <div class="row">

            <div class="col-xl-12">

            <main class="site-main" id="main">
                <div class="row row-eq-height">

                <?php if ( have_posts() ) : ?>

                    <?php /* Start the Loop */ ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'loop-templates/content', 'index' );
                        ?>

                    <?php endwhile; ?>

                <?php else : ?>

                    <?php get_template_part( 'loop-templates/content', 'none' ); ?>

                <?php endif; ?>
                </div>
            </main><!-- #main -->

            </div>


        </div><!-- .row -->


    </div><!-- Wrapper end -->

<?php get_footer(); ?>
