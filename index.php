<?php

/**
 * Plugin Name: Custom WP
 * Description:  A little plugin use to improve our Wordpress user experience (sitemap, improve dashboard) 
 * Author: Ludovic Vimont
 * Version: 1.0
 * Author URI: https://github.com/1ud0v1c/customwp
 */

require_once "hooks.php";
require_once "Sitemap.php";
require_once "WordpressData.php";

function cwp_create_sitemap() {
    $sitemap = new Sitemap;
    $sitemap->add_entry(WordpressData::get_domain_name());

    foreach (WordpressData::get_pages() as $page) {
        $sitemap->add_entry($page);
    }

    foreach (WordpressData::get_authors() as $author) {
        $sitemap->add_entry($author);
    }

    foreach (WordpressData::get_categories() as $category) {
        $sitemap->add_entry($category);
    }

    foreach(WordpressData::get_posts() as $post) {
        setup_postdata($post);
        $postdate = explode(" ", $post->post_modified);
        $sitemap->add_entry_with_last_modification(get_permalink($post->ID), $postdate[0]);
    }

    $sitemap->end();
    $sitemap->write();
}

function cwp_update_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}

function cwp_posts_columns($defaults){
    $begin_of_columns = array_slice($defaults, 0, 2, true);
    $end_of_columns = array_slice($defaults, 2, count($defaults) - 1, true);
    $image_column = array('thumbs' => __('Image'));
    return $begin_of_columns + $image_column + $end_of_columns;
}

function cwp_posts_custom_columns($column_name, $id){
    switch ($column_name) {
        case 'thumbs':
            if(has_post_thumbnail()) {
                $size = array(100,100);
                $options = array();
                echo the_post_thumbnail($size, $options);
            }
            break;

        default:
            break;
    }
}

?>