<?php
	$motopress_cam_id = uniqid();
	$sliderHeight = "389px";

	// WPML filter
	$suppress_filters = get_option('suppress_filters');

	// query
	$args = array(
		'post_type'        => 'slider',
		'posts_per_page'   => -1,
		'post_status'      => 'publish', 
		'orderby'          => 'name',
		'order'            => 'ASC',
		'suppress_filters' => $suppress_filters
		);
	$slides = get_posts($args);
	if (empty($slides)) return;
?>

<script type="text/javascript">
		jQuery(document).ready(function() {
			var myAccordion 	= jQuery('#accordion<?php echo $motopress_cam_id; ?>'),
				myAccordionList = jQuery('ul', myAccordion),
				sliderImg       = jQuery(".slider_img", myAccordionList),
				imagesCount     = sliderImg.length,
				imagesLoaded    = 0,
				startingSlide   = <?php echo of_get_option('acc_starting_slide')-1; ?>,
				easing          = "<?php echo (of_get_option('acc_easing')!="") ? of_get_option('acc_easing') : 'easeOutCubic'; ?>",
				speed           = <?php echo (of_get_option('acc_animation_speed')!="") ? of_get_option('acc_animation_speed') : 700; ?>,
				auto            = <?php echo (of_get_option('acc_slideshow')!="") ? of_get_option('acc_slideshow') : true; ?>;
			if(auto && startingSlide<0){
				startingSlide = 0;
			}

			if (!myAccordion.hasClass('motopress-accordion')) {
				myAccordion.addClass('motopress-accordion');
				function checkLoadImg(){
					if(imagesLoaded>=imagesCount){
						jQuery('.accordion_loader', myAccordion).stop(true).delay(1000).fadeOut(500);
						setTimeout(function(){
							jQuery("ul", myAccordion).css({"visibility":"visible", "display":"none"}).stop(true, true).fadeIn(1000);
							resizeWindow();
						},
						1000);
					}
				}
				function resizeWindow(){
					var getImgHeight = sliderImg.height();
					myAccordionList.css({"height":getImgHeight});
					jQuery("li", myAccordionList).css({"height":getImgHeight});
					myAccordion.css({"height":getImgHeight});
				}
				function mouseLeaveSlider(){
					if(!auto){
						var sliderImgWidth = 100/imagesCount;
						jQuery(">li", myAccordionList).each(function(index){
							jQuery(this).removeClass("accordion_slider-open").addClass("accordion_slider-closed").stop(true).animate({'left':index*sliderImgWidth+"%", 'cursor':'pointer'}, speed, easing);
							
						})
						myAccordionList.data('current','-1');
					}
				}
				sliderImg.each(function(){
					if(jQuery(this)[0].complete){
						imagesLoaded++;
						checkLoadImg()
					}else{
						jQuery(this).bind("load", function(){
							imagesLoaded++;
							checkLoadImg()
							jQuery(this).unbind("load");
						})
					}
				})
				myAccordionList.zAccordion({
					timeout: <?php echo (of_get_option('acc_pausetime')!="") ? of_get_option('acc_pausetime') : 7000 ; ?>,
					height: "<?php echo $sliderHeight; ?>",
					width: "100%",
					slideWidth: "70%",
					tabWidth: null,
					startingSlide: startingSlide,
					trigger: "<?php echo (of_get_option('acc_trigger')!="") ? of_get_option('acc_trigger') : 'click' ; ?>",
					speed: speed,
					easing: easing,
					auto: auto,
					pause: <?php echo (of_get_option('acc_hover_pause')!="") ? of_get_option('acc_hover_pause') : true; ?>,
					slideClass: "accordion_slider",
					buildComplete: function () {
						if(startingSlide<0){
							mouseLeaveSlider();
						}
					}
				});

				jQuery(window).resize(resizeWindow);
				myAccordionList.mouseleave(mouseLeaveSlider);
			}
		});
</script>

<div id="accordion<?php echo $motopress_cam_id; ?>" class="accordion_wrap accordion" style=" height: <?php echo $sliderHeight; ?>; ">
	<ul>
		<?php
			$post_array = (of_get_option('acc_show_post')=="") ? array() : of_get_option('acc_show_post');

			foreach( $slides as $k => $slide ) {
				// Unset not translated posts
				if ( function_exists( 'wpml_get_language_information' ) ) {
					global $sitepress;

					$check              = wpml_get_language_information( $slide->ID );
					$language_code      = substr( $check['locale'], 0, 2 );
					if ( $language_code != $sitepress->get_current_language() ) unset( $slides[$k] );

					// Post ID is different in a second language Solution
					if ( function_exists( 'icl_object_id' ) ) $slide = get_post( icl_object_id( $slide->ID, 'slider', true ) );
				}

				if(in_array("1", $post_array)){
					if($post_array[$slide -> ID] == 1){
						addItem($slide);
					}
				}else{
					addItem($slide);
				}
			}
			wp_reset_postdata();

			function addItem($slide){
				$url          = get_post_meta($slide->ID, 'my_slider_url', true);
				$caption      = get_post_meta($slide->ID, 'my_slider_caption', true);
				$sl_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($slide->ID), 'slider-post-thumbnail');
				$img_class    = "";

				if($sl_image_url[0]==""){
					$sl_image_url[0] = PARENT_URL."/images/blank.gif";
					$img_class = 'max_height';
				}
				if($url!=""){
					$url = '<a href="'.$url.'" title="'.theme_locals('read_more').'" class="btn btn-primary" >'.theme_locals('read_more').'</a>';
				}
				if ($caption) {
					$caption = stripslashes(htmlspecialchars_decode($caption));
				}
				echo '<li>';
					echo '<img src="'.$sl_image_url[0].'" width="100%" height="auto" class="slider_img '.$img_class.'" alt="">';
					if($caption!="" || $url!=""){
						echo '<div class="accordion_caption">'.$caption.$url.'</div>';
					}
				echo '</li>';
			}
		?>
	</ul>
	<div class="accordion_loader"></div>
</div>