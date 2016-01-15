<?php
/**
 * Count post view
 * 
 * To display post count view in theme use this code
	$meta_value = get_post_meta( $post_ID, '_s_post_views_count', true );
	if( !empty( $meta_value ) ) {
		echo $meta_value;
	}
 */
function _s_metadata_post_views_count() {
	if (is_single()) {

		global $post;
		//Set the name of the Posts Custom Field.
		$count_key = '_s_post_views_count'; 

		//Returns values of the custom field with the specified key from the specified post.
		$count = get_post_meta($post->ID, $count_key, true);

		//If the the Post Custom Field value is empty. 
		if($count == ''){
			$count = 1; // set the counter to one.

			//Delete all custom fields with the specified key from the specified post. 
			delete_post_meta($post->ID, $count_key);

			//Add a custom (meta) field (Name/value)to the specified post.
			add_post_meta($post->ID, $count_key, $count);

		//If the the Post Custom Field value is NOT empty.
		}else{
			$count++; //increment the counter by 1.
			//Update the value of an existing meta key (custom field) for the specified post.
			update_post_meta($post->ID, $count_key, $count);
		}
		//delete_post_meta_by_key($count_key);
	}
}
add_action('wp_head', '_s_metadata_post_views_count');