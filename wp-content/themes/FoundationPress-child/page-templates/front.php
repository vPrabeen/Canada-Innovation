<?php
/*
Template Name: Front
*/
get_header(); ?>

<div class="banner">
	<div style="position:relative;">
		    <div id="slider" class="owl-carousel owl-theme">

            <?php
            query_posts('post_type=slider&posts_per_page=-1');
            if (have_posts()) : while (have_posts()) : the_post();
            ?>

            <div class="item">
              <?php the_post_thumbnail( 'full' ); ?>
              <div class="caption">
                <div class="grid-container">
                    <?php the_content(); ?>
                    <a href="<?php the_field('slider_button'); ?>" class="banner_read_btn">Read More</a>
                  </div>
              </div>
            </div>
            <?php endwhile; ?>
            <?php endif; wp_reset_query();?>
    	   </div>
    </div>
</div>

<div class="bodygrid-container"> 
  	<div class="grid-container">
        <div class="span_1 ">
        	<div class="grid-x grid-margin-x">
        	<div class="medium-6 cell">
            	   <?php the_content(); ?>
				         <a href="<?php bloginfo('url')?>/canada-innovative-financial-inc/" class="d_readmore">Read More</a>
            </div>

            <div class="medium-6 cell">
            	<?php the_post_thumbnail( 'full' ); ?>
            </div>
        </div>
     	</div>
        <div class="certification">
          <h2>Certification</h2>
            <?php
            query_posts('post_type=certification&posts_per_page=-1&order=ASC');
            if (have_posts()) : while (have_posts()) : the_post();
            ?>
            <div class="img"><?php the_post_thumbnail( 'full' ); ?></div>
            <?php endwhile; ?>
            <?php endif; wp_reset_query();?>
        </div>
	</div>
        
            <div class="review">
              <div class="grid-container">
                <h2>Google Reviews</h2>
                <!-- <div class="review_area">
                   <div id="review" class="owl-carousel owl-theme">
                      <div class="item">
                        <div class="review_box">
                     <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                     </div>
                     <p><span><i class="fa fa-quote-left" aria-hidden="true"></i></span> Jeff was very helpful and knowledgeable. He has helped me with two mortgage deals and both times were a good experience. Would  definitely recommend Jeff.</p>
                     <div class="review_user_area">
                        <div class="review_user">
                          <img src="<?php bloginfo('template_url');?>/src/assets/images/user.png" alt="">
                          <h3>Ernest Grundza<br><span>4/15/2019</span></h3>
                         </div>
                       <div class="clear"></div>
                     </div>
                   </div>
                      </div>
                      <div class="item">
                        <div class="review_box">
                     <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                     </div>
                     <p><span><i class="fa fa-quote-left" aria-hidden="true"></i></span> Thank you so much Jeff Evans for all your hard work and help finding the best rate for our new home. Your very honest and if we have questions you answers it right away!!</p>
                     <div class="review_user_area">
                        <div class="review_user">
                          <img src="<?php bloginfo('template_url');?>/src/assets/images/user_2.png" alt="">
                          <h3>Bessie Espiritu<br><span>3/12/2019</span></h3>
                         </div>
                       <div class="clear"></div>
                     </div>
                   </div>
                      </div>
                      <div class="item">
                        <div class="review_box">
                     <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                     </div>
                     <p><span><i class="fa fa-quote-left" aria-hidden="true"></i></span> Jeff worked hard to assist  with our mortgage needs. His time and effort was very much appreciated.</p>
                     <div class="review_user_area">
                        <div class="review_user">
                          <img src="<?php bloginfo('template_url');?>/src/assets/images/user_3.png" alt="">
                          <h3>Rod Simpson<br><span>1/21/2019</span></h3>
                         </div>
                       <div class="clear"></div>
                     </div>
                   </div>
                      </div>
                    </div>
                   <div class="clear"></div>
                </div> -->

                <?php do_action( 'wprev_pro_plugin_action', 1 ); ?>

                <div class="w100"><a href="https://search.google.com/local/reviews?placeid=ChIJkcBpDgR1hlQRm-lnyNU2jSc" class="view-btm mt-3">View All Reviews</a></div>
              </div>
            </div>
            
             <div class="span_2">
               <div class="grid-container">
                <h2><span>Mortgage Lenders</span><br>in Vancouver BC, Canada</h2>
                <div class="clear display-flex display-flex-none">
                  <div class="span_2_left"><img src="<?php the_field('mortgage_lenders_image');?>" alt=""></div>
                  <div class="span_2_right">
                    <?php the_field('mortgage_lenders_content');?>
                  </div>
                  <div class="clear"></div>
                </div>
               </div>
             </div>
         
             <div class="span_3">
               <div class="grid-container">
                 <h2>Our Blog</h2>
                 <div id="blog" class="owl-carousel owl-theme">
                  <?php $posts = get_posts( "numberposts=3" ); ?>
                  <?php if( $posts ) : ?>
                  <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
                      


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


                  <?php endforeach; ?>
                  <?php endif; wp_reset_query(); ?>
                  
                  
                  
                </div>
                <div class="w100 text-center"><a href="<?php bloginfo('url');?>/blog" class="view-btm mt-3">View All Blog</a></div>
               </div>
             </div>
         
             <div class="span_4">
               <div class="grid-container">
                 <div class="downlode_area">
                  <?php 
                  $downloadimage = get_field('download_section_image');
                  if( !empty( $downloadimage ) ): ?>
                      <img src="<?php echo esc_url($downloadimage['url']); ?>" alt="<?php echo esc_attr($downloadimage['alt']); ?>" />
                  <?php endif; ?>


                  <div class="left">
                   <?php the_field('download_section_content'); ?>
                   	
	                    <?php echo do_shortcode( '[contact-form-7 id="54" title="Download form"]' ); ?>

                  </div>
                 </div>
               </div>
             </div>
         
             <div class="span_5">
               <div class="grid-container">
                 <div class="contact_area">
                   <div id="contact" class="owl-carousel owl-theme">
                      
                       

                      <?php
            query_posts('post_type=cntactdetails&posts_per_page=-1&order=ASC');
            if (have_posts()) : while (have_posts()) : the_post();
            ?>
            
            <div class="item display-flex">
                <div class="contact_left">
                  <div class="img"><?php the_post_thumbnail( 'full' ); ?></div>
                  <h2><?php the_title(); ?></h2>
                  <h3><?php the_field('degisnation'); ?></h3>
                </div>
                <div class="contact_right">
                  <div class="locaton disflex">
                    <div class="dis_icon"><img src="<?php bloginfo('template_url');?>/src/assets/images/location.png" alt=""></div>
                    <div class="dis_con"><?php the_field('address_1'); ?></div>
                  </div>
                  <div class="locaton disflex">
                    <div class="dis_icon"><img src="<?php bloginfo('template_url');?>/src/assets/images/location.png" alt=""></div>
                   <div class="dis_con"><?php the_field('address_2'); ?></div>
                  </div>
                  <div class="call disflex">
                    <div class="dis_icon"><img src="<?php bloginfo('template_url');?>/src/assets/images/call.png" alt=""></div>
                    <div class="dis_con"><a href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?></a></div>
                  </div>
                  <div class="msg disflex">
                    <div class="dis_icon"><img src="<?php bloginfo('template_url');?>/src/assets/images/msg.png" alt=""></div>
                    <div class="dis_con"><a href="mailto:<?php the_field('email_id'); ?>"><?php the_field('email_id'); ?></a></div>
                  </div>
                </div>
              </div>


            <?php endwhile; ?>
            <?php endif; wp_reset_query();?>


                      
                      

                    </div>
                 </div>
               </div>
             </div>
             
    </div>

<?php get_footer();
