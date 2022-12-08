<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Villas_Bay
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function villas_bay_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 1920,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	// add_theme_support( 'wc-product-gallery-zoom' );
	// add_theme_support( 'wc-product-gallery-lightbox' );
	// add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'villas_bay_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function villas_bay_woocommerce_scripts() {
	wp_enqueue_style( 'villas-bay-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'villas-bay-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'villas_bay_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function villas_bay_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'villas_bay_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function villas_bay_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'villas_bay_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'villas_bay_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function villas_bay_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'villas_bay_woocommerce_wrapper_before' );

if ( ! function_exists( 'villas_bay_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function villas_bay_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'villas_bay_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'villas_bay_woocommerce_header_cart' ) ) {
			villas_bay_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'villas_bay_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function villas_bay_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		villas_bay_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'villas_bay_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'villas_bay_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function villas_bay_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'villas-bay' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'villas-bay' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'villas_bay_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function villas_bay_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php echo do_shortcode('[icon name="cart-shopping" prefix="fa-solid"]'); ?></a><?php villas_bay_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				)
				?>
			</li>
		</ul>
		<?php
	}
}

// Start of custom code written by jonny

// adding service & amentities acf under single product
function villas_bay_services_and_amenities() {
	if ( has_term( 17, 'product_cat') ) : 
		if ( have_rows( 'amenities_&_services' ) ) : ?>
			<div class='each-faq'>
				<button class='faq-accordion'>
					<h3>Services and Amenities</h3>
				</button>
				<div class='panel'>
					<section class='icon-container'>
				<?php while ( have_rows( 'amenities_&_services' ) ) :
						the_row();
						$icon = get_sub_field('icon');
						$description = get_sub_field('description_amenities'); ?>
						<p>
						<?php echo do_shortcode( $icon ); ?>
						<?php echo $description?>
						</p>
				<?php endwhile; ?>
					</section>
				</div>
		</div>
	<?php endif;
	endif;
}

add_action(
	'woocommerce_after_single_product_summary',
	'villas_bay_services_and_amenities',
	9
);

// adding terms of service content under single product
function villas_bay_terms_and_conditions() {
	$args = array(
		'page_id' => 202,
	);

	$query = new WP_Query( $args );

	if ( $query -> have_posts() ) :
		while ( $query -> have_posts() ) :
			$query -> the_post(); ?>
			<div class="each-faq">
				<button class="faq-accordion">
				<h3><?php the_title(); ?></h3>
				</button>
				<div class="panel"> 
				<?php the_content() ?>
				</div>
			</div>
				
		<?php endwhile;
		wp_reset_postdata();
		endif;
};

add_action (
	'woocommerce_after_single_product_summary',
	'villas_bay_terms_and_conditions',
	13
);

// changing location of the output product data tabs
remove_action(
	'woocommerce_after_single_product_summary',
	'woocommerce_output_product_data_tabs',
	10
);
add_action(
	'woocommerce_single_product_summary',
	'woocommerce_output_product_data_tabs',
	51
);

// displaying cpt testimonial related to villa, if none will randomly display any testimonial
function villas_bay_testimonial() {
	
	// 17 = id for the "stay" product category
	if ( has_term( 17, 'product_cat' ) ) : 
		
		global $post;
		$post_slug = $post->post_name;

		$args = array(
			'post_type' 		=> 'vb-testimonial',
			'posts_per_page' 	=> 1,
			'orderby'			=> 'rand',
			'tax_query' 		=> array(
				array(
					'taxonomy' => 'vb-testimonial-category',
					'field'	   => 'slug',
					'terms'	   => $post_slug,
				)
			),
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : ?>
			<section class='testimonial'>
				<?php while ( $query->have_posts() ) : 
						$query->the_post(); ?>
						<?php the_content() ?>
				<?php endwhile; ?>
			</section>
		<?php 

		wp_reset_postdata();

		else :
			$args = array(
				'post_type' 		=> 'vb-testimonial',
				'posts_per_page' 	=> 1,
				'orderby'			=> 'rand'
			);

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) : ?>
				<section class='testimonial'>
					<?php while ( $query->have_posts() ) : 
						$query->the_post(); ?>
						<h3><?php the_title() ?></h3>
						<?php the_content() ?>
					<?php endwhile; ?>
				</section>
			<?php endif;

			wp_reset_postdata();

		endif;
	endif;
}

add_action(
	'woocommerce_after_single_product_summary',
	'villas_bay_testimonial',
	18
);

// cta-stay for giftcard and single stay

function villas_bay_related_products() {
	get_template_part( 'template-parts/content', 'cta-stay'); 
};

add_action(
	'woocommerce_after_single_product_summary',
	'villas_bay_related_products',
	19
);

// displaying acf details about room
function villas_bay_room_details() { 
	if ( has_term( 17, 'product_cat') ) : ?>
	<section class='room-details'>
		<?php if (function_exists('get_field') ) : 
				if ( get_field('occupancy') ) : ?>
					<p>Occupancy: Sleeps <?php the_field('occupancy')?></p>
			<?php endif;
	
			 	if ( get_field('number_of_beds') ) : ?>
					<p>Number of Beds: <?php the_field('number_of_beds')?> King Bed</p>
			<?php endif;
	
				 if ( get_field('number_of_rooms') ) : ?>
					<p>Number of Rooms: <?php the_field('number_of_rooms'); ?></p>
			<?php endif;
		endif; ?>
	  </section>
	<?php endif;
};

add_action(
	'woocommerce_single_product_summary',
	'villas_bay_room_details',
	21
);



function villas_bay_output_opening_section() { ?>
	<section class='product-content'>
<?php };

add_action(
	'woocommerce_single_product_summary',
	'villas_bay_output_opening_section',
	1
);

function villas_bay_output_closing_section() { ?>
			</section>
<?php };

add_action(
	'woocommerce_single_product_summary',
	'villas_bay_output_closing_section',
	25
);

// displaying room photos
function villas_bay_product_images() { 
	if ( has_term( 17, 'product_cat') ) : ?>
	<section class='room-images'>
		<?php if (function_exists('get_field')) : ?>
					<?php if (get_field('room_image_1')) : ?>
						<?php $image = get_field('room_image_1');
						$size = 'large';
						echo wp_get_attachment_image( $image, $size );
					endif;
					if (get_field('room_image_2')) :
						$image = get_field('room_image_2');
						$size = 'large';
						echo wp_get_attachment_image( $image, $size ); 
					endif;
				endif;
	endif; ?>
	</section>
<?php };

add_action(
	'woocommerce_after_single_product_summary',
	'villas_bay_product_images',
	15
);

// removing widget area
remove_action(
	'woocommerce_sidebar',
	'woocommerce_get_sidebar',
	10
);

// displaying giftcard cta on single stay pages
function villas_bay_cta_giftcard() {

	if ( has_term( 17, 'product_cat') ) :
		get_template_part( 'template-parts/content-cta-giftcard' );
	endif;

};

add_action(
	'woocommerce_after_single_product_summary',
	'villas_bay_cta_giftcard',
	25
);

// removing product link from product image

function e12_remove_product_image_link( $html, $post_id ) {
    return preg_replace( "!<(a|/a).*?>!", '', $html );
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'e12_remove_product_image_link', 10, 2 );