<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Villas_Bay
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'villas-bay' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe take a look at one of our experiences or acommdations we have to offer?', 'villas-bay' ); ?></p>
				<?php get_template_part( 'template-parts/content', 'cta-stay' ) ; ?>
				<?php get_template_part( 'template-parts/content', 'cta-experience' ) ; ?>
					
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
