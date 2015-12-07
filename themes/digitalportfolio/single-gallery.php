<?php
/**
 * Template for the gallery custom post type.
 *
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.1
 */

function get_image( $req ) {

	$image_urls = get_post_gallery_images( $post ); //Array of image links [0]=>http://'uploads/2015/11/building.jpg'
	$max = max( array_keys( $image_urls ) ); //Max index value of gallery.
	$gallery = array();

	function get_file_name( $url ) { // Takes a url argument and returns the file name.

		$pathinfo = pathinfo( $url );
		return $pathinfo['filename'];
	}

	foreach ( $image_urls as $key => $image_url ) { // Sets up variables to be assigned to each image in the gallery.

		$name = get_file_name( $image_url ); //Uses the image filename to key the gallery array.

		//Each image must have its image_url stored.
		//This array also determins the images to be used 
		//in the previous/next links below.
		$gallery[$name] = array( 
			'url'		=>	$image_url,
			'next'		=>	!( $key >= $max ) ?
							get_file_name( $image_urls[( $key+1 )] ) :
							get_file_name( $image_urls[0] ),
			'previous'	=>	!( $key <= 0 ) ?
							get_file_name( $image_urls[( $key-1 )] ) :
							get_file_name( $image_urls[$max] )
		);

	}

	if ( array_key_exists( $req, $gallery ) ) { // Presents the user with the requested image if one is found in the gallery array.

		return $gallery[$req];

	} else { 
		reset( $gallery );
		$firstKey = key( $gallery );
		wp_redirect( get_permalink() . '/' . $firstKey ); // redirect user to the first item in the gallery.
		exit;
	}
}

global $wp_query;
$query_image = $wp_query->query_vars['image'];
$image_url = get_image( $query_image );

get_header();	?>

<a href="<?php echo esc_url( get_permalink() . $image_url['next'] ); ?>">Previous</a>
<img src="<?php echo esc_url( $image_url['url'] ); ?>">
<a href="<?php echo esc_url( get_permalink() . $image_url['previous'] ); ?>">Next</a><br />

<?php get_footer(); ?>