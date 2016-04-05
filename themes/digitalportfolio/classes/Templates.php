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

		$template_filename = get_post_meta( $post_id, '_wp_page_template', true );

		//Loads meta form and post meta data for the default template.
		define('LOAD_CONTACT_FORM', json_encode( array(
			'default'
		) ) );

		if ( in_array( $template_filename, json_decode( LOAD_CONTACT_FORM ) ) ) {

			function meta_boxes() {

				add_meta_box( 'contact_us_id', 'Contact Info', 'load_contact_us_form', 'page', 'normal', 'high' );

			}

			function load_contact_us_form() {

				global $post;

				//Validate form comes from this function.
				wp_nonce_field( basename( __FILE__ ), 'nonce' );

				//Grabs the data saved in the post_meta.
				$values = get_post_meta( $post->ID, 'contact_urls', true );

				$email_value = isset( $values['email'] ) ? $values['email'] : '';
				$fk_value = isset( $values['flickr'] ) ? $values['flickr'] : '';

				$fb_value = isset( $values['facebook'] ) ? $values['facebook'] : '';
				$ig_value = isset( $values['instagram'] ) ? $values['instagram'] : '';
				?>

				<!-- HTML Form -->
				<div class="row">
					<div class="col_hlf">
						<label for="email"><p>Email Address</p></label>
						<input type="email"
							name="email"
							value="<?php echo esc_attr( $email_value ); ?>"
							placeholder="example@gmail.com"
							title="Email Format: example@gmail.com">
					</div>
					<div class="col_hlf">
						<label for="flickr"><p>Flickr URL</p></label>
						<input type="flickr"
							name="flickr"
							value="<?php echo esc_attr( $fk_value ); ?>"
							pattern='https?://.+'
							placeholder="https://example.com"
							title="URL Format: http://example.com">
					</div>
				</div>

				<div class="row">
					<div class="col_hlf">
						<label for="facebook"><p>Facebook URL</p></label>
						<input type="url"
							name="facebook"
							value="<?php echo esc_attr( $fb_value ); ?>"
							pattern="https?://.+"
							placeholder="http://example.com"
							title="URL Format: http://example.com">
					</div>
					<div class="col_hlf">
						<label for="instagram"><p>Instagram URL</p></label>
						<input type="url"
							name="instagram"
							value="<?php echo esc_attr( $ig_value ); ?>"
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
				update_post_meta( $post_id, 'contact_urls', array(
					'email'		=> 	sanitize_text_field ( $_POST['email'] ),
					'flickr' 	=>	sanitize_text_field( $_POST['flickr'] ),
					'facebook'	=>	sanitize_text_field ( $_POST['facebook'] ),
					'instagram' =>	sanitize_text_field ( $_POST['instagram'] )
				) );
			}

			add_action( 'add_meta_boxes', 'meta_boxes');
			add_action( 'save_post', 'save_forms' );
		}
	}
}