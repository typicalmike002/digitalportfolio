<?php 
/**
* Displays each image inside a gallery and provides a link to each single image.
* This template is a sub template of single-gallery.php and will inherit its 
* variables.
*
* @package Galleriafy
* @subpackage single-gallery_single.php
* @since 0.1
*/
?>

<div>
	<?php foreach ( $image_gallery as $key => $value ) : ?>

		<?php if ( $key != 'is_single' ) : // Don't ever execute for the 'is_single' index value. ?>

			<?php /* Sets Current Variables */

				$image_url = get_permalink();
				$image_url .= $key;

				$image_src = $value;

			?>

			<?php if ( @get_headers( $image_src ) != 'HTTP/1.1 404 Not Found' ) : /* Ensures the image src exists on the server. */ ?>

				<?php $size = getimagesize( $image_src )[3]; /* HTML Friendly width and height values. */ ?>

				<div>
					<a href="<?php echo esc_url( $image_url ); ?>">
						<img src="<?php echo esc_url( $image_src ); ?>" <?php echo $size; ?> >
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</div>