<?php
/**
 * Template part for displaying posts on single page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header">
	<?php

		the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	?>
		<div class="post-meta">
			<?php _s_post_date(); _s_post_author(); ?>
		</div>
	</header>

	<div class="post-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'		=> '<div class="post-subpage">' . esc_html__( 'Pages:', '_s' ),
				'after'			=> '</div>',
				'link_before'   => '<span>',
				'link_after'    => '</span>',
			) );
		?>
	</div>

	<footer class="post-footer">
		<?php
			_s_post_cats();
			_s_post_tags();
			_s_post_comment_link();
			_s_post_views_count();
			_s_post_rating();
			_s_post_edit();
		?>
	</footer>
</article>
