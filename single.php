<?php
/**
 * The router for displaying all single posts
 *
 * Usage: If you want a different layout for single posts of Post Type "Books",
 * add a is_singular check in the switch below * and point it to your Books template
 *
 * page.php holds routing rules for pages
 * archive.php holds routing rules for displaying archives
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package foolish
 */

get_header();

fool_debug( basename( __DIR__ ), pathinfo( __FILE__, PATHINFO_FILENAME ) );

$sidebar = false;
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();
				switch ( true ) {
					default:
						get_template_part( 'posts/post-default' );
				}
			endwhile; // End of the loop.
			?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
if ( $sidebar ) {
	get_sidebar();
}

get_footer();
