<?php 
/**
* Displays the archive of all galleries and links to them using 
* the featured image as a thumbnail.  Also displays each gallery
* title.
*
* @package Galleriafy
* @subpackage archive-gallery.php
* @since 0.1
*/
get_header(); ?>

	<?php if ( have_posts() ) : 
		
		$args = array('post_type' => 'gallery' ); 
		$galleries = get_posts( $args );
		
		foreach ( $galleries as $gallery ) :

			$gallery_link = get_post_permalink( $gallery->ID );
			$thumbnail_url = wp_get_attachment_thumb_url( get_post_thumbnail_id( $gallery->ID, 'medium' ) ); ?>

			<!-- Thumbnail Object -->
			<a href="<?php echo $gallery_link ?>">
				<img  src="<?php echo $thumbnail_url ?>">
				<h3><?php echo get_the_title( $gallery->ID ); ?></h3>
			</a>
			
		<?php endforeach; ?>

	<?php else : ?>

		<?php echo 'No galleries found'; ?>

	<?php endif; ?>

<?php get_footer(); ?>