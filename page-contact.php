<?php
/**
 * The template for displaying Contact page
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
			<div class="page-content-wrapper contact site-wrapper">
			<?php
				if (function_exists('get_field')) {

					?>
					<div class="contact-content-top">
						<section class="villasbay-info">
							<?php
							if (get_field('address')) {					
								?><p><?php esc_html_e( 'Address: ', 'villas-bay' ); ?></p><address class=''><?php echo get_field('address'); ?></address>

								<?php
							}
							if (get_field('phone_number')) {					
								?><p><?php esc_html_e( 'Phone: ', 'villas-bay' ); ?></p><p class='phonenumber'><?php echo get_field('phone_number'); ?></p>

								<?php
							}
							if (get_field('email')) {					
								?><p><?php esc_html_e( 'Email: ', 'villas-bay' ); ?></p><a class='' href='mailto:<?php echo get_field('email'); ?>'><?php echo get_field('email'); ?></a>

								<?php
							}
							?>
						</section>
					
					<?php
				}

					?>
					<section class="contact-form">	
					<?php
					echo do_shortcode( '[contact-form-7 id="196" title="Contact form 1"]' );
					?>
					</section>
			</div>
				<?php
				echo do_shortcode( '[instagram-feed num=3 cols=3]' );

			?>
			</div>
			<?php


			
		endwhile; // End of the loop.
		?>


	</main><!-- #main -->
<?php
get_footer();
