<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function social_icons_lists($fields){
	$css_social_items = get_option('css_social_items');
	$value = 0;
	foreach($fields as $field){
        if(isset($css_social_items) && !$css_social_items == ''){
	        if(in_array($field['id'], $css_social_items )){
		        $value = 1;
	        }else{
		        $value = 0;
	        }
        }
		printf('
        <div class="social_icon %s">
            <span class="%s"></span>
            <label for="%s"> %s
                <input id="%s" name="css_social_items[]" type="checkbox" value="%s" %s >
            </label>
            %s
        </div>',
			$value === 1 ? 'active' : '',
			$field['icon'],
			$field['id'],
			$field['label'],
			$field['id'],
			$field['id'],
			$value === 1 ? 'checked' : '',
            isset($field['desc'] ) ? '<p>'.$field['desc'].'</p>': '',
		);
	}
}

function post_types_selection($positions){

	$s_post_types = get_option('css_supported_post_type');
	$field_options = get_option('css_post_type_options');
	$checked = 0;

	$post_types = get_post_types( array(
		'public'   => true,
	), 'objects' );
	foreach ( $post_types as $post_type ) {
		if ( 'attachment' === $post_type->name ) {
			continue;
		}
        if(isset($s_post_types) && !$s_post_types == ''){
	        if(in_array($post_type->name, $s_post_types, true)){
		        $checked = 1;
	        }else{
		        $checked = 0;
	        }
        }

		$icon  = $post_type->menu_icon;
		$label = $post_type->label;
		$name  = $post_type->name;
		echo '<div class="post_item">';
		printf( '<div class="post_item-title">
                        <label for="%s"><span class="dashicons %s"></span> %s</label>
                        <input class="post-type-box" type="checkbox" name="post_type[]" id="%s" value="%s" %s />
                    </div>',
			$name,
			$icon ? $icon : 'dashicons-admin-post',
			__($label, 'custom-social-share'),
			$name,
			$name,
			$checked === 1 ? 'checked' : ''
		);

		$itemClass =  $checked == 1 ? 'active': 'inactive';
		// here is the display position
		echo '<div class="position_item ' .$itemClass.' " >';
		$nameValue = $name.'[]';
		foreach ( $positions as $key => $value ) {
			if(isset($field_options[$post_type->name]) && $field_options[$post_type->name] ){
				$curArr = $field_options[$post_type->name];
				if(in_array($key, $curArr, true)){
					$isChecked = 'checked';
				}else{
					$isChecked = '';
				}
			}else{
				$isChecked = '';
			}

			?>
			<label>
				<input class="position-box"  type="checkbox" name="<?php echo _e($nameValue); ?>" value="<?php echo _e($key); ?>" <?php
				echo  $isChecked; ?>
				/> <?php
				echo _e($value); ?>
			</label>
			<?php
		}
		echo '</div> </div>';
	}


}