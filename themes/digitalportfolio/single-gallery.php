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
 * Function that takes the url of an attachment and returns it's id number.
 * This is used by the archive section for getting an image thumbnail src.
 * @param  string $url [Requested path to the attachment]
 * @return int      [The attachment's ID number]
 */
function get_attachment_id_by_url( $url ) {
	$post_id = attachment_url_to_postid( $url );

	if ( ! $post_id ) {
		$dir = wp_upload_dir();
		$path = $url;
		
		if ( 0 === strpos( $path, $dir['baseurl'] . '/' ) ) {
			$path = substr( $path, strlen( $dir['baseurl'] . '/' ) );
		}
		
		if ( preg_match( '/^(.*)(\-\d*x\d*)(\.\w{1,})/i', $path, $matches ) ) { 
			$url = $dir['baseurl'] . '/' . $matrches[1] . $matches[3];
			$post_id = attachment_url_to_postid( $url );
		}
	}

	return (int) $post_id;
}




/**
 * Retrives the requested gallery image url, and responds with an array of 
 * meta data to be used in the HTML.
 * 
 * @param  'string' $req [The name of an image in the gallery array.]
 * @return 'array'		 [$gallery_single: returns an accociative array of arrays
 *                       that contains a file name for the keys which are linked to
 *                       another array containing 4 values: the src, sets is_single
 *                       to true (see below), and the next and previous image names as they appear 
 *                       in order.
 *                       $gallery_archive: returns a single accociative array containing
 *                       the image name and its url.  This will also set is_single to
 *                       false (see below).
 * @return 'bool' 'is_single' [If the $req variable is empty, this will return false.  This value
 *                            should be used for determining which template to display.]
 * @return 'redirect'	 [Should anything other then one of the file names in the
 *                        gallery be passed through $req, redirect the gallery back
 *                        to the first image.]
 */
function get_gallery_data( $req ) {

	$gallery = get_post_gallery( get_the_ID(), false );
	$gallery_single = array();
	$gallery_archive = array();
	$max = max( array_keys( $gallery['src'] ) );

	foreach ( $gallery['src'] as $key => $src ) { 

		$name = get_file_name( $src );
		
		$gallery_single[$name] = array( 
			'src'		=>	$src,
			'is_single'	=>	true,	
			'next'		=>	!( $key >= $max ) ?
							get_file_name( $gallery['src'][( $key+1 )] ) :
							get_file_name( $gallery['src'][0] ),
			'previous'	=>	!( $key <= 0 ) ?
							get_file_name( $gallery['src'][( $key-1 )] ) :
							get_file_name( $gallery['src'][$max] ) 
		);


		$gallery_archive[$name] = $src;
	}

	$gallery_archive['is_single'] = false;

	if ( array_key_exists( $req, $gallery_single ) ) { 

		return $gallery_single[$req];

	} else if ( empty( $req ) ) {

		return $gallery_archive;
		
	} else {

		wp_redirect( get_home_url() . '/' . get_post_type() ); 
		exit();

	}
}




//Set of global values to be sanitized and passed to the HTML:

global $wp_query;

$query_image = $wp_query->query_vars['image'];
$query_image = sanitize_text_field( $query_image );
$image_gallery = get_gallery_data( $query_image );

get_header(); ?>

<?php if ( $image_gallery['is_single'] ) : /* Template for single image displays */
	
	$current = sanitize_text_field( $image_gallery['src'] );
	$next = sanitize_text_field( $image_gallery['next'] );
	$previous = sanitize_text_field( $image_gallery['previous'] ); ?>

	<a href="<?php echo '../' . $previous; ?>">Previous</a>
	<img src="<?php echo $current; ?>">
	<a href="<?php echo '../' . $next; ?>">Next</a>

<?php else : /* Template for whole gallery thumbnails */

	foreach ( $image_gallery as $key => $value ) : 

		$image_id = get_attachment_id_by_url( $value );
		$image_url = sanitize_text_field( $key );
		$image_thumbnail = wp_get_attachment_image_src( $image_id, 'thumbnail' );
		$image_src = esc_url( $image_thumbnail[0] );

		?>
		
		<a href="<?php echo $image_url; ?>">
			<img src="<?php echo $image_src; ?>">
		</a>

	<?php endforeach; ?>

<?php endif; ?>

<?php get_footer(); ?>