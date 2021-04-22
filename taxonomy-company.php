<?php
/**
 * The template for displaying Company taxonomy pages
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package foolish
 */

use Fool\FoolishPlugin\Api\Connection;

get_header();

fool_debug( basename( __DIR__ ), pathinfo( __FILE__, PATHINFO_FILENAME ) );

$post_ticker = get_queried_object()->slug;

$profile = ( new Connection( $post_ticker, 'profile' ) )->get_response();
$quote   = ( new Connection( $post_ticker, 'quote' ) )->get_response();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
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
                                <h1 class="entry-title"><?= $profile->companyName ?> (<?= $profile->exchangeShortName . ":" . $profile->symbol ?>)</h1>
                                <div class="company-logo"><img alt="<?= $profile->companyName ?> logo" src="<?= $profile->image ?>"></div>
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <div class="company-description">
									<?= $profile->description ?>
                                </div>

                                <div class="company-details">
                                    <h3>By the Numbers</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                            <tr>
                                                <td>Price:</td>
                                                <td><?= ( $profile->price ? $profile->price : "N/A" ) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Price Change:</td>
                                                <td><?= ( $quote->change ? $quote->change : "N/A" ) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Price Change Percentage:</td>
                                                <td><?= ( $quote->changesPercentage ? $quote->changesPercentage : "N/A" ) ?></td>
                                            </tr>
                                            <tr>
                                                <td>52 Week Range:</td>
                                                <td><?= ( $profile->range ? $profile->range : "N/A" ) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Beta:</td>
                                                <td><?= ( $profile->beta ? $profile->beta : "N/A" ) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Volume Average:</td>
                                                <td><?= ( $profile->volAvg ? $profile->volAvg : "N/A" ) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Market Capitalisation:</td>
                                                <td><?= ( $quote->marketCap ? $quote->marketCap : "N/A" ) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Last Dividend:</td>
                                                <td><?= ( $profile->lastDiv ? $profile->lastDiv : "N/A" ) ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="previous-recommendations">
								<?php get_template_part( 'template-parts/company-previous-recommendations' ); ?>
                            </div>

                            <div class="other-coverage">
								<?php get_template_part( 'template-parts/company-other-coverage' ); ?>
                            </div>

                            <footer class="entry-footer"></footer><!-- .entry-footer -->
                        </article><!-- #post-## -->
                    </div>
                </div>
            </div>
        </main>
    </div>

<?php get_footer() ?>
