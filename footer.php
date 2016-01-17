<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bravo
 */

?>

	<footer class="site-footer">
		<div class="footer-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bravo' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'bravo' ), 'WordPress' ); ?></a>
			|
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'bravo' ), 'bravo', '<a href="http://automattic.com/">Automattic</a>' ); ?>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
