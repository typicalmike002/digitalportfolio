<?php 
/*
Template Name: Portfolio
*/

//This template was created to display all gallery thumbnails on the portfolio landing page.
//The portfolio landing page acts as an archive for all galleries in the site.
	
get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>


			<?php get_template_part( 'content' ); ?>

			
			<?php 
			//To send the user to the first image when they click on a gallery thumbnail.
			$_SESSION['image_index'] = 0; 


			$args = array('post_type' => 'gallery' ); 
			$galleries = get_posts( $args );

			foreach ( $galleries as $gallery ) :

				$gallery_link = get_post_permalink( $gallery->ID );
				$thumbnail_url = wp_get_attachment_thumb_url( get_post_thumbnail_id($gallery->ID, 'medium' ) );

				?>
				<a class="gallery_link" href="<?php echo $gallery_link ?>">
					<img class="gallery_thumbnail" src="<?php echo $thumbnail_url ?>">
				</a>

				<?php

			endforeach;

			?>


		<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>