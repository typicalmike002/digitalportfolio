<?php 
/**
* Displays a single image if it exists inside one of the galleries.
* This template is a sub template of the single-gallery template and
* will inherit it's values.
*
* @package Galleriafy
* @subpackage single-gallery_single.php
* @since 0.1
*/

// Link and Image Variables: 
$next = $previous = get_permalink();
$current = $image_gallery['src'];
$next .= $image_gallery['next'];
$previous .= $image_gallery['previous'];

?>

<div>
	<a href="<?php echo esc_url( $previous ); ?>">Previous</a>
	<img src="<?php echo esc_url( $current ); ?>">
	<a href="<?php echo esc_url( $next ); ?>">Next</a>
</div>
