<?php 
/**
 * Creates the custom post type "gallery" with the specified options.
 *
 * @uses register_post_type() for creating the new post type.
 *
 * @since Digital Portfolio 0.1
 */

class Gallery {

	public function __construct () {

		//Hooks the post type into WordPress.
		add_action( 'init', array( $this, 'create_gallery_post_type' ) );

		//This post type requires a query_var to work right (See function below)
		add_filter( 'query_vars', array( $this, 'add_query_vars' ) );

		//Adds a rewrite rule to keep the url looking cleaner:
		add_action( 'init', array( $this, 'add_query_rewrites' ) );

	}

	function create_gallery_post_type() {

		//WordPress post type options for the new post type.
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

	//Sets up a query var that saves the current image index number being viewed:
	function add_query_vars( $vars ) {

		$vars[] = 'image';

		return $vars;
	}

	//Creates a rewrite rule that works with the query_var above:
	function add_query_rewrites() {

		add_rewrite_tag( '%image%', '([^/]*)');

		add_rewrite_rule('^gallery/([^/]*)/([^/]*)/?$', 'index.php?gallery=$matches[1]&image=$matches[2]', 'top');
	}
} ?>