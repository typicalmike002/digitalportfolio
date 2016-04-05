<?php 
/**
* Class Gallery
* 
* Constructs the data that is used by the gallery templates into 
* various associative arrays.  Redirects invalid requests to the
* gallery archive page.
*
* @package galleriafy
* @subpackage Gallery.php
* @since 0.1
*/

class Gallery {

	private $length;
	private $gallery;
	private $gallery_single;
	private $gallery_archive;

	public function __construct () {

		$this->gallery = get_post_gallery( get_the_ID(), false );

		$this->length = max( array_keys( $this->gallery['src'] ) );

		$this->gallery_single = $this->gallery_archive = array();

	}




	/**
	* Handles a request for a gallery by retriving its data and organizing it
	* into an object that is used by other templates.  There are 3 different
	* return cases this function is capable of producing.
	*
	* @param 'string' $req
	* @return 'string' $gallery_single[$req]
	* @return 'array' $gallery_archive
	* @return 'bool' get_gallery_data( $req )['is_single']
	*/
	public function get_gallery_data( $req ) {

		foreach ( $this->gallery['src'] as $key => $src ) {

			$name = $this->get_file_name( $src );

			$this->gallery_single[$name] = array(
				'src' 		=> $src,
				'is_single' => true,
				'next' 		=> !( $key >= $this->length ) ? 
								$this->get_file_name( $this->gallery['src'][( $key+1 )] ) :
								$this->get_file_name( $this->gallery['src'][0] ),
				'previous' 	=> !( $key <= 0 ) ?
								$this->get_file_name( $this->gallery['src'][( $key-1 )] ) :
								$this->get_file_name( $this->gallery['src'][$this->length] )
			);
			
			$this->gallery_archive[$name] = $src;
		}

		$this->gallery_archive['is_single'] = false;

		if ( array_key_exists( $req, $this->gallery_single ) ) {

			return $this->gallery_single[$req];
		
		} elseif ( empty( $req ) ) {

			return $this->gallery_archive;

		} else {

			wp_redirect( get_home_url() . '/' . get_post_type() );
			exit();
		}
	}



	/**
	* Takes a full URL path an an argument, and returns just the name of the file.
	*
	* @param 'string' $path
	* @return 'string' $pathinfo
	*/
	private function get_file_name( $path ) {
		$pathinfo = pathinfo( $path );
		return $pathinfo['filename'];
	}
}

?>