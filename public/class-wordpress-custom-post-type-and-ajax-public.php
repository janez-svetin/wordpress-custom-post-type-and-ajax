<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://teja.cetinski.eu
 * @since      1.0.0
 *
 * @package    Wordpress_Custom_Post_Type_And_Ajax
 * @subpackage Wordpress_Custom_Post_Type_And_Ajax/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordpress_Custom_Post_Type_And_Ajax
 * @subpackage Wordpress_Custom_Post_Type_And_Ajax/public
 * @author     Teja Cetinski <teja@cetinski.eu>
 */
class Wordpress_Custom_Post_Type_And_Ajax_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Custom_Post_Type_And_Ajax_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Custom_Post_Type_And_Ajax_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-custom-post-type-and-ajax-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Custom_Post_Type_And_Ajax_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Custom_Post_Type_And_Ajax_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-custom-post-type-and-ajax-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'afp_vars', array(
			'afp_nonce' => wp_create_nonce( 'afp_nonce' ),
			'afp_ajax_url' => admin_url( 'admin-ajax.php' )
			)
		);

	}
	
	public function limit_posts_per_archive_page( $query ) {
		
		if ( $query->is_post_type_archive( 'event' ) ) {
			set_query_var( 'posts_per_archive_page', 5 );
		}
		
	}
	
	public function ajax_filter_events( $types ) {
		
		if( !isset( $_POST['afp_nonce'] ) || !wp_verify_nonce( $_POST['afp_nonce'], 'afp_nonce' ) ) {
			die('Permission denied');
		}

		$types = $_POST['types'];

		$meta_query_args = [
			'post_type' => 'event',
			'posts_per_page' => 5,
			'paged' => $_POST['page'],
			'meta_query' => [
				[	'key' => '_type', 'value' => $types, 'compare' => 'IN']
			]
		];

		$query = new WP_Query( $meta_query_args );

		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				get_template_part( 'content', 'event' );
			endwhile;
		endif;

		die();
		
	}
	
	function get_single_template($template) {
		global $post;
		
		if($post->post_type == 'event') {
			$single_template = plugin_dir_path( __FILE__ ) . 'partials/wordpress-custom-post-type-and-ajax-public-display-single-event.php';
		}
		return $single_template;
	}
	
	function get_archives_template($template) {
		global $post;
		
		if($post->post_type == 'event') {
			$single_template = plugin_dir_path( __FILE__ ) . 'partials/wordpress-custom-post-type-and-ajax-public-display.php';
		}
		return $template;
	}

}
