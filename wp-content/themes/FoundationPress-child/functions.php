<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Format comments */
require_once( 'library/class-foundationpress-comments.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/class-foundationpress-top-bar-walker.php' );
require_once( 'library/class-foundationpress-mobile-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** Gutenberg editor support */
require_once( 'library/gutenberg.php' );

require_once( 'library/custompost-slider.php' );

require_once( 'library/custompost-certification.php' );

require_once( 'library/custompost-contact.php' );
/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */
add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

});
</script>



<?php


}


function wpb_author_info_box( $content ) {
 
global $post;
 
// Detect if it is a single post with a post author
if ( is_single() && isset( $post->post_author ) ) {
 
// Get author's display name 
$display_name = get_the_author_meta( 'display_name', $post->post_author );
 
// If display name is not available then use nickname as display name
if ( empty( $display_name ) )
$display_name = get_the_author_meta( 'nickname', $post->post_author );
 
// Get author's biographical information or description
$user_description = get_the_author_meta( 'user_description', $post->post_author );
 
// Get author's website URL 
$user_website = get_the_author_meta('url', $post->post_author);
 
// Get link to the author archive page
$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
  
if ( ! empty( $display_name ) )
 
$author_details = '<p class="author_name">About ' . $display_name . '</p>';
 
if ( ! empty( $user_description ) )
// Author avatar and bio
 
$author_details .= '<p class="author_details">' . get_avatar( get_the_author_meta('user_email') , 90 ) . nl2br( $user_description ). '</p>';
 
$author_details .= '<p class="author_links"><a href="'. $user_posts .'">View all posts by ' . $display_name . '</a>';  
 
// Check if author has a website in their profile
if ( ! empty( $user_website ) ) {
 
// Display author website link
$author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';
 
} else { 
// if there is no author website then just close the paragraph
$author_details .= '</p>';
}
 
// Pass all this info to post content  
$content = $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
}
return $content;
}
 
// Add our function to the post content filter 
add_action( 'the_content', 'wpb_author_info_box' );
 
// Allow HTML in author bio section 
remove_filter('pre_user_description', 'wp_filter_kses');
/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );




// Register and load the widget
function wpb_load_widget() {
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 
// Creating the widget 
class wpb_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'wpb_widget', 
 
// Widget name will appear in UI
__('Recent Post Advance Widget', 'wpb_widget_domain'), 
 
// Widget description
array( 'description' => __( 'Recent Post Advance Widget For Side Bar', 'wpb_widget_domain' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
 
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
?>
<?php // WP_Query arguments
$args = array (
	'post_type'              => $instance['posttype'],
	'post_status'            => array( 'publish' ),
	'posts_per_page'		 =>	$instance['noofpost'],		
	'order'                  => 'ASC',
);

// The Query
$postobj = new WP_Query( $args );

if( $postobj->have_posts() ) :
?>
<div class="recent_post_nw">
  <ul>
    <?php
      while( $postobj->have_posts() ) :
        $postobj->the_post();
        $image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        ?>
          <li><a href="<?php the_permalink(); ?>">
          	<img src="<?php echo $image[0] ?>" width="40" height="30">
          	<?php the_title(); ?> </a>
          </li>
        <?php
      endwhile;
      wp_reset_postdata();
    ?>
  </ul>
 </div>
<?php
else :
  esc_html_e( 'No Post Found!', 'text-domain' );
endif;
?>

<?php echo $args['after_widget'];
}
         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Recent Post', 'wpb_widget_domain' );
}

if ( isset( $instance[ 'posttype' ] ) ) {
$posttype = $instance[ 'posttype' ];
}
else {
$posttype = 'post' ;
}

if (isset( $instance[ 'noofpost' ] ) ) {
$noofpost = $instance[ 'noofpost' ];
}
else {
$noofpost = 5 ;
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'posttype' ); ?>"><?php _e( 'Posttype:' ); ?></label> 
<!--<input class="widefat" id="<?php echo $this->get_field_id( 'posttype' ); ?>" name="<?php echo $this->get_field_name( 'posttype' ); ?>" type="text" value="<?php echo esc_attr( $posttype ); ?>" />-->
<?php 
	$get_cpt_args = array(
		'public'   => true,
    	'_builtin' => false				
	);
	$post_types = get_post_types($get_cpt_args);
?>
<?php 
	$posttypearray[]='post';
	foreach ( $post_types as $cpt_key => $cpt_val ) { 
			$posttypearray[]=$cpt_key;
	}
	
?>
<select class="widefat" id="<?php echo $this->get_field_id( 'posttype' ); ?>" name="<?php echo $this->get_field_name( 'posttype' ); ?>">
	<?php foreach ( $posttypearray as  $posttypearrayVal ) { ?>
		<?php
				if($posttypearrayVal== $instance[ 'posttype' ])
				{
					$select='selected';
				}
				else
				{
					$select='';
				}
			?>
			<option value="<?php echo $posttypearrayVal ?>" <?php echo $select ?>><?php echo $posttypearrayVal ?></option>
		<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'noofpost' ); ?>"><?php _e( 'No Of Post:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'noofpost' ); ?>" name="<?php echo $this->get_field_name( 'noofpost' ); ?>" type="text" value="<?php echo esc_attr( $noofpost ); ?>" />
</p>


<?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['posttype'] = ( ! empty( $new_instance['posttype'] ) ) ? strip_tags( $new_instance['posttype'] ) : '';
$instance['noofpost'] = ( ! empty( $new_instance['noofpost'] ) ) ? strip_tags( $new_instance['noofpost'] ) : '';
return $instance;
}
} // Class wpb_widget ends here


// Filter except length to 35 words.
// tn custom excerpt length
function tn_custom_excerpt_length( $length ) {
return 22;
}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );




//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
    }
add_filter('language_attributes', 'add_opengraph_doctype');
 
//Lets add Open Graph Meta Info
 
function insert_fb_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
        echo '<meta property="fb:admins" content="YOUR USER ID"/>';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="Mortgage Broker"/>';
    if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
        $default_image="http://localhost/mortgage-broker/image.jpg"; //replace this with a default image on your server or an image in your media library
        echo '<meta property="og:image" content="' . $default_image . '"/>';
    }
    else{
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
    }
    echo "
";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );


add_filter('acf/settings/remove_wp_meta_box', '__return_false');