<?php
/**
 * The template for displaying event
 *
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 
 $event_types = [
	'theater' => __( 'play' ),
	'concert' => __( 'concert' ),
	'exhibition' => __( 'exhibition' ),
	'festival' => __( 'festival' ),
	'movie' => __( 'movie' ),
	'conference' => __( 'conference' )
];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		twentyfifteen_post_thumbnail();
	?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	  <?php $type = $event_types[get_post_meta( get_the_ID(), '_type', true )]; ?>	

		<p class="event_data">
		  <span class="type"><?php echo $type; ?></span>
		  <span class="date">
		  <?php
			  echo date_format( date_create_from_format( 'Y-m-d', get_post_meta( get_the_ID(), '_date', true ) ), get_option( 'date_format' ) );
			  if( in_array( $type, ['conference', 'festival'] ) ) {
			    $endTime = get_post_meta( get_the_ID(), '_end_date', true );
			    
			    if( !empty( $endTime ) ) {
			      echo " &ndash; " . date_format( date_create_from_format ( 'Y-m-d', $endTime), get_option( 'date_format' ) );
			    }
		    }
		  ?>
		  </span>
		  <span class="location">
		    @ <?php echo get_post_meta( get_the_ID(), '_location', true ); ?>
		  </span>
		</p>
	</header><!-- .entry-header -->
  
	<div class="entry-content">		
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'twentyfifteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer">
		<?php twentyfifteen_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
