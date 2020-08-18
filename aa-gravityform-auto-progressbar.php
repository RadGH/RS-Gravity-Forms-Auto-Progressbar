<?php
/*
Plugin Name: A+A Gravity Forms - Auto Progressbar
Description: Changes the Gravity Forms progress bar to update automatically as you answer questions, instead of being based on page number.
Version: 1.0.0
*/

if ( !defined( 'ABSPATH' ) ) exit;

define( 'AAGF_AP_URL', untrailingslashit(plugin_dir_url( __FILE__ )) );
define( 'AAGF_AP_PATH', dirname(__FILE__) );
define( 'AAGF_AP_VERSION', '1.0.0' );


// Initialize plugin: Load plugin files
function aagf_ap_init_plugin() {
	
	// Include JS with the form html
	include_once( AAGF_AP_PATH . '/includes/form.php' );
	
}
add_action( 'gform_loaded', 'aagf_ap_init_plugin', 19 );