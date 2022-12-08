<?php
/**
 * Template part for displaying Call-to-Action GiftCard
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Villas_Bay
 */
?>

<section class='cta-giftcard'>
    <div class="cta-giftcard-text">
        <?php		
            if ( get_field( 'title_cta_giftcard' , 'options') ) {
                echo '<h2>'. get_field( 'title_cta_giftcard' , 'options') .'</h2>';
            }
            
            if ( get_field( 'short_description_cta_giftcard', 'options' ) ) {
                echo '<p>'. get_field( 'short_description_cta_giftcard' , 'options') .'</p>';
            }
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 1,
                'post__in'       => array(
                    73
                )
            );
            $query = new WP_Query( $args ) ;
            if ( $query -> have_posts() ) :
                while ( $query -> have_posts() ) :
                    $query -> the_post(); ?>
                    <a class="outline-btn black-outline" href="<?php echo get_permalink()?>">Explore</a>
                <?php endwhile;
        ?>
    </div>

    <div class="cta-giftcard-image"> 
        <?php
            $image = get_field('image_cta_giftcard', 'options');
            $size = 'large'; // (thumbnail, medium, large, full or custom size)
            if( $image ) {
                echo wp_get_attachment_image( $image, $size );
            }
                wp_reset_postdata();
            endif;
        ?>
        </div> 
</section>