<?php
	class WordpressData {
		static function get_domain_name() {
			return "https://". $_SERVER['SERVER_NAME'] ."/";
		}

		static function get_pages() {
			$pages = array();

		    $post_per_page = get_option('posts_per_page');
		    $count_posts = wp_count_posts();
		    $nb_posts = $count_posts->publish;
		    $nb_pages = ceil($nb_posts / $post_per_page);

		    for ($i=0; $i < $nb_pages; $i++) {
		    	$pages[] = "https://". $_SERVER['SERVER_NAME'] ."/page/".($i+1)."/";
		    }

		    $args = array(
		        'sort_order' => 'asc',
		        'sort_column' => 'post_title',
		        'hierarchical' => 1,
		        'child_of' => 0,
		        'parent' => -1,
		        'offset' => 0,
		        'post_type' => 'page',
		        'post_status' => 'publish'
		    );
		    foreach (get_pages($args) as $publish_page) {
		        $pages[] = "https://".$_SERVER['SERVER_NAME']."/".$publish_page->post_name ."/";
		    }

		    return $pages;
		}

		static function get_authors() {
			$users = array();

			 $args = array(
		        'blog_id'      => $GLOBALS['blog_id'],
		        'meta_query'   => array(),
		        'include'      => array(),
		        'exclude'      => array(),
		        'orderby'      => 'login',
		        'order'        => 'ASC',
		        'count_total'  => false,
		        'fields'       => 'all',
	     	);
 		    foreach (get_users($args) as $author) {
		        $users[] = "https://".$_SERVER['SERVER_NAME']."/author/".$author->user_nicename ."/";
		    }

    		return $users;
		}

		static function get_categories() {
			$categories = array();

		    $args = array(
		        'type'                     => 'post',
		        'child_of'                 => 0,
		        'orderby'                  => 'name',
		        'order'                    => 'ASC',
		        'hide_empty'               => 1,
		        'hierarchical'             => 1,
		        'taxonomy'                 => 'category',
		        'pad_counts'               => false
		    );
 		    foreach (get_categories($args) as $category) {
		        $categories[] = "https://".$_SERVER['SERVER_NAME']."/category/".$category->slug ."/";
		    }
		    
    		return $categories;
		}

		static function get_posts() {
			$args = array(
				'numberposts' => -1,
		        'orderby' => 'modified',
		        'post_type'  => array('post'),
		        'order'    => 'DESC'
		    );
		    return get_posts($args);
		}
	}
?>