<?php
/**
 * Template part for displaying the banner image.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * * developed by jonny
 * @package Villas_Bay
 */

?>
	<header class="entry-header banner" id="entry-header">
		<?php villas_bay_post_thumbnail(); ?>
		<section class="hero-text"> 
		<?php the_title( '<h1 class="entry-title banner-title">', '</h1>' );
			if ( get_field('short_description') ) : ?>
				<p class='banner-text'><?php echo get_field('short_description') ?></p>
			<?php endif; ?>
		</section>
	</header><!-- .entry-header -->
