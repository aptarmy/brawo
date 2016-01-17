<?php
/**
 * 
 * This file won't be loaded by other files. It's just a prototype.
 * 
 * To use metabox in theme, copy all code in this file and paste copied code to newly-created file.
 * 
 */



/**
 * Function to add metabox
 */
function bravo_custom_meta() {
	add_meta_box( 'bravo_meta', __( 'Meta Box Title', 'bravo' ), 'bravo_meta_form', 'post', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'bravo_custom_meta' );

/**
 * Call back function
 */
function bravo_meta_form( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'bravo_nonce' ); // For security check. Read WP document for more infomation.
    $bravo_stored_meta = get_post_meta( $post->ID );
    ?>
 
    <p>
        <label for="meta-key" ><?php _e( 'Example Text Input', 'bravo' )?></label>
        <input type="text" name="meta-key" id="meta-key" value="<?php if ( isset ( $bravo_stored_meta['meta-key'] ) ) echo $bravo_stored_meta['meta-key'][0]; ?>" />
    </p>
 
    <?php
}

/**
 * Saves the custom meta input
 */
function bravo_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'bravo_nonce' ] ) && wp_verify_nonce( $_POST[ 'bravo_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-key' ] ) ) {
        update_post_meta( $post_id, 'meta-key', sanitize_text_field( $_POST[ 'meta-key' ] ) );
    }
 
}
add_action( 'save_post', 'bravo_meta_save' );

/**
 * To display meta data added to a post use this code in the loop
 */
//$meta_value = get_post_meta( get_the_ID(), 'meta-key', true );
//if( !empty( $meta_value ) ) {
//	echo $meta_value;
//}

/**
 * To delete all post meta values spacified by key, use this code
 */
//delete_post_meta_by_key('meta-key');