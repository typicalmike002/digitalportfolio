<?php
/**
 * Registers Ajax routes for the nagivagtion links of the website.
 *
 * 
 */

class Ajax {

	public function __construct( $request, $is_priv ) {

		if ( $is_priv != true ) {
			
			add_action( 'wp_ajax_nopriv_get_content', array( $this, 'get_content' ), $request );

		} else {

			add_action( 'wp_ajax_get_content', array( $this, 'get_content' ), $request );

		}
	}

	function get_content( $req ) {

		global $wpdb; //WordPress Database

		$request = parse_str( $_POST[$req] );

		echo $request;

		wp_die();
	}
}


?>