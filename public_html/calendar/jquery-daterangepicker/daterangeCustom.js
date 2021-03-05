$(function () {

	$('#date-range0').dateRangePicker({
		format: 'DD/MM/YYYY',
		separator: ' - ',
		autoClose: true,
		monthSelect: true,
		yearSelect: true,
		yearSelect: [1900, moment().get('year')]
	});
});
