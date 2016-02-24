<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://teja.cetinski.eu
 * @since      1.0.0
 *
 * @package    Wordpress_Custom_Post_Type_And_Ajax
 * @subpackage Wordpress_Custom_Post_Type_And_Ajax/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordpress_Custom_Post_Type_And_Ajax
 * @subpackage Wordpress_Custom_Post_Type_And_Ajax/admin
 * @author     Teja Cetinski <teja@cetinski.eu>
 */
class Wordpress_Custom_Post_Type_And_Ajax_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-custom-post-type-and-ajax-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-custom-post-type-and-ajax-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	public function create_event_type() {
		
		register_post_type( 'event', array(
				'labels' => array(
					'name' => __( 'Events' ),
					'singular_name' => __( 'Event' )
				),

				'public' => true,
				'has_archive' => true,
				'show_ui' => true,
				'supports' => [ 'title', 'editor', 'thumbnail' ],
				'capability_type' => 'post',
				'has_archive' => true,
				'rewrite' => [ 'slug' => 'events' ],
				'register_meta_box_cb' => '',
				'menu_icon' => 'dashicons-nametag'
			)
		);
		
	}

	public function add_metaboxes() {
		
		add_meta_box( 'event_info', __( 'Event Information' ), array( $this, 'metabox_event_properties' ), 'event', 'side', 'default' );
		
	}
	
	public function metabox_event_properties( $post ) {
		
		include( plugin_dir_path( __FILE__ ) . 'partials/wordpress-custom-post-type-and-ajax-admin-display.php' );
		
	}
	
	public function save_meta( $post_id, $post ) {
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
		if ( !current_user_can( 'edit_post', $post->ID ) ) { return; }
		if ( !isset( $_POST['eventposts_nonce'] ) ) { return; }
		if ( !wp_verify_nonce( $_POST['eventposts_nonce'], $this->plugin_name ) ) { return; }
		
		$event_meta['_date'] = $_POST['_date'];
		$event_meta['_end_date'] = $_POST['_end_date'];
		$event_meta['_type'] = $_POST['_type'];
		$event_meta['_location'] = $_POST['_location'];
		$event_meta['_features'] = [];

		$event_features = array(
			'free_parking' => __( 'Free parking' ),
			'eticket' => __( 'E-ticket' ),
			'lunch' => __( 'Lunch included' ),
			'early_discount' => __( 'Early bird discount' )
		);

		foreach( $event_features as $value => $name ) {
			if( isset( $_POST[$value] ) ) {
				$event_meta['_features'][] = $value;
			}
		}
		
		$event_meta['_features'] = serialize( $event_meta['_features'] );

		foreach( $event_meta as $key => $value ) {
			if ( get_post_meta( $post->ID, $key, TRUE ) ) {
				update_post_meta( $post->ID, $key, $value );
			}
			else {
				add_post_meta( $post->ID, $key, $value );
			}
			if ( !$value ) {
				delete_post_meta( $post->ID, $key );
			}
		}
		
	}
	
}
