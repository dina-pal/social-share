
<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<h1><?php echo __('Custom Social Share', 'custom-social-share'); ?></h1>

<?php 

$fields = array(
	array(
		'label' => __('Facebook', 'custom-social-share'),
		'id' => 'css_facebook',
		'type' => 'checkbox',
		'icon' => 'icon-facebook',
	),
	array(
		'label' => __('Twitter', 'custom-social-share'),
		'id' => 'css_twitter',
		'type' => 'checkbox',
		'icon' => 'icon-twitter',
	),
	array(
		'label' => __('Pinterest', 'custom-social-share'),
		'id' => 'css_pinterest',
		'type' => 'checkbox',
		'icon' => 'icon-pinterest',
	),
	array(
		'label' => __('Linkedin','custom-social-share'),
		'id' => 'css_linkedin',
		'type' => 'checkbox',
		'icon' => 'icon-linkedin2',
	),
	array(
		'label' => __('Whatsapp','custom-social-share'),
		'id' => 'css_whatsapp',
		'desc' => __('Whatsapp only work on Mobile devices','custom-social-share'),
		'type' => 'checkbox',
		'icon' => 'icon-whatsapp',
	)
);

$positions = array(
	'below_title' => __('Below the post title', 'custom-social-share' ),
	'left_area' => __('Floating on the left area', 'custom-social-share' ),
	'inside_image' => __('Inside The Feature Image', 'custom-social-share' ),
	'after_content' => __('After the post content', 'custom-social-share' ),
);

require_once plugin_dir_path(__FILE__).'fields-data.php';

 ?>

<form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
	<?php wp_nonce_field('css_social_share'); ?>
    <div class="social_fields-wrap">
        <div class="social_icons col-1">
            <h2><?php echo __('Select Social Icons', 'custom-social-share'); ?></h2>
		    <?php
            /**
             * Here we will display the Social media icons list.
             */
		    social_icons_lists($fields);
		    ?>
        </div>
        <div class="social_icons col-2">
            <h2><?php echo __('Select Post Type you want to add Share Buttons', 'custom-social-share'); ?></h2>
            <div class="post_items">
				<?php
                /**
                 * Here we will display the post types selection and position point
                 */
                post_types_selection($positions); ?>
			</div>
        </div>
		<div class="social_icons col-3">
			<h2><?php echo __('Shortcode for Social Share', 'custom-social-share'); ?></h2>
            <input type="text" readonly value="[css_social_share]" size="30" onclick="this.select();" />
		</div>

    </div>
	<input type="hidden" name="action" value="social_icons_save">
	<?php submit_button('Save Changes'); ?>
</form>

