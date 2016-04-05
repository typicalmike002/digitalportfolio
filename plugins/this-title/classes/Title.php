<?php 
class Title {

	private $title;
	private $seperator;

	public function __construct ( $Title, $Seperator ) {
		$this->title = $Title;
		$this->seperator = $Seperator;

		add_filter( 'wp_title', array($this, 'create_title'), $this->title, $this->seperator );
	}

	function create_title( $title, $seperator ) {
		
		global $paged, $page;

		
		if ( is_feed() ) {
			return $title;
		}

		$title .= get_bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );

		$theme = wp_get_theme();

		if ( $paged >= 2 || $page >= 2 ) {
			$title = sprintf( __( 'Page %s', $theme ), max( $paged, $page) ) . ' $seperator $title';
		}

		return $title;
	}
} ?>