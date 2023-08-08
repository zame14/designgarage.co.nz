<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/8/2019
 * Time: 3:55 PM
 */
class FeatureProject extends DGBase
{
    public function getFeatureImage()
    {
        return $this->getPostMeta('feature-image');
    }

    public function getProject1() {
        global $wpdb;
        // get the project assigned as this feature project
        $sql = 'SELECT child_id FROM ' . $wpdb->prefix . 'toolset_associations WHERE parent_id = ' . $this->Post->ID;
        $result = $wpdb->get_results($sql);

        return new Project($result[0]->child_id);
    }
    function getProject()
    {
        $parent_id = $this->id();
        $relationship_slug = 'the-feature-project';
        $project_id = toolset_get_related_posts(
            $parent_id,
            $relationship_slug,
            'parent',
            10,0,
            array(),
            'post_id',
            'child'
        );
        return new Project($project_id[0]);
    }
    public function getBgColour()
    {
        return $this->getPostMeta('hover-colour');
    }
}