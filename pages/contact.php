<?php
/**
 * Template for displaying contact page.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The_EDUT_Project
 */

?>

<?php fool_debug( basename( __DIR__ ), pathinfo( __FILE__, PATHINFO_FILENAME ) ); ?>

<div id="primary" class="content-area row">
	<main id="main" class="site-main col-sm-12" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class( "contact" ); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'edut' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->

			<?php if ( get_edit_post_link() ) : ?>
				<footer class="entry-footer">
					<?php
					edit_post_link(
						sprintf(
						/* translators: %s: Name of current post */
							esc_html__( 'Edit %s', 'edut' ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</footer><!-- .entry-footer -->
			<?php endif; ?>
		</article><!-- #post-## -->
	</main>
</div>
