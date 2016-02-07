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
	<meta charset="<?php esc_attr( bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="x-UA-Compatible" content-"IE=edge,chrome=1">
	<!--[if lt IE 7 ]> 	<html class="ie6 ie7 ie8 ie9"> <!endif]-->
	<!--[if IE 7 ]> 	<html class="ie7 ie8 ie9"> <!endif]-->
	<!--[if IE 8 ]> 	<html class="ie8 ie9"> <!endif]-->
	<!--[if IE 9 ]> 	<html class="ie9"> <!endif]-->
	<!--[if (gt IE 9)|!(IE)]><!--> <html class=""> <!--<![endif]-->
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<?php wp_head(); ?>

<body <?php body_class(); ?>>

<!-- header -->
<header id="header" role="banner">

	<!-- logo -->
	<div class="logo">

		<?php if ( is_front_page() ) : ?>
			<h1 class="header_title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
				data-nonce="<?php echo wp_create_nonce('content_nonce'); ?>"
				rel="<?php echo esc_attr( 'home' ); ?>"
				id="site-logo"
				/>
					<img src="<?php echo esc_url( bloginfo( 'template_url' ).'/images/logo.png'); ?>"
					alt="<?php esc_attr( bloginfo( 'name' ) ); ?>"
					/>
				</a>
			</h1>

		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
			title="<?php echo get_bloginfo( 'name', 'display' ); ?>"
			data-nonce="<?php echo wp_create_nonce('content_nonce'); ?>"
			rel="<?php echo esc_attr( 'home' ); ?>"
			id="site-logo"
			/>
				<img src="<?php echo esc_url( bloginfo( 'template_url' ).'/images/logo.png'); ?>"
				alt="<?php esc_attr( bloginfo( 'name' ) ); ?>"
				/>
			</a>

		<?php endif; ?>
	</div>

	<!-- navigation -->
	<nav id="nav" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav_menu') ); ?>
	</nav>
</header>

<!-- main -->
<main id="main" role="main">