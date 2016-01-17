<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bravo
 */

get_header(); ?>

	<main class="site-main">

		<section class="post-404">
			<header class="post-header">
				<h1 class="post-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bravo' ); ?></h1>
			</header>

			<div class="post-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search below?', 'bravo' ); ?></p>

				<?php
					get_search_form();
				?>

			</div>
		</section>
	</main>
<?php
get_footer();
