<?php
/**
 * Template part for displaying posts on single page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package brawo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header">
	<?php

		the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	?>
		<div class="post-meta">
			<?php brawo_post_date(); brawo_post_author(); ?>
		</div>
	</header>

	<div class="post-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'		=> '<div class="post-subpage">' . esc_html__( 'Pages:', 'brawo' ),
				'after'			=> '</div>',
				'link_before'   => '<span>',
				'link_after'    => '</span>',
			) );
		?>
	</div>

	<footer class="post-footer">
		<?php
			brawo_post_cats();
			brawo_post_tags();
			brawo_post_comment_link();
			brawo_post_views_count();
			brawo_post_rating();
			brawo_post_edit();
		?>
	</footer>
</article>
