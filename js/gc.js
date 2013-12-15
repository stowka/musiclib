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
function ad(a, d, c) {
	if ( !a && !d && !c ) {
		a = false;
		d = true;
	} else if ( !a && d && !c ) {
		a = false;
		d = false;
	} else if ( !a && !d && c ) {
		a = true;
		d = false;
	} else if ( !a && d && c ) {
		a = true;
		d = false;
	} else if ( a && !d && !c ) {
		a = false;
		d = true;
	} else if ( a && !d && c ) {
		a = false;
		d = false;
	} else {
		return null;
	}

	return [a, d];
}

function checkGC(c, n) {
	if ( c ) {
		$('#agree_button_'+ n ).button('loading');
	}

	if ( !c ) {
		$('#disagree_button_'+ n ).button('loading');
	}

	var a = $('#agree_button_'+n).hasClass('active');
	var d = $('#disagree_button_'+n).hasClass('active');
	// var k = $('#kc').val() === "1" ? true : false;
	// var o = $('#oc').val() === "1" ? true : false;
	var couple = ad(a, d, c);

	$.post(
		"ajax.gc.php", 
		{
			agree: couple[0],
			disagree: couple[1],
			songComment: $("#song_id").val(),
			userComment: $("#user_comment_" + n).val()
		},
		function(data) {
			if ( c ) {
				$('#agree_button_'+n).button('reset');
			}

			if ( !c ) {
				$('#disagree_button_'+n).button('reset');
			}

			/*
			 * We are testing a (agree)
			 */
			if ( couple[0] ) {
				$('#agree_button_'+n).addClass('active');

			} else {
				$('#agree_button_'+n).removeClass('active');
			}

			/*
			 * We are testing d (disagree)
			 */
			if ( couple[1] ) {
				$('#disagree_button_'+n).addClass('active');
			} else {
				$('#disagree_button_'+n).removeClass('active');
			}
		}
	)
}