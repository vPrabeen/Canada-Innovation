<?php
/*
Template Name: Contact
*/
get_header(); ?>


<div class="banner">
  <div id="slider2">
          <div>
                  <?php 
                  $contactimage = get_field('contact_page_banner');
                  if( !empty( $contactimage ) ): ?>
                      <img src="<?php echo esc_url($contactimage['url']); ?>" alt="<?php echo esc_attr($contactimage['alt']); ?>" />
                  <?php endif; ?>
                  <div class="caption">
                    <div class="main">
                        <h2 class="mt-8"><?php the_title(); ?></h2>
                       
                      </div>
                  </div>
              </div>
        </div>
  </div>

  <div class="bodymain p-0"> 
         <div class="map">
           <div class="grid-container">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2607.38574520735!2d-123.10195358460675!3d49.19324147932172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x548675040e69c091%3A0x278d36d5c867e99b!2sCanada%20Innovative%20Financial%20-%20Mortgage%20Architects%20%7C%20Mortgage%20Broker!5e0!3m2!1sen!2sin!4v1574090041657!5m2!1sen!2sin" width="100%" height="406" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
             </div>
         </div>

<div class="span_5">
         <div class="grid-container">
                 <div class="contact_area bor-none">
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
