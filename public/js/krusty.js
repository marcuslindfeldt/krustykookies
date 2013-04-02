(function(){
  var date = new Date();
  date.setDate(date.getDate()+1);
  $( ".datepicker" ).datepicker({ 
    dateFormat: 'yy-mm-dd',
    minDate: date
  });
})(); 