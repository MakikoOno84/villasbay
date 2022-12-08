<?php
/**
 * Template part for displaying header contents(navigation, CTA and ).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * * developed by Makiko
 * @package Villas_Bay
 */

?>
    <div id="custom-page-header" class="custom-page-header">
        <div class='header-left'>
            
        <?php if ( 101 === get_the_ID() ||  //Stay page
        (is_single() && 'product' == get_post_type() ) || //single product page
        is_cart() || // cart page
        is_checkout() // checkout page
        ) {
        echo do_shortcode('
        [woocommerce_currency_converter currency_codes="USD, EUR, CAD, AUD " show_symbols=1 show_reset=1 currency_display="select" disable_location=1]
        ');
        } else {
        ?>
        <a href="<?php echo get_page_link(15); ?>"><?php esc_html_e( 'My Account', 'villas-bay' ); ?></a>
        <?php
        }
        ?>
        <?php
		if ( function_exists( 'villas_bay_woocommerce_header_cart' ) ) {
			villas_bay_woocommerce_header_cart();
		}
	    ?>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class='screen-reader-text'><?php 
            esc_html_e( 'Primary Menu', 'villas-bay' );
            ?></span>
            <?php
            get_template_part('images/hamburger');
            ?>
            </button>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'header',
                    'menu_id'        => 'header-menu',
                )
            );
            ?>
        </nav><!-- #site-navigation -->

        <div class='header-right'>
            <div class='booknow-button'>
                <a href="<?php echo get_page_link(101); ?>" class='white-outline'><?php esc_html_e( 'Book Now', 'villas-bay' ); ?></a>
            </div>
        </div>
    </div>
