<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>



  



<?php $wpblog_fetrdimg = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    if(empty($wpblog_fetrdimg)) { ?>
    
    
    
    
    <div class="featured-hero" style="background-image: url(https://cdn.shortpixel.ai/client/q_glossy,ret_img/https://beta.bc-mortgage-broker.ca/wp-content/uploads/2019/11/banner.jpg);"></div>
    
    <?php } else { ?>
     
     
        <div class="featured-hero" style="background:url(<?php echo $wpblog_fetrdimg; ?>);"></div>
     
    <?php }  ?>
            
                    
            
  
  


<div class="main-container innerpages">
	<div class="main-grid nomarginblog">
		<main class="main-content blog_left">
			<div  class="pagecontent">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; ?>
			</div>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>




<?php
get_footer();
