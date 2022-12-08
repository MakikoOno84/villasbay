<?php
/**
 * The template for displaying the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Villas_Bay
 */

get_header();
?>
    
	<main id="primary" class="site-main">


	<?php while ( have_posts() ) :
			the_post();

            ?>
            <!-- Main Content -->
            <div class="front-page-main">
            <?php
            get_template_part( 'template-parts/banner', 'video' ); 

		endwhile; // End of the loop.
        
        // This h1 is Screen Read Only Text
        ?>
        <div class="site-wrapper"> 
            <h1 class='screen-reader-text'><?php the_title(); ?></h1>
        <?php
		$post_type = "vb-experience";
        $taxonomy = "vb-experience-category";
        $terms = get_terms(
            array(
            	'number' => 3,
                'taxonomy' => $taxonomy,
                    )
            ); ?>
        <section class='experience-section'>          
            <?php foreach($terms as $term):
                    
                $term_id = $term->term_id;
                $term_name = $term->name;
                    
                    $query = array(
                        'post_type'         => $post_type, 
                        'posts_per_page'    => 1,
                        'orderby'           => 'rand',
                        'tax_query'         => array(
                            array(
                                'taxonomy'  => $taxonomy,
                                'terms'     => $term_id
                            ),
                        ),
                    );

                        $posts = new WP_Query($query);
                        
                        while($posts->have_posts()) :
                            $posts->the_post();
                            $permalink = get_permalink($post->ID);
                            $get_term_link = get_term_link($term_id); ?>
                            <section class='featured-experience'>
                                <a href="<?php echo $permalink;?>">
                                <?php the_post_thumbnail('large'); ?>
                                </a>
                                <?php 
                                if ( function_exists('get_field') ) :
                                    if ( get_field( 'short_description' ) ) : ?>
                                        <p><?php the_field( 'short_description' ); ?></p>
                                    <?php endif;
                                endif; ?>
                            </section>
                        <?php endwhile;
            endforeach; 
            get_template_part( 'template-parts/content-cta-experience' ); ?>
            
        </section>
		<?php get_template_part( 'template-parts/content-cta-giftcard' );
        
		?>
        </div>
	</main><!-- #main -->

<?php

get_footer();
