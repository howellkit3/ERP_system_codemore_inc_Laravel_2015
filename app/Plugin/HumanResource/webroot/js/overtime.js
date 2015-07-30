var checkDepartmentEmployee = function(element){

    var departmentId = $(element).val();

    $append_cont = $('.employees.result');

    $append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');

    $('#myonoffswitch-all').change().prop('checked',false);

	$.ajax({
            type: "GET",
            url: serverPath + "human_resource/employees/findbyDepartment/"+departmentId,
            dataType: "html",
            success: function(data) {
            

                $append_cont.html(data)

            },
            error: function(){
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

    $body.on('change','#myonoffswitch-all',function(){

        if ($(this).is(':checked')) {
            $('.onoffswitch-checkbox').prop('checked',true);
        } else {
             $('.onoffswitch-checkbox').prop('checked',false);
        }

    });

     $body.on('change','.onoffswitch-checkbox',function(){
        $('.selected-text').empty();
        var selected = $('.widget-users .onoffswitch-checkbox:checked').length;

        $('.selected-text').html('Selected : <b>'+selected+'</b> ');

    }).trigger('change');


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

            $('#AbsenceTotalTime').val(hours + " hours :" + minutes + " minutes:" + seconds +' seconds');

            $('#AbsenceTotalTimeHidden').val(hours+':'+minutes+':'+seconds);
       
         }    
       
        
        }
    });

 });