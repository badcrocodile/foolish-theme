<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BreakingBread
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
    <div class="sf-header-search">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="get" id="searchform" class="form-search center-text" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="text" id="s" class="search-query cfc-h-tx center-text tt-upper" name="s" placeholder="Type and hit enter to search">
                    </form>

                    <span class="header-search-close"><i class="fa fa-times" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="search-backdrop"></div>

    <nav class="navbar" id="site-navigation">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button class="hamburger hamburger--arrowturn-r" type="button" id="open-mmenu" style="float: right;">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
                        </button>
                        <!--				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">-->
                        <!--					<span class="sr-only">Toggle navigation</span>-->
                        <!--					<span class="icon-bar"></span>-->
                        <!--					<span class="icon-bar"></span>-->
                        <!--					<span class="icon-bar"></span>-->
                        <!--				</button>-->
                        <!--                <a href="#site-navigation" id="open-mmenu">Open the menu</a>-->
                        <a class="navbar-brand" href="/"><img src="<?= bloginfo( 'template_directory' ) ?>/images/logo.png"></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
	                <?php
	                wp_nav_menu( array(
		                'theme_location'  => 'menu-1',
		                'depth'           => 3,
		                'container'       => 'div',
		                'container_class' => 'collapse navbar-collapse',
		                'container_id'    => 'navbar-collapse-1',
		                'menu_class'      => 'nav navbar-nav',
		                'menu_id'         => 'primary-menu',
		                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
		                'walker'          => new WP_Bootstrap_Navwalker(),
	                ) );
	                ?>
                </div>
            </div>
        </div>
    </nav>

    <div id="content" class="site-content">
