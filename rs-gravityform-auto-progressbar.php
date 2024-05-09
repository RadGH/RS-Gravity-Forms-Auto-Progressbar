<?php
/*
Plugin Name: RS Gravity Forms Auto Progressbar
Description: Changes the Gravity Forms progress bar to update automatically as you answer questions, instead of being based on page number.
Version: 1.0.1
Author: Radley Sustaire
Author URI: https://radleysustaire.com
GitHub Plugin URI: https://github.com/RadGH/RS-Gravity-Forms-Auto-Progressbar
*/

if ( !defined( 'ABSPATH' ) ) exit;

define( 'RSGF_AP_URL', untrailingslashit(plugin_dir_url( __FILE__ )) );
define( 'RSGF_AP_PATH', dirname(__FILE__) );
define( 'RSGF_AP_VERSION', '1.0.1' );


// Initialize plugin: Load plugin files
function rsgf_ap_init_plugin() {
	
	// Include JS with the form html
	include_once( RSGF_AP_PATH . '/includes/form.php' );
	
}
add_action( 'gform_loaded', 'rsgf_ap_init_plugin', 19 );