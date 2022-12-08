<?php
/**
 * Template part for displaying Call-to-Action Stays
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Villas_Bay
 */
?>

<section class='related-products'> 

    <?php 
			if ( !is_404() ) : 
				if (function_exists('get_field') ) :

	        		if ( get_field('title_cta_stay', 'options') ) : ?>

		    		<h3><?php the_field('title_cta_stay', 'options') ?></h3>	

	        		<?php endif;
	    		endif;
				else : ?>
					<h3>Take a look at the villas we have to offer!</h3>
				<?php 
			endif;

        remove_action(
			'woocommerce_after_single_product_summary',
			'woocommerce_output_related_products',
			20
		);

        if ( has_term( 20, 'product_cat' ) || is_404()) :
		
		$args = array(
			'posts_per_page'	=> 3,
			'post_type'			=> 'product',
			'orderby'           => 'meta_value_num',
    		'meta_key'          => '_price',
    		'order'             => 'asc',
			'tax_query'			=> array(
				array(
					'taxonomy'	=> 'product_cat',
					'field'		=> 'slug',
					'terms'		=> 'stay'
				)
			),
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :
				 while ( $query->have_posts() ) :
					$query->the_post();
					$product = wc_get_product( get_the_ID() ); /* get the WC_Product Object */ ?>
					<section class='related-villas'>
						<?php the_post_thumbnail('large') ?>
						<h4><?php echo $product->get_name() ?></h4>
						<?php the_excerpt() ?>
						<a class='outline-btn black-outline' href="<?php echo get_permalink() ?>">Explore</a>
					</section>
				<?php endwhile;
		endif;
		wp_reset_postdata();

	    endif;

        if ( has_term( 17, 'product_cat' ) ) :

            global $post;
            $postID = $post->ID;

            $args = array(
                'posts_per_page'	=> 3,
                'post_type'			=> 'product',
                'orderby'           => 'meta_value_num',
    		    'meta_key'          => '_price',
    		    'order'             => 'dsc',
                'post__not_in'      => array( $postID ),
                'tax_query'			=> array(
                    array(
                        'taxonomy'	=> 'product_cat',
                        'field'		=> 'slug',
                        'terms'		=> 'stay'
                    )
                ),
            );

            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                   $query->the_post();
                   $product = wc_get_product( get_the_ID() ); /* get the WC_Product Object */ ?>
                   <section class='related-villas'>
                       <?php the_post_thumbnail('large') ?>
                       <h4><?php echo $product->get_name() ?></h4>
                       <?php the_excerpt() ?>
                       <a class='outline-btn black-outline' href="<?php echo get_permalink() ?>">Explore</a>
                   </section>
               <?php endwhile;
       endif;
       wp_reset_postdata();

     endif; ?>
    
    

</section>