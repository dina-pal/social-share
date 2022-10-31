<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * this is the main class for adding social share bar on frontend.
 */
class ShowInFrontend{
	
	private $post_types = [];
	private $options = [];
	private $networks = [];

	public function __construct() {
		$this->post_types = get_option('css_supported_post_type');
		$this->options = get_option('css_post_type_options');
		$this->networks = get_option('css_social_items');
		add_filter('the_content', array($this, 'css_add_social_share_below_the_content'));
		add_filter('the_content', array($this, 'css_add_social_share_left_side'));
		add_filter('the_title', array($this, 'css_add_social_share_after_title'), 10, 3);
		add_filter( 'post_thumbnail_html', array($this,'css_add_social_icon_inside_featured_image'), 10, 3 );
	}
	/**
	 * This is the helper function get all selected social network.
	 * @param $networks Array get the selected networks array
	 * @param $post_id Number Post Id
	 *
	 * @return string get all selected social network
	 */
	public function css_get_social_icons($post_id){
		$networks = get_option('css_social_items');
		// Get selected social network
		$url = get_permalink($post_id);
		$title = get_the_title($post_id);
		$data = '<div class="css_social_items">';
		foreach ($networks as $network){
		$data .=	css_social_networks($title, $url, $network);
		}
		$data .= '</div>';
		return $data;
	}

	/**
	 * @param $content String Get Current Content
	 *
	 * @return mixed|string Modified Content
	 */
	public function  css_add_social_share_below_the_content($content){
			foreach ($this->post_types as $post_type){
				if( is_singular() && $post_type === get_post_type()){
					if(isset($this->options) && !$this->options == ''){
						if(in_array('after_content', $this->options[$post_type] ) && in_the_loop()){
							$rnContent = $content;
							$rnContent .= $this->css_get_social_icons(get_the_ID() );
							return $rnContent;
						}
					}
				}
			}
			return $content;
	}

	/**
	 * @param $content String Get Current Content
	 *
	 * @return mixed|string Modified Content
	 */
	public function  css_add_social_share_after_title($title, $url){
			foreach ($this->post_types as $post_type){
				if( is_singular() && $post_type === get_post_type()){
					if(isset($this->options) && !$this->options == ''){
						if(in_array('below_title', $this->options[$post_type] ) && in_the_loop()){
                            $networks = get_option('css_social_items');
							$reTitle = $title;
                            $reTitle .= "<div class='css_social_items'>";
                            foreach ($networks as $key => $value) {
                                $reTitle .=  css_social_networks( $title, get_permalink($url), $value);
                            }
                            $reTitle .= "</div>";
							return $reTitle;
						}
					}
				}
			}
			return $title;
	}

	/**
	 * Add Social icons bar in floating left side
	 * @param $content String Get Current Content
	 *
	 * @return mixed|string Modified Content
	 */
	public function  css_add_social_share_left_side($content){
			foreach ($this->post_types as $post_type){
				if( is_singular() && $post_type === get_post_type()){
					if(isset($this->options) && !$this->options == ''){
						if(in_array('left_area', $this->options[$post_type] ) && count($this->networks) > 0 && in_the_loop()){
							$rnContent = '<div class="float-left-share">';
							$rnContent .= $this->css_get_social_icons(get_the_ID() );
							$rnContent .= '<div class="nav_icon"><span class="icon-next"></span></div>';
							$rnContent .= '</div>';
							$rnContent .= $content;
							return $rnContent;
						}

					}
				}
			}
			return $content;
	}

	/**
	 * Add Social icons bar in inside featured image
	 * @param $content String Get Current Content
	 *
	 * @return mixed|string Modified Content
	 */
	function css_add_social_icon_inside_featured_image( $content, $post_id, $thumbnail_id ) {
		foreach ( $this->post_types as $post_type ) {
			if ( is_singular() && $post_type === get_post_type()  && in_the_loop()) {
				if ( isset( $this->options ) && ! $this->options == '' ) {
					if ( in_array( 'inside_image', $this->options[ $post_type ] ) && count( $this->networks ) > 0 && in_the_loop() ) {
						$rnContent = $content;
						$rnContent .= $this->css_get_social_icons( get_the_ID() );
						return $rnContent;
					}

				}
			}
		}
		return $content;
	}

}

// Initialized the Class
new ShowInFrontend();





