<?php
/**
 * Villas Bay functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Villas_Bay
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function villas_bay_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Villas Bay, use a find and replace
		* to change 'villas-bay' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'villas-bay', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	// register_nav_menus(
	// 	array(
	// 		'menu-1' => esc_html__( 'Primary', 'villas-bay' ),
	// 	)
	// );
	register_nav_menus(
		array(
			'header' => esc_html__( 'Header Menu Location', 'villas-bay' ),
			'footer-top' => esc_html__('Footer - top','villas-bay'),
			'footer-bottom' => esc_html__('Footer - bottom','villas-bay'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'villas_bay_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	/**
	 * Added by Makiko: begin
	 * Add support for Block Editor features.
	 *
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
	 */
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	/* Added by Makiko: end */

}
add_action( 'after_setup_theme', 'villas_bay_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function villas_bay_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'villas_bay_content_width', 640 );
}
add_action( 'after_setup_theme', 'villas_bay_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function villas_bay_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'villas-bay' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'villas-bay' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'villas_bay_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function villas_bay_scripts() {
	// get page id
	$page_id = get_the_ID();

	wp_enqueue_style( 
		'villas-bay-fonts', 
		'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,400&family=Playfair+Display:wght@400;600;700&display=swap', false,
		array(),
		null // Set null if loading multiple Google Fonts from their CDN
	);
	wp_enqueue_style( 'villas-bay-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'villas-bay-style', 'rtl', 'replace' );

	wp_enqueue_script( 'villas-bay-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'villas-bay-scripts', get_template_directory_uri() . '/js/accordion.js', array(), _S_VERSION, true ); //this one is for accordion repeater

		wp_enqueue_script(
			'villas-bay-googlemap1',
			'https://maps.googleapis.com/maps/api/js?key=<API Key Here>',
		);

		wp_enqueue_script(
			'villas-bay-googlemap2',
			get_template_directory_uri() . '/js/googlemap.js', array('villas-bay-googlemap1'), _S_VERSION, true );
 	
	wp_enqueue_script( 'villas-bay-exp', get_template_directory_uri() . '/js/exp-button.js', array(), _S_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load Swiper on About page with ID 33
	if ($page_id === 33) {
		wp_enqueue_style(
			'swiper-styles',
			get_template_directory_uri() . '/css/swiper-bundle.css',
			array(),
			'8.4.2'
		);
		wp_enqueue_script(
			'swiper-scripts',
			get_template_directory_uri() .'/js/swiper-bundle.min.js',
			array(),
			'8.4.2',
			true
		);

		wp_enqueue_script(
			'swiper-settings',
			get_template_directory_uri(). '/js/swiper-settings.js',
			array('swiper-scripts'),
			_S_VERSION,
			true
		);
	}

	// Load Banner Video Trigger on Home page with ID
	if ($page_id === 24) {
		wp_enqueue_script( 'villas-bay-banner', get_template_directory_uri() . '/js/banner.js', array(), _S_VERSION, true );
	}
	
	wp_enqueue_script( 'villas-bay-scroll', get_template_directory_uri() . '/js/scroll.js', array(), _S_VERSION, true );
	
}
add_action( 'wp_enqueue_scripts', 'villas_bay_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Added by Makiko: begin
*/
// Load CPT and Taxonomy
require get_template_directory() . '/inc/cpt-taxonomy.php';

// Create Options Page
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Call-to-Action Settings',
        'menu_title'    => 'Call-to-Action Settings',
        'menu_slug'     => 'call-to-action-settings',
        'capability'    => 'edit_posts',
		'parent_slug'	=> ''
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'CTA: Gift Certificate Settings',
        'menu_title'    => 'CTA-Gift-Certificate',
        'parent_slug'   => 'call-to-action-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'CTA: Experience Settings',
        'menu_title'    => 'CTA-Experience',
        'parent_slug'   => 'call-to-action-settings',
    ));

	acf_add_options_sub_page(array(
        'page_title'    => 'CTA: Stay Settings',
        'menu_title'    => 'CTA-Stay',
        'parent_slug'   => 'call-to-action-settings',
    ));
    
}

/* Automate adding new taxonomy term for Testimonial when new villa is added.
*  Taxonomy term is created when all the conditions below are met. 
*	- Old status is not "publish" and new status is "publish" (the post is newly published)
*	- CPT of the new post is "Product"
*	- The category of the new post is "Stay"
*	- The new taxonomy term that about to be created does not exist yet.
* 
* reference: https://davidwalsh.name/wordpress-publish-post-hook
*/
function create_taxonomy_term($new_status, $old_status, $post) {
	// Get CPT of new post
	$custom_post_type = get_post_type();

	// Get the category of new post
	$categoryArray = [];
	if ($custom_post_type === 'product') {
		$categoryArray = get_the_terms($post->id,'product_cat');
	}

	// Get existing tax. terms for Testimonial
	$existingTaxTerm = get_terms(array( 
		'taxonomy' => 'vb-testimonial')
	);

	// Check if the post is categorized as Stay(id 17) 
	$isVilla = false;
	if ($categoryArray) {
		foreach ($categoryArray as $category ) {
		if ($category->term_id === 17) {
			$isVilla = true;
			break;
		} 
		}
	}

	// Check if the term already exists.
	$isTermExist = false;
	foreach ($existingTaxTerm as $oneTerm) {
		if ($oneTerm === $post->post_title) {
			$isTermExist = true;
			break;
		}
	}

	// Create new tax. term for Testimonial
	if('publish' === $new_status && 'publish' !== $old_status && $custom_post_type === 'product' && $isVilla && $isTermExist===false) {
		wp_insert_term($post->post_title, 'vb-testimonial-category');
	} 
}
add_action('transition_post_status', 'create_taxonomy_term', 10, 3);

// Register API Key
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyAhvmbja1P4DA9KwGCeYwBqkTbgI1SRbGY');
}
add_action('acf/init', 'my_acf_init');

// Add logo in menu
// Note:  Wordpress can not find the url path in external css,,,we define it here...

function headerlogo() {
	?>
	<style>
		/* header logo (black) */
		.menu-logo a {			
		background-image: url(<?php echo get_template_directory_uri()?>/images/logo-black.svg);
		
		}
	 	/* header logo on image(white) */
		.page-id-24 .menu-logo a,
		.page-id-101 .menu-logo a,
		.page-id-144 .menu-logo a,
		.single-vb-experience .menu-logo a,
		.page-id-33 .menu-logo a,
		.page-id-21 .menu-logo a,
		.page-id-41 .menu-logo a,
		.page-id-202 .menu-logo a,
		.page-id-3 .menu-logo a,
		.single-product .menu-logo a{			
				background-image: url(<?php echo get_template_directory_uri()?>/images/logo-hex-EFEFEF.png);
				}
		
		@media (min-width: 768px) {
			.custom-page-header:hover .menu-logo a,
			.custom-page-header.scrollDown .menu-logo a {
				background-image: url(<?php echo get_template_directory_uri()?>/images/logo-black.svg);				
			}
		}
	</style>
	<?php
}

add_action('wp_head','headerlogo');

/*
* Added by Makiko: end
*/

/**
 * Lower Yoast SEO Metabox location
 */
function yoast_to_bottom(){
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom' );

/**
 * Customize Wordpress Login page
 */

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo-black.svg);
		height:150px;
		width:320px;
		background-size: 320px 150px;
		background-repeat: no-repeat;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'The Villas Bay';
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );

/** 
*  Remove unused admin navigation items for non-Administrator accounts
*/
function fwd_remove_admin_links() {
	if ( !current_user_can( 'manage_options' ) ) {
			remove_menu_page( 'edit.php' );	// Remove Posts link
    		remove_menu_page( 'edit-comments.php' );  // Remove Comments link
	}
}
add_action( 'admin_menu', 'fwd_remove_admin_links' );

/** 
*  Reorder admin navigation items 
*/

// Customize the WordPress Admin Menu
function fwd_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;

    // Modify the following array to reorder the menu
    // Add links, remove links, reorder links
    return array(
        'index.php',               // Dashboard
        'separator1',              // First separator
		'edit.php?post_type=vb-testimonial', // Testimonial
		'edit.php?post_type=vb-experience', // Experience
        'edit.php?post_type=page', // Pages
        'upload.php',              // Media
        'separator2',              // Second separator
        'themes.php',              // Appearance
        'users.php',               // Users
        'tools.php',               // Tools
        'options-general.php',     // Settings
        'separator-last',          // Last separator
    );
}
add_filter( 'custom_menu_order', 'fwd_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'fwd_custom_menu_order', 10, 1 );

/**
 * Customize ACF WYSIWYG Toolbars
 */

function my_toolbars( $toolbars )
{
    // Uncomment to view format of $toolbars
    // echo '< pre >';
    //     print_r($toolbars);
    // echo '< /pre >';
    
    // Add a new toolbar called "Very Simple"
    // - this toolbar has only 1 row of buttons
    $toolbars['Very Simple' ] = array();
    $toolbars['Very Simple' ][1] = array('bold' , 'italic' , 'underline' );

    // return $toolbars - IMPORTANT!
    return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );

/**
 * Remove block editor from some page
 * Note: This will switch from block editor to classic editor.
 * The classic editor uses content editor. If you want to disable content editor, go to ACF and check "content editor" in Hide on screen in Setting > Presentation.
 */
function fwd_post_filter( $use_block_editor, $post ) {
    // Change 75 to your Page ID
    $page_ids = array( 33 ,21 ,101 ,144 ,41 ,24 ,70 ,);
    if ( in_array( $post->ID, $page_ids ) ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'fwd_post_filter', 10, 2 );