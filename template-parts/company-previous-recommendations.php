<?php
/**
 * Template part for displaying Previous Recommendations for a specific company
 */
?>

<?php if ( have_posts() ) : ?>
    <div class="company-details well well-lg">
        <h3>Previous Recommendations</h3>
        <ul>
            <?php while(have_posts()) : the_post(); ?>
                <li><a href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>"><?= get_the_title() ?></a></li>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif; ?>
