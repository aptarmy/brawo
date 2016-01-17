<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package brawo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header">
	<?php

		the_title( '<h3 class="post-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );

	?>
		<div class="post-meta">
			<?php brawo_post_date(); brawo_post_author(); ?>
		</div>
	</header>

	<div class="post-content">
		<?php
			$content = get_the_excerpt() ? get_the_excerpt() : get_the_content();
			$excerpt = wp_trim_words($content, 50, '');
			echo $excerpt;
			printf(__( '<span class="post-readmore"><a href="%s">Read more</a></span>', 'brawo' ), get_the_permalink());
		?>
	</div>

	<footer class="post-footer">
		<?php
			brawo_post_cats();
			brawo_post_tags();
			brawo_post_comment_link();
		?>
	</footer>
</article>
