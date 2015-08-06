$(document).ready(function(){

$body = $('body');



$body.on('click','.btn.btn-success.upload-image',function(e){

    $('.image_profile input').click();

    e.preventDefault();
});

$( ".datepick" ).datepicker({
 	 format: "mm-yyyy",
    viewMode: "months", 
});

//$('.datepick').datepicker({  format: 'yyyy-mm-dd'  });


});

//seasch Employees