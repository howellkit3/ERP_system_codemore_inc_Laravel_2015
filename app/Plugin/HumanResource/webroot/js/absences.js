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
     }

     var $body = $('body');

 
     // $body.on('change',)

     init();

 });