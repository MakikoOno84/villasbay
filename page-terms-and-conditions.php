<?php
/**
 * The template for displaying Terms and Conditions page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Villas_Bay
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			
			get_template_part( 'template-parts/banner', 'image' );

		endwhile; // End of the loop.
		?>
		<div class="entry-content site-wrapper">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'villas-bay' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'villas-bay' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->	
		

	</main><!-- #main -->

<?php
get_footer();
