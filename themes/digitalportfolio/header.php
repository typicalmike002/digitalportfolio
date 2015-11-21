<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section.
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.1
 */
?><!DOCTYPE html>

<html>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="x-UA-Compatible" content-"IE=edge,chrome=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<?php wp_head(); ?>

<body <?php body_class(); ?>>

<!-- header -->
<header class="header" role="banner">

	<!-- title -->
	<div class="title">
		<h1 class="title_logo">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="title_link" />
				<img src="<?php bloginfo( 'template_url' ); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" class="title_image" />
			</a>
		</h1>
	</div>

	<!-- navigation -->

	<nav class="nav" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav_menu') ); ?>
	</nav>
</header>