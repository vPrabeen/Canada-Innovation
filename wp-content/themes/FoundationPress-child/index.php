<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="main-container">
	<div class="main-grid nomarginblog">
		<main class="main-content">
			<div class="grid-x grid-margin-x">

			<?php if ( have_posts() ) : ?>

			<?php ?>
			<?php while ( have_posts() ) : the_post(); ?>


			<div class="item medium-6 cell">
                <div class="blogbox">
                  <?php the_post_thumbnail( 'full' ); ?>
                  <h3><?php echo $post->post_title; ?></h3>
                  <?php the_excerpt(); ?>
                  <div class="clear">
                    <div class="user"><i class="fa fa-user" aria-hidden="true"></i> <?php the_author();  ?></div>
                    <div class="comment"><i class="fa fa-comment" aria-hidden="true"></i> <?php echo get_comments_number(); ?> Comments</div>
                    <div class="clear"></div>
                  </div>
                  <a href="<?php echo get_permalink($post->ID); ?>" class="readmore">Read More</a>
                </div>
              </div>
                <?php endwhile; ?>
               <?php endif;  ?>

			<?php  ?>
			
			
             </div>
             <?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php
			if ( function_exists( 'foundationpress_pagination' ) ) :
				foundationpress_pagination();
			elseif ( is_paged() ) :
			?>
				<nav id="post-nav">
					<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
					<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
				</nav>
			<?php endif; ?>
		</main>
		<?php get_sidebar(); ?>

	</div>
</div>
<?php get_footer();
