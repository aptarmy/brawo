<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package brawo
 */

if ( ! function_exists( 'brawo_post_date' ) ) :
/**
 * div.meta-date > time.meta-date-published
 */
function brawo_post_date() {
	$time_string = '<time class="meta-date-published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="meta-date-published" datetime="%1$s">%2$s</time><time class="meta-date-updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf(
		__( '<span class="meta-date">Post on : %s</span>', 'post date', 'brawo' ), $time_string
	);
}
endif;

if (!function_exists('brawo_post_author')) :
	/**
	 * .meta-author > a
	 */
	function brawo_post_author() {
		$author_name = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';
		printf(
			__( '<span class="meta-author">by %s</span>', 'post author', 'brawo' ),
			$author_name
		);
	}
endif;

if ( ! function_exists( 'brawo_post_cats' ) ) :
	/**
	 * Print categories list for post
	 */
	function brawo_post_cats(){
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list();
			if ( $categories_list && brawo_categorized_blog() ) {
				printf( '<span class="meta-cats">' . esc_html__( 'Categories : %1$s', 'brawo' ) . '</span>', $categories_list );
			}
		}
	}
endif;

if ( ! function_exists( 'brawo_post_tags' ) ) :
	/**
	 * Print tags list for post
	 */
	function brawo_post_tags(){
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('<ul><li>','</li><li>','</li></ul>');
			if ( $tags_list ) {
				printf( '<span class="meta-tags">' . esc_html__( 'Tagged %1$s', 'brawo' ) . '</span>', $tags_list );
			}
		}
	}
endif;

if ( ! function_exists( 'brawo_post_comment_link' ) ) :
	/**
	 * Print a link to comment
	 */
	function brawo_post_comment_link() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'brawo' ), esc_html__( '1 Comment', 'brawo' ), esc_html__( '% Comments', 'brawo' ) );
			echo '</span>';
		}
	}
endif;

if (!function_exists('brawo_post_edit')) :
	/**
	 * Get edit link for a post
	 */
	function brawo_post_edit(){
		edit_post_link(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit', 'brawo' ),
			'<span class="post-edit">',
			'</span>'
		);
	}
endif;

if (!function_exists('brawo_post_rating')):
	/**
	 * Display post star rating using metadata(metabox) added by "/inc/metabox/metabox.php"
	 * This function should be used within the loop.
	 */
	function brawo_post_rating(){
		$meta_value = get_post_meta( get_the_ID(), 'brawo-meta-rating', true );
		if( !empty( $meta_value ) ) {
		?>
			<div class="meta-rating">
				<span class="meta-rating-background">
					<span class="meta-rating-color"></span>
				</span>
			</div>
			<style>
				.meta-rating {
					font-size: 1em;
					height: 1em;
					width: 5em;
					position: relative;
					font-family: 'Genericons';
				}
				.meta-rating-background {
					color: wheat;
					position: absolute;
					display: inline-block;
				}
				.meta-rating-background:after {
					content: "\f512\f512\f512\f512\f512";
				}
				.meta-rating-color {
					width: <?php echo $meta_value; ?>%;
					color: red;
					overflow: hidden;
					position: absolute;
					display: inline-block;
				}
				.meta-rating-color:after {
					content: "\f512\f512\f512\f512\f512";
				}
			</style>
		<?php
		}

	}
endif;

if (!function_exists('brawo_post_views_count')) {
	/**
	 * display post view count using post metadata added by the file "/inc/metadata/metadata-post-view.php"
	 */
	function brawo_post_views_count() {
		$meta_value = get_post_meta(get_the_ID(), 'brawo_post_views_count', true );
		if( !empty( $meta_value ) ) {
			printf(
				__('<span class="meta-views">%1s views</span>', 'post views count', 'brawo'),
				$meta_value
			);
		} else {
			_e('<span class="meta-views">0 views</span>', 'post views count', 'brawo');
		}
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function brawo_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'brawo_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'brawo_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so brawo_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so brawo_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in brawo_categorized_blog.
 */
function brawo_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'brawo_categories' );
}
add_action( 'edit_category', 'brawo_category_transient_flusher' );
add_action( 'save_post',     'brawo_category_transient_flusher' );
