<?php
/**
 * Template part for displaying posts on archive page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header">
	<?php

		the_title( '<h3 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	?>
		<div class="post-meta">
			<?php _s_post_date(); _s_post_author(); ?>
		</div>
	</header>

	<div class="post-content">
		<?php
			$content = get_the_excerpt() ? get_the_excerpt() : get_the_content();
			$excerpt = wp_trim_words($content, 50, '');
			echo $excerpt;
			printf(__( '<span class="post-readmore"><a href="%s">Read more</a></span>', '_s' ), get_the_permalink());
		?>
	</div>

	<footer class="post-footer">
		<?php
			_s_post_cats();
			_s_post_tags();
			_s_post_comment_link();
		?>
	</footer>
</article>