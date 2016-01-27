<?php
/**
 * - Template name: single-gallery.php
 *
 * - This template uses a query_var set up inside classes/Gallery.php.
 *   It is named 'image' and 
 *
 * - This template is a parent template and uses the get_gallery_data(); function
 * 	 to determine whether to load either one of the two child templates or a 
 *   default template that are detailed below.  Remember to document changes!
 *
 * - - - - Sub Template:	single-gallery_single.php
 * - - - - Description:		Loads when the /gallery-name/image url is valid and
 *				will display the image that matches in the gallery.
 *
 * - - - - Sub Template:	single-gallery_archive.php
 * - - - - Description:		Loads all images found in the requested /gallery-name/
 *				if the url is valid.  The archive only displays when
 *				there are 0 chars after /gallery-name/ in the url.
 *
 * - - - - Sub Template:	archive-gallery.php
 * - - - - Description:		Loads by default if an invalid image name is passed 
 *				or the url contains /galleries/
 *
 * - - - - Sub Template:	404.php
 * - - - - Description:		Not really a sub template but a 404 error will return
 *				for any url containing an invalid gallery name.
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.1
 */




/**
 * Function: get_file_name( $path );
 * 
 * Function that takes a path and returns only the file name
 * after the last slash "\" and before the dot "."  This function
 * is useful for extracting a file name from a full url.
 * 
 * @param  'string'		$path 	Path to a file 
 * @return 'string'       		File name without the full url path.
 */
function get_file_name( $path ) {
	$pathinfo = pathinfo( $path );
	return $pathinfo['filename'];
}




/**
 * Function: get_gallery_data( $req );
 *
 * A function that handles the request made for an image inside
 * a valid gallery name (see main notes for details).  The data
 * it returns are used in the gallery template files.
 *
 * - Note: This functions returns either 2 different Arrays that
 * 			passes necessary data to one of the sub templates. 
 *
 * @param 	'string' 	$req 							url requested by the user.
 * @return 	'string' 	$gallery_single[$req]					Returns the requested image src.
 * @return 	'Array' 	$gallery_archive 					An assosiative array matching image 
 * 											names to their urls.
 * @return 	'Bool' 		['is_single']						Check to see if the request was for a 
 *											single image or an archive of the 
 *											currently loaded gallery.
 */
function get_gallery_data( $req ) {

	// gallery grabs all images associated with the currently 
	// loaded gallery and finds the $max index value as an int:
	$gallery = get_post_gallery( get_the_ID(), false );
	$max = max( array_keys( $gallery['src'] ) );

	$gallery_single = array();
	$gallery_archive = array();

	// loop through full gallery and pushes data about each
	// image to both of the arrays above:
	foreach ( $gallery['src'] as $key => $src ) { 

		// because $req only contains the image name, 
		// the get_file_name function is used here for
		// removing the full url of the image.
		$name = get_file_name( $src );

		// $gallery_single: Double Associative array that maps
		// all gallery image file names to an Array containing their full src,
		// the filenames of the next and previous images in the gallery,
		// and will return true when 'is_single' is checked.
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

		// $gallery_archive: Associative array that also
		// matches all gallery images names to their src.
		$gallery_archive[$name] = $src;
	}

	// 'is_single' now returns false:
	$gallery_archive['is_single'] = false;

	if ( array_key_exists( $req, $gallery_single ) ) { 

		// The request matches one of the filenames inside the $gallery_single 
		// array so return that Associative Array:
		return $gallery_single[$req];

	} else if ( empty( $req ) ) {

		// The filename field was empty, so load an Array containing all 
		// the gallery names and their src to display:
		return $gallery_archive;
		
	} else {

		// The request contained an invalid filename and was not found inside
		// the gallery so this will redirect to the archive-gallery.php 
		wp_redirect( get_home_url() . '/' . get_post_type() ); 
		exit();

	}
}




/**
* Global Variables:
* Uses the query_vars['image'] rewrite rule found in classes/Gallery.php to
* pass as the $req argument for the get_gallery_data( $req ); function.   
*/

global $wp_query;

$query_image = sanitize_text_field( $wp_query->query_vars['image'] );
$image_gallery = get_gallery_data( $query_image );

get_header(); ?>

<div class="gallery">

	<?php if ( $image_gallery['is_single'] ) :/* Display sub template single-gallery_single.php */?> 

		<?php include( locate_template('single-gallery_single.php') ); ?>

	<?php else : /* Display sub template single-gallery_archive.php */ ?>
			
		<?php include( locate_template( 'single-gallery_archive.php' ) ); ?>

	<?php endif; ?>

</div>

<?php get_footer(); ?>
