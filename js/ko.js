/**
 *
 * @author Antoines
 *
 * Function ko(c:boolean): 
 *		c takes 0 or 1 as values
 *		0 means Owned has been clicked
 *		1 means Known has been clicked
 *		it returns the couple (k, o) 
 * 		that has to be checked
 *		
 */
function ko(k, o, c) {
	if ( !k && !o && !c ) {
		k = true;
		o = true;
	} else if ( !k && !o && c ) {
		k = true;
		o = false;
	} else if ( k && !o && !c ) {
		k = true;
		o = true;
	} else if ( k && !o && c ) {
		k = false;
		o = false;
	} else if ( k && o && !c ) {
		k = true;
		o = false;
	} else if ( k && o && c ) {
		k = false;
		o = false;
	} else {
		return null;
	}

	return [k, o];
}

function checkKO(c) {
	if ( c ) {
		$('#known_label').button('loading');
	}

	if ( !c ) {
		$('#owned_label').button('loading');
	}

	// var k = $('#known_checkbox').is(':checked');
	// var o = $('#owned_checkbox').is(':checked');
	var k = $('#kc').val() === "1" ? true : false;
	var o = $('#oc').val() === "1" ? true : false;
	var couple = ko(k, o, c);

	$.post(
		"ajax.ko.php", 
		{
			known: couple[0],
			owned: couple[1],
			song: $("#song_id").val()
		},
		function(data) {
			if ( c ) {
				$('#known_label').button('reset');
			}

			if ( !c ) {
				$('#owned_label').button('reset');
			}

			/*
			 * We are testing k (Known)
			 */
			if ( couple[0] ) {
				$('#known_checkbox').prop('checked', true);
				$('#kc').val('1');
				$('#known_label').addClass('active');
				$('#rate_song').removeClass('invisible');
			} else {
				$('#known_checkbox').prop('checked', false);
				$('#kc').val('0');
				$('#known_label').removeClass('active');
				$('#rate_song').addClass('invisible');
			}

			/*
			 * We are testing o (Owned)
			 */
			if ( couple[1] ) {
				$('#owned_checkbox').prop('checked', true);
				$('#oc').val('1');
				$('#owned_label').addClass('active');
			} else {
				$('#owned_checkbox').prop('checked', false);
				$('#oc').val('0');
				$('#owned_label').removeClass('active');
			}
		}
	)
}