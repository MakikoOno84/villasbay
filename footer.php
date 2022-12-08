<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Villas_Bay
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-wrapper">
			<nav id="footer-navigation" class="footer-navigation menu">
				<?php
					wp_nav_menu(array('theme_location' => 'footer-top'));
				?>
			</nav>
			<nav id="footer-navigation" class="footer-navigation sns">
				<?php
					wp_nav_menu(array('theme_location' => 'footer-bottom'));
				?>
			</nav>
			<nav class="footer-navigation team">
				<ul class="dev-team-members-container">
					<span><?php esc_html_e( 'Created by ', 'villas-bay' ); ?></span>
					<li>
					<a href="<?php echo esc_url( __( 'https://josy.dev/', 'villas-bay' ) ); ?>"><?php esc_html_e( 'Josy Li', 'villas-bay' ); ?></a>
					</li>
					<li>
					<a href="<?php echo esc_url( __( 'https://willcreate.ca/', 'villas-bay' ) ); ?>"><?php esc_html_e( 'Will Tram', 'villas-bay' ); ?></a>
					</li>
					<li>
					<a href="<?php echo esc_url( __( 'https://www.jonnynguyen.com/', 'villas-bay' ) ); ?>"><?php esc_html_e( 'Jonny Nguyen', 'villas-bay' ); ?></a>
					</li>
					<li>
					<a href="<?php echo esc_url( __( 'https://makiko.dev/', 'villas-bay' ) ); ?>"><?php esc_html_e( 'Makiko Ono', 'villas-bay' ); ?></a>
					</li>
				</ul>
			</nav>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
