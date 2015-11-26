<?php
/*
Template Name: Contact Form
*/
get_header(); 

$contact_info = get_post_meta( $post->ID, 'contact_info', true );

$social_media = get_post_meta( $post->ID, 'social_media_urls', true );

// foreach ($values as $key => $value ) {
// 	echo $key .': '. $value . '<br />';
// }
// 
?>

	<section class="contact">
		<header class="page_header">
			<h1 class="page_title">
				Contact Information
			</h1>
		</header>

		<div class="page_content">
			<dl><!-- Display the Contact Info -->
				<?php foreach ( $contact_info as $key => $value ) : ?>
					<dt><?php echo esc_attr( $key ); ?></dt>
					<dd><?php echo esc_attr( $value ); ?></dd>
				<?php endforeach; ?>
			</dl>

			<dl><!-- Display Social Media Links -->
				<?php foreach ( $social_media as $key => $value ) : ?>
					<a href="<?php echo esc_url( $value ); ?>"><?php echo $key; ?></a><br/>
				<?php endforeach; ?>
			</dl>
		</div>
				







<?php get_footer(); ?>