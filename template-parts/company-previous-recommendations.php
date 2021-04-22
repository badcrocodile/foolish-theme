<?php
/**
 * Template part for displaying Previous Recommendations for a specific company
 */
?>

<?php if ( have_posts() ) : ?>
	<div class="company-details well well-lg">
		<h3>Previous Recommendations</h3>
		<ul>
			<?php while ( have_posts() ) : the_post(); ?>
				<li><a href="<?php echo get_the_permalink() ?>" title="<?php echo get_the_title() ?>"><?php echo get_the_title() ?></a></li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php endif; ?>
