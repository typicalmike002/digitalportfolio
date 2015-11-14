<?php 
/**
 * Digital Portfolio functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are sued in the 
 * theme as custom template tags.  Others are attached to actions and filter
 * hooks in wordpress to change core functionality.
 *
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.1
*/




/**
 * Sets up theme defaults and registers various WordPress features.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses add_theme_support() To add support for a gallery and captions.
 *
 * @since Digital Portfolio 0.1
 * 
 */
function digital_portfolio_setup() {


	//Switches default core markup for the gallery and captions.
	add_theme_support( 'html5', array(
		'gallery', 'caption'
	) );


	//Adds support for a custom navigation menu.
	register_nav_menu( 'primary', 'Navigation Menu' );

}
add_action( 'after_setup_theme', 'digital_portfolio_setup' );




/**
 * Configures the WordPress dashboard by adding/removing specific menu pages.
 *
 * @uses add_menu_page() For adding new menu pages to the dashboard.
 * @uses remove_menu_page() For removing default WordPress dashboard menus.
 *
 * @since Digital Portfolio 0.1
 */
function dashboard_menu() {

	//Adds the portfolio menu type
	add_menu_page( 'My Portfolio', 'Portfolio', 'manage_options', 'portfolio_menu', 'portfolio_options', 'dashicons-images-alt', 50 );


	function portfolio_options() { 
		
	}


	//Removes the post type and comments from the WordPress dashboard.
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );

}
add_action( 'admin_menu', 'dashboard_menu' );