<?php
/**
 * @package Law16
 */

$blog_single_thumb = law16_option('blog_single_thumb');

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php law16_posted_on(); ?>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->
	
	<?php
	if ( $blog_single_thumb ) {
		if( has_post_thumbnail( ) ) {
			echo '<div class="post-thumbnail">';
			the_post_thumbnail( 'blog-large' );
			echo '</div>';
		}
	}
	?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'law16' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php law16_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
