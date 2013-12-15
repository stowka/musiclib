function rate() {
	var song_id = $("#song_id").val();
	var grade_given = ratesl.getValue();

	$("#rating_grade").html( grade_given );

	$.post(
		"ajax.rate.php",
		{
			song: song_id,
			grade: grade_given,
		},
		function(data) {
			$("#rating_average").html( parseFloat( data.average ) );
			$("#average_slider").slider( 'setValue', parseFloat( data.average ) );
			$("#count_raters").html( data.raters );
		}
	);
}

function removeGrade() {
	$("#rating_grade").html( '-' );
	$("#rating_slider").slider( 'setValue', 0 );

	$.post(
		"ajax.rate.php",
		{
			song: song_id,
			remove: true,
		},
		function(data) {
			$("#rating_average").html( parseFloat( data.average ) );
			$("#average_slider").slider( 'setValue', parseFloat( data.average ) );
			$("#count_raters").html( data.raters );
		}
	);
}

function changeGrade() {
	var song_id = $("#song_id").val();
	var grade_given = ratesl.getValue();

	$("#rating_grade").html( grade_given );
}

function displaySliders() {
	avgsl = $('#average_slider').slider({
		min: 0,
		max: 10,
		step: 0,
		tooltip: 'hide',
		value: parseFloat( $("#average_value").val() ),
		handle: 'square',
	});

	ratesl = $('#rate_slider').slider({
		min: 0,
		max: 10,
		step: 1,
		tooltip: 'hide',
		value: parseFloat( $("#rate_value").val() ),
		handle: 'square',
	}).on('slide', changeGrade).data('slider');

	$('#rate_slider').slider().on('slideStop', rate).data('slider');
}