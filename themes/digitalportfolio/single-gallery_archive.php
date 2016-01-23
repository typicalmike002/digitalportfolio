<?php
/**
 * Template for displaying each image in a gallery using the thumbnail version of the image.  All values
 * are always inherited by single-gallery.php.
 */
?>
		
<a href="<?php echo esc_url( $image_url ); ?>" data-nonce="<?php echo wp_create_nonce('content_nonce'); ?>">
	<img src="<?php echo $image_src; ?>" data-nonce="<?php echo wp_create_nonce('content_nonce'); ?>">
</a>