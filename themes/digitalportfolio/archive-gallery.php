<?php
/*
* - Template Name: archive-gallery.php
* 
* - Description: Displays the archive for the post type galleries.  Each 
* 			 	 gallery featured image is used and will link to the 
* 				 single-gallery_archive.php for each gallery.
* 				 Think of it like an archive of galleries.
*/
get_header(); ?>

	<?php if ( have_posts() ) : 
		
		$args = array('post_type' => 'gallery' ); 
		$galleries = get_posts( $args );
		
		//Loops through all galleries to create a simple archive page:
		foreach ( $galleries as $gallery ) :

			$gallery_link = get_post_permalink( $gallery->ID );
			$thumbnail_url = wp_get_attachment_thumb_url( get_post_thumbnail_id( $gallery->ID, 'medium' ) ); ?>

			<!-- Thumbnail Object -->
			<a class="gallery_link" href="<?php echo $gallery_link ?>">
				<img class="gallery_thumbnail" src="<?php echo $thumbnail_url ?>">
				<h3 class="gallery_title"><?php echo get_the_title( $gallery->ID ); ?></h3>
			</a>
			
		<?php endforeach; ?>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>