<?php
/**
 * @package Galleriafy
 * @version 0.1
 */
/*
Plugin Name: Galleriafy
Plugin URI: https://github.com/typicalmike002/galleriafy
Description: Adds the galleries post type to a WordPress theme. Includes a template for displaying a gallery's full archive, and a single image from the gallery using the file name as the URL.
Version: 0.1
Author: typicalmike002
Author URI: https://github.com/typicalmike002/
License: MIT
Text Domain: galleriafy
*/




/**
* Registers a new post type to WordPress named 'gallery' and sets up the various 
* options.
*
* @uses resiger_post_type
* @since 0.1
*/
function create_gallery_post_type() {

	register_post_type( 'gallery', array(
		'show_in_nav_menues' => true,
		'public' 		=> true,
		'has_archive' 	=> true,
		'menu_icon'		=> '',
		'description'	=> 'Create galleries to store those precious moments!',
		'supports' 		=>	array( 'title', 'editor', 'thumbnail' ),
		'labels' 		=>	array(
			'name'					=>	__( 'Galleries' ),
			'singular_name'			=>	__( 'Gallery' ),
			'add_new'				=>	_x( 'Create New', 'Gallery' ),
			'add_new_item'			=>	__( 'Add New Gallery' ),
			'edit_item'				=>	__(	'Edit Gallery' ),
			'new_item'				=>	__( 'New Gallery' ),
			'view_item'				=>	__( 'View Gallery' ),
			'search_items'			=>	__( 'Search Galleries' ),
			'not_found'				=>	__( 'No galleries found' ),
			'not_found_in_trash'	=>	__( 'No galleries found in Trash' ),
			'parent_item_colon'		=>	__( 'Parent Gallery' )
			)
		)
	);
}
add_action( 'init', 'create_gallery_post_type' );




/**
* Allows the theme to get the gallery post type's custom single template. 
*
* @param $single_template
* @since 0.1
*/
function get_gallery_single_template( $single_template ) {

	global $post;

	if ( $post->post_type == 'gallery' ) {
		$single_template = dirname( __FILE__ ) . '/templates/single-gallery.php';
	}
	return $single_template;
}
add_filter( 'single_template', 'get_gallery_single_template' );




/**
* Allows the theme to get the gallery post type's custom archive template. 
*
* @param $archive_template
* @since 0.1
*/
function get_gallery_archive_template( $archive_template ) {

	global $post;

	if ( is_post_type_archive( 'gallery' ) ) {
		$archive_template = dirname( __FILE__ ) . '/templates/archive-gallery.php';
	}
	return $archive_template;
}
add_filter( 'archive_template', 'get_gallery_archive_template' );





/**
* Adds the 'image' query var which is used by the gallery to determine the index of the 
* current image being viewed.
*
* @since 0.1
*/
function add_query_var_image( $vars ) {

	$vars[] = 'image';

	return $vars;
}
add_filter( 'query_vars', 'add_query_var_image' );




/**
* Adds a rewrite tag to the 'image' query var and rewrites the URL 
* to produce a user friendly link for each of the images.
*
* @uses add_rewrite_tag 
* @uses add_rewrite_rule
* @since 0.1
*/
function add_rewrite_rules() {

	add_rewrite_tag( '%image%', '([^/]*)');

	add_rewrite_rule('^gallery/([^/]*)/([^/]*)/?$', 'index.php?gallery=$matches[1]&image=$matches[2]', 'top');
}
add_action( 'init', 'add_rewrite_rules' );




/* Actions and Filters for the admin section only.  */
if ( is_admin() ) {


	/**
	* Adds an icon to the wp-admin panal for the new galleries post type.
	*
	* @uses wp_enqueue_style
	* @since 0.1
	*/
	function add_galleries_icon() {

		$plugin_css = plugin_dir_url( __FILE__ ) . '/css/admin-style.css';

		wp_register_style( 'admin-style', $plugin_css );

		wp_enqueue_style( 'admin-style' );
	}
	add_action( 'admin_enqueue_scripts', 'add_galleries_icon' );


}
?>