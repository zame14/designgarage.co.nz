<?php
$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserra:wght@400;500;600&family=Inter:wght@200;400;600&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <?php wp_head(); ?>


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CW75ZLSH4B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-CW75ZLSH4B');
    </script>

    <meta name="facebook-domain-verification" content="ve5gglw01exrwv59lozjj4fyyguby2" />
    <!-- Mailchimp popup form -->
    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/c56424bdcbaa2373ffae9407b/937f77ba6eb391f278b8d0539.js");</script>
</head>

<body <?php body_class(); ?>>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>

<div class="hfeed site" id="page">
    <section id="header">
        <a name="top"></a>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 nopadding">
                    <div class="inner-wrapper">
                        <div class="logo-wrapper">
                            <?=the_custom_logo()?>
                        </div>
                        <div id="rk-menu-wrapper">
                            <div class="main-nav wrapper-fluid wrapper-navbar" id="wrapper-navbar">
                                <nav class="site-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                                    <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'primary',
                                            'container_class' => '',
                                            'menu_class' => 'nav navbar-nav',
                                            'fallback_cb' => '',
                                            'menu_id' => 'main-menu',
                                        )
                                    );
                                    ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>