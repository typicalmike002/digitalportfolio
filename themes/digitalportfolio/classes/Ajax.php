<?php
/**
 * Use get_content in the $.ajax([]); jQuery method to filter and return WordPress content.
 * Ajax.php creates a nonce called 'content_nonce' and requires that every link using Ajax
 * to have this nonce number inside a 'data-nonce' attribute type.
 * @param string $request: url sent by user, labeled 'nav' in functions.php
 * @param bool $is_priv: determines what wp_ajax privlidge to use.
 *
 * @return string $response: string containing html document after being filtered through security tests.
 * 
 */

class Ajax {

	public function __construct( $request, $is_priv ) {

		if ( $is_priv != true ) {
			
			add_action( 'wp_ajax_nopriv_get_content', array( $this, 'get_content' ), $request );

		} else {

			add_action( 'wp_ajax_get_content', array( $this, 'get_content' ), $request );

		}

		//Adds the data-nonce attribuite to all nav menu <a> tags in the primary nav menu.
		add_filter( 'nav_menu_link_attributes', array( $this, 'add_nonce_atts' ) );

	}

	function add_nonce_atts( $atts, $item, $args ){

		// Creates a custom nonce for ajax calls.
		$atts['data-nonce'] = wp_create_nonce('content_nonce');

		return $atts;
	}

	function get_content( $req ) {

		global $wpdb;

		$response = parse_str( $_REQUEST[$req] );

		// Varify request with nonce:
		if ( !wp_verify_nonce( $_REQUEST['nonce'], 'content_nonce' ) ) {
			exit('Your request is not valid.');
		}

		// Varify request is valid URL: 
		if ( !filter_var( $response, FILTER_VALIDATE_URL ) ) {
			exit('Not a valid URL');
		}

		// Varify user can access the requested url.
		if ( !current_user_can( $response ) ) {
			exit('The user is not allowed to perform this action');
		}

		echo $response;

		wp_die();
	}
}


?>