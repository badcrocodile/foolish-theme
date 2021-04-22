<?php
/**
 * Template part for displaying results in search pages
 */

?>

<script type="text/javascript">
	console.log("archives/archive-default");
</script>

<div class="container archive-item search-item">
	<div class="row">
		<div class="col-md-12">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h2 class="entry-title"><a href="<?= get_permalink() ?>"><?= relevanssi_the_title() ?></a></h2>
				</header><!-- .entry-header -->

				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->

				<footer class="entry-footer">
					<?php fool_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-## -->

		</div>
	</div>
</div>
