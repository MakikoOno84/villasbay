<?php
/**
 * Template part for displaying the banner video.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * * developed by Makiko
 * @package Villas_Bay
 */

?>
	<header class="entry-header banner" id="entry-header">
		<div class="banner-overlay" id="banner-overlay"></div>
		<?php 
		if ( function_exists ( 'get_field' ) ) {

			if ( get_field( 'video' ) ) {
				?>
				<video playsinline autoplay muted width="100%" class='welcome-video' id='welcome-video'>
					<source 
						src=<?php the_field('video') ?>
						type='video/mp4'>
				</video>

				<?php
			}
		}
        ?>
		<div class="hero-text" id="hero-text"> 
		<?php 
		if (function_exists('get_field')) :
				if ( get_field('welcome') ) : ?>
					<p class='entry-title banner-title h1 welcome' id='welcome'><?php echo get_field('welcome'); ?></p>
				<?php endif;
				if ( get_field( 'book_now' ) ) : ?>
						<a class='outline-btn black-outline' href="<?php esc_html_e(the_field('book_now')); ?>">Discover</a>
				<?php endif;
		endif; ?>
		
		</div>
	</header><!-- .entry-header -->
