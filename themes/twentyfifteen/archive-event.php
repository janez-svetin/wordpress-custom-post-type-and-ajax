<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
			  <h1 class="page-title"><?php _e( 'Events' ); ?></h1>
			</header><!-- .page-header -->
			
			<div class="event_filters hentry">
			  <div class="filter_inputs">
			  <?php foreach( $event_types as $value => $name ) { ?>
				  <input type="checkbox" name="<?php echo $value; ?>" id="<?php echo $value; ?>" checked="checked"/> 
				  <label for="<?php echo $value; ?>"><?php echo $name; ?></label>
			  <?php } ?>
			  </div>
			</div>
			
			<div class="tagged-posts">

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', 'event' );

			// End the loop.
			endwhile;
	?>
</div>
			<?php 
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
		
		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
<script>
</script>
