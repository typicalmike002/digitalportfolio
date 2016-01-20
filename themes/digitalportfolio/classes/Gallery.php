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

	}

	function create_gallery_post_type() {

		//WordPress post type options for the new post type.
		register_post_type( 'gallery', array(
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
} ?>