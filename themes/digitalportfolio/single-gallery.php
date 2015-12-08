<?php
/**
 * Template for the gallery custom post type.
 *
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.1
 */



/**
 * Function that takes a path and returns only the file name
 * after the last slash "\" and before the dot "."
 * 
 * @param  'string' $path [Path to a file, normally an image.]
 * @return 'string'       [File name without the file extention.]
 */
function get_file_name( $path ) {
	$pathinfo = pathinfo( $path );
	return $pathinfo['filename'];
}




/**
 * Retrives the requested gallery image url, and responds with an array of 
 * meta data to be used in the HTML.
 * 
 * @param  'string' $req [The name of an image in the gallery array.]
 * @return 'array'		 [Array of meta data containing the requested image's url.
 *                        This also attached the next and previous file names as
 *                        they appear in order.]
 * @return 'redirect'	 [Should anything other then one of the file names in the
 *                        gallery be passed through $req, redirect the gallery back
 *                        to the first image.]
 */
function get_gallery_data( $req ) {

	$gallery_data = array(); // Data to be returned.
	$gallery_urls = get_post_gallery_images( $post ); //Array of image links [0]=>http://'uploads/2015/11/building.jpg'
	$max = max( array_keys( $gallery_urls ) );

	foreach ( $gallery_urls as $key => $gallery_url ) { // Sets up variables to be assigned to each image in the gallery.

		$name = get_file_name( $gallery_url ); //Uses the image filename to key the gallery array.
		
		$gallery_data[$name] = array( 
			'url'		=>	$gallery_url,
			'next'		=>	!( $key >= $max ) ?
							get_file_name( $gallery_urls[( $key+1 )] ) :
							get_file_name( $gallery_urls[0] ),
			'previous'	=>	!( $key <= 0 ) ?
							get_file_name( $gallery_urls[( $key-1 )] ) :
							get_file_name( $gallery_urls[$max] ) 
		);
	}

	if ( array_key_exists( $req, $gallery_data ) ) { // Presents the user with the requested image if one is found in the gallery array.

		return $gallery_data[$req];

	} else { 
		$firstKey = key( $gallery_data );
		wp_redirect( get_permalink() . '/' . $firstKey ); // redirect user to the first item in the gallery.
		exit;
	}
}



global $wp_query;

$query_image = $wp_query->query_vars['image'];
$query_image = sanitize_text_field( $query_image );
$image_url = get_gallery_data( $query_image );




get_header(); ?>

<a href="<?php echo esc_url( get_permalink() . $image_url['next'] ); ?>">Previous</a>
<img src="<?php echo esc_url( $image_url['url'] ); ?>">
<a href="<?php echo esc_url( get_permalink() . $image_url['previous'] ); ?>">Next</a><br />

<?php get_footer(); ?>