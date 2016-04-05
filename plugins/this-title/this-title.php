<?php
/**
 * @package This Title
 */
/*
Plugin Name: This Title
Plugin URI: https://github.com/typicalmike002/this-title
Description: Describes a standard WordPress title format to the 'wp_title' filter.  The title is also filtered so that plugins can still provide their 
alternative title formats.
Version: 1.0
Author: typicalmike002
Author URI: https://github.com/typicalmike002/
License: MIT
Text Domain: unposts
*/

include( 'classes/Title.php' );
$title = new Title( 10, 2 );