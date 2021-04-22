<?php
/**
 * Template part for displaying Other Coverage for a specific company
 */

?>


<?php $articles = fool_company_other_coverage(); ?>

<?php if ( $articles ) : ?>
	<div class="company-details well well-lg">
		<h3>Other Coverage</h3>

		<div class="other-coverage-wrap">
			<ul>
				<?php foreach ( $articles as $article ) : ?>
					<li><a href="<?= $article['link'] ?>" title="<?= $article['title'] ?>"><?= $article['title'] ?></a></li>
				<?php endforeach ?>
			</ul>
		</div>

		<?php if ( $articles[0]['total_pages'] > 1 ) : ?>
			<div class="pagination">
				<?php for ( $x = 1; $x <= $articles[0]['total_pages']; $x ++ ) : ?>
					<button class="page-link <?= ( $x == 1 ? "current" : "" ) ?>" data-companyticker="<?= get_queried_object()->slug ?>"><?= $x ?></button>
				<?php endfor ?>
			</div>
		<?php endif ?>
	</div>
<?php endif ?>
