function readURL(input,element) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

            $('.'+element).attr('style','background:url('+ e.target.result +')')

        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(window).load(function(){

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

$(".autocomplete").select2();

});
// $('.datepick').datepicker({
// 		  format: 'mm-dd-yyyy'
		  
// });


//seasch Employees