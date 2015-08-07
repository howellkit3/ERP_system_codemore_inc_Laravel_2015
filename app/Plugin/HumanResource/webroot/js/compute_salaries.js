
$(document).ready(function(){

$body = $('body');

$('.autocomplete').select2();

	$( ".datepick" ).datepicker({
    format: 'yyyy-mm-dd', 
    changeYear: true,
    changeMonth: true,
    showMonthAfterYear: true, //this is what you are looking for
});

	//check employee
$body.on('change','#department_id',function(){

		var $this = $(this);

		$container = $('#result_container_employee');

		if ($this.val() != '') {

		$container.html('<img src="'+serverPath+'/img/loader.gif"/>');

		$('.emp-details').val('');

		$.ajax({
            type: "GET",
            url: serverPath + "human_resource/employees/getBy/",
            data: { 'department' : $this.val()},
            dataType: "json",
            success: function(data) {

            	
            try {

            	if (data.result != 0) {
					$html = '<ul class="list-group">'; 	

					$.each(data.result, function(key,value) {
					$html += '<li class="employee-li list-group-item" data-id="'+value.Employee.id+'"> <span class="badge badge-primary">'+value.Employee.code+'</span> '+value.Employee.first_name+'  '+value.Employee.last_name+'</li>';
					});

					$html += '</ul>';

					$container.html($html);
            	} else {

            		$container.html('<span class="label label-danger label-large">No result found</span>');
            	}
	           


 	           	} catch(e){

          		console.log(e)

          	}
          	
        
            },
           error: function(data){
           		$container.html('No result found');
            }
        });
		}
	});

$body.on('click','.date-range .input',function(e){

	if ($('.month-pay').val() != '' && $('#month-pay').val()) {

		$this = $(this);

		$.ajax({
            type: "GET",
            url: serverPath + "human_resource/attendances/getAllAttendance/",
            data: { 'month' : $('#month-pay').val(),'range' : $this.val(),'empdId' : $('#employee_id').val() },
            dataType: "html",
            success: function(data) {

                console.log(data)
            		
            $('#days_work').html(data);
            
            $('#total-hours').val($('#append-total-hours').val());

            }
        });	

	}
});

//get employee data
$body.on('click','.employee-li',function(){
	
	$('.employee-li').removeClass('active');
	
	var $this = $(this);

	$this.addClass('active');

	$id = $this.data('id');

	var employee_name = '';
	var employee_department = '';
	var employee_position = '';
	var employee_code = '';

	$.ajax({
            type: "GET",
            url: serverPath + "human_resource/employees/getBy/",
            data: { 'id' : $id },
            dataType: "json",
            success: function(data) {

            		$.each(data.result, function(key,value) {

            			 $('#employee_name').val(value.Employee.first_name + ' '+ value.Employee.middle_name + ' ' + value.Employee.last_name );
            			 $('#employee_code').val(value.Employee.code);
            			 $('#employee_id').val(value.Employee.id);
            			 $('#employee_department').val(value.Department.name);
            			 $('#employee_position').val(value.Position.name);

            			 if (value.Employee.image != null) {
            			 	$('.image_profile').attr('style','background:url('+serverPath+'img/uploads/employee/'+value.Employee.image+') !important; background-size:cover !important');
            			 }

                         if (value.Salary.id != '') {
                            $('#basic_pay').val(value.Salary.basic_pay);
                            $('#overtime').val(value.Salary.overtime);
                         }
            		});


            }
        });	
});


//get employee data
$body.on('submit','#SalariesComputeSalariesForm',function(e){

    console.log($(this).serialize());

    e.preventDefault();

});

});