<?php 

add_action("publish_post", "cwp_create_sitemap");
add_action("publish_page", "cwp_create_sitemap");

add_action('wp_before_admin_bar_render', 'cwp_update_admin_bar');

add_filter('manage_posts_columns', 'cwp_posts_columns', 5);
add_action('manage_posts_custom_column', 'cwp_posts_custom_columns', 5, 2);

?>