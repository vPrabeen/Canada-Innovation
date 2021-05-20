<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>


<div class="main-container">
	<div class="main-grid nomarginblog">
		<main class="main-content blog_left innerpages">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="img"><?php the_post_thumbnail('full'); ?></div>
				<h1><?php the_title(); ?></h1>
				<div class="clear">
	                <div class="user"><i class="fa fa-user" aria-hidden="true"></i> <?php the_author();  ?></div>
	                <div class="comment"><i class="fa fa-comment" aria-hidden="true"></i> <?php echo get_comments_number(); ?> Comments</div>
	                <div class="clear"></div>
	            </div>
	            <div><?php the_content(); ?></div>

	            	<h2>Related</h2>
	            	<div class="relatd_b">
             	    <?php
						$tags = wp_get_post_tags($post->ID);
						if ($tags) {
						$first_tag = $tags[0]->term_id;
						$args=array(
						'tag__in' => array($first_tag),
						'post__not_in' => array($post->ID),
						'posts_per_page'=>5,
						'caller_get_posts'=>3
						);

						$my_query = new WP_Query($args);
						if( $my_query->have_posts() ) {
						while ($my_query->have_posts()) : $my_query->the_post(); 

							


						?>
							<ul class="related_bx">
			                    <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
			                    <li>
			                    	<?php the_date();?><br>
			                    	<?php 
    foreach((get_the_category()) as $category){
        echo $category->name."<br>";
        }
    ?>

			                	</li>
			                </ul>


						 
						<?php
						endwhile;
						}
						wp_reset_query();
						}
						?>
						</div>
						<div class="clear"></div>









             	    <div class="clear mt-3">
             	    <?php if (get_the_author_meta('description')) : // Checking if the user has added any author descript or not. If it is added only, then lets move ahead ?>
					    <div class="author-box">
					        <div class="author-img"><?php echo get_avatar(get_the_author_meta('user_email'), '100'); // Display the author gravatar image with the size of 100 ?></div>
					        <h3 class="author-name"><?php esc_html(the_author_meta('display_name')); // Displays the author name of the posts ?></h3>
					        <p class="author-description"><?php esc_textarea(the_author_meta('description')); // Displays the author description added in Biographical Info ?></p>
					    </div>
					<?php endif; ?>
					</div>



				<!-- <?php the_post_navigation(); ?> -->


				<div class="blog_con"> <div class="get"><?php comments_template(); ?> </div> </div>


			<?php endwhile; ?>
		</main>

		<?php get_sidebar(); ?>


		<div class="span_3">
               <div class="grid-container">
                 <h2>Related Articles</h2>
                 <div id="blog" class="owl-carousel owl-theme">
                  
                 	<?php
						$tags = wp_get_post_tags($post->ID);
						if ($tags) {
						$first_tag = $tags[0]->term_id;
						$args=array(
						'tag__in' => array($first_tag),
						'post__not_in' => array($post->ID),
						'posts_per_page'=>5,
						'caller_get_posts'=>3
						);

						$my_query = new WP_Query($args);
						if( $my_query->have_posts() ) {
						while ($my_query->have_posts()) : $my_query->the_post(); 

							


						?>
						


                      <div class="item">
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
                  <?php
						endwhile;
						}
						wp_reset_query();
						}
						?>
                </div>
               </div>
             </div>
	</div>
</div>
<?php get_footer();
