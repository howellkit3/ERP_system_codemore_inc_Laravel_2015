var multiplePromptsCounter = 1;

function openMultiplePrompts(element,url,status){

    // $.prompt("Are you sure you want to "+status+" this request?", {
    //     //title: "confirmed",
    //     buttons: { "Yes": true, "No": false },
    //     persistent: false,
    //     submit: function(e,v,m,f) {
    //        if(v == true) {
    //            window.location.href = url;
    //         }
    //     }
    // });


       //var data1 = 1;
        var data = $(element).attr('data');
        
        swal({
            title: "Are you sure?",
            text: "You want to "+status+" this request ",
            type: "warning",
            showCancelButton: true,
            timer: 2000,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, "+status+" it!",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false 
        },
        function (isConfirm) {

            if (isConfirm) {

                        swal("Successful!","Quotation "+status+".", "success");
                        window.location.href = url;
                 

            } else {
                swal("Cancelled", "Transaction error.", "error");
            }
        });


}

     

var checkDepartmentEmployee = function(element){

    $departmentId = $(element).val();

    $append_cont = $('.employees.result');

    $append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');

    $('#myonoffswitch-all').change().prop('checked',false);

    $date = $('#OvertimeDate').val();

	$.ajax({
            type: "POST",
            url: serverPath + "human_resource/employees/findbyDepartment/"+$departmentId,
            dataType: "html",
            data : {
                'department_id' : $departmentId,
                'date' : $date 
            },
            success: function(data) {
            

                $append_cont.html(data)

            },
            error: function(){
            }
    });

}

// function confirmAction(status){
       
        
//     if (status) {
//      var confirmed = confirm("Reject this request");
//     } else {

//     var confirmed = confirm("Are you sure you want to approved this request");
   
//     }
//     return confirmed;
    
// } 

$(document).ready(function(){  

    // $('body').on('change','.onoffswitch-checkbox',function(e){ 
    //    
    // });



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


    $body.on('click','.table-link',function(e){
        var status = $(this).data('process');
        var url = $(this).attr('href');
        openMultiplePrompts(this,url,status);
        e.preventDefault();
    });

     $body.on('change','.onoffswitch-checkbox',function(){

        $('.selected-text').empty();
        var selected = $('.widget-users .onoffswitch-checkbox:checked').length;
        //console.log($(this));
        $('.selected-text').html('Selected : <b>'+selected+'</b> ');

    }).trigger('change');

    // $body.on('submit','#ovetimeForm',function(e){
   
    //     $return = true;
        
    //     if ($('.onoffswitch-checkbox:checked').length <= 0) {

    //              $('.selected-text').after('<label class="error appended-error" style="top:0;margin:0 10px;" >Please select employees to work.</label>');


    //         $('html, body').animate({
    //             scrollTop: parseInt($('.error.appended-error').offset().top - 150 )
    //         },300);
    //           $return = false;
    //           e.preventDefault();
    //     }

    //     return $return;
      
    // });


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


      $body.on('keyup','#SearchEmployee',function(e){

      $container = $('#result-tale-employee');

      $container.html('<img src="'+serverPath+'/img/loader.gif"/>');

        $.ajax({
                type: "GET",
                url: serverPath + "human_resource/employees/searchEmployee?overtime=true" ,
                dataType: "html",
                data: { 'search' : $('#SearchEmployee').val(), 'date' : $('#OvertimeDate').val() },
                success: function(data) {
                   
                   try {

                      $container.html(data);

                   } catch(e) {

                        $container.html('<span class="error-appended" style="color:red">Error Loading Page</span>');
                   } 
                 //$append_cont.html(data)

                },
                error: function(){
                }
          });



    });

  $('body').on('click','#printRequest',function(e){

        window.open($(this).attr('href'),'Print Request','width = 800,height=500');

        e.preventDefault();
  });
  $('body').on('click','#selection .select_employee',function(){

      
    
        if ($(this).is(':checked')) {

                $count = $('#resultList .alert-success').size();

                $(this).parent().find('.select_employee.attendance').attr('name','data[Attendance][id]['+ $count +']');

                $(this).parent().find('.select_employee.employee').attr('Ename','data[mployee][id]['+ $count +']').attr('disabled',false);

                $clone = $(this).parent().html();
             //  console.log( $clone );

               var html  = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-check-circle fa-fw fa-lg"></i>';
                 html  +=   '<b>' + $clone +'</b>';
                 html  +=  '</div>';


                $('#resultList').append(html);

                $(this).parent().parent().fadeOut();

        }
          




  });



  $('body').on('click','#resultList .close',function(){
  
        $(this).parents('.alert-success').remove();
  });


//    function searchEmployee () {

//    }     
//     var timeout;

// $('body').on('keypress','.searchEmployee',function(e){
   
//     if(timeout) {
//         clearTimeout(timeout);
//         timeout = null;
//     }

//     timeout = setTimeout(searchEmployee,450);

//           e.preventDefault();
// });



 });