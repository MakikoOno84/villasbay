<?php
/**
 * The template for displaying Stay page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Villas_Bay
 * 
 * developed by jonny
 * 
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php while ( have_posts() ) : 
				the_post(); 
				
				get_template_part( 'template-parts/banner', 'image' ); 
			endwhile; ?>

		<div class="site-wrapper">
			<?php
			$args = array(
				'posts_per_page' => -1,
				'post_type' 	 => 'product',
				'orderby' => 'meta_value_num',
				'meta_key' => '_price',
				'order' => 'asc',
				'tax_query' 	 => array(
					array(
						'taxonomy' 	=> 'product_cat',
						'field' 	=> 'slug',
						'terms' 	=> 'stay',
					)
				),
			);

			$query = new WP_Query( $args );

			if ( $query -> have_posts() ) :

				echo '<section class="villa-section">';

				while ( $query -> have_posts() ) :

					$query -> the_post();
					$product = wc_get_product( get_the_ID() ); /* get the WC_Product Object */ ?>

					<section class="villa">
						<section class="villa-image">
							<?php the_post_thumbnail() ?>
						</section>

						<section class="villa-content">
							<h2><?php echo $product->get_name() ?></h2>
							<p class='short-text'><?php echo get_the_excerpt() ?></p>
							<p class='occupancy'>Occupancy: <?php echo get_field('occupancy') ?></p>
							<p class='rooms'>Rooms: <?php echo get_field('number_of_rooms') ?></p>
							<p class='price'><?php echo $product->get_price_html()?></p>
							<a class="outline-btn black-outline" href="<?php echo get_permalink() ?>">Explore</a>
						</section>
					</section>

				<?php endwhile;

				echo '</section>';

			wp_reset_postdata();
			endif; 
			
			get_template_part( 'template-parts/content-cta-experience' ); ?>
		</div>

	</main><!-- #main -->

<?php
get_footer();
