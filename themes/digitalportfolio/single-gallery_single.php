<?php
/**
 * Template for displaying a single image in a gallery.  Also creates links to
 * the next and previous images from the selected gallery.  All values are 
 * inherited from single-gallery.php
 */
?>

<a href="<?php echo esc_url( $previous ); ?>" data-nonce="<?php echo wp_create_nonce('content_nonce'); ?>">Previous</a>
<img src="<?php echo esc_url( $current ); ?>">
<a href="<?php echo esc_url( $next ); ?>" data-nonce="<?php echo wp_create_nonce('content_nonce'); ?>">Next</a>
