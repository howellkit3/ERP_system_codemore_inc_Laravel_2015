$body = $("body");

$body.on('submit','#EmployeeModal',function(e){

	$department = $('#EmployeePosition').val();

	$name = $('#EmployeeName').val();
	$modal = $(this);
	
	$modal.find('#result_container').empty();


     $('#result_container').html('<img src="'+serverPath+'/img/loader.gif"/>');

        $.ajax({
            type: "GET",
            url: serverPath + "human_resource/employees/find/"+$department+"/"+$name,
            dataType: "HTML",
            success: function(data) {
                
            	$modal.find('#result_container').html(data);

            }
        });


	e.preventDefault();
})
.on('click','#item_type_pagination a',function(e){

	   var getUrl = $(this).attr('href');

       $('#result_container').html('<img src="'+serverPath+'/img/loader.gif"/>');

        $.ajax({
          url:getUrl,
          type: "GET",
          success:function(data){

          	$('#result_container').html(data);
          }
        });

        e.preventDefault();

       // return false;

})
.on('click','button.employee_select',function(e){

	$('#selectEmployee').empty();

	   var employee_id = $(this).data('id');

	   var name = $(this).parents('tbody').find('.employee').text();

	   $append = $('<option/>').text(name).val(employee_id);

	   $('#selectEmployee').append($append);
       // return false;

});

//tools
$body.on('submit','#ToolsAssignForm',function(e){

	$modal = $(this);

	$name = $('#ToolsName').val();

	$modal.find('#result_container').empty();


     $('#result_container').html('<img src="'+serverPath+'/img/loader.gif"/>');

        $.ajax({
            type: "GET",
            url: serverPath + "human_resource/tools/find/"+$name,
            dataType: "HTML",
            success: function(data) {
                
            	$modal.find('#result_container').html(data);

            }
        });


	e.preventDefault();
})
.on('click','button.tool_select',function(e){

	$('#selectTool').empty();

	   var tool_id = $(this).data('id');

	   var name = $(this).parents('tbody').find('.employee').text();

	   $append = $('<option/>').text(name).val(tool_id);

	   $('#selectTool').append($append);
       // return false;

});