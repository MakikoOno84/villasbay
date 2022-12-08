<?php
/**
 * The template for displaying Experience page
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
			get_template_part( 'template-parts/banner', 'image' ); 
		?>

	<div class="site-wrapper">
		<div id="exp-btn-container">

			<button id="all-exp" class="black-outline outline-btn" onclick="toggleExp()">All</button>

			<?php $terms = get_terms( 
				array(
					'taxonomy' => 'vb-experience-category',
				) 
			);
			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$args = array(
						'post_type'      => 'vb-experience',
						'posts_per_page' => -1,
						'order' => 'ASC',
						'orderby' => 'title',
						'tax_query'      => array(
							array(
								'taxonomy' => 'vb-experience-category',
								'field'    => 'slug',
								'terms'    => $term->slug,
							),
						),
					);
				
				$query = new WP_Query( $args );
				
				if ( $query -> have_posts() ) : ?>
					<button class="black-outline outline-btn" id="<?php echo $term -> name; ?>-exp" onclick="toggle<?php echo $term -> name; ?>()"> <?php echo $term -> name; ?></button>
					<?php
					endif;
				}
			} ?>
		</div>
		<div class="exp-container">
			
		<?php $args = array(
			'post_type' 	=> 'vb-experience',
			'post_per-page' => -1,		
			);

			$query = new WP_Query($args);

			if ($query->have_posts()){
				
				while($query->have_posts()){
					$query->the_post(); ?>
					<article style="display:block" class="<?php  $terms = wp_get_post_terms($post->ID, 'vb-experience-category' );
								foreach ( $terms as $term ) {
									echo $term->name;
									}
						?> exp">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('large');?>
							<h2><?php the_title(); ?></h2>
						</a>
					</article>
				<?php }
			}
			wp_reset_postdata(); ?>
		</div>
	</div>
	</main><!-- #main -->

<?php
get_footer();
