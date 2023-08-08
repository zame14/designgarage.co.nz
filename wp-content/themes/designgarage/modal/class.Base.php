<?php

class DGBase
{
    public $Post = null;

    function __construct($post)
    {
        // If an ID is passed instead then change for a post array
        if(intval($post)) $post = get_post($post);
        $this->Post = $post;
    }

    public function id() {
        return $this->Post->ID;
    }

    function getPostMeta($meta, $prefix = true) {
        if($prefix) $meta = 'wpcf-' . $meta;
        return get_post_meta($this->Post->ID, $meta, true);
    }


    public function getTitle()
    {
        $title = get_the_title($this->Post);
        return $title;
    }

    public function getContent()
    {
        $content = wpautop($this->Post->post_content);
        return $content;
    }

    public function link()
    {
        return esc_url(get_the_permalink($this->Post));
    }
    /*
        public function getImage($size = 'large')
        {
            return get_the_post_thumbnail($this->Post, $size);
        }
    */
}
