<?php 
/**
 * This file controls the forms on the backend of a wordpress site that uses its own custom
 * templates.  Different page templates require different forms to be displayed.   
 *
 * This section needs to be cleaned up and some security mesures should be added/tested.
 *
 * @uses get_post_meta() for getting the page's currently loaded template name.
 * @since Digital Portfolio 0.1
 */

class Templates {

	public function __construct () {

		if ( is_admin() ) { //This class should only load in the admin section.

			add_action( 'admin_init', array( $this, 'admin_custom_input' ) );
		}
	}

	function admin_custom_input() {

		global $pagenow;

		if ( ! ( 'post.php' === $pagenow ) ) { return; /* Escape for all other sections of the admin. */ }


		//GET or POST the post_ID number and ensure that its an int. 
		$post_id = filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT )
					? filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT )
					: filter_input( INPUT_POST, 'post_ID', FILTER_SANITIZE_NUMBER_INT );
		if ( !isset($post_id) ) { return; /* The Filter returned false so escape. */ } 

		/**
		 * Use a define name and compares the list of template files in the array to the currently 
		 * loaded template set in the $template_filename variable above.  This define name is used 
		 * to separate what should be done to these list of templates in the admin sections.
		 */

		$template_filename = esc_url( get_post_meta( $post_id, '_wp_page_template', true ) );

		//Hides the page editor to the following templates.
		define('HIDE_PAGE_EDITOR', json_encode( array( 
			'http://page_templates/contact-form.php',
			'archive-gallery.php'
		) ) );
		if ( in_array( $template_filename, json_decode( HIDE_PAGE_EDITOR ) ) ) {
			
			remove_post_type_support( 'page', 'editor' );

		}

		//Loads meta form and post meta data for the contact us template.
		define('LOAD_CONTACT_FORM', json_encode( array(
			'http://page_templates/contact-form.php'
		) ) );


		if ( in_array( $template_filename, json_decode( LOAD_CONTACT_FORM ) ) ) {

			function meta_boxes() {

				add_meta_box( 'social_media_id', 'Social Media', 'load_social_media_form', 'page', 'normal', 'high' );

			}

			function load_social_media_form() {

				global $post;

				//Validate form comes from this function.
				wp_nonce_field( basename( __FILE__ ), 'nonce' );

				//Grabs the data saved in the post_meta.
				$values = get_post_meta( $post->ID, 'social_media_urls', true );
				?>

				<!-- HTML Form -->
				<div class="row">
					<div class="col_hlf">
						<label for="facebook"><p>Facebook URL</p></label>
						<input type="url"
							name="facebook"
							value="<?php echo $values['facebook']; ?>"
							pattern="https?://.+"
							placeholder="http://example.com"
							title="URL Format: http://example.com">
					</div>
					<div class="col_hlf">
						<label for="instagram"><p>Instagram URL</p></label>
						<input type="url"
							name="instagram"
							value="<?php echo $values['instagram']; ?>"
							pattern="https?://.+"
							placeholder="http://example.com"
							title="URL Format: http://example.com">
					</div>
				</div>
			<?php }

			function save_forms ( $post_id ) {

				//Validates data:
				$is_autosave = wp_is_post_autosave( $post_id );
				$is_revision = wp_is_post_revision( $post_id );
				$is_valid_nonce = (isset ( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], basename(__FILE__) ) ) ? 'true' : 'false';
				$is_valid_user = current_user_can( 'edit_post', $post_id );
				
				if ( $is_autosave || $is_revision || !$is_valid_nonce || !$is_valid_user ) { return;/*Exits the function if the data is not safe: */}

				//Saves admin's data to database:
				update_post_meta( $post_id, 'social_media_urls', array(
					'facebook'	=>	sanitize_text_field ( $_POST['facebook'] ),
					'instagram' =>	sanitize_text_field ( $_POST['instagram'] )
				) );
			}

			add_action( 'add_meta_boxes', 'meta_boxes');
			add_action( 'save_post', 'save_forms' );
		}
	}
}