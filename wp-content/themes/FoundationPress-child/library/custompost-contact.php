<?php
/*
* Creating a function to create our CPT
*/



function custom_post_Ccntactdetails() {
	$labels = array(
		'name'                => _x( 'Contact Details', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'Contact Details', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'Contact Details', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent Contact Details', 'twentythirteen' ),
		'all_items'           => __( 'All Contact Details', 'twentythirteen' ),
		'view_item'           => __( 'View Contact Details', 'twentythirteen' ),
		'add_new_item'        => __( 'Add New Contact Details', 'twentythirteen' ),
		'add_new'             => __( 'Add New', 'twentythirteen' ),
		'edit_item'           => __( 'Edit Contact Details', 'twentythirteen' ),
		'update_item'         => __( 'Update Contact Details', 'twentythirteen' ),
		'search_items'        => __( 'Search Contact Details', 'twentythirteen' ),
		'not_found'           => __( 'Not Found', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	);
	$args = array(
		'label'               => __( 'Contact Details', 'twentythirteen' ),
		'description'         => __( 'Contact Details news and reviews', 'twentythirteen' ),
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
	register_post_type( 'cntactdetails', $args );
}
add_action( 'init', 'custom_post_Ccntactdetails', 0 );

