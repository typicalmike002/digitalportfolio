<?php
/**
 * Template for the gallery custom post type.
 *
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.3
 */

get_header(); 

//Retrieve all image url's from the gallery.
$gallery = get_post_gallery_images( $post );


//Comutes the highest index number in the gallery array.
$gallery_length = count( $gallery );
$gallery_length--;


//Session variable to remember what image our user is viewing.  Defaults to 0.
//This will also reset to 0 if the image is larger then the gallery length 
//(this happens sometimes when the user is comeing from another gallery).
if (empty($_SESSION['image_index']) || $_SESSION['image_index'] > $gallery_length ) {
	
	 $_SESSION['image_index'] = 0;
}


//control_action becomes set when the user presses one of the gallery controls.
//this section will choose what image to load next.
if ( isset( $_POST['control_action'] ) ) {

	if ( $_POST['control_action'] === 'left' ) {
	
		$_SESSION['image_index'] = $_SESSION['image_index'] > 0 ? $_SESSION['image_index'] -= 1 : $gallery_length;
		
	}

	if ( $_POST['control_action'] === 'right' ) {

		$_SESSION['image_index'] = $_SESSION['image_index'] < $gallery_length ? $_SESSION['image_index'] += 1 : 0;

	}
	

} ?>


<?php if (array_key_exists( '0', $gallery ) ) { ?>
	<form class="gallery" method="POST">
		<img class="gallery_display" src="<?php echo $gallery[$_SESSION['image_index']] ?>" ><br/>
		<button class="gallery_control" name="control_action" type="submit" value="left" >Left</button>
		<button class="gallery_control" name="control_action" type="submit" value="right" >Right</button>
	</form>
<?php } else { die("Warning: No images in this gallery were found."); } ?> 

<?php get_footer(); ?>