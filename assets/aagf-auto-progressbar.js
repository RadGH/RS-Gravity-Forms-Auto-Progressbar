jQuery(function() {

	jQuery('.gform_wrapper').each(function() {
		let $wrapper = jQuery(this);
		let $form = $wrapper.find('form');
		let $bar = $form.find('.gf_progressbar');

		if ( $bar.length > 0 ) dtl_init_auto_progress_bar( $form, $bar );
	});

});

/**
 * Makes the progress bar update automatically as fields are filled in. Also stops it from reading 25% complete when you first land on the page.
 *
 * @param $form
 * @param $bar
 */
function dtl_init_auto_progress_bar( $form, $bar ) {
	let debugmode = false;
	let current_progress = -1;
	let $all_fields = $form.find('.gform_body .gfield');

	// Update the progress bar to a percentage.
	// amount = 0.4 will become 40%.
	let set_progress = function( amount ) {
		amount *= 100;

		let percentage = Math.floor(amount) + "%";

		$bar.find('.gf_progressbar_percentage').css('width', percentage );
		$bar.find('span').html( percentage );

		if ( debugmode ) console.log('set_progress: ', percentage);
	};

	// Calculate how many fields are remaining.
	let calculate_progress = function() {
		let filled = 0;
		let total = 0;

		$all_fields.each(function() {
			let $val_inputs = jQuery(this).find('input[type="text"], input[type="email"], textarea, select');
			let $check_inputs = jQuery(this).find('input[type="checkbox"], input[type="radio"]');

			// Ignore text boxes for radio/checkbox fields
			$val_inputs = $val_inputs.filter(function() { return jQuery(this).closest('.gfield_radio, .gfield_checkbox').length === 0; });

			if ( $val_inputs.length > 0 || $check_inputs.length > 0 ) {
				// A field can have multiple inputs, like 5 radio buttons. It's still only one field.
				total += 1;

				// if ANY of those inputs has a value, it should be considered filled.
				if ( $val_inputs.filter(function() { return jQuery(this).val() !== ""; }).length > 0 ) {
					filled += 1; // has value
					if ( debugmode ) console.log('Filled Field:', this);
				} else if ( $check_inputs.filter(function() { return jQuery(this).prop('checked'); }).length > 0 ) {
					filled += 1; // is checked
					if ( debugmode ) console.log('Checked Field:', this);
				}else{
					if ( debugmode ) console.log('Empty field: ', this );
				}
			}
		});

		// Get progress from number of filled fields versus total fields
		let progress = filled / total;

		// Update progress bar if amount changed
		if ( current_progress !== progress ) {
			set_progress( progress );

			if ( progress >= 0.5 ) {
				$bar.addClass('over-half').removeClass('under-half');
			}else{
				$bar.removeClass('over-half').addClass('under-half');
			}
		}

		if ( debugmode ) console.log('filled:', filled, '; total:', total, '; progress:', progress);
	};

	// Calculate every time a field changes
	$form.on('change', ':input, textarea, select', calculate_progress);

	// Also calculate immediately
	calculate_progress();
}