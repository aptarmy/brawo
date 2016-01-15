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
function _s_custom_meta() {
	add_meta_box( '_s_meta', __( 'Meta Box Title', '_s' ), '_s_meta_callback', 'post', 'side', 'default' );
}
add_action( 'add_meta_boxes', '_s_custom_meta' );

/**
 * Call back function
 */
function _s_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), '_s_nonce' ); // For security check. Read WP document for more infomation.
    $_s_stored_meta = get_post_meta( $post->ID );
    ?>
 
    <p>
        <label for="meta-key" ><?php _e( 'Example Text Input', '_s' )?></label>
        <input type="text" name="meta-key" id="meta-key" value="<?php if ( isset ( $_s_stored_meta['meta-key'] ) ) echo $_s_stored_meta['meta-key'][0]; ?>" />
    </p>
 
    <?php
}

/**
 * Saves the custom meta input
 */
function _s_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ '_s_nonce' ] ) && wp_verify_nonce( $_POST[ '_s_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-key' ] ) ) {
        update_post_meta( $post_id, 'meta-key', sanitize_text_field( $_POST[ 'meta-key' ] ) );
    }
 
}
add_action( 'save_post', '_s_meta_save' );

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