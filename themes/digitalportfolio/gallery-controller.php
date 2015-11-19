<?php
/**
 * Controls the view and controller of our gallery.  This code in here is used as a fallback to give
 * users without javascript something to see.  Normally, ajax and javascript should be used to 
 * load gallery images.
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.3
*/

//Start the gallery with a session with a single variable that controls 
//the image that should be displayed.
session_start();

//Retrieve all galleries of this gallery post type.
$gallery = get_post_gallery_images( $post );

//Store the highest image array index.
$gallery_length = count($gallery);
$gallery_length--;

if (empty($_SESSION['image_index']) ) {
	
	$_SESSION['image_index'] = 0;
}


if (isset($_POST['gallery_controller'])) {

	if ($_POST['gallery_controller'] == 'left' && $_SESSION['image_index'] > 0 ) {
	
		$_SESSION['image_index']--;
	
	}

	if ($_POST['gallery_controller'] == 'right' && $_SESSION['image_index'] < $gallery_length ) {

		$_SESSION['image_index']++;

	}
}

 ?>

<div class="gallery">
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
			<div class="gallery_control--left">
				<button name="gallery_controller" type="submit" value="left">Left</button>
			</div>
			<?php echo '<img src="' . $gallery[$_SESSION['image_index']] . '" class="gallery_image">'; ?>
			<div class="gallery_control--right">
				<button name="gallery_controller" type="submit" value="right">Right</button>
			</div>
	</form>
</div>
