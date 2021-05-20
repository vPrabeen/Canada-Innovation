<?php
/*
* Creating a function to create our CPT
*/



function custom_post_type() {
	$labels = array(
		'name'                => _x( 'Slider', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'Slider', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'Slider', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent Slider', 'twentythirteen' ),
		'all_items'           => __( 'All Slider', 'twentythirteen' ),
		'view_item'           => __( 'View Slider', 'twentythirteen' ),
		'add_new_item'        => __( 'Add New Slider', 'twentythirteen' ),
		'add_new'             => __( 'Add New', 'twentythirteen' ),
		'edit_item'           => __( 'Edit Slider', 'twentythirteen' ),
		'update_item'         => __( 'Update Slider', 'twentythirteen' ),
		'search_items'        => __( 'Search Slider', 'twentythirteen' ),
		'not_found'           => __( 'Not Found', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	);
	$args = array(
		'label'               => __( 'Slider', 'twentythirteen' ),
		'description'         => __( 'Slider news and reviews', 'twentythirteen' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'          => array( 'genres' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'slider', $args );
}
add_action( 'init', 'custom_post_type', 0 );

