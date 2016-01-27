<?php
/**
 * - Sub Template name: single-gallery_single.php
 *
 * - Description: Used for displaying a single image in a gallery. 
 * 				  Also creates links to the next and previous images
 *				  from the selected gallery.  All values are inherited
 * 				  from single-gallery.php
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.1
 */

// Link and Image Variables:
$next = $previous = get_permalink();
$current = sanitize_text_field( $image_gallery['src'] );
$next .= sanitize_text_field( $image_gallery['next'] );
$previous .= sanitize_text_field( $image_gallery['previous'] );
?>

<div class="gallery_single">
	<a href="<?php echo esc_url( $previous ); ?>" data-nonce="<?php echo wp_create_nonce('content_nonce'); ?>">Previous</a>
	<img src="<?php echo esc_url( $current ); ?>">
	<a href="<?php echo esc_url( $next ); ?>" data-nonce="<?php echo wp_create_nonce('content_nonce'); ?>">Next</a>
</div>
