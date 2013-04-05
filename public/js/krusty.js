(function(){
	var date = new Date();
	date.setDate(date.getDate()+1);
	var dp = $( ".datepicker" );
	dp.datepicker({
		dateFormat: 'yy-mm-dd',
		minDate: date
	});


$('#login').find('button[type=button]').on('click', function(){
	$(this).next().focus().select();
});

// Select a Date Range with datepicker
$( "#rangeStart" ).datepicker({
	dateFormat: 'yy-mm-dd',
    onClose: function( selectedDate ) {
        $( "#rangeEnd" ).datepicker( "option", "minDate", selectedDate );
    }
});

$( "#rangeStart.min-date-tomorrow" ).datepicker("option", "minDate", date);

$( "#rangeEnd" ).datepicker({
	dateFormat: 'yy-mm-dd',
    onClose: function( selectedDate ) {
        $( "#rangeStart" ).datepicker( "option", "maxDate", selectedDate );
    }
});
})();

