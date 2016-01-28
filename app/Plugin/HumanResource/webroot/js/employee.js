
function ajaxCallSearchEmployee(DepartmentId,thisStatus,inputSearch,profile,is_contract){

    $container =  $('.append-table-department');

    $container.html('<img src="'+serverPath+'/img/loader.gif"/>');

    $.ajax({
        type: "GET",
        url: serverPath + "human_resource/employees/search_by_department/"+DepartmentId+"/"+thisStatus+"/"+inputSearch+'/'+profile+'/html/'+is_contract,
        dataType: "html",
        success: function(data) {
           
            if(data){
                $container.html(data); 
            }else{
                $container.html('<font color="red"><b>No result..</b></font>'); 
            }
            
        }
    });

}

function readURL(input,element) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

            //$('.'+element).attr('style','background:url('+ e.target.result +')')

            $('.image_profile.emp').attr('style','background:url('+ e.target.result +')')

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
    
    $('.appended-label').remove();


    $department = $('#EmployeeDepartmentId').val();
    $position = $('#EmployeePositionId').val();
    $dateHired = $('#EmployeeDateHired').val();

   if ($this.is(':checked')) {

    if ($department == '') {
       
         $('#EmployeeCode').after('<label class="error error-appended" for="EmployeeFirstName">Please Select Department</label>');
    
    }
    else if($dateHired == '') {

              $('#EmployeeCode').after('<label class="error error-appended" for="EmployeeFirstName">Please add Date Hired</label>');
    }     

    else {
         $.ajax({
            type: "POST",
            data : {'department' :  $department, 'position' : $position, 'date-hired' :  $dateHired},
            url: serverPath + "human_resource/employees/getCode/",
            dataType: "json",
            success: function(data) {

                $('#EmployeeCode').val(data.emp_number);
                checkExistingCode( '#EmployeeCode' );

            }
        });
      }   
    } else {

        $('#EmployeeCode').val(''); 
    }  
}

var checkExistingCode = function(element){


    $('.appended-label').remove();

    $this = $('#EmployeeCode');



    if ($this.val() != '') {

         $.ajax({
            type: "POST",
            data : {'emp_code' : $this.val() },
            url: serverPath + "human_resource/employees/checkExistingCode/",
            dataType: "json",
            success: function(data) {
                
               
                if (data.result > 0) {
                    
                   $('#EmployeeCode').after('<label class="label label-danger error-appended appended-label" for="EmployeeFirstName" style="position:relative; top:8px"> <i class="fa fa-times"></i> This Emp Number is already taken </label>');

                } else {

                    $('#EmployeeCode').after('<label class="label label-success appended-label" for="EmployeeFirstName" style="position:relative; top:8px">  <i class="fa fa-check"></i> Emp Number is available</label>');  
                }
            }
        });
    }

}


function searchEmployee() {

         //some filter
    var DepartmentId = $('.select-department-view option:selected').val();
    if (!DepartmentId) {
        DepartmentId = 0;
    };

    var status = $('.select-status-view option:selected').val();
    if (!status) {
        status = 0;
    };

         var profile = $('#profile option:selected').val();
    if (!profile) {
        profile ='no';
    };

   
    var inputSearch = $('.searchEmployee').val();
      if (!inputSearch) {
        inputSearch =0;
    };


    $('.searchHidden').val(inputSearch);

    $('.default-table').hide();
    $('.append-table-department').show();


    var is_contract = 0;
    if ($('.searchEmployee ').hasClass('end_contract')) {
        is_contract = 1;
    }

    //ajax function to search
    ajaxCallSearchEmployee(DepartmentId,status,inputSearch,profile,is_contract);
}




$(document).ready(function(){


    var timeout;

$('body').on('keypress','.searchEmployee',function(){
   
    if(timeout) {
        clearTimeout(timeout);
        timeout = null;
    }

    timeout = setTimeout(searchEmployee,450)
});


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

$body.on('change','#EmployeeCode',function(e) {
    
    $('.appended-label').remove();

    if ($(this).val() != '') {
        checkExistingCode('#checkbox-generate');  
    }

});

$('[name="data[Employee][first_name]"]').blur();

$('.name-check').blur(function(){


    $('.error-appended,.label-success').remove();

    $first_name = $('[name="data[Employee][first_name]"]').val();

    $last_name = $('[name="data[Employee][last_name]"]').val();

    $middle_name = $('[name="data[Employee][middle_name]"]').val();


    if ( $first_name != '' && $last_name != '') {

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

// $body.on('click','.btn.btn-success.upload-image',function(e){

//     $('.image_profile input').click();

//     e.preventDefault();
// });

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

    //some filter
    var status = $('.select-status-view option:selected').val();
    if (!status) {
        status = 0;
    };
       var profile = $('#profile option:selected').val();
    if (!profile) {
        profile ='';
    };

    var inputSearch = $('.searchEmployee').val();
        if (!inputSearch) {
        inputSearch =0;
        }

    var thisDepartmentId = $(this).val();

    if (!thisDepartmentId) {
        thisDepartmentId = 0;
    };

    $('.departmentHidden').val(thisDepartmentId);

    $('.default-table').hide();
    $('.append-table-department').show();

    //ajax function to search 
    ajaxCallSearchEmployee(thisDepartmentId,status,inputSearch,profile);

});

$('body').on('change','.select-status-view',function(e){

    console.log('wewewe');
    //some filter
    var DepartmentId = $('.select-department-view option:selected').val();
    if (!DepartmentId) {
        DepartmentId = 0;
    };
    var profile = $('#profile option:selected').val();

    if (!profile) {
        profile ='no';
    };
    
    var inputSearch = $('.searchEmployee').val();
     if (!inputSearch) {
        inputSearch =0;
    };

    var thisStatus = $(this).val();
    
    if (!thisStatus) {
        thisStatus = 0;
    };

    $('.statusHidden').val(thisStatus);

    $('.default-table').hide();
    $('.append-table-department').show();

    var is_contract = 0;
    if ($(this).hasClass('end_contract')) {
        is_contract = 1;
    }
    //ajax function to search
    ajaxCallSearchEmployee(DepartmentId,thisStatus,inputSearch,profile,is_contract);
   
});

$('body').on('change','.select-profile-view',function(e){

    //some filter
    var DepartmentId = $('.select-department-view option:selected').val();
    if (!DepartmentId) {
        DepartmentId = 0;
    };
    
    var profile = $('#profile').val();

    var inputSearch = $('.searchEmployee').val();

    if (!inputSearch) {
        inputSearch = 0;
    };

    var thisStatus =$('.select-status-view').val();
    
     if (!thisStatus) {
        thisStatus = 0;
    };

    $('.profileHidden').val(profile);

    $('.default-table').hide();
    $('.append-table-department').show();

    //ajax function to search
    ajaxCallSearchEmployee(DepartmentId,thisStatus,inputSearch,profile);
   
});

// $('body').on('keyup','.searchEmployee',function(e){

//     //some filter
//     var DepartmentId = $('.select-department-view option:selected').val();
//     if (!DepartmentId) {
//         DepartmentId = 0;
//     };

//     var status = $('.select-status-view option:selected').val();
//     if (!status) {
//         status = 0;
//     };
   
//     var inputSearch = $(this).val();
//     $('.searchHidden').val(inputSearch);

//     $('.default-table').hide();
//     $('.append-table-department').show();

//     //ajax function to search
//     ajaxCallSearchEmployee(DepartmentId,status,inputSearch);
   
// });

$('body').on('click','.select-status',function(e){

    var thisMe = $(this).val();
    
    if (thisMe == 'M') {
        $('.for-married-section').attr('style','block');
        
    }
    if (thisMe == 'S') {
        $('.for-married-section').hide();
      
    }
   
});





//select other department

$('body').on('change','#EmployeeDepartmentId',function(){

    if ($(this).val() == 'other') {

        $('.department-other').removeClass('hide');

        $('.department-other').find('input').attr('disabled',false);
    } else {
         $('.department-other').addClass('hide');

        $('.department-other').find('input').attr('disabled','disabled');
    }

});

$('body').on('change','#EmployeePositionId',function(){

    if ($(this).val() == 'other') {

        $('.position-other').removeClass('hide');

        $('.position-other').find('input').attr('disabled',false);
    } else {
         $('.position-other').addClass('hide');

        $('.position-other').find('input').attr('disabled','disabled');
    }

});

$('body').on('click','.edit_contract',function(){

    $empId = $(this).data('id');

    $modal_body = $('#changeStatus');

    $container =  $modal_body.find('.modal-body.result');

     $container.html('<img src="'+serverPath+'/img/loader.gif"/>');

    $url = serverPath + 'human_resource/employees/check_contract/'+$empId;

    if ($empId != '') {

         $.ajax({
            type: "GET",
            url: $url,
            dataType: "html",
            success: function(data) {

                $container.html(data); 
                  
            }

    });


    }

})
