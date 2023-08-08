<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/30/2020
 * Time: 12:36 PM
 */
class Blog extends DGBase
{
    public function getTeaser()
    {
        return substr($this->getContent(),0,150) . ' <a href="' . $this->link() . '">[...]</a>';
    }
    public function getImage($size)
    {
        return get_the_post_thumbnail($this->Post, $size);
    }
}