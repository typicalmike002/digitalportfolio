<?php
/**
 * @package Unposts.php
 */
/*
Plugin Name: Unposts
Plugin URI: https://github.com/typicalmike002/unposts
Description: Disables Posting and Commenting capabilities.  Useful for when the blog feature WordPress offers is not necessary and a developer would like the Post and Comments option to disapear.  All Posts and Comments are still saved and you can easliy disable this plugin to get the features back.
Version: 1.0
Author: typicalmike002
Author URI: https://github.com/typicalmike002/
License: MIT
Text Domain: unposts
*/



/* Admin only section */
if ( is_admin() ) {



	/**
	 * Removes the entire posts and comments section from
	 * the WordPress admin.  This is only necessary if we 
	 * are loading the admin section of WordPress.
	 */
	function remove_from_menu() {
		remove_menu_page( 'edit.php' );
		remove_menu_page( 'edit-comments.php');
	}
	add_action( 'admin_menu', 'remove_from_menu' );




/* End Admin only section */  }




/**
 * Removes the add post and customize post from the 
 * admin bar's options.
 */
function remove_from_admin_bar() {

	global $wp_admin_bar;

	$wp_admin_bar->remove_node( 'new-post' );
	$wp_admin_bar->remove_menu( 'customize' );
}
add_action( 'wp_before_admin_bar_render', 'admin_bar_options' );

