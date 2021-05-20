<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
	<p>
    	<label>Test Meta Box </label>
		 <?php $mb->the_field('youtubevideo');	?>
         
          <textarea id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"></textarea>
	</p>
	
    
</div>