<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://teja.cetinski.eu
 * @since             1.0.0
 * @package           Wordpress_Custom_Post_Type_And_Ajax
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Post Type and AJAX
 * Plugin URI:        https://github.com/tejac/wordpress-custom-post-type-and-ajax
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Teja Cetinski
 * Author URI:        http://teja.cetinski.eu
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-custom-post-type-and-ajax
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordpress-custom-post-type-and-ajax-activator.php
 */
function activate_wordpress_custom_post_type_and_ajax() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-custom-post-type-and-ajax-activator.php';
	Wordpress_Custom_Post_Type_And_Ajax_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordpress-custom-post-type-and-ajax-deactivator.php
 */
function deactivate_wordpress_custom_post_type_and_ajax() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-custom-post-type-and-ajax-deactivator.php';
	Wordpress_Custom_Post_Type_And_Ajax_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wordpress_custom_post_type_and_ajax' );
register_deactivation_hook( __FILE__, 'deactivate_wordpress_custom_post_type_and_ajax' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-custom-post-type-and-ajax.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wordpress_custom_post_type_and_ajax() {

	$plugin = new Wordpress_Custom_Post_Type_And_Ajax();
	$plugin->run();

}
run_wordpress_custom_post_type_and_ajax();
