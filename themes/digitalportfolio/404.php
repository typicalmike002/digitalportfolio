<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Digital Portfolio
 * @version 0.1 
 */

get_header(); ?>

	

	<section class="error">
		<header class="page_header">
			<h1 class="page_title">
				Error
			</h1>
		</header>

		<div class="page_content">
			<h2 class="page_subtitle">
				404 - File not found
			</h2>
			<p class="page_paragraph error_paragraph--1">
				The page you're looking for cannot be found.  You may
				have typed the address incorrectly or you may have used
				an outdated link.
			</p>
			<p class="page_paragraph error_paragraph--2">
				Please press back and try again.  You might also want
				to go to the
				<a href="<?php echo esc_attr( home_url( '/' ) ); ?>"
					title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
					rel="<?php echo esc_attr( 'home' ); ?>"
				/>home page</a> and try again.
			</p>
		</div>
	</section>

<?php get_footer(); ?>