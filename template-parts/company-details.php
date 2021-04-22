<?php

use Fool\Connection;

$ticker = strtoupper( get_the_terms( $id, 'company' )[0]->name );

$profile = ( new Connection( $ticker, 'profile' ) )->getResponse();
?>

<?php if ( is_string( $profile ) ) : ?>
	<?php echo $profile ?>
<?php else : ?>
    <div class="company-details well well-lg">
        <h3>Company Profile: <a href="<?= $profile->website ?>" title="Link to company website"><?= $profile->companyName ?></a></h3>
        <div class="company-logo"><img alt="<?= $profile->companyName ?> logo" src="<?= $profile->image ?>"></div>
        <div class="company-meta"><strong>Exchange:</strong> <?= $profile->exchangeShortName ?></div>
        <div class="company-meta"><strong>Industry:</strong> <?= $profile->industry ?></div>
        <div class="company-meta"><strong>Sector:</strong> <?= $profile->sector ?></div>
        <div class="company-meta"><strong>CEO:</strong> <?= $profile->ceo ?></div>
        <div class="company-meta"><strong>Description:</strong> <?= $profile->description ?></div>
    </div>
<?php endif ?>
