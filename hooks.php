<?php 

add_action("publish_post", "cwp_create_sitemap");
add_action("publish_page", "cwp_create_sitemap");

add_action('wp_before_admin_bar_render', 'cwp_update_admin_bar');

?>