<?php
/**
 * The template for displaying About page
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



			
			?>
			<div class="site-wrapper">
				<?php
				if (function_exists('get_field')) {
					// Display gallery
					if (get_field('gallery_images')) {
						$imageArray = get_field('gallery_images');
						?>
						<div class="swiper">
							<div class="swiper-wrapper">
							<?php
							foreach($imageArray as $oneImage) {
								?>
								<div class="swiper-slide">
								<img src="<?php echo esc_url($oneImage['url']); ?>" alt="<?php echo esc_attr($oneImage['alt']); ?>" />
								</div>
								<?php
							}
							?>
							
							</div>
							<div class="swiper-pagination"></div>
							<!-- <div class="swiper-button-prev"></div>
							<div class="swiper-button-next"></div> -->
						</div>
						<?php
					}
					
					// Display description
					if (get_field('description_about')) {
						?>
						<div class="description_about">
						<p><?php echo get_field('description_about');?></p>
						</div>
						<?php
					}
					// Display direction
					if (get_field('direction')) {
						?>
						<div class="about-direction">
							<?php echo get_field('direction');?>
						</div>
						<?php
					}
				}		


				endwhile; // End of the loop.
				?>
				<!-- google map a single marker: begin -->
				<?php 
				$location = get_field('map');
				if( $location ): ?>
					<div class="acf-map" data-zoom="16">
						<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
					</div>
				<?php endif; ?>
						<!-- google map a single marker: end -->
			</div>
	</main><!-- #main -->

		<?php
get_footer();

?>
