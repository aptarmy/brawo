<?php
/**
 * Template part for displaying posts on single page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bravo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header">
	<?php

		the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	?>
		<div class="post-meta">
			<?php bravo_post_date(); bravo_post_author(); ?>
		</div>
	</header>

	<div class="post-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'		=> '<div class="post-subpage">' . esc_html__( 'Pages:', 'bravo' ),
				'after'			=> '</div>',
				'link_before'   => '<span>',
				'link_after'    => '</span>',
			) );
		?>
	</div>

	<footer class="post-footer">
		<?php
			bravo_post_cats();
			bravo_post_tags();
			bravo_post_comment_link();
			bravo_post_views_count();
			bravo_post_rating();
			bravo_post_edit();
		?>
	</footer>
</article>
