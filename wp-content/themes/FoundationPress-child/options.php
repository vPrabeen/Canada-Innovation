<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'options-framework-theme';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'mortgagebroker'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __( 'One', 'mortgagebroker' ),
		'two' => __( 'Two', 'mortgagebroker' ),
		'three' => __( 'Three', 'mortgagebroker' ),
		'four' => __( 'Four', 'mortgagebroker' ),
		'five' => __( 'Five', 'mortgagebroker' )
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __( 'French Toast', 'mortgagebroker' ),
		'two' => __( 'Pancake', 'mortgagebroker' ),
		'three' => __( 'Omelette', 'mortgagebroker' ),
		'four' => __( 'Crepe', 'mortgagebroker' ),
		'five' => __( 'Waffle', 'mortgagebroker' )
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __( 'Basic Settings', 'mortgagebroker' ),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => __( 'Logo', 'mortgagebroker' ),
		'desc' => __( 'This creates a full size uploader that previews the image.', 'mortgagebroker' ),
		'id' => 'example_uploader',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => __( 'Copyright Text', 'mortgagebroker' ),
		'desc' => __( '' ),
		'id' => 'copyright',
		'std' => '',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => __( 'Contact Information', 'mortgagebroker' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( 'Email', 'mortgagebroker' ),
		'desc' => __( '' ),
		'id' => 'mailid',
		'std' => '',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( 'Phone Number', 'mortgagebroker' ),
		'desc' => __( '' ),
		'id' => 'phonenumber',
		'std' => '',
		'type' => 'text'
	);

	

	

	return $options;
}