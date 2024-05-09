<?php

function rsgf_ap_include_assets_with_form_html( $html, $form ) {
	if ( empty( rgar($form, 'pagination') ) ) return $html;
	if ( rgar($form['pagination'], 'type') != 'percentage' ) return $html;
	
	// Only run once
	remove_action( "gform_get_form_filter", 'rsgf_ap_include_assets_with_form_html', 20 );
	
	// Include JS in the html
	$src = RSGF_AP_URL . '/assets/rsgf-auto-progressbar.js';
	$modified = filemtime( RSGF_AP_PATH . '/assets/rsgf-auto-progressbar.js' );
	
	$src = add_query_arg( array('v', substr($modified, -5)), $src );
	
	$html .= "\n" . '<script type="text/javascript" src="'. esc_attr( $src ) . '"></script>';
	
	return $html;
}
add_action( "gform_get_form_filter", 'rsgf_ap_include_assets_with_form_html', 30, 2 );