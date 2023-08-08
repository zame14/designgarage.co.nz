<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/4/2019
 * Time: 4:07 PM
 */
class Project extends DGBase
{
    public function getFeatureImage()
    {
        return $this->getPostMeta('project-feature-image');
    }
    public function getLogo()
    {
        return $this->getPostMeta('project-logo');
    }
    public function getCategories()
    {
        return $this->getPostMeta('project-categories');
    }
    public function getDescription()
    {
        $content = wpautop($this->getPostMeta('project-description'));
        return $content;
    }
    public function getGalleryImages()
    {
        $gallery = Array();
        $field = get_post_meta($this->id());
        foreach($field['wpcf-project-gallery-images'] as $image) {
            $gallery[] = $image;
        }
        return $gallery;
    }
    public function previous()
    {
        global $wpdb;
        $sql = '
        SELECT p.ID
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.ID < ' . $this->Post->ID . '
        AND post_status="publish" 
        AND post_type="project" 
        ORDER BY p.ID DESC
        LIMIT 1';
        $result = $wpdb->get_results($sql);

        $previd = $result[0]->ID;
        if($previd == "") {
            $sql1 = '
            SELECT p.ID 
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="project"
            ORDER BY p.ID DESC
            LIMIT 1';
            $result1 = $wpdb->get_results($sql1);

            $previd = $result1[0]->ID;

        }

        return new Project($previd);
    }
    public function next()
    {
        global $wpdb;
        $sql = '
        SELECT p.ID 
        FROM ' . $wpdb->prefix . 'posts p
        WHERE p.ID > ' . $this->Post->ID . '
        AND post_status="publish" 
        AND post_type="project" 
        ORDER BY p.ID ASC
        LIMIT 1';
        $result = $wpdb->get_results($sql);

        $nextid = $result[0]->ID;
        if($nextid == "") {
            $sql1 = '
            SELECT p.ID 
            FROM ' . $wpdb->prefix . 'posts p
            WHERE post_status="publish" 
            AND post_type="project"
            ORDER BY p.ID ASC
            LIMIT 1';
            $result1 = $wpdb->get_results($sql1);

            $nextid = $result1[0]->ID;

        }
        return new Project($nextid);
    }
}