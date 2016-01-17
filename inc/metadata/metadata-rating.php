<?php

/**
 * Rating star for post. include this file to add metabox and save meta data to database.
 * use this code to show meta rating "bravo_post_rating();"
 */

/**
 * Function to add metabox
 */
function bravo_metabox_post_rating() {
	add_meta_box( 'bravo_meta', __( 'Post Rating', 'bravo' ), 'bravo_metabox_post_rating_form', 'post', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'bravo_metabox_post_rating' );

/**
 * Call back function
 */
function bravo_metabox_post_rating_form( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'bravo_nonce' ); // For security check. Read WP document for more infomation.
    $bravo_stored_meta = get_post_meta( $post->ID );
    ?>
 
    <p>
        <label for="bravo-meta-rating" ><?php _e( 'Rate your post by draging range here.', 'bravo' )?></label>
        <input type="range" min="0" max="100" step="1" name="bravo-meta-rating" onchange="bravo_meta_rating_output.value=value" value="<?php if ( isset ( $bravo_stored_meta['bravo-meta-rating'] ) ) echo $bravo_stored_meta['bravo-meta-rating'][0]; ?>" />
		<output id="bravo_meta_rating_output"><?php if ( isset ( $bravo_stored_meta['bravo-meta-rating'] ) ) echo $bravo_stored_meta['bravo-meta-rating'][0]; ?></output>
    </p>
 
    <?php
}

/**
 * Saves the custom meta input
 */
function bravo_metabox_post_rating_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'bravo_nonce' ] ) && wp_verify_nonce( $_POST[ 'bravo_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'bravo-meta-rating' ] ) ) {
        update_post_meta( $post_id, 'bravo-meta-rating', sanitize_text_field( $_POST[ 'bravo-meta-rating' ] ) );
    }
}
add_action( 'save_post', 'bravo_metabox_post_rating_save' );

/**
 * To display meta data added to a post use this code in the loop
 */
//$meta_value = get_post_meta( get_the_ID(), 'bravo-meta-rating', true );
//if( !empty( $meta_value ) ) {
//	echo $meta_value;
//}

/**
 * To delete all post meta values spacified by key, use this code
 */
//delete_post_meta_by_key('bravo-meta-rating');
