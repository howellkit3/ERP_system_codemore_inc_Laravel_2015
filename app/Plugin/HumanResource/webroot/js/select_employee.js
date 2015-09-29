$(document).ready(function(){

	$('#selectEmployee').click(function(){

		$appendTable = $('#appendTable #result-table');

		$('#employeeTable .employee_select:checked').each(function(){
			$parent = $(this).parents('tr');

			$(this).attr('checked','true');

			$html = $parent.clone();
			
			$appendTable.append($html);

			$parent.remove();
		});

	});

	$('#removeEmployee').click(function(){

		$appendTable = $('#employeeTable #employee_orig_cont');

		$('#appendTable .employee_select:checked').each(function(){
			$parent = $(this).parents('tr');

			$(this).attr('checked',false);
			
			$html = $parent.clone();
			
			$appendTable.append($html);

			$parent.remove();
		});

	});

	$('body').on('click','#selectAll',function(){

		$parent = $(this).parents('.employees');
		
		$parent.find('.employee_select:checkbox').not(this).prop('checked', this.checked);
	
	});

	$('.ProcessPayroll').click(function(){

		swal({   title: "Process Payroll",  
		 text: "This will update employee payroll information. Click OK to continue",  
		 type: "info", 
		 showCancelButton: true,   
		 closeOnConfirm: false,   
		 showLoaderOnConfirm: true, },
		 function() {  
		 		
				$('#PayrollEmployeeSelectForm').submit();
		  });


	});


});