<?php 
/**
 * Digital Portfolio functions and definitions.
 *
 * Configures the theme's core functionality using the WordPress api.  Loads
 * custom post types, custom css/js, and configures various options that 
 * control the admin section of the site using filter() and action().
 *
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.1
*/




/**
 * Sets up theme defaults and registers various WordPress features.
 *
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses add_theme_support() To add support for post formats and post thumbnails.
 *
 * 
 * @since Digital Portfolio 0.1
 *
 * @return void
 */
function digital_portfolio_setup() {


	//Output valid HTML5 for the template tags listed below.
	add_theme_support( 'html5', array(
		'gallery', 'caption'
	) );

	//Adds support for a custom navigation menu.
	register_nav_menu( 'primary', 'Navigation Menu' );

	//This theme supports the use of thumbnails.
	add_theme_support( 'post-thumbnails' );

}
add_action( 'after_setup_theme', 'digital_portfolio_setup' );





/**
 * Class: Title
 * Description: classes/Title.php
 * 
 * @since Digital Portfolio 0.1
 */

include( 'classes/Title.php' );
$title = new Title( 10, 2 );




/**
 * Class: Gallery
 * Description: classes/Gallery.php
 * 
 * @since Digital Portfolio 0.1
 */

include( 'classes/Gallery.php' );
$gallery = new Gallery();




/**
 * Class: Ajax
 * Description: classes/Gallery.php
 * 
 * @since Digital Portfolio 0.1
 */

include( 'classes/Ajax.php' );
$nav_ajax = new Ajax( 'nav', false );



/**
 * Class: Templates
 * Description: classes/Templates.php
 * 
 * @since Digital Portfolio 0.1
 */

include( 'classes/Templates.php' );
$template_controls = new Templates();





/**
 * Injects Scripts into the footer and styles into the header to
 * optomize rendering.  
 *
 * @uses wp_enqueue_style() for injecting style files into the <head>
 * @uses wp_enqueu_script() to place javascript files ontop of <body>
 * @uses wp_register_script() to register config.js with a dependency.
 * @uses wp_localize_script() for passing the directory path to config.js
 * 
 * @since Digital Portfolio 0.1
 */
function inject_scripts() {

	global $wp_styles, $wp_scripts;

	//Default way of loading styles.  Version number added to ensure
	//the correct version is sent to the client regardless of caching.
	wp_register_style( 'style', get_stylesheet_uri(), false, '1.0.0' );
	wp_enqueue_style( 'style' );

	// Adds an ie8 and below stylesheet:	
	wp_enqueue_style( 'ie8_style', get_stylesheet_directory_uri() . '/css/ie8.css', array( 'style' ) );
	wp_style_add_data( 'ie8_style', 'conditional', 'lte IE 8' );


	$js_dir = get_template_directory_uri() . '/js';
	$js_libs = $js_dir . '/libraries';

	//Loads requirejs, all scripts are set true to push them into the footer:
	wp_enqueue_script( 'requrejs', $js_libs . '/require.js', '', '', true );


	//config file that depends on requirejs.
	wp_register_script( 'optimize', $js_dir . '/optimize.min.js', 'requirejs', '', true );


	//Creates a json object so the configjs knows its directory. 
	wp_localize_script( 'optimize', 'dir', array(
		'path'		=> $js_dir,
		'ajax_url'	=> admin_url( 'admin-ajax.php' )
	));


	wp_enqueue_script( 'optimize', '', '', '', true );


}
add_action( 'wp_enqueue_scripts', 'inject_scripts' );




/**
 * Configures the WordPress Admin bar.  Removes 'new-post' from the 
 * +new dropdown in the WordPress admin bar as well as customize.
 * 
 *
 * @uses remove_node() to remove unneeded nodes from the admin bar.
 *
 * @since Digital Portfolio 0.1
 */
function admin_bar_options() {

	global $wp_admin_bar;

	//Removes  "Add New post".
	$wp_admin_bar->remove_node( 'new-post' );


	//Removes "Customize"
	$wp_admin_bar->remove_menu('customize');

}
add_action( 'wp_before_admin_bar_render', 'admin_bar_options' );






if ( is_admin() ) { //Functions that are only needed for the backend.


	/**
	 * Loads custom styles into the wp-admin.
	 *
	 * @uses admin_enqueue_scripts() to properly load the icon.
	 * 
	 * @since Digital Portfolio 0.1
	 */
	function admin_stylesheet() {

		wp_register_style( 'admin-styles', get_template_directory_uri() . '/css/admin-styles.css', false, '1.0.0' );

		wp_enqueue_style( 'admin-styles' );

	}
	add_action( 'admin_enqueue_scripts', 'admin_stylesheet' );
	



	/**
	 * Configures the WordPress dashboard by adding/removing specific menu pages.
	 *
	 * @uses add_menu_page() For adding new menu pages to the dashboard.
	 * @uses remove_menu_page() For removing default WordPress dashboard menus.
	 *
	 * @since Digital Portfolio 0.1
	 */
	function dashboard_menu() {

		//Removes the post type and comments from the WordPress dashboard.
		remove_menu_page( 'edit.php' );
		remove_menu_page( 'edit-comments.php' );

	}
	add_action( 'admin_menu', 'dashboard_menu' );


/* End admin only section */ } ?>