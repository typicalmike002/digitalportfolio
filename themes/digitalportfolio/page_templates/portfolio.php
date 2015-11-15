<?php 
/*
Template Name: Portfolio
 */

	
	$category = get_the_category();
	$category_link = get_category_link( $category[0]->cat_ID );

	wp_redirect( $category_link );

	

?>