<?php
/**
 * The template for displaying the blog front page
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fool
 */

get_header();

fool_debug( basename( __DIR__ ), pathinfo( __FILE__, PATHINFO_FILENAME ) );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php if ( have_posts() ) : ?>
				<div class="container">
					<div class="row">
						<div class="col-sm-9 main-content">
							<header class="page-header">
								<h1 class="page-title">Articles</h1>
							</header><!-- .page-header -->
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'archives/archive-default' ); ?>
							<?php endwhile; ?>

							<?php fool_pagination( $wp_query ) ?>
						</div>

						<div class="col-sm-3 sidebar">
							<?php get_sidebar(); ?>
						</div>
					</div>
				</div>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
