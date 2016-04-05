<?php 
/**
* Template used for displaying either a single image from a single gallery, or
* the entire archive of a single gallery.  This file chooses which one will
* be loaded based upon the URL contents which is explained below.
*
* @package galleriafy
* @subpackage single-gallery.php
* @since 0.1
*/

global $wp_query;
include dirname( __FILE__ ) . '/../classes/Gallery.php';
$gallery = new Gallery();

// Sanitizes the URL request and checks if it's set before building a new Gallery class.
$image_query = isset( $wp_query->query_vars['image'] ) ? sanitize_text_field( $wp_query->query_vars['image'] ) : '';
$image_gallery = $gallery->{'get_gallery_data'}( $image_query );

get_header(); ?>

	<?php if ( $image_gallery['is_single'] ) :/* Display sub template single-gallery_single.php */?> 

		<?php include( 'single-gallery_single.php'); ?>

	<?php else : /* Display sub template single-gallery_archive.php */ ?>
			
		<?php include( 'single-gallery_archive.php' ); ?>

	<?php endif; ?>
	
<?php get_footer(); ?>
