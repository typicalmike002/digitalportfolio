<?php
/**
 * Provides a standard format for the page title depending on the view.
 * This is filtered so that plugins can provide alternative title formats.
 * Adds the site title after the | in the title.
 * 
 * @param string $title Default title text for current view.
 * @param string $seperator Optional seperator.
 * @return filter 'wp_title', 'create_wp_title' with the results.
 * 
 * @since Digital Portfolio 0.1
 */


class Title {

	private $title;
	private $seperator;

	public function __construct ( $Title, $Seperator ) {
		$this->title = $Title;
		$this->seperator = $Seperator;

		//Adds the filter() to wordpress.
		add_filter( 'wp_title', array($this, 'create_title'), $this->title, $this->seperator );
	}

	function create_title( $title, $seperator ) {
		
		global $paged, $page;
		
		if ( is_feed() ) {
			return $title;
		}

		//Add the site name.
		$title .= get_bloginfo( 'name' );

		//Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );

		//Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = sprintf( __( 'Page %s', 'digitalportfolio' ), max( $paged, $page) ) . ' $seperator $title';
		}

		return $title;
	}
}

?>