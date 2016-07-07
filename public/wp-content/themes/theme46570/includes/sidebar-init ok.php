<?php
function elegance_widgets_init() {
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name'					=> theme_locals("sidebar"),
		'id' 						=> 'main-sidebar',
		'description'   => theme_locals("sidebar_desc"),
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
        // Header Widget Area 1
	// Location: at the top of the header
	register_sidebar(array(
		'name'					=> __('Header Area 1', CURRENT_THEME),
		'id' 						=> 'header-sidebar-1',
		'description'   => __('Located at the top of pages.', CURRENT_THEME),
		'before_widget' => '<div id="%1$s" class="header-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
        // Header Widget Area 2
	// Location: at the top of the header
	register_sidebar(array(
		'name'					=> __('Header Area 2', CURRENT_THEME),
		'id' 						=> 'header-sidebar-2',
		'description'   => __('Located at the top of pages.', CURRENT_THEME),
		'before_widget' => '<div id="%1$s" class="header-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
        // Home Widget Area
	// Location: at the right of the Home Page
	register_sidebar(array(
		'name'					=> __('Home Area', CURRENT_THEME),
		'id' 						=> 'home-sidebar',
		'description'   => __('Located at the right of Home Page.', CURRENT_THEME),
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	// Footer Widget Area
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'					=> __('Footer Area', CURRENT_THEME),
		'id' 						=> 'footer-sidebar',
		'description'   => __('Located at the bottom of pages.', CURRENT_THEME),
		'before_widget' => '<div id="%1$s" class="span2 widget-footer">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
}
/** Register sidebars by running elegance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'elegance_widgets_init' );
?>