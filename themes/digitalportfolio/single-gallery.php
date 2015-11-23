<?php
/**
 * Template for the gallery custom post type.
 *
 *
 * @package  WordPress
 * @subpackage  Digital Portfolio
 * @version 0.1
 */

get_header(); 

//Retrieve all image url's from the gallery.
$gallery = get_post_gallery_images( $post );


//Comutes the highest index number in the gallery array.
$gallery_length = count( $gallery );
$gallery_length--;


//Session variable to remember what image our user is viewing.  Defaults to 0.
if (empty($_SESSION['current_image']) ) {
	 $_SESSION['current_image'] = 0;
}


//Validates that the current_image is an intiger.
$_SESSION['current_image'] = filter_var( $_SESSION['current_image'], FILTER_VALIDATE_INT );


//when users come from another gallery, the $current_image variable might be 
//higher then the current gallery's max array length.  This fixes that.
if ( $_SESSION['current_image'] > $gallery_length ) {
	$_SESSION['current_image'] = 0;
}



//control_action becomes set when the user presses one of the gallery controls.
//this section will choose what image to load next.
if ( isset( $_POST['control_action'] ) ) {

	//Validates that control_action is a boolean.
	$action = filter_var( $_POST['control_action'], FILTER_VALIDATE_BOOLEAN );

	if ( $action === false ) {
		$_SESSION['current_image'] = $_SESSION['current_image'] > 0 ? $_SESSION['current_image'] -= 1 : $gallery_length;
		
	}

	if ( $action === true ) {

		$_SESSION['current_image'] = $_SESSION['current_image'] < $gallery_length ? $_SESSION['current_image'] += 1 : 0;

	}
	

} ?>


<?php if (array_key_exists( '0', $gallery ) ) { ?>
	<form class="gallery" method="POST">
		<img class="gallery_display" src="<?php echo esc_url( $gallery[$_SESSION['current_image']] ); ?>" ><br/>
		<button class="gallery_control" name="control_action" type="submit" value="false" >Left</button>
		<button class="gallery_control" name="control_action" type="submit" value="true" >Right</button>
	</form>
<?php } else { die("Warning: No images in this gallery were found."); } ?> 

<?php get_footer(); ?>