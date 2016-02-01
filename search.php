<?php
/**
 * The template for displaying search results pages.
 *
 * @package Law16
 */

get_header(); ?>
		
		<?php law16_breadcrumb(); ?>

		<div id="content-wrap" class="container <?php echo law16_get_layout_class(); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) : ?>

						<header class="page-header">
							<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'law16' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</header><!-- .page-header -->

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php
							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'content', 'search' );
							?>

						<?php endwhile; ?>

						<?php law16_paging_nav(); ?>

					<?php else : ?>

						<?php get_template_part( 'content', 'none' ); ?>

					<?php endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php echo law16_get_sidebar(); ?>
					
		</div> <!-- /#content-wrap -->

<?php get_footer(); ?>
