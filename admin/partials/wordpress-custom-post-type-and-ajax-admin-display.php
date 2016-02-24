<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://teja.cetinski.eu
 * @since      1.0.0
 *
 * @package    Wordpress_Custom_Post_Type_And_Ajax
 * @subpackage Wordpress_Custom_Post_Type_And_Ajax/admin/partials
 */

$event_types = array(
	'theater' => __( 'play'),
	'concert' => __( 'concert' ),
	'exhibition' => __( 'exhibition' ),
	'festival' => __( 'festival' ),
	'movie' => __( 'movie' ),
	'conference' => __( 'conference' )
);

$event_features = array(
	'free_parking' => __( 'Free parking' ),
	'eticket' => __( 'E-ticket' ),
	'lunch' => __( 'Lunch included' ),
	'early_discount' => __( 'Early bird discount' )
);

wp_nonce_field( $this->plugin_name, 'eventposts_nonce' );

// get event meta from the DB
$event_meta = get_post_custom( $post->ID );
$date = isset( $event_meta['_date'][0] ) ? $event_meta['_date'][0] : '';
$end_date = isset( $event_meta['_end_date'][0] ) ? $event_meta['_end_date'][0] : '';
$location = isset( $event_meta['_location'][0] ) ? $event_meta['_location'][0] : '';
$type = isset( $event_meta['_type'][0] ) ? $event_meta['_type'][0] : '';
$features = isset( $event_meta['_features'][0] ) ? $event_meta['_features'][0] : '';
$features = empty( $features ) ? [] : unserialize( unserialize( $features ) );

?>

	<div class="event_meta_item">
		<label><?php _e( 'Date' ); ?>:</label> <input type="date" name="_date" value="<?php echo $date; ?>" placeholder="YYYY-MM-DD" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" />
	</div>

	<div class="fest_conf_show <?php echo ( !in_array( $type, ['conference', 'festival'] ) ) ? 'hidden' : ''; ?>">	
		<div class="event_meta_item">
			<label><?php _e( 'End date' ); ?>:</label> <input type="date" name="_end_date" placeholder="YYYY-MM-DD" value="<?php echo $end_date; ?>" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" />
		</div>
	</div>

	<div class="event_meta_item">
		<label><?php _e( 'Location' ); ?>:</label> <input type="text" name="_location" value="<?php echo $location; ?>" />
	</div>

	<div class="event_meta_item">
		<label><?php _e( 'Type' ); ?>:</label> 
		<select name="_type" value="<?php echo $type; ?>" />
			<option value=""></option>
			<?php foreach( $event_types as $value => $name ) { ?>
				<option value="<?php echo $value; ?>"<?php echo ( $value == $type ) ? ' selected="selected"' : ''; ?>><?php echo $name; ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="event_meta_item features">
	<?php foreach( $event_features as $value => $name ) { ?>
		<input type="checkbox" name="<?php echo $value; ?>" id="<?php echo $value; ?>" value="<?php echo $value; ?>" <?php echo ( in_array( $value, $features ) ) ? ' checked="checked"' : ''; ?> /> 
		<label for="<?php echo $value; ?>"><?php _e( $name ); ?></label>
	<?php } ?>
	</div>
