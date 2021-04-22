<?php
/**
 * The router for displaying archive pages
 *
 * Usage: If you want a different layout for the archive display of Post Type "Books",
 * add an is_post_type_archive('books) check in the switch below * and point it to your Books template
 *
 * page.php holds routing rules for pages
 * single.php holds routing rules for single posts and post-types
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fool
 */

get_header();

fool_debug( basename( __DIR__ ), pathinfo( __FILE__, PATHINFO_FILENAME ) );

$sidebar = false;
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row">
					<div class="main-content <?= ( isset( $sidebar ) ? "col-sm-9" : "col-sm-12" ) ?>">
						<header class="page-header">
							<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
						</header><!-- .page-header -->

						<?php
						if ( have_posts() ) {
							while ( have_posts() ) : the_post();
								switch ( true ) {
									default:
										$sidebar = true;
										get_template_part( 'archives/archive', 'default' );
								}
							endwhile;

							fool_pagination( $wp_query );
						} else {
							get_template_part( 'template-parts/content', 'none' );
						}
						?>
					</div>

					<?php if ( $sidebar ) : ?>
						<div class="col-sm-3">
							<?php get_sidebar(); ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		</main>
	</div>

<?php
get_footer();
