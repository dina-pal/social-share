<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Generate Shortcode for selected options
 */

require_once plugin_dir_path(__FILE__). 'network-data.php';

function css_social_share_options(){
	ob_start();
	// Get selected social network
	global $post;
	$post_id =  $post->ID;
	$url = get_permalink($post_id);
	$title = get_the_title($post_id);
	$content = get_the_content($post_id);
	$networks = get_option('css_social_items');
	$length = count($networks);
	$data =  '<div class="css_social_items">';
	for ($i = 0; $i< $length; $i++){
		$net = $networks[$i];
		$data .= css_social_networks($title, $url, $content, $net );
	}
	$data .= "</div>";
	echo $data;
return ob_get_clean();
}
add_shortcode('css_social_share', 'css_social_share_options');
