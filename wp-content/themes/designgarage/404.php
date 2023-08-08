<?php
get_header(); ?>

    <div class="wrapper wrapper-404" id="wrapper-index">
        <div id="content" class="container">
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <div class="row">
                        <div class="col-xl-12">
                            <section class="error-404 not-found">
                                <h1>404 Error - Page Not Found</h1>
                                <div class="page-content">
                                    <p>Oops… something hasn’t quite gone right!</p>
                                    <p>The page you were looking for doesn't exist anymore or might have been moved.</p>
                                    <p>Please try the following:</p>
                                    <ul>
                                        <li>If you typed the page address in the address bar, make sure it is spelled correctly.</li>
                                        <li>Open the <a href="<?=get_home_url()?>"><?=substr(get_home_url(), strpos(get_home_url(), '://') + 3)?></a> home page, and then look for links to information you want.</li>
                                        <li>Click the <a href="javascript:history.back(1)">back</a> button to try another link.</li>
                                    </ul>
                                </div>
                            </section>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
<?php get_footer(); ?>