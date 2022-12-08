<?php

function vb_register_custom_post_types() {

    // Testimonial CPT
    $labels = array(
        'name'               => _x( 'Testimonial', 'post type general name' ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name'),
        'menu_name'          => _x( 'Testimonial', 'admin menu' ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'testimonial' ),
        'add_new_item'       => __( 'Add New Testimonial' ),
        'new_item'           => __( 'New Testimonial' ),
        'edit_item'          => __( 'Edit Testimonial' ),
        'view_item'          => __( 'View Testimonial' ),
        'all_items'          => __( 'All Testimonial' ),
        'search_items'       => __( 'Search Testimonial' ),
        'parent_item_colon'  => __( 'Parent Testimonial:' ),
        'not_found'          => __( 'No Testimonial found.' ),
        'not_found_in_trash' => __( 'No Testimonial found in Trash.' ),
        'archives'           => __( 'Testimonial Archives'),
        'insert_into_item'   => __( 'Insert into testimonial'),
        'uploaded_to_this_item' => __( 'Uploaded to this testimonial'),
        'filter_item_list'   => __( 'Filter Testimonial list'),
        'items_list_navigation' => __( 'Testimonial list navigation'),
        'items_list'         => __( 'Testimonial list'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonial' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        // 'menu_position'      => 10,  // Order admin menu using "custom_menu_order" filter 
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array('title','editor'),
    );
    register_post_type( 'vb-testimonial', $args );

    // Experience CPT
    $labels = array(
        'name'               => _x( 'Experience', 'post type general name' ),
        'singular_name'      => _x( 'Experience', 'post type singular name'),
        'menu_name'          => _x( 'Experience', 'admin menu' ),
        'name_admin_bar'     => _x( 'Experience', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'experience' ),
        'add_new_item'       => __( 'Add New Experience' ),
        'new_item'           => __( 'New Experience' ),
        'edit_item'          => __( 'Edit Experience' ),
        'view_item'          => __( 'View Experience' ),
        'all_items'          => __( 'All Experience' ),
        'search_items'       => __( 'Search Experience' ),
        'parent_item_colon'  => __( 'Parent Experience:' ),
        'not_found'          => __( 'No experience found.' ),
        'not_found_in_trash' => __( 'No experience found in Trash.' ),
        'archives'           => __( 'Experience Archives'),
        'insert_into_item'   => __( 'Insert into experience'),
        'uploaded_to_this_item' => __( 'Uploaded to this experience'),
        'filter_item_list'   => __( 'Filter experience list'),
        'items_list_navigation' => __( 'Experience list navigation'),
        'items_list'         => __( 'Experience list'),
        'featured_image'     => __( 'Experience featured image'),
        'set_featured_image' => __( 'Set experience featured image'),
        'remove_featured_image' => __( 'Remove experience featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'experience' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        // 'menu_position'      => 21,
        'menu_icon'          => 'dashicons-palmtree',
        'supports'           => array( 'title','thumbnail','editor' ),
        // 'template'           => array( array( 'core/paragraph'), array( 'core/button')  ),
        // 'template_lock'      => 'all',
    );
    register_post_type( 'vb-experience', $args );

}
add_action( 'init', 'vb_register_custom_post_types' );

function vb_register_taxonomies() {
    // Add Testimonial Taxonomy
    $labels = array(
        'name'              => _x( 'Testimonial Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Testimonial Categories' ),
        'all_items'         => __( 'All Testimonial Category' ),
        'parent_item'       => __( 'Parent Testimonial Category' ),
        'parent_item_colon' => __( 'Parent Testimonial Category:' ),
        'edit_item'         => __( 'Edit Testimonial Category' ),
        'view_item'         => __( 'Vview Testimonial Category' ),
        'update_item'       => __( 'Update Testimonial Category' ),
        'add_new_item'      => __( 'Add New Testimonial Category' ),
        'new_item_name'     => __( 'New Testimonial Category Name' ),
        'menu_name'         => __( 'Testimonial Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        // 'show_in_menu'      => true, //default inherited from show_ui(default true)
        // 'show_in_nav_menu'  => true, //default inherited from show_ui(default true)
        'show_in_rest'      => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'testimonial-categories' ),
    );
    register_taxonomy( 'vb-testimonial-category', array( 'vb-testimonial' ), $args );

    // Add Experience Taxonomy
    $labels = array(
        'name'              => _x( 'Experience Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Experience Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Experience Categories' ),
        'all_items'         => __( 'All Experience Category' ),
        'parent_item'       => __( 'Parent Experience Category' ),
        'parent_item_colon' => __( 'Parent Experience Category:' ),
        'edit_item'         => __( 'Edit Experience Category' ),
        'view_item'         => __( 'Vview Experience Category' ),
        'update_item'       => __( 'Update Experience Category' ),
        'add_new_item'      => __( 'Add New Experience Category' ),
        'new_item_name'     => __( 'New Experience Category Name' ),
        'menu_name'         => __( 'Experience Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        // 'show_in_menu'      => true, //default inherited from show_ui(default true)
        // 'show_in_nav_menu'  => true, //default inherited from show_ui(default true)
        'show_in_rest'      => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'experience-categories' ),
    );
    register_taxonomy( 'vb-experience-category', array( 'vb-experience' ), $args );
}
add_action( 'init', 'vb_register_taxonomies');



// This flushed permalinks if the themes are switched.
function vb_rewrite_flush() {
    vb_register_custom_post_types();
    vb_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'vb_rewrite_flush' );
?>