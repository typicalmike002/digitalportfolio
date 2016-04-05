<?php
/**
 * Digital Portfolio's main header content.
 *
 * Displays all of the <head>, <nav>, <header>, and 
 * the opening <main> tag of the theme.
 *
 * The navigation's view is controlled by the navigation.js 
 * module which allows it to stick to the top of the page 
 * when the user scrolls down.
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
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<?php wp_head(); ?>

<body <?php body_class(); ?>>

<!-- Homepage Hashtag -->
<a name="home" class="anchor_home"></a>

<!-- Navigation -->
<nav id="nav" class="grid_row grid_row--center" role="navigation">
		
	<!-- Logo Column -->
	<div class="grid_column--forth">
		
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
		title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
		rel="<?php echo esc_attr( 'home' ); ?>"
		/>
			<img src="<?php echo esc_url( bloginfo( 'template_url' ) . '/images/icon-logo_small--white.png' ); ?>"
			alt="<?php esc_attr( bloginfo( 'name' ) ); ?>"
			class="site-logo"
			/>
		</a>
	</div>

	<!-- Nav Links Column -->
	<div class="grid_column grid_column--center">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav_menu') ); ?>
	</div>

	</div>
</nav>

<!-- Site Header -->
<?php if ( is_front_page() ) : ?>
	
	<header id="header" class="hero_image" role="banner">

	</header>

<?php endif; ?>

<!-- main -->
<main id="main" role="main">