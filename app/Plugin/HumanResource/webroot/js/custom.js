var datetime = null,
	date = null;

var update = function () {
		date = moment(new Date())
		$('.clock').text(date.format('MMMM-D-YYYY, HH:mm:ss'));
	};

var updateTime = function(thisElement){

	    datetime = $('.clock');
		update();
	    setInterval(update, 1000);

	    	console.log('wew');
	   // $('.item_type.autocomplete').change();
}

updateTime();

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