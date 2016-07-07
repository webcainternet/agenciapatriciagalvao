<?php

/*
Plugin Name: Posts Order Widget
Plugin URI: http://www.my-wp-plugins.com/Forum-posts-order-widget.html
Description: This widget will let visitors order posts by context rather than date with a dropdown menu.
Author: LordPretender
Version: 2.0.3
Author URI: http://www.duy-pham.fr
Domain Path: /languages
*/

//http://www.fruityfred.com/2012/08/20/internationaliser-traduire-un-plugin-wordpress/
load_plugin_textdomain('post-order-widget', false, dirname( plugin_basename( __FILE__ ) ). '/languages/');

require( rtrim(plugin_dir_path(__FILE__), '/') . '/taxonomy.class.php');
$pow_taxonomy = new POW_Taxonomy();

//S'inspirer de wp-includes/default-widgets.php
$id_bytitle = "bytitle";
$id_bydatea = "bydatea";
$id_bymodified = "bymodified";
$id_rand = "rand";

//Modification de l'ordre d'affichage des articles et initialisation de divers attributs de la classe POW_Taxonomy.
add_filter('pre_get_posts', array($pow_taxonomy, 'frontend_initialiser'), -100);

//Déclaration de notre extention en tant que Widget
function register_POW_Widget() {
    register_widget( 'POW_Widget' );
}
add_action( 'widgets_init', 'register_POW_Widget' );

// Documentation : http://codex.wordpress.org/Widgets_API
class POW_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'pow_widget', // Base ID
			'Posts Order Widget', // Name
			array( 'description' => __('Let visitors order posts by context rather than date with a dropdown menu.', 'post-order-widget'), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $id_bytitle, $id_bydatea, $id_bymodified, $id_rand, $pow_taxonomy;
		
		//On n'affiche pas le widget si nous sommes dans une page, un article, un média.
		if(is_page() || is_single() || is_attachment())return;
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $args['before_widget'];
		
		if ( ! empty( $title ) )echo $args['before_title'] . $title . $args['after_title'];
		
		//Ajout des options en fonction des paramètres du widget
		$opt_title = $instance[$id_bytitle] ? $pow_taxonomy->getHTMLOption("title") : "";
		$opt_bydatea = $instance[$id_bydatea] ? $pow_taxonomy->getHTMLOption("datea") : "";
		$opt_bymodified = $instance[$id_bymodified] ? $pow_taxonomy->getHTMLOption("modified") : "";
		$opt_rand = $instance[$id_rand] ? $pow_taxonomy->getHTMLOption("rand") : "";
		$opt_bydated = $pow_taxonomy->getHTMLOption("dated");
		
		echo "
		<form method=\"get\" id=\"order\">
			<select name=\"pow\" onchange=\"this.form.submit()\">
			  $opt_title
			  $opt_bydated
			  $opt_bydatea
			  $opt_bymodified
			  $opt_rand
			</select>
		</form>";
		
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
 	public function form( $instance ) {
		global $id_bytitle, $id_bydatea, $id_bymodified, $id_rand;
		
		$checked_bytitle = $instance[$id_bytitle] ? 'checked="checked"' : '';
		$checked_bydatea = $instance[$id_bydatea] ? 'checked="checked"' : '';
		$checked_bymodified = $instance[$id_bymodified] ? 'checked="checked"' : '';
		$checked_rand = $instance[$id_rand] ? 'checked="checked"' : '';
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __('Sort posts', 'post-order-widget') ); ?>" />
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php echo $checked_bytitle; ?> id="<?php echo $this->get_field_id($id_bytitle); ?>" name="<?php echo $this->get_field_name($id_bytitle); ?>" />
			<label for="<?php echo $this->get_field_id($id_bytitle); ?>"><?php _e('Display the order by title', 'post-order-widget'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" <?php echo $checked_bydatea; ?> id="<?php echo $this->get_field_id($id_bydatea); ?>" name="<?php echo $this->get_field_name($id_bydatea); ?>" />
			<label for="<?php echo $this->get_field_id($id_bydatea); ?>"><?php _e('Display the order by ascending date', 'post-order-widget'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" <?php echo $checked_bymodified; ?> id="<?php echo $this->get_field_id($id_bymodified); ?>" name="<?php echo $this->get_field_name($id_bymodified); ?>" />
			<label for="<?php echo $this->get_field_id($id_bymodified); ?>"><?php _e('Display the order by modification', 'post-order-widget'); ?></label>
			<br />
			<input class="checkbox" type="checkbox" <?php echo $checked_rand; ?> id="<?php echo $this->get_field_id($id_rand); ?>" name="<?php echo $this->get_field_name($id_rand); ?>" />
			<label for="<?php echo $this->get_field_id($id_rand); ?>"><?php _e('Display the order randomly', 'post-order-widget'); ?></label>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		global $id_bytitle, $id_bydatea, $id_bymodified, $id_rand;
		
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
		//Les checkboxes
		$instance[$id_bytitle] = $new_instance[$id_bytitle] ? 1 : 0;
		$instance[$id_bydatea] = $new_instance[$id_bydatea] ? 1 : 0;
		$instance[$id_bymodified] = $new_instance[$id_bymodified] ? 1 : 0;
		$instance[$id_rand] = $new_instance[$id_rand] ? 1 : 0;

		return $instance;
	}
}

?>