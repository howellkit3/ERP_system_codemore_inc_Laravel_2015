
function readURL(input,element) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

            $('.'+element).attr('style','background:url('+ e.target.result +')')

        }

        reader.readAsDataURL(input.files[0]);
    }
}
var checkexistingDept = function(thisElement){

    $('.dynamic-input').remove();

    $('.appended-error').remove();

    $this = $(thisElement);

    $employee_id = $(thisElement).val();

    $.ajax({
        type: "GET",
        url: serverPath + "human_resource/timekeeps/findExisting/"+$employee_id,
        dataType: "json",
        success: function(data) {
           
           $this.append($('<input class="dynamic-input"/>').attr('name','data[Attendance][id]').attr('value',data.id));
            //$modal.find('#result_container').html(data);

            $('.radio input').attr('disabled',false);

            if (data.type == 'in'){

                $('#categoryRadio1').attr('disabled',true).next().text('Time-In: '+data.time);
                $('#categoryRadio2').click();
            } else {
                $('#categoryRadio2').attr('checked',false);
                $('#categoryRadio1').click().attr('disabled',false).next().text('In')

            }


        }
    });

}

var getCode = function(element){

   $this = $(element);

    $('.error-appended').remove();

    $department = $('#EmployeeDepartmentId').val();
    $position = $('#EmployeePositionId').val();

   if ($this.is(':checked')) {

    if ($department == '') {
        $('#EmployeeCode').after('<label class="error error-appended" for="EmployeeFirstName">Please Select Department</label>');
    
        }  else {
         $.ajax({
            type: "POST",
            data : {'department' :  $department, 'position' : $position },
            url: serverPath + "human_resource/employees/getCode/",
            dataType: "json",
            success: function(data) {
                $('#EmployeeCode').val(data.emp_number);
            }
        });
      }   
    } else {

        $('#EmployeeCode').val(''); 
    }  
}

$(document).ready(function(){

$body = $('body');

$('#EmployeeAddForm').submit(function(e){

    // var error = $('.error-appended');

    if  ($('.error-appended').length > 0) {


         $('html, body').animate({
                scrollTop: parseInt($('.error-appended').offset().top - 150 )
            },300);


        e.preventDefault();


    }

});

$body.on('change','#EmployeeDepartmentId',function(e) {


    if ($('#checkbox-generate').is(':checked')) {

            getCode('#checkbox-generate');
       
    }

});

$('[name="data[Employee][first_name]"]').blur();

$('.name-check').blur(function(){


    $('.error-appended,.label-success').remove();

    $first_name = $('[name="data[Employee][first_name]"]').val();

    $last_name = $('[name="data[Employee][last_name]"]').val();

    $middle_name = $('[name="data[Employee][middle_name]"]').val();


    if ( $first_name != '' && $last_name != '' && $middle_name != '') {

         $.ajax({
            type: "POST",
            data : {'first_name' :  $first_name, 'last_name' : $last_name ,'middle_name' : $middle_name },
            url: serverPath + "human_resource/employees/checkExistingEmployee/",
            dataType: "json",
            success: function(employee) {
                
                if (employee > 0) {
                    
                    $('[name="data[Employee][middle_name]"]').after('<label class="label label-danger error-appended" for="EmployeeFirstName" style="position:relative; top:8px"> <i class="fa fa-times"></i> This name is already taken </label>');

                } else {

                   $('[name="data[Employee][middle_name]"]').after('<label class="label label-success" for="EmployeeFirstName" style="position:relative; top:8px">  <i class="fa fa-check"></i> Name is available</label>');  
                }
            }
        });
    }
});

$body.on('click','.btn.btn-success.upload-image',function(e){

    $('.image_profile input').click();

    e.preventDefault();
});

// $( ".datepick" ).datepicker({
//     format: 'yyyy-mm-dd', 
//     changeYear: true,
//     changeMonth: true,
//     showMonthAfterYear: true,
//      'viewMode':2 //this is what you are looking for
// });

$(".autocomplete").select2();
//$('.datepick').datepicker({  format: 'yyyy-mm-dd'  });


});

//view employee by department
$('body').on('change','.select-department-view',function(e){

    var thisDepartmentId = $(this).val();
    console.log(thisDepartmentId);
    if (thisDepartmentId > 0) {
        $('.default-table').hide();
        $('.append-table-department').show();

        $.ajax({
            type: "GET",
            url: serverPath + "human_resource/employees/search_by_department/"+thisDepartmentId,
            dataType: "html",
            success: function(data) {
               
                if(data){
                    $('.append-table-department').html(data); 
                }else{
                    $('.append-table-department').html('<font color="red"><b>No result..</b></font>'); 
                }
                
            }
        });

    }else{

        $('.default-table').show();
        $('.append-table-department').hide();
    } 
    

});
