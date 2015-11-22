<?php
/*
Template Name: Archives
*/
get_header(); ?>

	<?php if ( have_posts() ) : 

		//This will reset the gallery's index number so when the user loads another 
		//gallery, the first image in the list is shown.
		$_SESSION['image_index'] = 0; 


		//Loops through all galleries to create a simple archive page.
		$args = array('post_type' => 'gallery' ); 
		$galleries = get_posts( $args );

		foreach ( $galleries as $gallery ) :

			$gallery_link = get_post_permalink( $gallery->ID );
			$thumbnail_url = wp_get_attachment_thumb_url( get_post_thumbnail_id($gallery->ID, 'medium' ) ); ?>


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