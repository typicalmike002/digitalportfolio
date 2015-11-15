<?php 
/*
Template Name: Portfolio
 */
	
	//Get the first page category and turn it into it's link form.
	$category = get_the_category();
	$category_link = get_category_link( $category[0]->cat_ID );
	
	
	if ( $category_link ) {

		//Redirects to the first category associated with the portfolio page.
		wp_redirect( $category_link );

	} else {

		//When no category is selected, redirect home.
		wp_redirect( home_url() );

	}
?>