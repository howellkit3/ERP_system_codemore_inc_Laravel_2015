var checkEmployee = function(element){


	var employeeId = $(element).val();

	$.ajax({
            type: "GET",
            url: serverPath + "human_resource/employees/findbyId/"+employeeId,
            dataType: "json",
            success: function(data) {
               	$('#AbsenceCode').val(data.Employee.code);
            },
            error: function(){
            	$('#AbsenceCode').val('');
            }
    });

} 

$(document).ready(function(){  

  	var init = function(){

     		$('.datepick').datepicker();
     		$(".autocomplete").select2();

            $('#AbsenceEmployeeId').change();
     }

     var $body = $('body');

     init();

    $body.on('change','.datetimepick',function(){

        var from = $('#AbsenceFrom');
        var to = $('#AbsenceTo');

        $('.error-date').remove();

        if (from.val() != '' && to.val() != '') {

         if (from.val() > to.val()) {
            $('#AbsenceTo').after($('<label/>').addClass('error-date error').text('This must be larger than the other date'));
         } else {

            var diff =  Math.abs(new Date(to.val()) - new Date(from.val()));
            var seconds = Math.floor(diff/1000); //ignore any left over units smaller than a second
            var minutes = Math.floor(seconds/60); 
            seconds = seconds % 60;
            var hours = Math.floor(minutes/60);
            minutes = minutes % 60;

            console.log(diff);

            $('#AbsenceTotalTime').val(hours + " hours :" + minutes + " minutes:" + seconds +' seconds');

            $('#AbsenceTotalTimeHidden').val(hours+':'+minutes+':'+seconds);
       
         }    
       
        
        }
    });

 });