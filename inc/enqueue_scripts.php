<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action('wp_enqueue_scripts', 'css_enqueue_scripts');
add_action( 'admin_enqueue_scripts', 'css_admin_enqueue_scripts' );

	function css_enqueue_scripts(){
		wp_enqueue_style('css-front-css', plugin_dir_url(__DIR__).'assets/style.css', null, CSS_VERSION );
		wp_enqueue_script('css-front-scripts',plugin_dir_url(__DIR__).'assets/scripts.js', array('jquery'), CSS_VERSION,
			true	);
	}

	/**
	 * @param $screen Custom Screen
	 *
	 * @return void
	 */
	function css_admin_enqueue_scripts( $screen ) {
		if ( 'toplevel_page_social-share' != $screen ) {
			return;
		}
		wp_enqueue_script( 'css-admin-scripts', plugin_dir_url( __DIR__ ) . 'assets/admin-scripts.js', array('jquery'),
		CSS_VERSION,
			true );
		wp_enqueue_style('css-admin-css', plugin_dir_url(__DIR__).'assets/admin-style.css', null,
			CSS_VERSION );
	}