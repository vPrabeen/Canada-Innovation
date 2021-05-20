<?php /*Add Metabox to Contact*/

new WPAlchemy_MetaBox(array
(
	'id' => '_youtube_settings',
	'title' => 'Test Meta Box',
	'exclude_template' => array('front-page.php'),
	'context' => 'normal',
	'priority' => 'high',
	'template' => get_stylesheet_directory().'/inc/metaboxes/videoSettings.php',
));

new WPAlchemy_MetaBox(array
(
	'id' => '_youtube_settings2',
	'title' => 'Test Meta Box',
	'types' => array('post'),
	'context' => 'normal',
	'priority' => 'high',
	'template' => get_stylesheet_directory().'/inc/metaboxes/videoSettings.php',
));


?>