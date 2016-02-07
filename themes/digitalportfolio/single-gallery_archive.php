<?php
/**
 * - Sub Template Name: single-gallery_archive.php
 *
 * - Description: Displays each image in a gallery as a link to
 * 				  the single version.  All values for this template
 * 				  are inherited from single-gallery.php 
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.1
 */
?>

<div class="gallery_archive">

	<?php foreach ( $image_gallery as $key => $value ) : ?>

		<?php if ( $key != 'is_single' ) : /* Avoids loading an empty image. */
					
			// Returns the attachment id of the image:
			$image_id = attachment_url_to_postid( $value );
			
			// link to single-gallery_single version of the image
			$image_url = get_permalink();
			$image_url .= sanitize_text_field( $key );

			// src passed to the template:
			$image_src = $value;


			/* Displays a single image from gallery: */?>
			<div class="gallery_thumbnail">	
				<a href="<?php echo esc_url( $image_url ); ?>" data-nonce="<?php echo wp_create_nonce('content_nonce'); ?>">
					<img src="<?php echo esc_url( $image_src )  ; ?>" data-nonce="<?php echo wp_create_nonce('content_nonce'); ?>">
				</a>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>

</div>