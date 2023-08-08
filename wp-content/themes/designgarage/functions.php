<?php
require_once('modal/class.Base.php');
require_once('modal/class.Project.php');
require_once('modal/class.FeatureProject.php');
add_action( 'wp_enqueue_scripts', 'p_enqueue_styles');
function p_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css?' . filemtime(get_stylesheet_directory() . '/css/bootstrap.min.css'));
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css?' . filemtime(get_stylesheet_directory() . '/css/font-awesome.css'));
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/style.css?' . filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js?' . filemtime(get_stylesheet_directory() . '/js/bootstrap.min.js'), array('jquery'));
    wp_enqueue_script( 'waypoint', get_stylesheet_directory_uri() . '/js/noframework.waypoints.min.js');
    wp_enqueue_script('understap-theme', get_stylesheet_directory_uri() . '/js/theme.js?' . filemtime(get_stylesheet_directory() . '/js/theme.js'), array('jquery'));
}
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_image_size( 'feature', 575, 510, true);
add_image_size( 'gallery', 770, 510, true);
add_image_size( 'feature_long', 768, 365, true);
add_image_size( 'feature_tall', 365, 760, true);
add_image_size( 'feature_square', 365, 365, true);

function dg_remove_page_templates( $templates ) {

    unset( $templates['page-templates/blank.php'] );

    unset( $templates['page-templates/right-sidebarpage.php'] );

    unset( $templates['page-templates/both-sidebarspage.php'] );

    unset( $templates['page-templates/empty.php'] );

    unset( $templates['page-templates/fullwidthpage.php'] );

    unset( $templates['page-templates/left-sidebarpage.php'] );

    unset( $templates['page-templates/right-sidebarpage.php'] );

    return $templates;

}
add_filter( 'theme_page_templates', 'dg_remove_page_templates' );

add_action('admin_init', 'my_general_section');
function my_general_section() {
    add_settings_section(
        'my_settings_section', // Section ID
        'Custom Website Settings', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field( // Option 1
        'phone', // Option ID
        'Phone Number', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'phone' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'email', // Option ID
        'Email', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'email' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'address', // Option ID
        'Address', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'address' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'facebook', // Option ID
        'Facebook Link', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'facebook' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'instagram', // Option ID
        'Instagram Link', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'instagram' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'linkedin', // Option ID
        'LinkedIn Link', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'linkedin' // Should match Option ID
        )
    );

    register_setting('general','phone', 'esc_attr');
    register_setting('general','email', 'esc_attr');
    register_setting('general','address', 'esc_attr');
    register_setting('general','facebook', 'esc_attr');
    register_setting('general','instagram', 'esc_attr');
    register_setting('general','linkedin', 'esc_attr');
}

function my_section_options_callback() { // Section Callback
    echo '';
}

function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

function formatPhoneNumber($ph) {
    $ph = str_replace('(', '', $ph);
    $ph = str_replace(')', '', $ph);
    $ph = str_replace(' ', '', $ph);
    $ph = str_replace('+64', '0', $ph);

    return $ph;
}
function getImageID($image_url)
{
    global $wpdb;
    $sql = 'SELECT ID FROM ' . $wpdb->prefix . 'posts WHERE guid = "' . $image_url . '"';
    $result = $wpdb->get_results($sql);

    return $result[0]->ID;
}

function getProjects() {
    $projects = Array();
    $posts_array = get_posts([
        'post_type' => 'project',
        'post_status' => 'publish',
        'numberposts' => -1,
        'order' => 'desc',
        'meta_query' => [
            [
                'key' => 'wpcf-hide-project',
                'value' => 0,
            ]
        ]
    ]);
    foreach ($posts_array as $post) {
        $project = new Project($post);
        $projects[] = $project;
    }
    return $projects;
}

function getProjectsByCategory($category) {
    $projects = Array();
    $posts_array = get_posts([
        'post_type' => 'project',
        'post_status' => 'publish',
        'numberposts' => -1,
        'order' => 'desc',
        'meta_query' => [
            [
                'key' => 'wpcf-project-categories',
                'value' => $category
            ]
        ]
    ]);
    foreach ($posts_array as $post) {
        $project = new Project($post);
        $projects[] = $project;
    }
    return $projects;
}

function getFeatureProjects() {
    $projects = Array();
    $posts_array = get_posts([
        'post_type' => 'feature-project',
        'post_status' => 'publish',
        'numberposts' => -1,
        'order' => 'asc'
    ]);
    foreach ($posts_array as $post) {
        $project = new FeatureProject($post);
        $projects[] = $project;
    }
    return $projects;
}

function projectTiles_shortcode() {
    $html = '
    <div class="row category-nav-wrapper">
        <div class="col-xl-12">
            <ul>
                <li><a href="javascript:;" onclick="filterCategory(0)">All</a></li>
                <li><a href="javascript:;" onclick="filterCategory(1)">Graphic Design</a></li>
                <li><a href="javascript:;" onclick="filterCategory(2)">Branding</a></li>
                <li><a href="javascript:;" onclick="filterCategory(3)">Website</a></li>
                <li><a href="javascript:;" onclick="filterCategory(4)">Logo Design</a></li>
            </ul>
        </div>
    </div>
    <div class="row project-tiles-wrapper">';
    foreach (getProjects() as $project) {
        $imageid = getImageID($project->getFeatureImage());
        $img = wp_get_attachment_image_src($imageid, 'feature');
        $html .= '
        <div class="col-12 col-sm-6 col-md-4 project-tile">
            <a href="' . $project->link() . '">
                <div class="image-wrapper">
                    <img src="' . $img[0] . '" alt="' . $project->getTitle() . '" />
                </div>
                <div class="content-wrapper">
                    <h2>' . $project->getTitle() . '</h2>
                    <ul>';
        foreach ($project->getCategories() as $category) {
            $html .= '<li>' . $category[0] . '</li>';
        }
        $html .= '
                    </ul>
                    <span>view</span>
                </div>
                <div class="tile-overlay"></div>
            </a>
        </div>';
    }
    $html .= '
    </div>';

    return $html;
}
add_shortcode('projects', 'projectTiles_shortcode');

add_filter( 'excerpt_length', function($length) {
    return 20;
} );

function socialMediaMenu() {
    $html = '
    <ul class="social-media">';
    if(get_option('facebook')) {
        $html .= '<li><a href="' . get_option('facebook') . '" target="_blank" class="fa fa-facebook-square"></a>';
    }
    if(get_option('instagram')) {
        $html .= '<li><a href="' . get_option('instagram') . '" target="_blank" class="fa fa-instagram"></a>';
    }
    if(get_option('linkedin')) {
        $html .= '<li><a href="' . get_option('linkedin') . '" target="_blank" class="fa fa-linkedin-square"></a>';
    }
    $html .= '</ul>';

    return $html;
}

function featureProjects_shortcode() {
    $projects = getFeatureProjects();
    $grid_image_1 = getImageID($projects[0]->getFeatureImage());
    $project1 = $projects[0]->getProject();
    $img1 = wp_get_attachment_image_src($grid_image_1, 'feature_long');

    $grid_image_2 = getImageID($projects[1]->getFeatureImage());
    $project2 = $projects[1]->getProject();
    $img2 = wp_get_attachment_image_src($grid_image_2, 'feature_long');

    $grid_image_3 = getImageID($projects[2]->getFeatureImage());
    $project3 = $projects[2]->getProject();
    $img3 = wp_get_attachment_image_src($grid_image_3, 'feature_square');

    $grid_image_4 = getImageID($projects[3]->getFeatureImage());
    $project4 = $projects[3]->getProject();
    $img4 = wp_get_attachment_image_src($grid_image_4, 'feature_square');

    $grid_image_5 = getImageID($projects[4]->getFeatureImage());
    $project5 = $projects[4]->getProject();
    $img5 = wp_get_attachment_image_src($grid_image_5, 'feature_tall');

    $grid_image_6 = getImageID($projects[5]->getFeatureImage());
    $project6 = $projects[5]->getProject();
    $img6 = wp_get_attachment_image_src($grid_image_6, 'feature_square');

    $grid_image_7 = getImageID($projects[6]->getFeatureImage());
    $project7 = $projects[6]->getProject();
    $img7 = wp_get_attachment_image_src($grid_image_7, 'feature_square');

    $grid_image_8 = getImageID($projects[7]->getFeatureImage());
    $project8 = $projects[7]->getProject();
    $img8 = wp_get_attachment_image_src($grid_image_8, 'feature_long');

    $html = '
    <div class="row grid-row-1">
        <div class="col-12 col-sm-6">
            <div class="project-tile" data-bg="' . $projects[0]->getBgColour() . '">
                <a href="' . $project1->link() . '">
                    <div class="image-wrapper">
                        <img src="' . $img1[0] . '" alt="' . $project1->getTitle() . '" />
                    </div>
                    <div class="content-wrapper">
                        <h2>' . $project1->getTitle() . '</h2>
                        <ul>';
    foreach ($project1->getCategories() as $category) {
        $html .= '<li>' . $category[0] . '</li>';
    }
    $html .= '
                        </ul>
                        <span><i>view</i></span>
                    </div>
                    <div class="tile-overlay"></div>
                </a>
            </div>        
        </div>
        <div class="col-12 col-sm-6">
            <div class="project-tile" data-bg="' . $projects[1]->getBgColour() . '">
                <a href="' . $project2->link() . '">
                    <div class="image-wrapper">
                        <img src="' . $img2[0] . '" alt="' . $project2->getTitle() . '" />
                    </div>
                    <div class="content-wrapper">
                        <h2>' . $project2->getTitle() . '</h2>
                        <ul>';
    foreach ($project2->getCategories() as $category) {
        $html .= '<li>' . $category[0] . '</li>';
    }
    $html .= '
                        </ul>
                        <span><i>view</i></span>
                    </div>
                    <div class="tile-overlay"></div>                                   
                </a>                                 
            </div>
        </div>
    </div>
    <div class="row grid-row-2">
        <div class="col-12 col-sm-6 col-md-3 col-1">
            <div class="project-tile square" data-bg="' . $projects[2]->getBgColour() . '">
                <a href="' . $project3->link() . '">
                    <div class="image-wrapper">
                        <img src="' . $img3[0] . '" alt="' . $project3->getTitle() . '" />
                    </div>
                    <div class="content-wrapper">
                        <h2>' . $project3->getTitle() . '</h2>
                        <ul>';
    foreach ($project3->getCategories() as $category) {
        $html .= '<li>' . $category[0] . '</li>';
    }
    $html .= '
                        </ul>
                        <span><i>view</i></span>
                    </div>
                    <div class="tile-overlay"></div>                                   
                </a>                    
            </div>
            <div class="project-tile square" data-bg="' . $projects[3]->getBgColour() . '">
                <a href="' . $project4->link() . '">
                    <div class="image-wrapper">
                        <img src="' . $img4[0] . '" alt="" />
                    </div>
                    <div class="content-wrapper">
                        <h2>' . $project4->getTitle() . '</h2>
                        <ul>';
    foreach ($project4->getCategories() as $category) {
        $html .= '<li>' . $category[0] . '</li>';
    }
    $html .= '
                        </ul>
                        <span><i>view</i></span>
                    </div>
                    <div class="tile-overlay"></div>  
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-2">
            <div class="project-tile" data-bg="' . $projects[4]->getBgColour() . '">
                <a href="' . $project5->link() . '">
                    <div class="image-wrapper">
                        <img src="' . $img5[0] . '" alt="' . $project5->getTitle() . '" />
                    </div>
                    <div class="content-wrapper">
                        <h2>' . $project5->getTitle() . '</h2>
                        <ul>';
    foreach ($project5->getCategories() as $category) {
        $html .= '<li>' . $category[0] . '</li>';
    }
    $html .= '
                        </ul>
                        <span><i>view</i></span>
                    </div>
                    <div class="tile-overlay"></div>                                   
                </a>                    
            </div>         
        </div>
        <div class="col-12 col-sm-12 col-md-6">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="project-tile square" data-bg="' . $projects[5]->getBgColour() . '">
                        <a href="' . $project6->link() . '">
                            <div class="image-wrapper">
                                <img src="' . $img6[0] . '" alt="' . $project6->getTitle() . '" />
                            </div>
                            <div class="content-wrapper">
                                <h2>' . $project6->getTitle() . '</h2>
                                <ul>';
    foreach ($project6->getCategories() as $category) {
        $html .= '<li>' . $category[0] . '</li>';
    }
    $html .= '
                                </ul>
                                <span><i>view</i></span>
                            </div>
                            <div class="tile-overlay"></div>                                   
                        </a>                    
                    </div>            
                </div>
                <div class="col-12 col-sm-6">
                    <div class="project-tile square" data-bg="' . $projects[6]->getBgColour() . '">
                        <a href="' . $project7->link() . '">
                            <div class="image-wrapper">
                                <img src="' . $img7[0] . '" alt="' . $project7->getTitle() . '" />
                            </div>
                            <div class="content-wrapper">
                                <h2>' . $project7->getTitle() . '</h2>
                                <ul>';
    foreach ($project7->getCategories() as $category) {
        $html .= '<li>' . $category[0] . '</li>';
    }
    $html .= '
                                </ul>
                                <span><i>view</i></span>
                            </div>
                            <div class="tile-overlay"></div>                                   
                        </a>                    
                    </div>           
                </div>
                <div class="col-xl-12 image-8-wrapper">
                    <div class="project-tile" data-bg="' . $projects[7]->getBgColour() . '">
                        <a href="' . $project8->link() . '">
                            <div class="image-wrapper">
                                <img src="' . $img8[0] . '" alt="' . $project8->getTitle() . '" />
                            </div>
                            <div class="content-wrapper">
                                <h2>' . $project8->getTitle() . '</h2>
                                <ul>';
    foreach ($project8->getCategories() as $category) {
        $html .= '<li>' . $category[0] . '</li>';
    }
    $html .= '
                                </ul>
                                <span><i>view</i></span>
                            </div>
                            <div class="tile-overlay"></div>                                   
                        </a>                    
                    </div>          
                </div>
            </div>
        </div>
    </div>';

    return $html;
}
add_shortcode('feature_projects', 'featureProjects_shortcode');

if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] == "filter_category") {
    $html = '';
    $filter_category = '';
    if($_REQUEST['categoryid'] > 0) {
        // filter results
        switch ($_REQUEST['categoryid']) {
            case 1:
                // Graphic Design
                $filter_category  = 'Graphic Design';
                break;
            case 2:
                // Branding
                $filter_category  = 'Branding';
                break;
            case 3:
                // Website
                $filter_category  = 'Website';
                break;
            case 4:
                // Logo Design
                $filter_category  = 'Logo Design';
                break;
        }
        foreach (getProjects() as $project) {
            $options = get_post_meta( $project->id(), 'wpcf-project-categories' );
            $options_values = array_values( $options[0] );
            $filter = false;
            // check if we have a matching category
            foreach($options_values as $value) {
                if($value[0] == $filter_category) {
                    $filter = true;
                    break;
                }
            }
            if($filter) {
                $imageid = getImageID($project->getFeatureImage());
                $img = wp_get_attachment_image_src($imageid, 'feature');
                $html .= '
                <div class="col-12 col-sm-6 col-md-4 project-tile ani-in">
                    <a href="' . $project->link() . '">
                        <div class="image-wrapper">
                            <img src="' . $img[0] . '" alt="' . $project->getTitle() . '" />
                        </div>
                        <div class="content-wrapper">
                            <h2>' . $project->getTitle() . '</h2>
                            <ul>';
                foreach ($project->getCategories() as $category) {
                    $html .= '<li>' . $category[0] . '</li>';
                }
                $html .= '
                            </ul>
                            <span>view</span>
                        </div>
                        <div class="tile-overlay"></div>
                    </a>
                </div>';
            }

        }
    } else {
        foreach (getProjects() as $project) {
            $imageid = getImageID($project->getFeatureImage());
            $img = wp_get_attachment_image_src($imageid, 'feature');
            $html .= '
            <div class="col-12 col-sm-6 col-md-4 project-tile">
                <a href="' . $project->link() . '">
                    <div class="image-wrapper">
                        <img src="' . $img[0] . '" alt="' . $project->getTitle() . '" />
                    </div>
                    <div class="content-wrapper">
                        <h2>' . $project->getTitle() . '</h2>
                        <ul>';
            foreach ($project->getCategories() as $category) {
                $html .= '<li>' . $category[0] . '</li>';
            }
            $html .= '
                        </ul>
                        <span>view</span>
                    </div>
                    <div class="tile-overlay"></div>
                </a>
            </div>';
        }
    }
    echo $html;
    exit;
}
function bannerVideo_shortcode()
{
    $html = '<div class="banner-video-wrapper">
        <video id="dgVideo" muted="" autoplay loop playsinline>
            <source src="' . get_field('dg_video_link',7) . '" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>';

    return $html;
}
add_shortcode('banner_video', 'bannerVideo_shortcode');
function footer_widget_init()
{
    register_sidebar( array(
        'name'          => __( 'Footer Widget', 'understrap' ),
        'id'            => 'footerwidget',
        'description'   => 'Widget area in the footer',
        'before_widget'  => '<div class="footer-widget-wrapper">',
        'after_widget'   => '</div><!-- .footer-widget -->',
        'before_title'   => '<h3 class="widget-title">',
        'after_title'    => '</h3>',
    ) );
}
add_action( 'widgets_init', 'footer_widget_init' );
add_action('init', 'dg_register_menus');
function dg_register_menus() {
    register_nav_menus(
        Array(
            'footer-menu' => __('Footer Menu'),
        )
    );
}