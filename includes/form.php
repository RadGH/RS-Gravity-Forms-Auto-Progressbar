<?php

function aagf_ap_include_assets_with_form_html( $html, $form ) {
	if ( empty( rgar($form, 'pagination') ) ) return $html;
	if ( rgar($form['pagination'], 'type') != 'percentage' ) return $html;
	
	// Only run once
	remove_action( "gform_get_form_filter", 'aagf_ap_include_assets_with_form_html', 20 );
	
	// Include JS in the html
	$src = AAGF_AP_URL . '/assets/aagf-auto-progressbar.js';
	$modified = filemtime( AAGF_AP_PATH . '/assets/aagf-auto-progressbar.js' );
	
	$src = add_query_arg( array('v', substr($modified, -5)), $src );
	
	$html .= "\n" . '<script type="text/javascript" src="'. esc_attr( $src ) . '"></script>';
	
	return $html;
}
add_action( "gform_get_form_filter", 'aagf_ap_include_assets_with_form_html', 30, 2 );