<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * @param $title String Post Title
 * @param $url String Post Url
 * @param $network String Social network Name
 *
 * @return false|string Return the social icon
 */
function css_social_networks($title='', $url ='' , $network = '') {
	switch ($network){
		case 'css_facebook':
			return sprintf('
				<a class="facebook_share css_share_icon" href="https://www.facebook.com/sharer.php?u=%s" target="_blank">
				<span class="%s"></span></a>', esc_url($url), 'icon-facebook' );
			break;
		case 'css_twitter':
			return sprintf('
				<a class="twitter_share css_share_icon" target="_blank" href="https://twitter.com/intent/tweet?url=%s&text=%s">
				<span class="%s"></span></a>', esc_url($url), esc_html($title) , 'icon-twitter' );
			break;
		case 'css_pinterest':
			return sprintf('
				<a class="pinterest_share css_share_icon" href="https://pinterest.com/pin/create/link/?url=%s" target="_blank">
				<span class="%s"></span></a>', esc_url($url),  'icon-pinterest' );
			break;
		case 'css_linkedin':
			return sprintf('
				<a class="linkedin_share css_share_icon" href="https://www.linkedin.com/sharing/share-offsite/?url=%s" target="_blank">
				<span class="%s"></span></a>', esc_url($url),  'icon-linkedin2' );
			break;
		case ('css_whatsapp' && wp_is_mobile()):
			return sprintf('
				<a class="whatsapp_share css_share_icon" href="whatsapp://send/?text=%s+%s" target="_blank">
				<span class="%s"></span></a>', esc_html($title),  esc_url($url),  'icon-whatsapp' );
			break;
	}
}