<?php
/**
 * The template for displaying single experience page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Villas_Bay
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
			get_template_part( 'template-parts/banner', 'image' ); 

			if ( function_exists ( 'get_field' ) ) { ?>
				<div class="site-wrapper">
				<section class='single-experience'>

				<section class='single-experience-text'>
					<?php if ( get_field( 'duration_experience' ) ) { ?>
						<h2>Duration: <?php echo get_field( 'duration_experience' )?></h2>
					<?php }

					if ( get_field( 'description_experience' ) ) { ?>
						<p><?php the_field( 'description_experience' )?></p>
					<?php } ?>
				</section>
					
				<?php if ( get_field( 'gallery_experience' ) ) {
				$images = get_field('gallery_experience');
				$size = 'large'; // (thumbnail, medium, large, full or custom size)
				if( $images ): ?>
					<section class="exp-gallery">
						<?php foreach( $images as $image_id ): ?>
							<article class='gallery-image'>
								<?php echo wp_get_attachment_image( $image_id, $size ); ?>
							</article>
						<?php endforeach; ?>
						</section>
				<?php endif; 
				}
				?>
				</section>
				<?php } ?>

				<div class="exp-nav">
				<?php the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'villas-bay' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'villas-bay' ) . '</span> <span class="nav-title">%title</span>',
					)
				); ?>
				</div>
				</div>

	</main><!-- #main -->

<?php
get_footer();
