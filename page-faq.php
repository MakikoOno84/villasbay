<?php
/**
 * The template for displaying FAQ page
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
		<section class='accordionWrapper site-wrapper'>
			<?php

			// Check rows existexists.
			if( have_rows('qa') ):

				// Loop through rows.
				while( have_rows('qa') ) : the_row();

					// Load sub field value.
					?>
					<article class ='each-faq'>

					<button  class="faq-accordion">
					<h3>
						<?php 
						echo get_sub_field('question')
						?>
					</h3>
					</button>
					
					<p class="panel">
						<?php
						echo get_sub_field('answer')
						?>
					</p>
					</article>					
					<?php
					
				// End loop.
				endwhile;
				?>
					
				<?php
				// No value.
				else :
				// Do something...
				endif
			?>
		</section>
		
		

	</main><!-- #main -->

<?php
get_footer();
