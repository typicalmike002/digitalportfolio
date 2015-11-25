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


	//OUtput valid HTML5 for the template tags listed below.
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
 * Begins a php session for storing special session variables to be used by 
 * the single-gallery.php file.  This function will also end sessions when logging in and 
 * out of the WordPress backend.
 *
 * @uses session_start()
 *
 * @since Digital Portfolio 0.1
 */
function begin_session() {

	if( !session_id() ) {
	
		session_start();
	
	}
}

function kill_session() {

	session_destroy();

}
add_action('init', 'begin_session', 1);
add_action('wp_logout', 'kill_session');
add_action('wp_login', 'kill_session');





/**
 * Provides a standard format for the page title depending on the view.
 * This is filtered so that plugins can provide alternative title formats.
 * Adds the site title after the | in the title.
 * 
 * @param string $title Default title text for current view.
 * @param string $sep Optional seperator.
 * @return string The filtered title.  
 * 
 * @since Digital Portfolio 0.1
 */
function create_wp_title( $title, $sep ) {
	
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	//Add the site name.
	$title .= get_bloginfo( 'name' );

	//Add the site description for the home/from page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	//Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = sprintf( __( 'Page %s', 'digitalportfolio' ), max( $paged, $page) ) . " $sep $title";
	}

	return $title;
}
add_filter( 'wp_title', 'create_wp_title', 10, 2 );





/**
 * Creates the custom post type "gallery" with the specified options.
 *
 * @uses register_post_type() for creating the new post type.
 *
 * @since Digital Portfolio 0.1
 */
function create_gallery_post_type() {


	//Options for the new post type.
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
add_action( 'init', 'create_gallery_post_type' );





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

	global $wp_styles;

	//Default way of loading styles.  Version number added to ensure
	//the correct version is sent to the client regardless of caching.
	wp_register_style( 'style', get_stylesheet_uri(), false, '1.0.0' );
	wp_enqueue_style( 'style' );

	/**
	 * Loads our ie8 only stylesheet then, adds a lte IE 8 contitional.
	 */
	
	wp_enqueue_style( 'ie8', get_stylesheet_directory_uri() . '/css/ie8.css', array( 'style' ) );
	$wp_styles->add_data( 'ie8', 'conditional', 'lte IE 8' );


	$js_dir = get_template_directory_uri() . '/js';

	//Loads requirejs, we set true to push everything into the footer.
	wp_enqueue_script( 'requrejs', $js_dir . '/require.js', '', '', true );


	//requirejs config file that depends on requirejs.
	wp_register_script( 'configjs', $js_dir . '/config.js', 'requirejs', '', true );


	//Creates a json object so the configjs knows its directory. 
	wp_localize_script( 'configjs', 'js_dir', array(
		'path'		=> $js_dir
	));


	wp_enqueue_script( 'configjs', '', '', '', true );

	

}
add_action( 'wp_enqueue_scripts', 'inject_scripts' );




/**
 * Adds Categories to both pages and posts.  Now both have
 * their own section for catagories.
 *
 * @uses register_taxonomy_for_object_type() for enabling catagories.
 *
 * @since Digital Portfolio 0.1
 */
function add_taxonomies() {

	//Adds categories for attachments.
	register_taxonomy_for_object_type( 'category', 'attachment' );
	apply_filters( 'wpmediacategory_taxonomy' , 'category' );

	//Adds categories for the gallery post type.
	register_taxonomy_for_object_type( 'category', 'gallery' );

}
add_action( 'init', 'add_taxonomies' );





/**
 * Removes wp_emojicons from loading in the <head>.
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
	 * Loads different form fields for different page templates into the admin section of the site.
	 * What template a page is using will now effect how authors add information to that page.
	 * For example, the contact-form.php page doesn't need the whole page editor and instead should
	 * load a simpler form to be filled out by the site owner.
	 *
	 * This section needs to be cleaned up and some security mesures should be added/tested.
	 *
	 * @uses get_post_meta() for getting the page's currently loaded template name.
	 * @since Digital Portfolio 0.1
	 */
	function customize_content_input() {

		global $pagenow;

		if ( ! ( 'post.php' === $pagenow ) ) { return; /* Escape for all other sections of the admin. */ }


		//GET or POST the post_ID number and ensure that its an int. 
		$post_id = filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT )
					? filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT )
					: filter_input( INPUT_POST, 'post_ID', FILTER_SANITIZE_NUMBER_INT );


		if ( !isset($post_id) ) { return; /* The Filter returned false so escape. */ } 

		
		//Current post_id's loaded template.
		$template_filename = esc_url( get_post_meta( $post_id, '_wp_page_template', true ) );


		/**
		 * Use a define name and compares the list of template files in the array to the currently 
		 * loaded template set in the $template_filename variable above.  This define name is used 
		 * to separate what should be done to these list of templates in the admin sections.
		 */


		//Hides the page editor to the following templates.
		define('HIDE_PAGE_EDITOR', json_encode( array( 
			'http://page_templates/contact-form.php',
			'archive-gallery.php'
		) ) );
		if ( in_array( $template_filename, json_decode( HIDE_PAGE_EDITOR ) ) ) {
			remove_post_type_support( 'page', 'editor' );
		}


		//Loads options for the contact us form.
		define('LOAD_CONTACT_FORM', json_encode( array(
			'http://page_templates/contact-form.php'
		) ) );
		if ( in_array( $template_filename, json_decode( LOAD_CONTACT_FORM ) ) ) {

			

			function social_media_input() {

   				add_meta_box( 'social_media_id', 'Social Media', 'load_social_media_form', 'page', 'normal', 'high' );

			}

			function load_social_media_form() {

				global $post; 

				wp_nonce_field( basename( __FILE__ ), 'nonce' );  //Validate form comes from this function.

				$values = get_post_meta( $post->ID, 'social_media_urls', true ); //Grabs the data saved in the post_meta.
				?>

				<!-- HTML Form -->
				<p>
					<label for="facebook">Facebook</label>
					<input type="text" name="facebook" id="facebook" style="width: 100%;" value="<?php echo $values['facebook']; ?>">
					<label for="instagram">Instagram</label>
					<input type="test" name="instagram" id="instagram" style="width: 100%;" value="<?php echo $values['instagram']; ?>">
				</p>

			<?php }

			function save_social_media_form ( $post_id ) {

				//Validates data:
				$is_autosave = wp_is_post_autosave( $post_id );
				$is_revision = wp_is_post_revision( $post_id );
				$is_valid_nonce = (isset ( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], basename(__FILE__) ) ) ? 'true' : 'false';
				$is_valid_user = current_user_can( 'edit_post', $post_id );

				//Exits the function if the data is not safe:
				if ( $is_autosave || $is_revision || !$is_valid_nonce || !$is_valid_user ) { return; }

				update_post_meta( $post_id, 'social_media_urls', array(
					'facebook' => $_POST['facebook'],
					'instagram' => $_POST['instagram']
				) );


			}

			add_action( 'add_meta_boxes', 'social_media_input' );
			add_action( 'save_post', 'save_social_media_form');

		}
	}

	add_action( 'admin_init', 'customize_content_input' );





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
	 * Adds a dropdown menu for the media library page.  See the
	 * add_taxonomies() function to see where this happens.
	 *
	 * @uses wp_dropdown_categories() to add a new dropdown option.
	 * 
	 * @since  Digital Portfolio 0.1
	 */
	function add_media_category_filter() {
		
		//Admin current page.
		global $pagenow; 
		
		//Only add the dropdown to the media library (upload.php) and the Gallery post type (edit.php?post_type=gallery)
		if ( 'upload.php' == $pagenow ) {

			$dropdown_options = array(
				'taxonomy'			=>	'category',
				'show_option_all'	=>	__( 'All categories' ),
				'hide_empty'		=>	false
			);

			wp_dropdown_categories( $dropdown_options );

		}
	}
	add_action( 'restrict_manage_posts', 'add_media_category_filter' );
	



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