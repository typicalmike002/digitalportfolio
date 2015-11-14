<?php
/**
 * The main template file.
 *
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.1
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

	
		<?php get_template_part( 'content' ); ?>

	<?php endwhile; ?>

<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>