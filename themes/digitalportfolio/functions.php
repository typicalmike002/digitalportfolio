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
 * Injects Scripts and Styles into the head element.
 * 
 * @since Digital Portfolio 0.1
 */
function inject_scripts() {

	//Default way of loading styles.
	wp_enqueue_style( 'style', get_stylesheet_uri() );


	$js_dir = get_template_directory_uri() . '/js';

	//Loads requirejs, we set true to push everything into the footer.
	wp_enqueue_script( 'requrejs', $js_dir . '/require.js', '', true );


	//requirejs config file that depends on requirejs.
	wp_register_script( 'configjs', $js_dir . '/config.js', 'requirejs', true );


	//Creates a json object so the configjs knows its directory. 
	wp_localize_script( 'configjs', 'js_dir', array(
		'path'		=> $js_dir
	));


	wp_enqueue_script( 'configjs','', '', true );

}
add_action( 'wp_enqueue_scripts', 'inject_scripts' );




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




/**
 * Configures the WordPress Admin bar.
 *
 * @uses remove_node() to remove unneeded nodes from the admin bar.
 *
 * @since Digital Portfolio 0.1
 */
function admin_bar_options() {

	global $wp_admin_bar;

	//Removes  Add New post.
	$wp_admin_bar->remove_node( 'new-post' );

}
add_action( 'wp_before_admin_bar_render', 'admin_bar_options' );




/**
 * Adds Categories to other types of content.
 *
 * @uses register_taxonomy_for_object_type() for enabling catagories.
 *
 * @since Digital Portfolio 0.1
 */
function add_taxonomies() {

	//Adds categories for attachments.
	register_taxonomy_for_object_type( 'category', 'attachment' );

	//Adds categories for pages.
	register_taxonomy_for_object_type( 'category', 'page');

}
add_action( 'init', 'add_taxonomies' );





/**
 * Removes wp_emojicons from slowing our theme down.
 *
 * @since digital Portfolio 0.1
 */
function disable_emojicons() {

	//Remove emoji actions.
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_detection_script' );
	
	//Remove emoji filters.
	remove_filter( 'wp_mail', 'wp_staticize_emoji_style' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// Filter to remove TinyMCE emojis
	remove_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_emojicons');

?>