<?php
/*
* Creating a function to create our CPT
*/



function custom_post_certification() {
	$labels = array(
		'name'                => _x( 'Certification', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'Certification', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'Certification', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent Certification', 'twentythirteen' ),
		'all_items'           => __( 'All Certification', 'twentythirteen' ),
		'view_item'           => __( 'View Certification', 'twentythirteen' ),
		'add_new_item'        => __( 'Add New Certification', 'twentythirteen' ),
		'add_new'             => __( 'Add New', 'twentythirteen' ),
		'edit_item'           => __( 'Edit Certification', 'twentythirteen' ),
		'update_item'         => __( 'Update Certification', 'twentythirteen' ),
		'search_items'        => __( 'Search Certification', 'twentythirteen' ),
		'not_found'           => __( 'Not Found', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	);
	$args = array(
		'label'               => __( 'Certification', 'twentythirteen' ),
		'description'         => __( 'Certification news and reviews', 'twentythirteen' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
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
	register_post_type( 'certification', $args );
}
add_action( 'init', 'custom_post_certification', 0 );

