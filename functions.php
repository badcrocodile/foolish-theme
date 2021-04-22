<?php
/**
 * foolish functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package foolish
 */

// Register Custom Navigation Walker
require_once get_template_directory() . '/libraries/wp-bootstrap-navwalker.php';

add_action( 'after_setup_theme', 'fool_setup' );
if ( ! function_exists( 'fool_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fool_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on foolish, use a find and replace
		 * to change 'foolish' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'foolish', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'foolish' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'fool_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
add_action( 'after_setup_theme', 'fool_content_width', 0 );
function fool_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fool_content_width', 640 );
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
add_action( 'widgets_init', 'fool_widgets_init' );
function fool_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'foolish' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'foolish' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'fool_scripts' );
function fool_scripts() {
	wp_enqueue_style( 'bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
	wp_enqueue_style( 'fontawesome-5', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css' );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,900;1,400&family=Ubuntu:wght@500&display=swap' );
	wp_enqueue_style( 'foolish-style', get_stylesheet_uri(), [], filemtime( get_template_directory() . '/style.css' ) );

	wp_deregister_script( 'jquery' );

	wp_enqueue_script( 'foolish-navigation', get_template_directory_uri() . '/js/navigation.js', [], '20151215', true );
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', false, '2.2.0' );
	wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', [ 'jquery' ], '1.0' );
	wp_enqueue_script( 'foolish-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', [], '1.0', true );
	wp_enqueue_script( 'foolish-scripts', get_template_directory_uri() . '/js/scripts.js', [ 'jquery' ], filemtime( get_template_directory() . '/js/scripts.js' ), true );
	wp_localize_script( 'foolish-scripts', 'ajax_var', [ 'url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'foolish-nonce' ) ] );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom breadcrumbs for this theme.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Customize the login screen
 */
add_action( 'login_enqueue_scripts', 'fool_login_logo_one' );
add_filter( 'login_headerurl', 'fool_login_logo_url' );
add_filter( 'login_headertitle', 'fool_login_logo_url_title' );
function fool_login_logo_one() {
	?>
    <style type="text/css">
        body.login {
            background: #fff !important;
        }

        body.login div#login h1 a {
            background-image: url(<?php bloginfo('template_url'); ?>/images/logo.png);
            background-size: 310px;
            width: 100%;
        }

        body.login form {
            padding: 30px 20px;
            box-shadow: 0px 4px 7px 1px rgba(0, 0, 0, .13);
        }

        body.login #backtoblog {
            display: none;
        }
    </style>
	<?php
}

function fool_login_logo_url() {
	return home_url();
}

function fool_login_logo_url_title() {
	return 'Foolish Theme';
}

/**
 * Theme options page
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );
}

/**
 * Add svg support to media library
 */
add_filter( 'upload_mimes', 'fool_go_mime_types' );
function fool_go_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

/**
 * Outputs information about the template being displayed.
 * Useful for debugging template files
 * Toggled on/off by ACF field in Theme Settings --> General
 *
 * @param $filepath
 * @param $filename
 */
function fool_debug( $filepath, $filename ) {
	if ( get_field( 'theme_debug', 'option' ) ) : ?>
        <script type="text/javascript">
			console.log("<?= $filepath ?>/<?= $filename ?>");
        </script><?php
	endif;
}

/**
 * Add Theme Support for wide and full-width images.
 *
 * Add this to your theme's functions.php, or wherever else
 * you are adding your add_theme_support() functions.
 *
 * @action after_setup_theme
 */
add_action( 'after_setup_theme', 'fool_setup' );
function fool_setup() {
	add_theme_support( 'align-wide' );
}

/**
 * Tell ACF to not hide regular WP custom fields
 */
add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );

/**
 * Custom styles for Admin screens
 * @source https://css-tricks.com/snippets/wordpress/apply-custom-css-to-admin-area/
 */
add_action( 'admin_head', 'fool_custom_admin_css' );
function fool_custom_admin_css() {
	echo '<style>
    .acf-field[data-acf-relationship-create-enabled="true"] a.acf-relationship-create-link {
        float: right;
        text-decoration: none;
        z-index: 9999;
        display: block;
        position: absolute;
        right: 10px;
        top: 100px;
    </style>';
}

/**
 * Append stock ticker and exchange to posts that are in category "Stock Recommendations"
 */
add_filter( 'the_title', 'fool_add_symbol_to_title', 10, 2 );
function fool_add_symbol_to_title( $title, $id ) {
	if ( ! is_admin() ) { // don't run the filter on admin pages
		if ( in_category( 'stock-recommendation', $id ) && get_the_terms( $id, 'company' ) ) {
			$ticker = strtoupper( get_the_terms( $id, 'company' )[0]->name );

			return "$title ($ticker)";
		}
	}

	return $title;
}

/**
 * Outputs pagination links when padded a query object, such as $wp_query in most instances.
 *
 * @param $wp_query_in
 */
function fool_pagination( $wp_query_in ) {
	$big = 999999999; // need an unlikely integer

	echo paginate_links( array(
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'end_size'  => 5,
		'total'     => $wp_query_in->max_num_pages,
		'next_text' => "<i class='fas fa-arrow-right'></i>",
		'prev_text' => "<i class='fas fa-arrow-left'></i>"
	) );
}

/**
 * Filter the query on Company taxonomy archive pages
 * Only returns posts that are also in category 'Stock Recommendations'
 */
add_action( 'pre_get_posts', function( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_tax( 'company' ) ) {
		$query->set( 'category_name', 'stock-recommendation' );
	}
} );


/**
 * Get all posts in category Stock Recommendations that have ACF "Company Association" set to the currently displayed Company.
 * We do this by using a reverse lookup based on the ACF Relationship field
 *
 * @source https://www.advancedcustomfields.com/resources/querying-relationship-fields/
 *
 * @return array
 */
function fool_get_previous_recommendations() {
	$articles = [];

	$args = [
		'post_type'              => 'post',
		'post_status'            => 'publish',
		'category_name'          => 'stock-recommendation',
		'no_found_rows'          => true,
		'update_post_term_cache' => true,
		'meta_query'             => [
			[
				'key'     => 'company_association',
				'value'   => '"' . get_the_ID() . '"',
				'compare' => 'LIKE'
			]
		],
	];

	$results = new WP_Query( $args );

	if ( $results->have_posts() ) {
		$x = 0;
		while ( $results->have_posts() ) {
			$results->the_post();
			$articles[ $x ]['title'] = get_the_title();
			$articles[ $x ]['link']  = get_the_permalink();
			$x ++;
		}

		wp_reset_postdata();
	}

	return $articles;
}

/**
 * Get all Posts that have taxonomy "Company" set to the currently displayed Company.
 * Excludes category "Stock Recommendations"
 *
 * @return array
 */
function fool_company_other_coverage() {
	$post_ticker = get_queried_object()->slug;
	$articles    = [];

	$args = [
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'category__not_in' => [ get_category_by_slug( 'stock-recommendation' )->term_id ],
		'posts_per_page'   => 5,
		'tax_query'        => [
			[
				'taxonomy' => 'company',
				'field'    => 'slug',
				'terms'    => $post_ticker
			]
		]
	];

	$results = new WP_Query( $args );

	if ( $results->have_posts() ) {

		$x = 0;
		while ( $results->have_posts() ) {
			$results->the_post();
			$articles[ $x ]['title']       = get_the_title();
			$articles[ $x ]['link']        = get_the_permalink();
			$articles[ $x ]['total_pages'] = $results->max_num_pages;
			$x ++;
		}

		wp_reset_postdata();
	}

	return $articles;
}

/**
 * AJAX callback
 * Handles pagination on Other Coverage queries
 */
add_action( 'wp_ajax_fool_paginate_custom_query', 'fool_paginate_custom_query' );
add_action( 'wp_ajax_nopriv_fool_paginate_custom_query', 'fool_paginate_custom_query' );
function fool_paginate_custom_query() {
	/**
	 * JS will pass us a number that represents the pagination status (1, 2, 3)
	 * We'll take that number and create the appropriate offset to WP_Query
	 * and pass the next 10 results back to the JS
	 * where we'll dynamically insert the results.
	 */
	if ( ! wp_verify_nonce( $_POST['nonce'], 'foolish-nonce' ) ) {
		die ( 'No Access' );
	}

	$articles = [];

	// The page that was clicked
	$page = $_POST['page'];

	// Offset will be the desired page minus 1, times the posts_per_page
	// Using page 3 and posts_per_page of 5 for example: (3 - 1) x 5 = 10. Ten should be our offset.
	$offset = ( $page - 1 ) * 5;

	$company_ticker = $_POST['company_ticker'];

	$args = [
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'category__not_in' => [ get_category_by_slug( 'stock-recommendation' )->term_id ],
		'posts_per_page'   => 5,
		'offset'           => $offset,
		'tax_query'        => [
			[
				'taxonomy' => 'company',
				'field'    => 'slug',
				'terms'    => $company_ticker
			]
		]
	];

	$results = new WP_Query( $args );

	if ( $results->have_posts() ) {
		$x = 0;
		while ( $results->have_posts() ) {
			$results->the_post();
			$articles[ $x ]['title'] = get_the_title();
			$articles[ $x ]['link']  = get_the_permalink();
			$x ++;
		}

		wp_reset_postdata();
	}

	$return_string = "<ul>";

	foreach ( $articles as $article ) {
		$return_string .= "<li><a href='" . $article['link'] . "' title='" . $article['title'] . "'>" . $article['title'] . "</a>";
	}

	$return_string .= "</ul>";

	echo $return_string;

	die();
}

// add_action( 'init', 'cptui_register_my_taxes_company' );

/**
 * Taxonomy: Companies.
 */
add_action( 'init', function() {
	$labels = [
		"name"                       => __( "Companies", "foolish" ),
		"singular_name"              => __( "Company", "foolish" ),
		"menu_name"                  => __( "Companies", "foolish" ),
		"all_items"                  => __( "All Companies", "foolish" ),
		"edit_item"                  => __( "Edit Company", "foolish" ),
		"view_item"                  => __( "View Company", "foolish" ),
		"update_item"                => __( "Update Company name", "foolish" ),
		"add_new_item"               => __( "Add new Company", "foolish" ),
		"new_item_name"              => __( "New Company name", "foolish" ),
		"parent_item"                => __( "Parent Company", "foolish" ),
		"parent_item_colon"          => __( "Parent Company:", "foolish" ),
		"search_items"               => __( "Search Companies", "foolish" ),
		"popular_items"              => __( "Popular Companies", "foolish" ),
		"separate_items_with_commas" => __( "Separate Companies with commas", "foolish" ),
		"add_or_remove_items"        => __( "Add or remove Companies", "foolish" ),
		"choose_from_most_used"      => __( "Choose from the most used Companies", "foolish" ),
		"not_found"                  => __( "No Companies found", "foolish" ),
		"no_terms"                   => __( "No Companies", "foolish" ),
		"items_list_navigation"      => __( "Companies list navigation", "foolish" ),
		"items_list"                 => __( "Companies list", "foolish" ),
		"back_to_items"              => __( "Back to Companies", "foolish" ),
	];

	$args = [
		"label"                 => __( "Companies", "foolish" ),
		"labels"                => $labels,
		"public"                => true,
		"publicly_queryable"    => true,
		"hierarchical"          => false,
		"show_ui"               => true,
		"show_in_menu"          => true,
		"show_in_nav_menus"     => true,
		"query_var"             => true,
		"rewrite"               => [ 'slug' => 'company', 'with_front' => true, ],
		"show_admin_column"     => true,
		"show_in_rest"          => true,
		"rest_base"             => "company",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit"    => true,
	];

	register_taxonomy( "company", [ "post" ], $args );
} );
