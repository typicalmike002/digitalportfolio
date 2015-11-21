<?php
/**
 * Controls the view and controller of our gallery.  This code in here is used as a fallback to give
 * users without javascript something to see.  Normally, ajax and javascript should be used to 
 * load gallery images.
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.31
*/

//This gallery uses a php session that saves the index number of the image being
//currently viewed.  This php code acts as a fallback for people without javascript.
session_start();

//Session variable to remember what image our user is viewing.  Defaults to 0.
if (empty($_SESSION['image_index']) ) {
	
	 $_SESSION['image_index'] = 0;
}


$index = $_SESSION['image_index'];


//Retrieve all images from the gallery.
$gallery = get_post_gallery_images( $post );


//Highest index number in gallery array.
$gallery_length = count( $gallery );
$gallery_length--;


//When form class gallery submits, change the image_index up or down. 
if ( isset( $_POST['control_action'] ) ) {

	if ( $_POST['control_action'] === 'left' ) {
	
		$_SESSION['image_index'] = $index > 0 ? $index -= 1 : $gallery_length;
		
	}

	if ( $_POST['control_action'] === 'right' ) {

		$_SESSION['image_index'] = $index < $gallery_length ? $index += 1 : 0;

	}

} ?>

<form class="gallery" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<img class="gallery_image" src="<?php echo $gallery[$_SESSION['image_index']]; ?>" ><br/>
	<button class="gallery_button" name="control_action" type="submit" value="left" >Left</button>
	<button class="gallery_button" name="control_action" type="submit" value="right" >Right</button>
</form>

