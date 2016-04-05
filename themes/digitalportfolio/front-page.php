<?php
/**
 * Digital Portfolio's home page view.  Since it is a SPA and the only page is
 * the home page, this contains everything inside <main>.  There are 2 sections,
 * a portfolio which displays the entire image library loaded from WordPress in a
 * masonry layout.  
 *
 * This view depends on the gallery.js module for both the masonry and lazyloading 
 * libraries and the settings to each of these.
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.2
 */

$args = array(
	'post_type' 		=> 'attachment',
	'post_mime_type' 	=> 'image',
	'post_status' 		=> 'inherit',
	'posts_per_page'	=> - 1
);

$query_images = new WP_Query( $args );

$images = array();

foreach ( $query_images->posts as $image ) {

	$images[] = wp_get_attachment_url( $image->ID );

}

$contact_info = get_post_meta( $post->ID, 'contact_urls' )[0];

$email = $contact_info['email'];
$flickr = $contact_info['flickr'];
$facebook = $contact_info['facebook'];
$instagram = $contact_info['instagram'];

get_header(); ?>

<a name="portfolio"></a>

<!-- Displays a masonry of all images inside WordPress. -->
<section class="portfolio">

	<div id="js-disabled">
		<noscript><p>Please enable javascript to view images inside the gallery</p></noscript>
	</div>

	<div class="masonry-container">
		<?php foreach ( $query_images->posts as $image ) : ?>

			<?php $src = wp_get_attachment_url( $image->ID ); ?>
			<?php $title = get_the_title( $image->ID ); ?>
			<?php $size = getimagesize( $src )[3]; ?>

			<a href="<?php echo esc_url( $src ); ?>" data-lightbox="<?php echo esc_attr( $title ); ?>">
				<img class="lazy masonry-item" data-original="<?php echo esc_url( $src ); ?>"
				src="<?php echo esc_url( bloginfo( 'template_url' ) . '/images/loading.gif' ); ?>">
			</a>

		<?php endforeach; ?>
	</div>
</section>

<a name="contact_info"></a>

<!-- Displays the contact info data -->
<section class="contact_info grid_row grid_row--center">
		
	<div class="grid_column">

		<!-- Email -->
		<p><label><i class="fa fa-envelope"></i></label>
		<?php echo esc_html( $email ); ?></p>
		
		<!-- Flickr -->
		<p><label><i class="fa fa-flickr"></i></label>
		<a href="<?php echo esc_html( $flickr ); ?>">Flickr</a></p>

		<!-- Facebook -->
		<p><label><i class="fa fa-facebook-official"></i>
		<a href="<?php echo esc_html( $facebook ); ?>">Facebook</a></p>

		<!-- Instagram -->
		<p><label><i class="fa fa-instagram"></i>
		<a href="<?php echo esc_html( $instagram ); ?>">Instagram</a></p>

	</div>

</section>

<?php get_footer(); ?>