<?php
/**
 * Plugin Name:       Social Share
 * Plugin URI:        https://dinapal.tech
 * Description:       The Custom Plugin for Content Social Share
 * Version:           1.0.0
 * Author:            Dinabandhu Pal
 * Author URI:        https://dinapal.tech
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-social-share
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define( 'CSS_VERSION', '1.0.0' );

// Initialized the plugin
add_action('plugins_loaded', 'css_load_textdomain');
add_action( 'admin_menu', 'css_create_settings' );
add_action('admin_post_social_icons_save', 'save_social_share_post');
add_action('admin_post_nopriv_social_icons_save', 'save_social_share_post');

// Include require Files Files
require_once plugin_dir_path(__FILE__) .'inc/enqueue_scripts.php';
require_once plugin_dir_path(__FILE__) .'public/css-shortcode.php';
require_once plugin_dir_path(__FILE__) .'public/show-in-frontend.php';

// add admin menu page for managing the plugin actions.
function css_create_settings(){
	$GLOBALS['social-share'] = add_menu_page(
		__('Social Share', 'custom-social-share'),
		__('Social Share', 'custom-social-share'),
		'manage_options',
		'social-share',
		'css_settings_content',
		'dashicons-share',
		10
	);
}

//The content option for admin managing page
function css_settings_content(){
	require_once plugin_dir_path(__FILE__) .'inc/option-page.php';
}

function css_load_textdomain(){
	 load_plugin_textdomain('custom-social-share', false,  dirname( plugin_basename( __FILE__ ) ) .'/languages/');
}


// Save the setting data in database.
function save_social_share_post(){
	$items = [];
	$post_types = [];
	$post_types_options = [];
	if(isset($_POST)){
		// Save Social Icons
		foreach( $_POST['css_social_items'] as $value ) {
	        array_push($items, $value);
	    }
		update_option('css_social_items', $items);
		// Save Supported Post Types
		foreach( $_POST['post_type'] as $value ) {
	        array_push($post_types, $value);
	    }
    	update_option('css_supported_post_type', $post_types);

		// Get the supported post types
		$s_post_types = get_option('css_supported_post_type');
		foreach($s_post_types as $s_post_type){
			$post_item = [];
			foreach($_POST[$s_post_type] as $value){
				array_push($post_item, $value);
			}
			$post_types_options[$s_post_type] = $post_item;
		}
		update_option('css_post_type_options', $post_types_options);

		// after update all data redirect to same page 
		wp_redirect('admin.php?page=social-share');
	}
}