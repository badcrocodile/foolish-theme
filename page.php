<?php
/**
 * The router for displaying all pages
 *
 * Usage: If you want a different layout for your contact page,
 * add an is_page check in the switch below * and point it to your Books template
 *
 * single.php holds routing rules for posts
 * archive.php holds routing rules for displaying archives
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
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
					case( is_page( 'contact' ) ):
						get_template_part( 'pages/contact' );
					break;
					default:
						get_template_part( 'pages/default' );
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
