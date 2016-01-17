<?php
/**
 * Template part for displaying posts on archive page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bravo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header">
	<?php

		the_title( '<h3 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	?>
		<div class="post-meta">
			<?php bravo_post_date(); bravo_post_author(); ?>
		</div>
	</header>

	<div class="post-content">
		<?php
			$content = get_the_excerpt() ? get_the_excerpt() : get_the_content();
			$excerpt = wp_trim_words($content, 50, '');
			echo $excerpt;
			printf(__( '<span class="post-readmore"><a href="%s">Read more</a></span>', 'bravo' ), get_the_permalink());
		?>
	</div>

	<footer class="post-footer">
		<?php
			bravo_post_cats();
			bravo_post_tags();
			bravo_post_comment_link();
		?>
	</footer>
</article>