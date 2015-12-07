<?php
/*
Template Name: Contact Form
*/

$contact_info	=	get_post_meta( $post->ID, 'contact_info', true );
$address 		=	get_post_meta( $post->ID, 'address', true );
$social_media 	=	get_post_meta( $post->ID, 'social_media_urls', true );

get_header(); ?>

<section class="section contact_page">
	<header class="page_header">
		<h1 class="page_title">
			Contact Information
		</h1>
	</header>
	<div class="page_content">
		<div class="page_section">
			<dl><!-- Display the Contact Info -->
				<?php foreach ( $contact_info as $key => $value ) : ?>
					<?php if ( $value ) : ?>
						<dt><strong><?php echo esc_attr( ucfirst( $key ) . ': ' ); ?></strong></dt>
						<dd><?php echo esc_attr( $value ); ?></dd>
					<?php endif; ?>
				<?php endforeach; ?>
			</dl>
		</div>
		<div class="page_section">
			<dl><!-- Display the Address -->
				<?php if ( isset( $address['street_address'] ) ) : ?> 
					<dt><strong>Address: </strong></dt>
				<?php endif; ?>
				<dd>
					<?php foreach ( $address as $key => $value ) : ?>
						<?php if ( $value ) : ?>
							<?php echo esc_attr( $value ); ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</dd>
			</dl>
		</div>
		<div class="page_section">
			<dl><!-- Display Social Media Links -->
			<?php foreach ( $social_media as $key => $value ) : ?>
				<?php if ( $value ) : ?>
					<dt><a href="<?php echo esc_url( $value ); ?>"><?php echo $key; ?></dt></a>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>