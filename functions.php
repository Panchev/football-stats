<?php
use WPEmerge\Facades\WPEmerge;
define( 'CRB_THEME_DIR', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );

# Enqueue JS and CSS assets on the front-end
add_action( 'wp_enqueue_scripts', 'crb_enqueue_assets' );
function crb_enqueue_assets() {
	$template_dir = get_template_directory_uri();
	# Enqueue CSS files
	wp_enqueue_style( 'theme-bootstrap', $template_dir . '/resources/css/bootstrap.css' );
	wp_enqueue_style( 'theme-dl-menu', $template_dir . '/js/dl-menu/component.css' );
	wp_enqueue_style( 'slick', $template_dir . '/resources/css/slick.css' );
	wp_enqueue_style( 'slick-theme', $template_dir . '/resources/css/slick-theme.css' );
	wp_enqueue_style( 'theme-fa', $template_dir . '/resources/css/font-awesome.css' );
	wp_enqueue_style( 'theme-svg-icons', $template_dir . '/resources/css/svg-icons.css' );
	wp_enqueue_style( 'theme-prettyPhoto', $template_dir . '/resources/css/prettyPhoto.css' );
	wp_enqueue_style( 'theme-typography', $template_dir . '/resources/css/typography.css' );
	wp_enqueue_style( 'theme-widget', $template_dir . '/resources/css/widget.css' );
	wp_enqueue_style( 'theme-shortcodes', $template_dir . '/resources/css/shortcodes.css' );
	wp_enqueue_style( 'theme-style', $template_dir . '/style.css' );
	wp_enqueue_style( 'theme-color', $template_dir . '/resources/css/color.css' );
	wp_enqueue_style( 'theme-responsive', $template_dir . '/resources/css/responsive.css' );

	# Enqueue Custom JS files
	// wp_enqueue_script( 'theme-bootstrap', $template_dir . '/resources/js/bootstrap.js', array( 'jquery' ) );
	wp_enqueue_script( 'theme-slick', $template_dir . '/resources/js/slick.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'theme-downCount', $template_dir . '/resources/js/downCount.js', array( 'jquery' ) );
	wp_enqueue_script( 'theme-waypoints-min', $template_dir . '/resources/js/waypoints-min.js', array( 'jquery' ) );
	wp_enqueue_script( 'theme-modernizr', $template_dir . '/resources/js/dl-menu/modernizr.custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'theme-jquery.dlmenu', $template_dir . '/resources/js/dl-menu/jquery.dlmenu.js', array( 'jquery' ) );
	wp_enqueue_script( 'theme-jprogress', $template_dir . '/resources/js/jprogress.js', array( 'jquery' ) );
	wp_enqueue_script( 'theme-prettyPhoto', $template_dir . '/resources/js/jquery.prettyPhoto.js', array( 'jquery' ) );
	wp_enqueue_script( 'theme-custom', $template_dir . '/resources/js/custom.js', array( 'jquery' ) );

	wp_localize_script( 'theme-custom', 'crb_options', [
		'ajax_url' => admin_url( 'admin-ajax.php' )
	]);

	// React JS
	wp_enqueue_script( 'theme-custom-react-scripts', $template_dir . '/build/index.js', ['wp-element'], time(), true );
	wp_localize_script( 'theme-custom-react-scripts', 'crb_theme_options', [
		'ajax_url' => admin_url( 'admin-ajax.php' )
	]);

	# Enqueue Comments JS file
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

# Enqueue JS and CSS assets on admin pages
add_action( 'admin_enqueue_scripts', 'crb_admin_enqueue_scripts' );
function crb_admin_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	# Enqueue script only on League Administration page
	if ( isset( $_GET['page'] ) && $_GET['page'] === 'league-admin' ) {
		wp_enqueue_script( 'theme-custom-admin-scripts', $template_dir . '/build/index.js', ['wp-element'], time(), true );
		wp_localize_script( 'theme-custom-admin-scripts', 'crb_theme_options', [
			'ajax_url' => admin_url( 'admin-ajax.php' )
		]);
	}

	# Enqueue Styles
	# @crb_enqueue_style attributes -- id, location, dependencies, media = all
	crb_enqueue_style( 'theme-admin-styles', $template_dir . '/resources/css/admin.css' );

	# Editor Styles
	# add_editor_style( 'css/custom-editor-style.css' );
}

add_action( 'login_enqueue_scripts', 'crb_login_enqueue' );
function crb_login_enqueue() {
	crb_enqueue_style( 'theme-login-styles', get_template_directory_uri() . '/css/login-style.css' );
}

# Attach Custom Post Types and Custom Taxonomies
add_action( 'init', 'crb_attach_post_types_and_taxonomies', 0 );
function crb_attach_post_types_and_taxonomies() {
	# Attach Custom Post Types
	include_once( CRB_THEME_DIR . 'options/post-types.php' );

	# Attach Custom Taxonomies
	include_once( CRB_THEME_DIR . 'options/taxonomies.php' );
}

add_action( 'after_setup_theme', 'crb_setup_theme' );

# To override theme setup process in a child theme, add your own crb_setup_theme() to your child theme's
# functions.php file.
if ( ! function_exists( 'crb_setup_theme' ) ) {
	function crb_setup_theme() {
		# Make this theme available for translation.
		load_theme_textdomain( 'crb', get_template_directory() . '/languages' );

		# Autoload dependencies
		$autoload_dir = CRB_THEME_DIR . 'vendor/autoload.php';
		if ( ! is_readable( $autoload_dir ) ) {
			wp_die( __( 'Please, run <code>composer install</code> to download and install the theme dependencies.', 'crb' ) );
		}
		include_once( $autoload_dir );
		\Carbon_Fields\Carbon_Fields::boot();


		# Additional libraries and includes
		include_once( CRB_THEME_DIR . 'includes/comments.php' );
		include_once( CRB_THEME_DIR . 'includes/title.php' );
		include_once( CRB_THEME_DIR . 'includes/gravity-forms.php' );
		include_once( CRB_THEME_DIR . 'includes/helpers.php' );
		include_once( CRB_THEME_DIR . 'includes/import-content-from-api.php' );

		include_once( CRB_THEME_DIR . 'includes/leagues-administration.php' );

		// include classes
		include_once( CRB_THEME_DIR . 'includes/match-class.php' );
		include_once( CRB_THEME_DIR . 'includes/team-class.php' );
		include_once( CRB_THEME_DIR . 'includes/league-class.php' );
		include_once( CRB_THEME_DIR . 'includes/football-api-class.php' );

		// Cron jobs
		include_once( CRB_THEME_DIR . 'app/Controllers/Web/CronjobController.php' );
		$cronjob_object = new App\Controllers\Web\CronjobController();

		WPEmerge::bootstrap( [
	        'routes' => [
	            'web' => __DIR__ . '/app/routes/web.php',
	            'ajax' => __DIR__ . '/app/routes/ajax.php'
	        ],
	    ]);


		global $football_api;
		$football_api = new Football_Api();
		// $import_object = new Crb_Import();



		# Theme supports
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'menus' );
		add_theme_support( 'html5', array( 'gallery' ) );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		# Register Theme Menu Locations
		register_nav_menus( array(
			'main_menu' => __( 'Main Menu', 'crb' ),
			'main_menu_mobile' => __( 'Main Menu (Mobile)', 'crb' ),
			'footer_menu_left' => __( 'Footer Menu Left', 'crb' ),
			'footer_menu_bottom_left' => __( 'Footer Menu Bottom Left', 'crb' ),
			'footer_menu_right' => __( 'Footer Menu Right', 'crb' ),
			'footer_menu_bottom_right' => __( 'Footer Menu Bottom Right', 'crb' ),
			'footer_menu_mobile_only' => __( 'Footer Menu ( Mobile Only )', 'crb' ),
		) );



		# Attach custom shortcodes
		include_once( CRB_THEME_DIR . 'options/shortcodes.php' );

		# Add Actions
		add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );

		# Add Filters
		add_filter( 'excerpt_more', 'crb_excerpt_more' );
		add_filter( 'excerpt_length', 'crb_excerpt_length', 999 );
		add_filter( 'crb_theme_favicon_uri', function() {
			return get_template_directory_uri() . '/dist/images/favicon.ico';
		} );
		add_filter( 'carbon_fields_map_field_api_key', 'crb_get_google_maps_api_key' );		
	}
}


add_action( 'init', function() {
     session_start(); // required only if you use Flash and OldInput
} );

# Sidebar Options
function crb_get_default_sidebar_options() {
	return array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widget__title">',
		'after_title'   => '</h2>',
	);
}

function crb_attach_theme_options() {
	# Attach fields
	include_once( CRB_THEME_DIR . 'options/theme-options.php' );
	include_once( CRB_THEME_DIR . 'options/post-meta.php' );
}

function crb_excerpt_more() {
	return '...';
}

function crb_excerpt_length() {
	return 55;
}

/**
 * Returns the Google Maps API Key set in Theme Options.
 *
 * @return string
 */
function crb_get_google_maps_api_key() {
	return carbon_get_theme_option( 'crb_google_maps_api_key' );
}

/**
 * Get the path to a versioned bundle relative to the theme directory.
 *
 * @param  string $path
 * @return string
 */
function crb_assets_bundle( $path ) {
	static $manifest = null;

	if ( is_null( $manifest ) ) {
		$manifest_path = CRB_THEME_DIR . 'dist/manifest.json';

		if ( file_exists( $manifest_path ) ) {
			$manifest = json_decode( file_get_contents( $manifest_path ), true );
		} else {
			$manifest = array();
		}
	}

	$path = isset( $manifest[ $path ] ) ? $manifest[ $path ] : $path;

	return '/dist/' . $path;
}

/**
 * Sometimes, when using Gutenberg blocks the content output
 * contains empty unnecessary paragraph tags.
 *
 * In WP v5.2 this will be fixed, however, until then this function
 * acts as a temporary solution.
 *
 * @see https://core.trac.wordpress.org/ticket/45495
 *
 * @param  string $content
 * @return string
 */
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'crb_fix_empty_paragraphs_in_blocks' );
function crb_fix_empty_paragraphs_in_blocks( $content ) {
	global $wp_version;

	if ( version_compare( $wp_version, '5.2', '<' ) && has_blocks() ) {
		return $content;
	}

	return $content;
}

function crb_socials_array() {
	$social_icons = array(
		'facebook',
		'instagram',
		'twitter',
		'youtube',
	);

	return $social_icons;
}

add_action( 'template_redirect', 'crb_test_api' );
function crb_test_api() {

	if ( !isset( $_GET['test_api'] ) ) {
		return;
	}

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/leagues",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"x-rapidapi-host: api-football-v1.p.rapidapi.com",
			"x-rapidapi-key: b2a481ae62msh42eee36242dab3ap13bd7cjsn1556871f49bb"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {

		echo '<pre>';
		$response = json_decode( $response );
		print_r($response);
		exit;
	}
}


function crb_get_league_slugs() {
	$leagues = get_terms([
		'taxonomy' => 'crb_league',
		'hide_empty' => false
	]);

	$leagues = wp_list_pluck(  $leagues, 'slug' );
	return $leagues;
}


add_action( 'init', 'crb_rewrite_rules' );
function crb_rewrite_rules() {
	$leagues = crb_get_league_slugs();
	foreach ( $leagues as $league ) {
		add_rewrite_rule(
			'^league/(' . $league .')/matches/?$',
			'index.php?taxonomy=crb_league&term=$matches[1]&page_type=matches',
			'top'
		);
		add_rewrite_rule(
			'^league/(' . $league .')/standings/(.*)?$',
			'index.php?taxonomy=crb_league&term=$matches[1]&page_type=standings&standings_type=$matches[2]',
			'top'
		);

		add_rewrite_rule(
			'^league/(' . $league .')/consecutive-matches-data/?$',
			'index.php?taxonomy=crb_league&term=$matches[1]&page_type=consecutive-matches-data',
			'top'
		);
	}

	// Profile Page
	$profile_page_id = carbon_get_theme_option( 'crb_profile_page_id' );
	if ( $profile_page_id )  {
		add_rewrite_rule( '^profile/?$', 'index.php?page_id=' . $profile_page_id ); 
	}

	add_rewrite_tag( '%page_type%','([^&]+)' );
	add_rewrite_tag( '%standings_type%','([^&]+)' );
}

