<?php
/**
 * Template for the gallery custom post type.
 *
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.3
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'gallery-controller' ); ?>

		<?php endwhile; ?>

	<?php else : ?>

		<?php echo 'No content to display'; ?>

	<?php endif; ?>

<?php get_footer(); ?>