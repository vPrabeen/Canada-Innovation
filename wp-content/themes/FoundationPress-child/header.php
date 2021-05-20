<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link defar href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&display=swap" rel="stylesheet">
        
            
            
         <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>   -->
            
            
            
            <?php
            $schema = get_post_meta(get_the_ID(), 'schema', true);
            if(!empty($schema)) {
             echo $schema;
            }
            ?>


		<?php wp_head(); ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-75076874-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-75076874-1');
</script>

<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1074053502963646');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1074053502963646&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

	</head>
	<body <?php body_class(); ?>>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>


<header class="header">
<div class="header-top">
  <div class="grid-container">
   <div class="call"><i class="fa fa-phone-square" aria-hidden="true"></i> <a href="tel:<?php echo of_get_option( 'phonenumber', 'no entry' ); ?>"><?php echo of_get_option( 'phonenumber', 'no entry' ); ?></a></div>
   <div class="mail"><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:<?php echo of_get_option( 'mailid', 'no entry' ); ?>"><?php echo of_get_option( 'mailid', 'no entry' ); ?></a></div>
  </div>
  <div class="clear"></div>
</div>
<div class="header-bottom"> 
    <div class="grid-container">
        <div class="logo">
            <?php $logo = of_get_option( 'logo' );
            if(empty($logo)) {
            ?>
            <a href="<?php bloginfo('home'); ?>/"><img src="<?php bloginfo('template_url')?>/src/assets/images/logo.png" alt="<?php bloginfo('name'); ?>" /></a>     
            <?php } else { ?>
             <a href="<?php bloginfo('home'); ?>/"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" /></a>
            <?php }  ?>
        </div>
        <div class="menu_icon">
            <a href="javascript:void(0)" onclick="openNav()"><img src="<?php bloginfo('template_url')?>/src/assets/images/menu_icon.png" alt="" /></a>
            <div id="myNav" class="overlay">
                <div class="overlay-content">
                    <div class="menu_header">
                        <div class="menu_text">Menu</div>
                         <div class="close_icon"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a></div>
                    </div>
                    <?php wp_nav_menu( array( 'theme_location' => 'primary' , 'menu_class'=>'' ) ); ?>
                  </div>
            </div>
        </div>
        <div class="navigation">
        	<nav class="nav">
                	<?php wp_nav_menu( array( 'theme_location' => 'primary' , 'menu_class'=>'') ); ?>
                    <div class="clear"></div>
            </nav>
            <a href="https://velocity.newton.ca/sso/public.php?sc=18zc389tp8pvk" class="apply_btn" window="new">Apply Now</a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</header>