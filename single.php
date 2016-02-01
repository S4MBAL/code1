<?php
/**
 * The template for displaying all single posts.
 *
 * @package Law16
 */

get_header(); ?>
	
	<?php law16_breadcrumb(); ?>

	<div id="content-wrap" class="container <?php echo law16_get_layout_class(); ?>">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'single' ); ?>

					<?php
						if ( law16_option('page_comments') ) {
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						}
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php echo law16_get_sidebar(); ?>
	</div> <!-- /#content-wrap -->
<?php get_footer(); ?>
