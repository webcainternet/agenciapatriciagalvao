<?php
	// Loading child theme textdomain
	load_child_theme_textdomain( CURRENT_THEME, get_stylesheet_directory() . '/languages' );
        
        require_once('my_script.php');
        
        // function to display number of posts.
        function getPostViews($postID){
            $count_key = 'post_views_count';
            $count = get_post_meta($postID, $count_key, true);
            if($count==''){
                delete_post_meta($postID, $count_key);
                add_post_meta($postID, $count_key, '0');
                return __('Views', CURRENT_THEME);
            }
            if($count==1){
                return $count.' '.__('View', CURRENT_THEME);
            } else {
                return $count.' '.__('Views', CURRENT_THEME);
            }
        }
           
        // function to count views.
        function setPostViews($postID) {
            $count_key = 'post_views_count';
            $count = get_post_meta($postID, $count_key, true);
            if($count==''){
                $count = 0;
                delete_post_meta($postID, $count_key);
                add_post_meta($postID, $count_key, '0');
            }else{
                $count++;
                update_post_meta($postID, $count_key, $count);
            }
        }
           
        // Add it to a column in WP-Admin - (Optional)
        add_filter('manage_posts_columns', 'posts_column_views');
        add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
        function posts_column_views($defaults){
            $defaults['post_views'] = __('Views', CURRENT_THEME);
            return $defaults;
        }
        function posts_custom_column_views($column_name, $id){
                if($column_name === 'post_views'){
                echo getPostViews(get_the_ID());
            }
        }
        
	// WP Pointers
	add_action('admin_enqueue_scripts', 'myHelpPointers');
	function myHelpPointers() {
	//First we define our pointers 
	$pointers = array(
	   	array(
	       'id' => 'xyz1',   // unique id for this pointer
	       'screen' => 'options-permalink', // this is the page hook we want our pointer to show on
	       'target' => '#submit', // the css selector for the pointer to be tied to, best to use ID's
	       'title' => theme_locals("submit_permalink"),
	       'content' => theme_locals("submit_permalink_desc"),
	       'position' => array( 
	                          'edge' => 'top', //top, bottom, left, right
	                          'align' => 'left', //top, bottom, left, right, middle
	                          'offset' => '0 5'
	                          )
	       ),

	    array(
	       'id' => 'xyz2',   // unique id for this pointer
	       'screen' => 'themes', // this is the page hook we want our pointer to show on
	       'target' => '#toplevel_page_options-framework', // the css selector for the pointer to be tied to, best to use ID's
	       'title' => theme_locals("import_sample_data"),
	       'content' => theme_locals("import_sample_data_desc"),
	       'position' => array( 
	                          'edge' => 'bottom', //top, bottom, left, right
	                          'align' => 'top', //top, bottom, left, right, middle
	                          'offset' => '0 -10'
	                          )
	       ),

	    array(
	       'id' => 'xyz3',   // unique id for this pointer
	       'screen' => 'toplevel_page_options-framework', // this is the page hook we want our pointer to show on
	       'target' => '#toplevel_page_options-framework', // the css selector for the pointer to be tied to, best to use ID's
	       'title' => theme_locals("import_sample_data"),
	       'content' => theme_locals("import_sample_data_desc_2"),
	       'position' => array( 
	                          'edge' => 'left', //top, bottom, left, right
	                          'align' => 'top', //top, bottom, left, right, middle
	                          'offset' => '0 18'
	                          )
	       )
	    // more as needed
	    );
		//Now we instantiate the class and pass our pointer array to the constructor 
		$myPointers = new WP_Help_Pointer($pointers); 
	};
        
//Recent Posts
if (!function_exists('shortcode_recent_posts')) {

	function shortcode_recent_posts($atts, $content = null) {		
		extract(shortcode_atts(array(
				'type'             => 'post',
				'category'         => '',
				'custom_category'  => '',
				'post_format'      => 'standard',
				'num'              => '5',
				'meta'             => 'true',
				'thumb'            => 'true',
				'thumb_width'      => '120',
				'thumb_height'     => '120',
				'more_text_single' => '',
				'excerpt_count'    => '0',
				'custom_class'     => ''
		), $atts));

		$output = '<ul class="recent-posts '.$custom_class.' unstyled">';

		global $post;
		global $my_string_limit_words;
		
		if($post_format == 'standard') {
						
			$args = array(
						'post_type'         => $type,
						'category_name'     => $category,
						$type . '_category' => $custom_category,
						'numberposts'       => $num,
						'orderby'           => 'post_date',
						'order'             => 'DESC',
						'tax_query'         => array(
						'relation'          => 'AND',
							array(
								'taxonomy' => 'post_format',
								'field'    => 'slug',
								'terms'    => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-audio', 'post-format-video'),
								'operator' => 'NOT IN'
							)
						)
					);
		
		} else {
		
			$args = array(
				'post_type'         => $type,
				'category_name'     => $category,
				$type . '_category' => $custom_category,
				'numberposts'       => $num,
				'orderby'           => 'post_date',
				'order'             => 'DESC',
				'tax_query'         => array(
				'relation'          => 'AND',
					array(
						'taxonomy' => 'post_format',
						'field'    => 'slug',
						'terms'    => array('post-format-' . $post_format)
					)
				)
			);		
		}

		$latest = get_posts($args);
		
		foreach($latest as $post) {
				setup_postdata($post);
				$excerpt        = get_the_excerpt();
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
				$url            = $attachment_url['0'];
				$image          = aq_resize($url, $thumb_width, $thumb_height, true);				
				
				$post_classes = get_post_class();
				foreach ($post_classes as $key => $value) {
					$pos = strripos($value, 'tag-');
					if ($pos !== false) {
						unset($post_classes[$key]);
					}
				}
				$post_classes = implode(' ', $post_classes);				

				$output .= '<li class="recent-posts_li ' . $post_classes . '">';				
				
				//Aside
				if($post_format == "aside") {
					
					$output .= the_content($post->ID);
				
				} elseif ($post_format == "link") {
				
					$url =  get_post_meta(get_the_ID(), 'tz_link_url', true);
				
					$output .= '<a target="_blank" href="'. $url . '">';
					$output .= get_the_title($post->ID);
					$output .= '</a>';				
				
				//Quote
				} elseif ($post_format == "quote") {
				
					$quote =  get_post_meta(get_the_ID(), 'tz_quote', true);
					
					$output .= '<div class="quote-wrap clearfix">';
							
							$output .= '<blockquote>';
								$output .= $quote;
							$output .= '</blockquote>';
							
					$output .= '</div>';					
				
				//Image
				} elseif ($post_format == "image") {
				
				if (has_post_thumbnail() ) :
				
					$lightbox = get_post_meta(get_the_ID(), 'tz_image_lightbox', TRUE);
					
					$src      = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( '9999','9999' ), false, '' );
					
					$thumb    = get_post_thumbnail_id();
					$img_url  = wp_get_attachment_url( $thumb,'full'); //get img URL
					$image    = aq_resize( $img_url, 200, 120, true ); //resize & crop img
					
					
					$output .= '<figure class="thumbnail featured-thumbnail large">';
						$output .= '<a class="image-wrap" rel="prettyPhoto[gallery]" title="' . get_the_title($post->ID) . '" href="' . $src[0] . '">';
						$output .= '<img src="' . $image . '" alt="' . get_the_title($post->ID) .'" />';
						$output .= '<span class="zoom-icon"></span></a>';
					$output .= '</figure>';
				
				endif;
				
				
				//Audio
				} elseif ($post_format == "audio") {
				
					$template_url = get_template_directory_uri();
					$id           = $post->ID;
					
					// get audio attribute
					$audio_title  = get_post_meta(get_the_ID(), 'tz_audio_title', true);
					$audio_artist = get_post_meta(get_the_ID(), 'tz_audio_artist', true);
					$audio_format = get_post_meta(get_the_ID(), 'tz_audio_format', true);
					$audio_url    = get_post_meta(get_the_ID(), 'tz_audio_url', true);
						
					$output .= '<script type="text/javascript">
						$(document).ready(function(){
							var myPlaylist_'. $id.'  = new jPlayerPlaylist({
							jPlayer: "#jquery_jplayer_'. $id .'",
							cssSelectorAncestor: "#jp_container_'. $id .'"
							}, [
							{
								title:"'. $audio_title .'",
								artist:"'. $audio_artist .'",
								'. $audio_format .' : "'. stripslashes(htmlspecialchars_decode($audio_url)) .'"}
							], { 
								playlistOptions: {enableRemoveControls: false},
								ready: function () {$(this).jPlayer("setMedia", {'. $audio_format .' : "'. stripslashes(htmlspecialchars_decode($audio_url)) .'", poster: "'. $image .'"});
							},
							swfPath: "'. $template_url .'/flash",
							supplied: "'. $audio_format .', all",
							wmode:"window"
							});
						});
						</script>';
						
					$output .= '<div id="jquery_jplayer_'.$id.'" class="jp-jplayer"></div>
								<div id="jp_container_'.$id.'" class="jp-audio">
									<div class="jp-type-single">
										<div class="jp-gui">
											<div class="jp-interface">
												<div class="jp-progress">
													<div class="jp-seek-bar">
														<div class="jp-play-bar"></div>
													</div>
												</div>
												<div class="jp-duration"></div>
												<div class="jp-time-sep"></div>
												<div class="jp-current-time"></div>
												<div class="jp-controls-holder">
													<ul class="jp-controls">
														<li><a href="javascript:;" class="jp-previous" tabindex="1" title="'.theme_locals("prev").'"><span>'.theme_locals("prev").'</span></a></li>
														<li><a href="javascript:;" class="jp-play" tabindex="1" title="'.theme_locals("play").'"><span>'.theme_locals("play").'</span></a></li>
														<li><a href="javascript:;" class="jp-pause" tabindex="1" title="'.theme_locals("pause").'"><span>'.theme_locals("pause").'</span></a></li>
														<li><a href="javascript:;" class="jp-next" tabindex="1" title="'.theme_locals("next").'"><span>'.theme_locals("next").'</span></a></li>
														<li><a href="javascript:;" class="jp-stop" tabindex="1" title="'.theme_locals("stop").'"><span>'.theme_locals("stop").'</span></a></li>
													</ul>
													<div class="jp-volume-bar">
														<div class="jp-volume-bar-value"></div>
													</div>
													<ul class="jp-toggles">
														<li><a href="javascript:;" class="jp-mute" tabindex="1" title="'.theme_locals("mute").'"><span>'.theme_locals("mute").'</span></a></li>
														<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="'.theme_locals("unmute").'"><span>'.theme_locals("unmute").'</span></a></li>
													</ul>
												</div>
											</div>
											<div class="jp-no-solution">
												'.theme_locals("update_required").'
											</div>
										</div>
									</div>
									<div class="jp-playlist">
										<ul>
											<li></li>
										</ul>
									</div>
								</div>';
				
				
				$output .= '<div class="entry-content">';
					$output .= get_the_content($post->ID);
				$output .= '</div>';
				
				//Video
				} elseif ($post_format == "video") {
					
					$template_url = get_template_directory_uri();
					$home_url     = home_url();
					$id           = $post->ID;
				
					// get video attribute
					$video_title  = get_post_meta(get_the_ID(), 'tz_video_title', true);
					$video_artist = get_post_meta(get_the_ID(), 'tz_video_artist', true);
					$embed        = get_post_meta(get_the_ID(), 'tz_video_embed', true);
					$m4v_url      = get_post_meta(get_the_ID(), 'tz_m4v_url', true);
					$ogv_url      = get_post_meta(get_the_ID(), 'tz_ogv_url', true);					
					
					// get thumb
					if(has_post_thumbnail()) {
						$thumb   = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
						$image   = aq_resize( $img_url, 770, 380, true ); //resize & crop img
					}

					if ($embed == '') {
						$output .= '<script type="text/javascript">
							$(document).ready(function(){							
								$("#jquery_jplayer_'. $id.'").jPlayer({
									ready: function () {
										$(this).jPlayer("setMedia", {
											m4v: "'. $home_url . '/' . stripslashes(htmlspecialchars_decode($m4v_url)) .'",
											ogv: "'. $home_url . '/' . stripslashes(htmlspecialchars_decode($ogv_url)) .'",
											poster: "'. $image .'"
										});
									},
									swfPath: "'. $template_url .'/flash",
									solution: "flash, html",
									supplied: "ogv, m4v, all",
									cssSelectorAncestor: "#jp_container_'. $id.'",
									size: {
										width: "100%",
										height: "100%"
									}
								});
							});
							</script>';
							$output .= '<div id="jp_container_'. $id .'" class="jp-video fullwidth">';
							$output .= '<div class="jp-type-list-parent">';
							$output .= '<div class="jp-type-single">';
							$output .= '<div id="jquery_jplayer_'. $id .'" class="jp-jplayer"></div>';
							$output .= '<div class="jp-gui">';
							$output .= '<div class="jp-video-play">';
							$output .= '<a href="javascript:;" class="jp-video-play-icon" tabindex="1" title="'.theme_locals("play").'">'.theme_locals("play").'</a></div>';
							$output .= '<div class="jp-interface">';
							$output .= '<div class="jp-progress">';
							$output .= '<div class="jp-seek-bar">';
							$output .= '<div class="jp-play-bar">';
							$output .= '</div></div></div>';
							$output .= '<div class="jp-duration"></div>';
							$output .= '<div class="jp-time-sep">/</div>';
							$output .= '<div class="jp-current-time"></div>';
							$output .= '<div class="jp-controls-holder">';
							$output .= '<ul class="jp-controls">';
							$output .= '<li><a href="javascript:;" class="jp-play" tabindex="1" title="'.theme_locals("play").'"><span>'.theme_locals("play").'</span></a></li>';
							$output .= '<li><a href="javascript:;" class="jp-pause" tabindex="1" title="'.theme_locals("pause").'"><span>'.theme_locals("pause").'</span></a></li>';
							$output .= '<li class="li-jp-stop"><a href="javascript:;" class="jp-stop" tabindex="1" title="'.theme_locals("stop").'"><span>'.theme_locals("stop").'</span></a></li>';
							$output .= '</ul>';
							$output .= '<div class="jp-volume-bar">';
							$output .= '<div class="jp-volume-bar-value">';
							$output .= '</div></div>';
							$output .= '<ul class="jp-toggles">';
							$output .= '<li><a href="javascript:;" class="jp-mute" tabindex="1" title="'.theme_locals("mute").'"><span>'.theme_locals("mute").'</span></a></li>';
							$output .= '<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="'.theme_locals("unmute").'"><span>'.theme_locals("unmute").'</span></a></li>';
							$output .= '</ul>';
							$output .= '</div></div>';
							$output .= '<div class="jp-no-solution">';
							$output .= theme_locals("update_required");
							$output .= '</div></div></div></div>';
							$output .= '</div>';
					} else {
						$output .= '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($embed)) . '</div>';
					}
					
					if($excerpt_count >= 1){
						$output .= '<div class="excerpt">';
							$output .= my_string_limit_words($excerpt,$excerpt_count);
						$output .= '</div>';
				}
				
				//Standard
				} else {
				
				if ($thumb == 'true') {
						if ( has_post_thumbnail($post->ID) ){
								$output .= '<figure class="thumbnail featured-thumbnail"><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
								$output .= '<img  src="'.$image.'"/>';
								$output .= '</a>';

                                                                
                                                                if (!function_exists('custom_taxonomies_terms_links')) {
                                                                        function custom_taxonomies_terms_links() {
                                                                                global $post, $post_id;
                                                                                // get post by post id
                                                                                $post = &get_post($post->ID);
                                                                                // get post type by post
                                                                                $post_type = $post->post_type;
                                                                                // get post type taxonomies
                                                                                $taxonomies = get_object_taxonomies($post_type);
                                                                                foreach ($taxonomies as $taxonomy) {
                                                                                        // get the terms related to post
                                                                                        $terms = get_the_terms( $post->ID, 'category' );
                                                                                        //if ( !empty( $terms ) ) {
                                                                                        //        $out = array();
                                                                                         //       foreach ( $terms as $term )
                                                                                          //              $out[] = '<span class="category"><a href="' .get_term_link($term->slug, 'category') .'">'.$term->name.'</a></span>';
                                                                                         //       $return = join( ', ', $out );
                                                                                        //}
                                                                                }
                                                                                return $return;
                                                                        }
                                                                }
                                                                $output .= custom_taxonomies_terms_links();
                                                                
                                                                $output .= '</figure>';
						}
					}
					$output .= '<h5><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
							$output .= get_the_title($post->ID);
					$output .= '</a></h5>';
					if($meta == 'true'){
							$output .= '<span class="meta">';
									$output .= '<span class="post-date">';
										$output .= get_the_time( 'F j, Y' );
									$output .= '</span>';
							$output .= '</span>';
					}
                                        if (has_excerpt($post->ID)) {
                                            $output .= '<span class="excerpt">';
                                                $output .= get_the_excerpt();
                                            $output .= '</span>';    
                                        } else {
                                            if($excerpt_count >= 1){
                                                    $output .= '<span class="excerpt">';
                                                            $output .= my_string_limit_words($excerpt,$excerpt_count);
                                                    $output .= '</span>';
                                            }
                                        }
					
					if($more_text_single!=""){
						$output .= '&nbsp;<a href="'.get_permalink($post->ID).'" class="btn btn-link btn-normal" title="'.get_the_title($post->ID).'">';
						$output .= $more_text_single;
						$output .= '</a>';
					}
				
				}				
			$output .= '<div class="clear"></div>';
			$output .= '</li><!-- .entry (end) -->';
		}
		$output .= '</ul><!-- .recent-posts (end) -->';
		return $output;		
	}
	add_shortcode('recent_posts', 'shortcode_recent_posts');
}

/**
 * Post List
 *
 */
if (!function_exists('posts_list_shortcode')) {

	function posts_list_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			'type' => '',
			'thumbs' => '',
			'thumb_width' => '',
			'thumb_height' => '',
			'post_content' => '',
			'numb' => '5',
			'order_by' => '',
			'order' => '',
			'link' => '',
			'link_text' => theme_locals('read_more'),
			'tags' => '',
			'custom_class' => ''
		), $atts));

		// check what order by method user selected
		switch ($order_by) {
			case 'date':
				$order_by = 'post_date';
				break;
			case 'title':
				$order_by = 'title';
				break;
			case 'popular':
				$order_by = 'meta_value_num';
                                $meta_key = 'post_views_count';
				break;
			case 'random':
				$order_by = 'rand';
				break;
		}

		// check what order method user selected (DESC or ASC)
		switch ($order) {
			case 'DESC':
				$order = 'DESC';
				break;
			case 'ASC':
				$order = 'ASC';
				break;
		}

		global $post;
		global $my_string_limit_words;
		global $_wp_additional_image_sizes;
                
                if (!isset($meta_key)) $meta_key = '';
						
		$args = array(
			'post_type' => $type,
			'numberposts' => $numb,
			'orderby' => $order_by,
                        'meta_key' => $meta_key,
			'order' => $order
		);

		$posts = get_posts($args);
		$i = 0;

		// thumbnail size
		$thumb_x = 0;
		$thumb_y = 0;
		if ($thumbs == 'large') {
			$thumb_x = 620;
			$thumb_y = 300;
		} else {
			$thumb_x = $_wp_additional_image_sizes['post-thumbnail']['width'];
			$thumb_y = $_wp_additional_image_sizes['post-thumbnail']['height'];
		}

		// thumbnail class
		$thumbs_class = '';
		if ($thumbs == 'large')
			$thumbs_class = 'large';

		$output = '<div class="posts-list '.$custom_class.'">';
		
		foreach($posts as $post) {
			setup_postdata($post);
			$excerpt = get_the_excerpt();
			$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			$url = $attachment_url['0'];
			if (($thumb_width != '') && ($thumb_height != ''))
				$image = aq_resize($url, $thumb_width, $thumb_height, true);
			else
				$image = aq_resize($url, $thumb_x, $thumb_y, true);
			
			$mediaType = get_post_meta($post->ID, 'tz_portfolio_type', true);
			$format = get_post_format();

				$output .= '<div class="row-fluid">';
				$output .= '<article class="span12 post__holder">';

					//post thumbnail
					if ((has_post_thumbnail($post->ID)) && ($format == 'image' || $mediaType == 'Image')) {

						$output .= '<figure class="featured-thumbnail thumbnail '.$thumbs_class.'">';
						$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
						$output .= '<img src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
						$output .= '</a></figure>';					

					} elseif ($mediaType != 'Video' && $mediaType != 'Audio') {							

						$thumbid = 0;
						$thumbid = get_post_thumbnail_id($post->ID);
						$images = get_children( array(
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'post_type' => 'attachment',
							'post_parent' => $post->ID,
							'post_mime_type' => 'image',
							'post_status' => null,
							'numberposts' => -1
						) ); 

						if ( $images ) {

							$k = 0;
							//looping through the images
							foreach ( $images as $attachment_id => $attachment ) {

								$image_attributes_t = wp_get_attachment_image_src( $attachment_id); // returns an array (thumbnail size)
								$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' ); // returns an array (full size)
								if (($thumb_width != '') && ($thumb_height != '')) {
									$img = aq_resize($image_attributes[0], $thumb_width, $thumb_height, true);  //resize & crop img
								} else {
									$img = aq_resize($url, $thumb_x, $thumb_y, true);
								}					
									
								$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
								$image_title = $attachment->post_title;

								if ( $k == 0 ) {
									$output .= '<figure class="featured-thumbnail thumbnail '.$thumbs_class.'">';
									$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
									$output .= '<img  src="'.$img.'" alt="'.get_the_title($post->ID).'" />';
								}
								$output .= '</a></figure>';
								break;
							}					
						} elseif (has_post_thumbnail($post->ID)) {
							$output .= '<figure class="featured-thumbnail thumbnail '.$thumbs_class.'">';
							$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
							if (($thumb_width != '') && ($thumb_height != ''))
								$output .= '<img  src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
							else {
								if ($thumbs == 'normal') {
									$output .= get_the_post_thumbnail($post->ID);
								} else {
									$output .= '<img  src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
								}
							}						
							$output .= '</a></figure>';
						}
					} else {

						// for Video and Audio post format - no lightbox
						$output .= '<figure class="featured-thumbnail thumbnail '.$thumbs_class.'"><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
						if (($thumb_width != '') && ($thumb_height != ''))
							$output .= '<img  src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
						else {
							if ($thumbs == 'normal') {
								$output .= get_the_post_thumbnail($post->ID);
							} else {
								$output .= '<img  src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
							}
						}					
						$output .= '</a></figure>';
					}
                                        
                                        //post header
					$output .= '<header class="post-header">';
						$output .= '<h2 class="post-title"><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
							$output .= get_the_title($post->ID);
						$output .= '</a></h2>';

						// post meta
						$output .= '<div class="post_meta">';

							

						// post date
						$output .= '<span class="post_date">';
						$output .= '<time datetime="'.get_the_time('Y-m-d\TH:i:s', $post->ID).'">' .get_the_date(). '</time>';
						$output .= '</span>';

						

						$output .= '</div>';
					$output .= '</header>';

					// post content
					if ($post_content != 'none' || $link == 'yes') {
						$output .= '<div class="post_content">';

						switch ($post_content){
							case 'excerpt':
								$output .= '<p class="excerpt">';
									$output .= my_string_limit_words(get_the_excerpt(), 8);
								$output .= '</p>';
								break;
							case 'content':
								$output .= '<div class="full-post-content">';
									$output .= get_the_content();
								$output .= '</div>';
								break;
							case 'none':
								break;
							
						}
						if($link == 'yes'){
							$output .= '<a href="'.get_permalink($post->ID).'" class="btn btn-primary" title="'.get_the_title($post->ID).'">';
							$output .= $link_text;
							$output .= '</a>';
						}
						$output .= '</div>';
					}

					//post footer
					if ($tags == 'yes') {
						$posttags = get_the_tags();						
						if ($posttags) {
							$output .= '<footer class="post_footer">'.theme_locals('tags').": ";
							  foreach($posttags as $tag) {
							    $output .= '<a href="'.get_tag_link($tag->term_id).'" rel="tag">'.$tag->name . '</a> '; 
							 }
							 $output .= '</footer>';
						}
					}
                                        
                                        if ($order_by=='meta_value_num') {
                                            $output .= '<span class="post_views">';
                                            $output .= getPostViews($post->ID);
                                            $output .= '</span>';
                                        }
                                                                
					$output .= '</article>';
					$output .= '</div><!-- .row-fluid (end) -->';

					$i++;

			} // end foreach
		$output .= '</div><!-- .posts-list (end) -->';	
		return $output;
	} 
	add_shortcode('posts_list', 'posts_list_shortcode');
	
}

/**
 * Post Grid
 *
 */
if (!function_exists('posts_grid_shortcode')) {

	function posts_grid_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			'type'          => '',
			'columns'       => '3',
			'rows'          => '3',
			'order_by'      => 'date',
			'order'         => 'DESC',
			'thumb_width'   => '370',
			'thumb_height'  => '250',
			'meta'          => '',
			'excerpt_count' => '15',
			'link'          => 'yes',
			'link_text'     => theme_locals('read_more'),
			'custom_class'  => ''
		), $atts));


		$spans = $columns;
		$rand  = rand();

		// columns
		switch ($spans) {
			case '1':
				$spans = 'span12';
				break;
			case '2':
				$spans = 'span6';
				break;
			case '3':
				$spans = 'span4';
				break;
			case '4':
				$spans = 'span3';
				break;
			case '6':
				$spans = 'span2';
				break;
		}

		// check what order by method user selected
		switch ($order_by) {
			case 'date':
				$order_by = 'post_date';
				break;
			case 'title':
				$order_by = 'title';
				break;
			case 'popular':
				$order_by = 'comment_count';
				break;
			case 'random':
				$order_by = 'rand';
				break;
		}

		// check what order method user selected (DESC or ASC)
		switch ($order) {
			case 'DESC':
				$order = 'DESC';
				break;
			case 'ASC':
				$order = 'ASC';
				break;
		}

		// show link after posts?
		switch ($link) {
			case 'yes':
				$link = true;
				break;
			case 'no':
				$link = false;
				break;
		}

			global $post;
			global $my_string_limit_words;

			$numb = $columns * $rows;
							
			$args = array(
				'post_type'   => $type,
				'numberposts' => $numb,
				'orderby'     => $order_by,
				'order'       => $order
			);		

			$posts = get_posts($args);
			$i = 0;
			$count = 1;
			$output_end = '';
			if ($numb > count($posts)) {
				$output_end = '</ul>';
			}

			$output = '<ul class="posts-grid row-fluid unstyled '. $custom_class .'">';

			for ( $j=0; $j < count($posts); $j++ ) {
				$post_id        = $posts[$j]->ID;
				setup_postdata($posts[$j]);
				$excerpt        = get_the_excerpt();
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
				$url            = $attachment_url['0'];
				$image          = aq_resize($url, $thumb_width, $thumb_height, true);
				$mediaType      = get_post_meta($post_id, 'tz_portfolio_type', true);
				$prettyType     = 0;

				if ($count > $columns) {
					$count = 1;
					$output .= '<ul class="posts-grid row-fluid unstyled '. $custom_class .'">';
				}

				$output .= '<li class="'. $spans .'">';
					if(has_post_thumbnail($post_id) && $mediaType == 'Image') {
											
						$prettyType = 'prettyPhoto-'.$rand;									

						$output .= '<figure class="featured-thumbnail thumbnail">';
						$output .= '<a href="'.$url.'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
						$output .= '<img  src="'.$image.'" alt="'.get_the_title($post_id).'" />';
						$output .= '<span class="zoom-icon"></span></a></figure>';
					} elseif ($mediaType != 'Video' && $mediaType != 'Audio') {					

						$thumbid = 0;
						$thumbid = get_post_thumbnail_id($post_id);
										
						$images = get_children( array(
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'post_type' => 'attachment',
							'post_parent' => $post_id,
							'post_mime_type' => 'image',
							'post_status' => null,
							'numberposts' => -1
						) ); 

						if ( $images ) {

							$k = 0;
							//looping through the images
							foreach ( $images as $attachment_id => $attachment ) {
								$prettyType = "prettyPhoto-".$rand ."[gallery".$i."]";								
								//if( $attachment->ID == $thumbid ) continue;

								$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' ); // returns an array
								$img = aq_resize( $image_attributes[0], $thumb_width, $thumb_height, true ); //resize & crop img
								$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
								$image_title = $attachment->post_title;

								if ( $k == 0 ) {
									if (has_post_thumbnail($post_id)) {
										$output .= '<figure class="featured-thumbnail thumbnail">';
										$output .= '<a href="'.$image_attributes[0].'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
										$output .= '<img src="'.$image.'" alt="'.get_the_title($post_id).'" />';
									} else {
										$output .= '<figure class="featured-thumbnail thumbnail">';
										$output .= '<a href="'.$image_attributes[0].'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
										$output .= '<img  src="'.$img.'" alt="'.get_the_title($post_id).'" />';
									}
								} else {
									$output .= '<figure class="featured-thumbnail thumbnail" style="display:none;">';
									$output .= '<a href="'.$image_attributes[0].'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
									$output .= '<img  src="'.$img.'" alt="'.get_the_title($post_id).'" />';
								}
								$output .= '<span class="zoom-icon"></span></a></figure>';
								$k++;
							}					
						} elseif (has_post_thumbnail($post_id)) {
							//$prettyType = 'prettyPhoto-'.$rand;
							$output .= '<figure class="featured-thumbnail thumbnail">';
							$output .= '<a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
							$output .= '<img  src="'.$image.'" alt="'.get_the_title($post_id).'" />';
							$output .= '<span class="thumb-border"></span></a></figure>';
						}
					} else {

						// for Video and Audio post format - no lightbox
						$output .= '<figure class="featured-thumbnail thumbnail"><a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
						$output .= '<img  src="'.$image.'" alt="'.get_the_title($post_id).'" />';
						$output .= '<span class="thumb-border"></span></a></figure>';
					}
                                        
                                        //$output .= '<div class="clear"></div>';

					// post category
                                        //$output .= '<span class="post_category">';
                                        //if ($type!='' && $type!='post') {
                                        //        $terms = get_the_terms( $post_id, $type.'_category');
                                        //        if ( $terms && ! is_wp_error( $terms ) ) {
                                        //                $out = array();
                                        //                //$output .= '<em>Posted in </em>';
                                        //                foreach ( $terms as $term )
                                        //                        $out[] = '<a href="' .get_term_link($term->slug, $type.'_category') .'">'.$term->name.'</a>';
                                        //                        $output .= join( ', ', $out );
                                        //        }
                                        //} else {
                                        //        $categories = get_the_category($post_id);
                                        //        if($categories){
                                        //                $out = array();
                                                        //$output .= '<em>Posted in </em>';
										//				$counter = 0; // para imprimir 1 categoria
	                                    //                foreach($categories as $category)
										//				if ($counter == 0) { // para imprimir 1 categoria
                                        //                        $out[] = '<a href="'.get_category_link($category->term_id ).'" title="'.$category->name.'">'.$category->cat_name.'</a> ';
                                        //                        $output .= join( ', ', $out );
										//					$counter++; // para imprimir 1 categoria
										//				}
                                        //        }
                                        //}
                                        //$output .= '</span>';
										
					
					$output .= '<h5><a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
						$output .= get_the_title($post_id);
					$output .= '</a></h5>';

					if ($meta == 'yes') {
						// begin post meta
						$output .= '<div class="post_meta">';

							// post date
							$output .= '<span class="post_date">';
							$output .= '<time datetime="'.get_the_time('Y-m-d\TH:i:s', $post_id).'">' .get_the_time( get_option( 'date_format' ), $post_id ). '</time>';
							$output .= '</span>';

							// post author
							$output .= '<span class="post_author">';
							$output .= '<em>by </em>';
							$output .= '<a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta('display_name').'</a>';
							$output .= '</span>';

							// post comment count
							$num = 0;						
							$queried_post = get_post($post_id);
							$cc = $queried_post->comment_count;
							if( $cc == $num || $cc > 1 ) : $cc = $cc.' Comments';
							else : $cc = $cc.' Comment';
							endif;
							$permalink = get_permalink($post_id);
							$output .= '<span class="post_comment">';
							$output .= '<a href="'. $permalink . '" class="comments_link">' . $cc . '</a>';
							$output .= '</span>';

						$output .= '</div>';
						// end post meta
					}

					if($excerpt_count >= 1){
						$output .= '<p class="excerpt">';
							$output .= my_string_limit_words($excerpt,$excerpt_count);
						$output .= '</p>';
					}
					if($link){
						$output .= '<a href="'.get_permalink($post_id).'" class="btn btn-primary" title="'.get_the_title($post_id).'">';
						$output .= $link_text;
						$output .= '</a>';
					}
					$output .= '</li>';
					if ($j == count($posts)-1) {
						$output .= $output_end;
					}
				if ($count % $columns == 0) {
					$output .= '</ul><!-- .posts-grid (end) -->';
				}
			$count++;
			$i++;		

		} // end for
		
		return $output;
	}	 
	add_shortcode('posts_grid', 'posts_grid_shortcode');	
}

/*-----------------------------------------------------------------------------------*/
/* Custom Comments Structure
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'mytheme_comment' ) ) {
	function mytheme_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>" class="clearfix">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
			<div class="wrapper">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment->comment_author_email, 80 ); ?>
					<?php printf('<span class="author">%1$s</span>', get_comment_author_link()) ?>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php echo theme_locals("your_comment") ?></em>
				<?php endif; ?>
				<div class="extra-wrap">
					<?php comment_text() ?>
				</div>
			</div>
			<div class="wrapper">
				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
				<div class="comment-meta commentmetadata"><?php printf('%1$s', get_comment_date('F j, Y')) ?></div>
			</div>
		</div>
<?php }
}
add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );
function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 25;
	$args['largest'] = 24;
	$args['smallest'] = 12;
	$args['unit'] = 'px';
	return $args;
}      
?>