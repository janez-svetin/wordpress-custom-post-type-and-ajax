<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://teja.cetinski.eu
 * @since      1.0.0
 *
 * @package    Wordpress_Custom_Post_Type_And_Ajax
 * @subpackage Wordpress_Custom_Post_Type_And_Ajax/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wordpress_Custom_Post_Type_And_Ajax
 * @subpackage Wordpress_Custom_Post_Type_And_Ajax/includes
 * @author     Teja Cetinski <teja@cetinski.eu>
 */
class Wordpress_Custom_Post_Type_And_Ajax_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wordpress-custom-post-type-and-ajax',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
