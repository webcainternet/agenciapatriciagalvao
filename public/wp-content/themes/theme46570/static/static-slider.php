<?php /* Static Name: Slider */ ?>
<?php if(of_get_option('slider_type') != 'none_slider'){ ?>
	<div id="slider-wrapper" class="slider">
	    	<?php get_slider_template_part(); ?>
	</div><!-- .slider -->
<?php }else{ ?>
	<div class="slider_off"><!--slider off--></div>
<?php } ?>