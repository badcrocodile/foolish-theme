<?php fool_debug( basename( __DIR__ ), pathinfo( __FILE__, PATHINFO_FILENAME ) ); ?>

<article data-template="content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <a href="<?= the_permalink() ?>"> <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?> </a>
    </header><!-- .entry-header -->

    <div class="entry-content">
		<?php the_excerpt(); ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
		<?php fool_posted_on(); ?>
        <br>
		<?php fool_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->

