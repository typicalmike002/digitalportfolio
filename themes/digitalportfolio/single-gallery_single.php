<?php
/**
 * Template for displaying a single image in a gallery.  Also creates links to
 * the next and previous images from the selected gallery.  All values are 
 * inherited from single-gallery.php
 */
?>

<a href="<?php echo '../' . $previous; ?>">Previous</a>
<img src="<?php echo $current; ?>">
<a href="<?php echo '../' . $next; ?>">Next</a>
