<?php
	/*
	 * Set Proper Parent/Child theme paths for inclusion
	 */
	@define( 'PARENT_DIR', get_template_directory() );
	@define( 'CHILD_DIR', get_stylesheet_directory() );

	@define( 'PARENT_URL', get_template_directory_uri() );
	@define( 'CHILD_URL', get_stylesheet_directory_uri() );

	@define( 'CURRENT_THEME', getCurrentTheme() );
	@define( 'FILE_WRITEABLE', is_writeable(PARENT_DIR.'/style.css'));
	/*
	 * Variables array init
	 *
	 */
	$variablesArray = array(
		'textColor'      =>	'#000000',
		'bodyBackground' =>	'#000000',
		'baseFontFamily' =>	'#000000',
		'baseFontSize'   =>	'#000000',
		'baseLineHeight' =>	'#000000',
		'linkColor'      =>	'#000000',
		'linkColorHover' =>	'#000000'
		);

	/*
	 * Definition current theme
	 *
	 */
	function getCurrentTheme() {
		if ( function_exists('wp_get_theme') ) {
			$theme = wp_get_theme();
			if ( $theme->exists() ) {
				$theme_name = $theme->Name;
			}
		} else {
			$theme_name = get_current_theme();
		}
		$theme_name = preg_replace("/\W/", "_", strtolower($theme_name) );
		return $theme_name;
	}

	/*
	 * Comment some value from variables.less
	 *
	 */
	if ( CURRENT_THEME != 'cherry' )
		add_action('cherry_activation_hook', 'comment_child_var');

	function comment_child_var() {
		global $variablesArray;

		$file = CHILD_DIR .'/bootstrap/less/variables.less';

		if ( file_exists($file) ) {
			$allVariablessArray = file($file);

			foreach ($variablesArray as $key => $value) {
				foreach ($allVariablessArray as $k => $v) {
					$pos = strpos($v, $key);
					if ( $pos!==false && $pos == 1 ) {
						$allVariablessArray[$k] = '// ' . $v;
						break;
					}
				}
			}
			file_put_contents($file, $allVariablessArray);
		}
	}

	/* 
	 * Helper function to return the theme option value. 
	 * If no value has been saved, it returns $default.
	 * Needed because options are saved as serialized strings.
	 */
	if ( !function_exists( 'of_get_option' ) ) {
		function of_get_option($name, $default = false) {
			
			$optionsframework_settings = get_option('optionsframework');
			
			// Gets the unique option id
			$option_name = $optionsframework_settings['id'];
			
			if ( get_option($option_name) ) {
				$options = get_option($option_name);
			}
			
			if ( isset($options[$name]) ) {
				return $options[$name];
			} else {
				return $default;
			}
		}
	}

	/*
	 * Unlink less cache files
	 */
	add_action('cherry_activation_hook', 'clean_less_cache');
	
	function clean_less_cache() {
		if ( CURRENT_THEME == 'cherry' ) {
			$bootstrapInput	= PARENT_DIR .'/less/bootstrap.less';
			$themeInput		= PARENT_DIR .'/less/style.less';
		} else {
			$bootstrapInput	= CHILD_DIR .'/bootstrap/less/bootstrap.less';
			$themeInput		= CHILD_DIR .'/style.less';
		}

		$cacheFile1 = $bootstrapInput.".cache";
		$cacheFile2 = $themeInput.".cache";
		if (file_exists($cacheFile1)) unlink($cacheFile1);
		if (file_exists($cacheFile2)) unlink($cacheFile2);
	}

	if ( (is_admin() && ($pagenow == "themes.php")) && FILE_WRITEABLE ) {
		do_action('cherry_activation_hook');
	}

	/*
	 * Loading theme textdomain
	 */
	if ( !function_exists('cherry_theme_setup')) {
		function cherry_theme_setup() {
			load_theme_textdomain( CURRENT_THEME, PARENT_DIR . '/languages' );
		}
		add_action('after_setup_theme', 'cherry_theme_setup');
	}
	include_once (PARENT_DIR . '/includes/locals.php');
	
	// WPML compatibility
	// WPML filter for correct posts IDs for the current language Solution
	if ( function_exists( 'wpml_get_language_information' )) {
		update_option('suppress_filters', 0);
	} else {
		update_option('suppress_filters', 1);
	}
	// Register Flickr and recent posts widgets link label for translation
	function wpml_link_text_filter( $link_text, $widget_title ) {
		icl_translate( 'cherry', 'link_text_' . $widget_title, $link_text );
	}
	// Check if WPML is activated
	if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
		add_filter( 'widget_linktext', 'wpml_link_text_filter', 10, 2 );
	}

	//Loading Custom function
	include_once (CHILD_DIR . '/includes/custom-function.php');

	//Loading jQuery and Scripts
	include_once (PARENT_DIR . '/includes/theme-scripts.php');
	
	//Widget and Sidebar
	include_once (CHILD_DIR . '/includes/sidebar-init.php');
	include_once (PARENT_DIR . '/includes/register-widgets.php');
	include_once (PARENT_DIR . '/includes/widgets/widgets-manager.php');

	//Theme initialization
	include_once (CHILD_DIR . '/includes/theme-init.php');
	
	//Additional function
	include_once (PARENT_DIR . '/includes/theme-function.php');
	
	//Shortcodes
	include_once (PARENT_DIR . '/includes/theme_shortcodes/columns.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/shortcodes.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/posts_grid.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/posts_list.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/mini_posts_list.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/mini_posts_grid.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/alert.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/tabs.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/toggle.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/html.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/misc.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/service_box.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/post_cycle.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/carousel.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/progressbar.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/banner.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/table.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/hero_unit.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/roundabout.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/categories.php');
	include_once (PARENT_DIR . '/includes/theme_shortcodes/media.php');
	
	//tinyMCE includes
	include_once (PARENT_DIR . '/includes/theme_shortcodes/tinymce/tinymce_shortcodes.php');
	
	//Aqua Resizer for image cropping and resizing on the fly
	include_once (PARENT_DIR . '/includes/aq_resizer.php');

	// Add the pagemeta
	include_once (PARENT_DIR . '/includes/theme-pagemeta.php');
	
	// Add the postmeta
	include_once (PARENT_DIR . '/includes/theme-postmeta.php');
	
	// Add the postmeta to Portfolio posts
	include_once (PARENT_DIR . '/includes/theme-portfoliometa.php');
	
	// Add the postmeta to Slider posts
	include_once (PARENT_DIR . '/includes/theme-slidermeta.php');
	
	// Add the postmeta to Testimonials
	include_once (PARENT_DIR . '/includes/theme-testimeta.php');
	
	// Add the postmeta to Our Team posts
	include_once (PARENT_DIR . '/includes/theme-teammeta.php');

	//Loading options.php for theme customizer
	include_once (CHILD_DIR . '/options.php');
	include_once (PARENT_DIR . '/framework_options.php');

	//Plugin Activation
	include_once (CHILD_DIR . '/includes/class-tgm-plugin-activation.php');
	include_once (CHILD_DIR . '/includes/register-plugins.php');

	// Framework Data Management
	include_once (PARENT_DIR . '/admin/data_management/data_management_interface.php');

	// SEO Settings
	include_once (PARENT_DIR . '/admin/seo/seo_settings_page.php');
	
	// WP Pointers
	include_once (PARENT_DIR . '/includes/class.wp-help-pointers.php');

	// Embedding LESS compile
	if ( !class_exists('lessc') ) {
		include_once (PARENT_DIR .'/includes/lessc.inc.php');
	}
	include_once (PARENT_DIR .'/includes/less-compile.php');
	
	// include shop
	function include_shop(){
		if ( file_exists(get_stylesheet_directory().'/shop.php') ) {
			include_once (CHILD_DIR . '/shop.php');
		}
	}
	add_action('after_setup_theme', 'include_shop');

	// removes detailed login error information for security
	add_filter('login_errors',create_function('$a', "return null;"));
	
	/* 
	 * Loads the Options Panel
	 *
	 * If you're loading from a child theme use stylesheet_directory
	 * instead of template_directory
	 */
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', PARENT_URL . '/admin/' );
		include_once dirname( __FILE__ ) . '/admin/options-framework.php';
	}
	
	/* 
	 * Removes Trackbacks from the comment cout
	 *
	 */
	if (!function_exists('comment_count')) {
		add_filter('get_comments_number', 'comment_count', 0);
		
		function comment_count( $count ) {
			if ( ! is_admin() ) {
				global $id;
				$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
				return count($comments_by_type['comment']);
			} else {
				return $count;
			}
		}
	}
	
	/*
	 * Post Formats
	 *
	 */
	$formats = array( 
				'aside', 
				'gallery', 
				'link', 
				'image', 
				'quote', 
				'audio',
				'video');
	add_theme_support( 'post-formats', $formats ); 
	add_post_type_support( 'post', 'post-formats' );
	
	/*
	 * Custom excpert length
	 *
	 */ 
	if(!function_exists('new_excerpt_length')) {
		
		function new_excerpt_length($length) {
			return 30;
		}
		add_filter('excerpt_length', 'new_excerpt_length');
	}
	
	// enable shortcodes in sidebar
	add_filter('widget_text', 'do_shortcode');
	
	// custom excerpt ellipses for 2.9+
	if(!function_exists('custom_excerpt_more')) {
	
		function custom_excerpt_more($more) {
			return theme_locals("read_more").' &raquo;';
		}
		add_filter('excerpt_more', 'custom_excerpt_more');
	}
	
	// no more jumping for read more link
	if(!function_exists('no_more_jumping')) {
		
		function no_more_jumping($post) {
			//return '&nbsp;<a href="'.get_permalink().'" class="read-more">'.theme_locals("continue_reading").'</a>';
			return '';
		}
		add_filter('excerpt_more', 'no_more_jumping');
	}
	
	// category id in body and post class
	if(!function_exists('category_id_class')) {
		
		function category_id_class($classes) {
			global $post;
			foreach((get_the_category()) as $category)
				$classes [] = 'cat-' . $category->cat_ID . '-id';
				return $classes;
		}
		add_filter('post_class', 'category_id_class');
		add_filter('body_class', 'category_id_class');
	}
	
	// Threaded Comments
	if(!function_exists('enable_threaded_comments')) {
		function enable_threaded_comments() {
			if (!is_admin()) {
				if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
					wp_enqueue_script('comment-reply');
				}
			}
		}
		add_action('get_header', 'enable_threaded_comments');
	}

	//remove auto loading rel=next post link in header
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

	/*
	 * Navigation with description
	 *
	 */
	if (! class_exists('description_walker')) {
		class description_walker extends Walker_Nav_Menu {
			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
				global $wp_query;
				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$class_names = $value = '';

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;

				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
				$class_names = ' class="'. esc_attr( $class_names ) . '"';

				$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

				$description  = ! empty( $item->description ) ? '<span class="desc">'.esc_attr( $item->description ).'</span>' : '';

				if($depth != 0) {
					$description = $append = $prepend = "";
				}

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before;

				if (isset($prepend))
					$item_output .= $prepend;

				$item_output .= apply_filters( 'the_title', $item->title, $item->ID );

				if (isset($append))
					$item_output .= $append;
				
				$item_output .= $description.$args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}
	}

	/*
	 * Cherry update
	 */
	$cherryTemplates = array(
		'404.php',
		'archive.php',
		'author.php',
		'category.php',
		'index.php',
		'page.php',
		'page-archives.php',
		'page-faq.php',
		'page-fullwidth.php',
		'page-home.php',
		'page-Portfolio2Cols-filterable.php',
		'page-Portfolio3Cols-filterable.php',
		'page-Portfolio4Cols-filterable.php',
		'page-testi.php',
		'search.php',
		'single.php',
		'single-portfolio.php',
		'single-team.php',
		'single-testi.php',
		'tag.php'
	);

	$headerFooterPattern = '/(\<header.*?\>.*?\<\/header\>|\<footer.*?\>.*?\<\/footer\>)/is';

	if (is_user_logged_in() && current_user_can('update_themes')) {
		$updateErrors = array();

		$oldCherryVersion = get_option('cherry_version', '1.0');
		$currentCherryVersion = getCherryVersion($updateErrors);
		$cherryV2 = '2.0';
		$cherryForceUpdate = (bool) get_option('cherry_force_update', false);

		if (version_compare($oldCherryVersion, $cherryV2) == -1 || $cherryForceUpdate) {
			writeLog(PHP_EOL . date('Y-m-d H:i:s'));
			writeLog('Old CherryFramework version: ' . $oldCherryVersion);
			writeLog('Current CherryFramework version: ' . $currentCherryVersion);
			writeLog('Force update: ' . (int) $cherryForceUpdate);

			cherryUpdate($cherryTemplates, $headerFooterPattern, $updateErrors);
			//changeChildTheme
			changeChildTheme($updateErrors);
			//end changeChildTheme
			if (empty($updateErrors)) {
				update_option('cherry_version', $currentCherryVersion);
				update_option('cherry_force_update', 0);
			}
		}
	}

	function getCherryVersion(&$updateErrors) {
		$style = TEMPLATEPATH . '/style.css';
		$themeVersion = 0;

		if (function_exists('wp_get_theme')) {
			$theme = wp_get_theme(get_option('template', 'CherryFramework'));
			if (file_exists($style) && $theme->exists()) {
				$themeVersion = $theme->Version;
			} else {
				$updateErrors[] = $style . ' does not exist';
				writeLog($style . ' does not exist');
			}
		} elseif (function_exists('get_theme_data')) {
			if (file_exists($style)) {
				$theme = get_theme_data($style);
				$themeVersion = $theme['Version'];
			} else {
				$updateErrors[] = $style . ' does not exist';
				writeLog($style . ' does not exist');
			}
		} else {
			if (file_exists($style)) {
				$content = file_get_contents($style);
				if ($content) {
					$pattern = '/\s*version\s*:\s*([^\n]+)\s*/is';
					preg_match($pattern, $content, $matches);
					if (!empty($matches[1])) {
						$themeVersion = trim($matches[1]);
					}
				} else {
					$updateErrors[] = 'Failed to read ' . $style;
					writeLog('Failed to read ' . $style);
				}
			} else {
				$updateErrors[] = $style . ' does not exist';
				writeLog($style . ' does not exist');
			}
		}
		return $themeVersion;
	}

	function isCherryChildTheme($themePath, $name, &$updateErrors) {
		$style = $themePath . '/style.css';
		$themeTemplate = false;

		if (function_exists('wp_get_theme')) {
			$theme = wp_get_theme($name);
			if ($theme->exists()) {
				if ($theme->Stylesheet != $theme->Template) {
					$themeTemplate = $theme->Template;
				}
			} else {
				$updateErrors[] = 'Theme ' . $theme->Name . ' does not exist';
				writeLog('Theme ' . $theme->Name . ' does not exist');
			}
		} elseif (function_exists('get_theme_data')) {
			$theme = get_theme_data($style);
			$themeTemplate = $theme['Template'];
		} else {
			$content = file_get_contents($style);
			if ($content) {
				$pattern = '/\s*template\s*:\s*([^\n]+)\s*/is';
				preg_match($pattern, $content, $matches);
				if (!empty($matches[1])) {
					$themeTemplate = trim($matches[1]);
				}
			} else {
				$updateErrors[] = 'Failed to read ' . $style;
				writeLog('Failed to read ' . $style);
			}
		}
		return ($themeTemplate == 'CherryFramework') ? true : false;
	}

	function getHeaderFooterCode($headerFooterPattern) {
		$headerFooter = array('header', 'footer');
		$headerFooterCode = array('header' => null, 'footer' => null);

		foreach ($headerFooter as $name) {
			$filePath = TEMPLATEPATH . '/' . $name . '.php';
			if (file_exists($filePath)) {
				$content = file_get_contents($filePath);
				if ($content) {
					$matchesCount = preg_match($headerFooterPattern, $content, $matches);
					if ($matchesCount == 1 && !empty($matches[0])) {
						$headerFooterCode[$name] = $matches[0];
					} else {
						$updateErrors[] = 'header|footer code not found in ' . $filePath;
						writeLog('header|footer code not found in ' . $filePath);
					}
				} else {
					$updateErrors[] = 'Failed to read ' . $filePath;
					writeLog('Failed to read ' . $filePath);
				}
			} else {
				$updateErrors[] = $filePath . ' does not exist';
				writeLog($filePath . ' does not exist');
			}
		}

		return $headerFooterCode;
	}

	function backupFile($templatePath) {
		return copy($templatePath, $templatePath . '.bak');
	}

	function writeLog($message) {
		$logFile = TEMPLATEPATH . '/update.log';
		if (is_writable(TEMPLATEPATH)) {
			file_put_contents($logFile, $message . PHP_EOL, FILE_APPEND);
		}
	}

	function cherryUpdate($cherryTemplates, $headerFooterPattern, &$updateErrors) {
		$themesPath = get_theme_root();

		$skip = array('.', '..', 'CherryFramework', 'twentytwelve', 'twentyeleven', 'twentyten', 'index.php');
		$themes = array_diff(scandir($themesPath), $skip);

		if (!empty($themes)) {
			foreach ($themes as $theme) {
				$themePath = $themesPath . '/' . $theme;
				if (is_dir($themePath) && file_exists($themePath . '/style.css')) {

					$isCherryChildTheme = isCherryChildTheme($themePath, $theme, $updateErrors);

					if ($isCherryChildTheme) {
						if (is_writable($themePath)) {
							writeLog(PHP_EOL . 'Child theme: ' . $themePath);
							$files = scandir($themePath);
							$themeTemplates = array_intersect($files, $cherryTemplates);
							if (!empty($themeTemplates)) {
								foreach ($themeTemplates as $template) {
									$templatePath = $themePath . '/' . $template;
									if (is_writable($templatePath)) {
										$content = file_get_contents($templatePath);
										if ($content) {
											$headerFooterMatchesCount = preg_match_all($headerFooterPattern, $content, $headerFooterMatches);
											if ($headerFooterMatchesCount > 0) {
												$backupFile = backupFile($templatePath);
												if ($backupFile) {
													writeLog('Backup ' . $templatePath);

													$content = preg_replace($headerFooterPattern, '', $content, -1, $headerFooterReplaceCount);
													if (!is_null($content) && $headerFooterReplaceCount > 0) {
														writeLog('Replace ' . $headerFooterReplaceCount . ' header|footer');

														if (file_put_contents($templatePath, $content)) {
															writeLog('Save ' . $templatePath);
														} else {
															$updateErrors[] = 'Failed to save ' . $templatePath;
															writeLog('Failed to save ' . $templatePath);
														}
													}
												} else {
													$updateErrors[] = 'Failed to backup ' . $templatePath;
													writeLog('Failed to backup ' . $templatePath);
												}
											}
										} else {
											$updateErrors[] = 'Failed to read ' . $templatePath;
											writeLog('Failed to read ' . $templatePath);
										}
									} else {
										$updateErrors[] = $templatePath . ' is not writable';
										writeLog($templatePath . ' is not writable');
									}
								}
							}

							$headerFooter = array_intersect($files, array('header.php', 'footer.php'));
							if (!empty($headerFooter)) {
								$headerFooterCode = getHeaderFooterCode($headerFooterPattern);
								if (!is_null($headerFooterCode['header']) && !is_null($headerFooterCode['footer'])) {
									foreach ($headerFooter as $file) {
										$filePath = $themePath . '/' . $file;
										if (is_writable($filePath)) {
											$content = file_get_contents($filePath);
											if ($content) {
												$headerFooterMatchesCount = preg_match_all($headerFooterPattern, $content, $headerFooterMatches);
												if ($headerFooterMatchesCount === 0) {
													$backupFile = backupFile($filePath);
													if ($backupFile) {
														writeLog('Backup ' . $filePath);

														if ($file == 'header.php') {
															$content .= $headerFooterCode['header'];
														} elseif ($file == 'footer.php') {
															$content = $headerFooterCode['footer'] . $content;
														}

														writeLog('Add header|footer code in ' . $filePath);

														if (file_put_contents($filePath, $content)) {
															writeLog('Save ' . $filePath);
														} else {
															$updateErrors[] = 'Failed to save ' . $filePath;
															writeLog('Failed to save ' . $filePath);
														}
													} else {
														$updateErrors[] = 'Failed to backup ' . $filePath;
														writeLog('Failed to backup ' . $filePath);
													}
												}
											} else {
												$updateErrors[] = 'Failed to read ' . $filePath;
												writeLog('Failed to read ' . $filePath);
											}
										} else {
											$updateErrors[] = $filePath . ' is not writable';
											writeLog($filePath . ' is not writable');
										}
									}
								}
							}
						} else {
							$updateErrors[] = $themePath . ' is not writable';
							writeLog($themePath . ' is not writable');
						}
					}
				}
			}
		}
	}
//changeChildTheme
	function changeChildTheme(&$updateErrors){
		$themesPath = get_theme_root();

		$skip = array('.', '..', 'CherryFramework', 'twentytwelve', 'twentyeleven', 'twentyten', 'index.php');
		$themes = array_diff(scandir($themesPath), $skip);

		if (!empty($themes)) {
			foreach ($themes as $theme) {
				$themePath = $themesPath . '/' . $theme;
				if (is_dir($themePath) && file_exists($themePath . '/style.css')) {

					$isCherryChildTheme = isCherryChildTheme($themePath, $theme, $updateErrors);

					if ($isCherryChildTheme) {
						if (is_writable($themePath)) {
							unset($slider_in_header, $slider_in_page_home, $pahe_home_content);
							writeLog(PHP_EOL . 'Child theme: ' . $themePath);
							$files = scandir($themePath);
							$header_php = array_intersect($files, array('header.php'));
							if (!empty($header_php)) {
								$templatePath = $themePath . '/header.php';
								$content = file_get_contents($templatePath);
								if (stripos($content, '"static/static-slider"')!==false) {
									$slider_in_header = true;
								}
							}
							if(!isset($slider_in_header)){
								if (is_dir($themePath."/wrapper")){
									$nestedFiles = scandir($themePath."/wrapper");
									$header_wrapper_php = array_intersect($nestedFiles, array('wrapper-header.php'));
									if (!empty($header_wrapper_php)) {
										$header_wrapper_php_path = $themePath . '/wrapper/wrapper-header.php';
										$content = file_get_contents($header_wrapper_php_path);
										if (stripos($content, '"static/static-slider"')!==false) {
											$slider_in_header = true;
										}
									}
								}
							}
							if(!isset($slider_in_header)){
								$page_home_php = array_intersect($files, array('page-home.php'));
								if (!empty($page_home_php)) {
									$templatePath = $themePath . '/page-home.php';
									$content = file($templatePath);
									for ($i=0, $arrayCount = count($content); $i < $arrayCount ; $i++) {
										if(stripos($content[$i], '"static/static-slider"')!==false){
											$slider_in_page_home = $i;
										}
										if(stripos($content[$i], '"page-home.php"')!==false){
											$pahe_home_content = $i;
										}
									}
									if(!isset($slider_in_page_home)){
										array_splice($content, $pahe_home_content+1, 0, "\t<div class=\"row\">\n\t\t<div class=\"span12\" data-motopress-type=\"static\" data-motopress-static-file=\"static/static-slider.php\">\n\t\t\t<?php get_template_part(\"static/static-slider\"); ?>\n\t\t</div>\n\t</div>\n");
										writeLog('Change page-home.php');
										if (file_put_contents($templatePath, $content)) {
											writeLog('Save ' . $templatePath);
										} else {
											$updateErrors[] = 'Failed to save ' . $templatePath;
											writeLog('Failed to save ' . $templatePath);
										}
									}
								}
							}
							$stylesheet = array_intersect($files, array('style.css'));
							$stylePath = $themePath . '/style.css';
							if (!empty($stylesheet)) {
								$styleContent = file($stylePath);
								if ($styleContent) {
									for ($i=0, $arrayCount = count($styleContent); $i < $arrayCount ; $i++) {
										if(stripos($styleContent[$i], "/*--")!==false){
											$styleContentChange = array();
										}
										if(isset($styleContentChange)){
											$styleContentChange[$i] = $styleContent[$i];
										}
										if(stripos($styleContent[$i], "--*/")!==false){
											break;
										}
									}
									array_push($styleContentChange, '@import url("main-style.css");');
									if (file_put_contents($stylePath, $styleContentChange)) {
										writeLog('Save ' . $stylePath);
									} else {
										$updateErrors[] = 'Failed to save ' . $stylePath;
										writeLog('Failed to save ' . $stylePath);
									}
								} else {
									$updateErrors[] = 'Failed to read ' . $stylesheet;
									writeLog('Failed to read ' . $stylesheet);
								}
							}
							if (is_dir($themePath."/static")){
								$nestedFiles = scandir($themePath."/static");
								$staticSlider = array_intersect($nestedFiles, array('static-slider.php'));
								$staticSliderPath = $themePath . '/static/static-slider.php';
								unset($sliderStatic, $new_function);
								if (!empty($staticSlider)) {
									$backupFileStatic = backupFile($staticSliderPath);
									if ($backupFileStatic) {
											$staticSliderContent = file($staticSliderPath);
											if ($staticSliderContent) {
												$static_slider_dom_1 = "<?php if(of_get_option('slider_type') != 'none_slider'){ ?>\n";
												$static_slider_dom_2 = "\t<?php get_slider_template_part(); ?>\n";
												$static_slider_dom_3 = "\n<?php }else{ ?>\n\t<div class=\"slider_off\"></div>\n<?php } ?>\n";
												for ($i=0, $arrayCount = count($staticSliderContent); $i < $arrayCount ; $i++) {
													if(stripos($staticSliderContent[$i], "get_template_part('slider')")!==false){
														$sliderStatic = $i;
													}
													if(stripos($staticSliderContent[$i], "get_slider_template_part")!==false){
														$new_function = $i;
													}
												}
												if(!isset($sliderStatic) && !isset($new_function)){
													$staticSliderContent = "<?php /* Static Name: Slider */ ?>\n<?php if(of_get_option('slider_type') != 'none_slider'){ ?>\n\t<div id=\"slider-wrapper\" class=\"slider\">\n\t\t<div class=\"container\">\n\t\t\t<?php get_slider_template_part(); ?>\n\t\t</div>\n\t</div><!-- .slider -->\n<?php }else{ ?>\n\t<div class=\"slider_off\"><!--slider off--></div>\n<?php } ?>";
												}else{
													if(!isset($new_function)){
														$staticSliderContent[$sliderStatic] = $static_slider_dom_2;
														array_splice($staticSliderContent, 1, 0, $static_slider_dom_1);
														array_push($staticSliderContent, $static_slider_dom_3);
													}
												}
												if (file_put_contents($staticSliderPath, $staticSliderContent)) {
													writeLog('Save ' . $staticSliderPath);
												} else {
													$updateErrors[] = 'Failed to save ' . $staticSliderPath;
													writeLog('Failed to save ' . $staticSliderPath);
												}
											} else {
												$updateErrors[] = 'Failed to read ' . $staticSlider;
												writeLog('Failed to read ' . $staticSlider);
											}
										
									}else {
										$updateErrors[] = 'Failed to backup ' . $staticSliderPath;
										writeLog('Failed to backup ' . $staticSliderPath);
									}
								}
							}
						} else {
							$updateErrors[] = $themePath . ' is not writable';
							writeLog($themePath . ' is not writable');
						}
					}
				}
			}
		}
	};
//end changeChildTheme
	if (has_action('after_switch_theme')) {
		add_action('after_switch_theme', 'activateCherryForceUpdate', 10, 0);
	} else {
		if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
			activateCherryForceUpdate();
		}
	}

	function activateCherryForceUpdate() {
		global $cherryTemplates;
		global $headerFooterPattern;

		$style = STYLESHEETPATH . '/style.css';
		$themeTemplate = false;

		if (function_exists('wp_get_theme')) {
			$theme = wp_get_theme();
			if (file_exists($style) && $theme->exists()) {
				if ($theme->Stylesheet != $theme->Template) {
					$themeTemplate = $theme->Template;
				}
			} else {
				writeLog($style . ' does not exist');
			}
		} elseif (function_exists('get_theme_data')) {
			if (file_exists($style)) {
				$theme = get_theme_data($style);
				$themeTemplate = $theme['Template'];
			} else {
				writeLog($style . ' does not exist');
			}
		} else {
			if (file_exists($style)) {
				$content = file_get_contents($style);
				if ($content) {
					$pattern = '/\s*template\s*:\s*([^\n]+)\s*/is';
					preg_match($pattern, $content, $matches);
					if (!empty($matches[1])) {
						$themeTemplate = trim($matches[1]);
					}
				} else {
					writeLog('Failed to read ' . $style);
				}
			} else {
				writeLog($style . ' does not exist');
			}
		}

		if ($themeTemplate == 'CherryFramework') {
			$themePath = get_stylesheet_directory();
			$files = scandir($themePath);
			$themeTemplates = array_intersect($files, $cherryTemplates);

			$cherryForceUpdate = false;

			if (!empty($themeTemplates)) {
				foreach ($themeTemplates as $template) {
					$templatePath = $themePath . '/' . $template;
					$content = file_get_contents($templatePath);
					if ($content) {
						$headerFooterMatchesCount = preg_match($headerFooterPattern, $content);
						if ($headerFooterMatchesCount == 1) {
							$cherryForceUpdate = true;
							break;
						}
					} else {
						writeLog('Failed to read ' . $templatePath);
					}
				}
			}

			if ($cherryForceUpdate) {
				update_option('cherry_force_update', 1);
			} else {
				update_option('cherry_force_update', 0);
			}
		}
	}
//------------------------------------------------------
//  slider function
//------------------------------------------------------
	if (!function_exists("my_post_type_slider")) {
		function my_post_type_slider() {
			register_post_type( 'slider',
				array( 
					'label'               => theme_locals("slides"), 
					'singular_label'      => theme_locals("slides"),
					'_builtin'            => false,
					'exclude_from_search' => true, // Exclude from Search Results
					'capability_type'     => 'page',
					'public'              => true, 
					'show_ui'             => true,
					'show_in_nav_menus'   => false,
					'rewrite' => array(
								'slug'       => 'slide-view',
								'with_front' => FALSE,
					),
					'query_var' => "slide", // This goes to the WP_Query schema
					'menu_icon' => get_template_directory_uri() . '/includes/images/icon_slides.png',
					'supports'  => array(
									'title',
									// 'custom-fields',
									'thumbnail'
					)
				)
			);
		}
		add_action('init', 'my_post_type_slider');
	}
	if (!function_exists("get_slider_template_part")) {
		function get_slider_template_part() {
			switch (of_get_option('slider_type')) {
				case "accordion_slider":
					$slider_type = "accordion";
				break;
				default:
					$slider_type = "slider";
			}
			return get_template_part($slider_type);
		}
	}
//------------------------------------------------------
//  Warning notice
//------------------------------------------------------
add_action( 'admin_notices', 'warning_notice' );
function warning_notice() {
	global $pagenow;
	$pageHidden = array('admin.php');
    if (!get_user_meta(get_current_user_id(), '_wp_hide_notice', true) && is_admin() && !FILE_WRITEABLE && !in_array($pagenow, $pageHidden)) {
        printf('<div class="updated"><strong><p>'.theme_locals('warning_notice_2').'</p><p>'.theme_locals('warning_notice_3').'</p><p><a href="'.esc_url(add_query_arg( 'wp_nag', wp_create_nonce( 'wp_nag' ))).'">'.theme_locals('dismiss_notice').'</a></p></strong></div>');
    }
}
//------------------------------------------------------
//  Post Meta
//------------------------------------------------------
	$global_meta_elements = array();
	function get_post_metadata( $args = array() ) {
		global $global_meta_elements;
		if(array_key_exists('meta_elements', $args)){
			$global_meta_elements = array_unique(array_merge($global_meta_elements, $args['meta_elements']));
		}

		$meta_elements_empty  = isset($args['meta_elements']) ? false : true ;
		$defaults = array(
						'meta_elements' =>  array('start_unite', 'date', 'author', 'permalink', 'end_unite', 'start_unite', 'categories', 'tags', 'end_unite', 'start_unite', 'comment', 'views', 'like', 'dislike', 'end_unite'),
						'meta_class' => 'post_meta',
						'meta_before' => '',
						'meta_after'  => ''
					);
		$args = wp_parse_args( $args, $defaults );
		$post_meta_type = (of_get_option('post_meta') == 'true' || of_get_option('post_meta') == '') ? 'line' : of_get_option('post_meta');
		if($meta_elements_empty){
			foreach ($global_meta_elements as $key) {
				if($key != 'end_unite || start_unite'){
				unset($args['meta_elements'][array_search($key, $args['meta_elements'])]);
				}
			}	
		}


		if($post_meta_type!='false'){
			$post_ID = get_the_ID();
			$post_type = get_post_type($post_ID);
			$icon_tips_before = ($post_meta_type == 'icon') ? '<div class="tips">' : '';
			$icon_tips_after = ($post_meta_type == 'icon') ? '</div>' : '';

			$user_login = is_user_logged_in() ? true : false;
			$user_id = $user_login ? get_current_user_id() : "";
			$voting_class = $user_login ? 'ajax_voting ' : 'not_voting ';
			$voting_url = PARENT_URL.'/includes/voting.php?post_ID='.$post_ID.'&amp;get_user_ID='.$user_id;
			$get_voting_array = cherry_getPostVoting($post_ID, $user_id);
			$user_voting = $get_voting_array['user_voting'];

			echo $args['meta_before'].'<div class="'.$args['meta_class'].' meta_type_'.$post_meta_type.'">';
				foreach ($args['meta_elements'] as $value) {
					switch ($value) {
						case 'date':
							if(of_get_option('post_date') != 'no'){ ?>
								<div class="post_date">
									<i class="icon-calendar"></i>
									<?php echo $icon_tips_before . '<time datetime="' . get_the_time('Y-m-d\TH:i:s') . '">' . get_the_date() . '</time>' . $icon_tips_after; ?>
								</div>
								<?php
							}
							break;
						case 'author':
							if(of_get_option('post_author') != 'no'){ ?>
								<div class="post_author">
									<i class="icon-user"></i>
									<?php 
									echo $icon_tips_before;
									the_author_posts_link();
									echo $icon_tips_after;
									?>
								</div>
								<?php
							}
							break;
						case 'permalink':
							if(of_get_option('post_permalink') != 'no'){ ?>
								<div class="post_permalink">
									<i class="icon-link"></i>
									<?php echo $icon_tips_before.'<a href="'.get_permalink().'" title="'.get_the_title().'">'.theme_locals('permalink_to').'</a>'.$icon_tips_after; ?>
								</div>
								<?php 
							}
							break;
						case 'categories':
							if(of_get_option('post_category') != 'no'){ ?>
								<div class="post_category">
									<i class="icon-bookmark"></i>
									<?php 
										echo $icon_tips_before;
										($post_type != 'post') ? the_terms($post_ID, $post_type.'_category','',', ') : the_category(', ');
										echo $icon_tips_after;
									?>
								</div>
								<?php
							}
							break;
						case 'tags':
							if(of_get_option('post_tag') != 'no'){ ?>
								<div class="post_tag">
									<i class="icon-tag"></i>
									<?php 
										echo $icon_tips_before;
										if(get_the_tags() || has_term('', $post_type.'_tag', $post_ID)){
											echo ($post_type != 'post') ? the_terms($post_ID, $post_type.'_tag','',', ') : the_tags('', ', ');
										} else {
											echo theme_locals('has_not_tags');
										}
										echo $icon_tips_after;
									 ?>
								</div>
								<?php
							}
							break;
						case 'comment':
							if(of_get_option('post_comment') != 'no'){ ?>
								<div class="post_comment">
									<i class="icon-comments"></i>
									<?php 
										echo $icon_tips_before;
										comments_popup_link(theme_locals('no_comments'), theme_locals('comment'), '% '.theme_locals('comments'), theme_locals('comments_link'), theme_locals('comments_closed'));
										echo $icon_tips_after;
									 ?>
								</div>
								<?php 
							}
							break;
						case 'views':
							if(of_get_option('post_views') != 'no'){ ?>
								<div class="post_views" title="<?php echo theme_locals('number_views'); ?>">
									<i class="icon-eye-open"></i>
									<?php echo $icon_tips_before.cherry_getPostViews($post_ID).$icon_tips_after; ?>
								</div>
								<?php 
							}
							break;
						case 'dislike':
							if(of_get_option('post_dislike') != 'no'){ 
								$dislike_url = ($user_login && $user_voting=='none') ? 'href="'.$voting_url.'&amp;voting=dislike"' : '';
								$dislike_count = $get_voting_array['dislike_count'];
								$dislike_title = $user_login ? theme_locals('dislike') : theme_locals('not_voting');
								$dislike_class = ($user_voting == 'dislike') ? 'user_dislike ' : '';
								if($user_voting!='none'){
									$voting_class = "user_voting ";
								}
							?>
								<div class="post_dislike">
									<a <?php echo $dislike_url; ?> class="<?php echo $voting_class.$dislike_class; ?>" title="<?php echo $dislike_title; ?>" date-type="dislike" >
										<i class="icon-thumbs-down"></i>
										<?php echo $icon_tips_before.'<span class="voting_count">'.$dislike_count.'</span>'.$icon_tips_after; ?>
									</a>
								</div>
								<?php 
							}
							break;
						case 'like':
							if(of_get_option('post_like') != 'no'){
								$like_url = ($user_login && $user_voting=='none') ? 'href="'.$voting_url.'&amp;voting=like"' : '';
								$like_count = $get_voting_array['like_count'];
								$like_title = $user_login ? theme_locals('like') : theme_locals('not_voting');
								$like_class = ($user_voting == 'like') ? 'user_like ' : '';
								if($user_voting!='none'){
									$voting_class = "user_voting ";
								}
							?>
								<div class="post_like">
									<a <?php echo $like_url; ?> class="<?php echo $voting_class.$like_class; ?>" title="<?php echo $like_title; ?>" date-type="like" >
										<i class="icon-thumbs-up"></i>
										<?php echo $icon_tips_before.'<span class="voting_count">'.$like_count.'</span>'.$icon_tips_after; ?>
									</a>
								</div>
								<?php 
							}
						break;
						case 'start_unite':
							echo '<div class="post_meta_unite clearfix">';
						break;
						case 'end_unite':
							echo '</div>';
						break;
					}
				}
			echo '</div>'.$args['meta_after'];
		}
	}
//------------------------------------------------------
//  Post Views
//------------------------------------------------------
	function cherry_getPostViews($postID){
		return (get_post_meta($postID, 'post_views_count', true) == '') ? "0" : get_post_meta($postID, 'post_views_count', true);
	}
	function cherry_setPostViews($postID){
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 1;
		}else{
			$count++;
		} 
		update_post_meta($postID, $count_key, $count);
	}
//------------------------------------------------------
//  Post voting
//------------------------------------------------------
	function cherry_getPostVoting($postID, $user_id){
		$like_count = (get_post_meta($postID, 'post_like', true) == false) ? "0" : get_post_meta($postID, 'post_like', true);
		$dislike_count = (get_post_meta($postID, 'post_dislike', true) == false) ? "0" : get_post_meta($postID, 'post_dislike', true);
		$user_like_array = get_post_meta($postID, 'user_like');
		$user_dislike_array = get_post_meta($postID, 'user_dislike');
		$user_voting = 'none';
		if(in_array($user_id, $user_like_array)){
			$user_voting = 'like';
		}else if(in_array($user_id, $user_dislike_array)){
			$user_voting = 'dislike';
		}
		return array('like_count' => $like_count, 'dislike_count' => $dislike_count, 'user_voting' => $user_voting);
	}
//------------------------------------------------------
//  Get team social networks
//------------------------------------------------------
	function cherry_get_post_networks($args = array()){
		global $post;
		extract(
			wp_parse_args(
				$args,
				array(
					'post_id' => get_the_ID(),
					'class' => 'post_networks',
					'before_title' => '<h4>',
					'after_title' => '</h4>',
					'display_title' => true,
					'output_type' => 'echo'
				)
			)
		);
		$networks_array = explode(" ", get_option('fields_id_value'.$post_id, ''));

		if($networks_array[0]!=''){
			$count = 0;
			$network_title = get_post_meta($post_id, 'network_title', true);

			$output = '<div class="'.$class.'">';
			$output .= $network_title && $display_title ? $before_title.$network_title.$after_title : '';
			$output .= '<ul class="clearfix unstyled">';
			foreach ($networks_array as $networks_id) {
				$network_array = explode(";", get_option('network_'.$post_id.'_'.$networks_id, array('','','')));
				$output .= '<li class="network_'.$count.'">';
				$output .= $network_array[2] ? '<a href="'.$network_array[2].'" title="'.$network_array[1].'">' : '' ;
				$output .= $network_array[0] ? '<span class="'.$network_array[0].'"></span>' :'';
				$output .= $network_array[1] ? '<span class="network_title">'.$network_array[1].'</span>' : '' ;
				$output .= $network_array[2] ? '</a>' : '' ;
				$output .= '</li>';
				++$count;
			}
			$output .= '</ul></div>';
			if($output_type == 'echo'){
				echo $output;
			}else{
				return $output;
			}
		}
	}
function remover_versao() {
     return '';
}
add_filter('the_generator', 'remover_versao');
?>