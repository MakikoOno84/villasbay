<?php
/**
 * Template part for displaying Call-to-Action Experience
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Villas_Bay
 */
?>

<section class='cta-experience'>
<?php		    
    if (function_exists( 'get_field' )) :

        $image = get_field('image_cta_experience', 'options');
        $size = 'large'; // (thumbnail, medium, large, full or custom size)

        if ( $image ) { ?>
            <section class='cta-experience-image'>
                <?php echo wp_get_attachment_image( $image, $size ); ?>
            </section>
        <?php } ?>

        <section class='experience-content'>

        <?php if ( get_field( 'title_cta_experience' , 'options') ) {
            echo '<h2>'. get_field( 'title_cta_experience' , 'options') .'</h2>';
        }
        
        if ( get_field( 'short_description_cta_experience', 'options' ) ) {
            echo '<p>'. get_field( 'short_description_cta_experience' , 'options') .'</p>';
        }

        if ( get_field( 'read_more_cta_exp', 'options' ) ) {
            echo '<a class="outline-btn black-outline" href="'. get_field( 'read_more_cta_exp' , 'options') .'">Explore</a>';
        } ?>

        </section>

    <?php endif;
                
                
?>
</section>