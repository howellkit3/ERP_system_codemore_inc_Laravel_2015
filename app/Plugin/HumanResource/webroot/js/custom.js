$(document).ready(function(){

$body = $('body');



$body.on('click','.btn.btn-success.upload-image',function(e){

    $('.image_profile input').click();

    e.preventDefault();
});

$( ".datepick" ).datepicker({
    format: 'yyyy-mm-dd', 
    changeYear: true,
    changeMonth: true,
    showMonthAfterYear: true, //this is what you are looking for
});

//$('.datepick').datepicker({  format: 'yyyy-mm-dd'  });


});

//seasch Employees