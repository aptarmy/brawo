<?php

/**
 * Rating star for post. include this file to add metabox and save meta data to database.
 * use this code to show meta rating "_s_post_rating();"
 */

/**
 * Function to add metabox
 */
function _s_metabox_post_rating() {
	add_meta_box( '_s_meta', __( 'Post Rating', '_s' ), '_s_metabox_post_rating_callback', 'post', 'side', 'default' );
}
add_action( 'add_meta_boxes', '_s_metabox_post_rating' );

/**
 * Call back function
 */
function _s_metabox_post_rating_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), '_s_nonce' ); // For security check. Read WP document for more infomation.
    $_s_stored_meta = get_post_meta( $post->ID );
    ?>
 
    <p>
        <label for="_s-meta-rating" ><?php _e( 'Rate your post by draging range here.', '_s' )?></label>
        <input type="range" min="0" max="100" step="1" name="_s-meta-rating" onchange="_s_meta_rating_output.value=value" value="<?php if ( isset ( $_s_stored_meta['_s-meta-rating'] ) ) echo $_s_stored_meta['_s-meta-rating'][0]; ?>" />
		<output id="_s_meta_rating_output"><?php if ( isset ( $_s_stored_meta['_s-meta-rating'] ) ) echo $_s_stored_meta['_s-meta-rating'][0]; ?></output>
    </p>
 
    <?php
}

/**
 * Saves the custom meta input
 */
function _s_metabox_post_rating_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ '_s_nonce' ] ) && wp_verify_nonce( $_POST[ '_s_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ '_s-meta-rating' ] ) ) {
        update_post_meta( $post_id, '_s-meta-rating', sanitize_text_field( $_POST[ '_s-meta-rating' ] ) );
    }
}
add_action( 'save_post', '_s_metabox_post_rating_save' );

/**
 * To display meta data added to a post use this code in the loop
 */
//$meta_value = get_post_meta( get_the_ID(), '_s-meta-rating', true );
//if( !empty( $meta_value ) ) {
//	echo $meta_value;
//}

/**
 * To delete all post meta values spacified by key, use this code
 */
//delete_post_meta_by_key('_s-meta-rating');
