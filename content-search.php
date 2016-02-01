<?php
/**
 * @package Law16
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
		if( has_post_thumbnail( ) ) {
			echo '<div class="post-thumbnail">';
			the_post_thumbnail( 'blog-large' );
			echo '</div>';
		}
	?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php law16_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_excerpt();
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'law16' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->