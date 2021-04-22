<?php
/**
 * Template part for displaying posts
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fool
 */

fool_debug( basename( __DIR__ ), pathinfo( __FILE__, PATHINFO_FILENAME ) );

?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="breadcrumbs post-meta">
				<?php fool_breadcrumbs(); ?>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12 main-content">
			<article data-template="content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php fool_posted_on(); ?><br>
					<?php fool_entry_footer(); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php
					if ( in_category( 'stock-recommendation' ) ) {
						get_template_part( 'template-parts/company-details' );
					}
					?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-## -->
		</div>
	</div>
</div>
