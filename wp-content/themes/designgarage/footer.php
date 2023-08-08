<?php

/**

 * The template for displaying the footer.

 *

 * Contains the closing of the #content div and all content after

 *

 * @package understrap

 */
?>
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="inner-wrapper">
                    <div class="f-col f-col-1">
                        <?php
                        if(is_active_sidebar('footerwidget')){
                            dynamic_sidebar('footerwidget');
                        }
                        ?>
                    </div>
                    <div class="f-col f-col-2">
                        <h3>Services</h3>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer-menu',
                                'container_class' => '',
                                'menu_class' => 'footer-menu',
                                'fallback_cb' => '',
                                'menu_id' => 'footer-menu'
                            )
                        );
                        ?>
                    </div>
                    <div class="f-col f-col-3">
                        <h3>Connect</h3>
                        <?=socialMediaMenu()?>
                    </div>
                    <div class="f-col f-col-4">
                        <h3>Ready to be seen?</h3>
                        <p>let's elevate your brand - together.</p>
                        <a href="<?=get_page_link(9)?>" class="btn btn-primary">Enquire now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="copyright">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul>
                    <li>copyright Design Garage <?=date('Y')?></li>
                    <li><a href="<?=get_page_link(6495)?>">privacy policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php wp_footer(); ?>
</body>
</html>