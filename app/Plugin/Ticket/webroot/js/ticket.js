$(document).ready(function(){

	$('body').on('click','.process_link',function(){

		$processId = $(this).data('processid');

		$productId = $(this).data('productid');

		$ticketUuid =  $(this).data('ticket_uuid');

    $product = $(this).data('product');

    $id = $(this).attr('id');

		$container = $('#result-table');

		$.ajax({
        url: serverPath + "ticket/ticketing_systems/find_process/"+$processId+'/'+$productId+'/'+$ticketUuid+'/'+$product+'/'+$id,
        type: "GET",
        dataType: "html",
       // data : { 'processId' : $processId , 'subProcess' : $subProcess , 'ticketId' : $ticketUuid },
        success: function(data) {
            
           	$container.html(data); 
            
            }
        });
	});


  $('body').on('change','#PlateMakingProcessMachine',function(){

    //check existing data
    if ($(this).val() != '') {

      $id = $(this).val();


      $container = $('#offsetForm');

    $.ajax({
        url: serverPath + "machines/find_machine",
        type: "POST",
        dataType: "json",
        data : { 'machineId' :  $id },
        success: function(data) {

         $container.find('#PlateMakingProcessPaperGripper').val(data.Machine.paper_gripper);


         $container.find('#PlateMakingProcessPlate').val(data.Machine.plate);


         $container.find('#PlateMakingProcessPlateGripper').val(data.Machine.plate_gripper);

            }
        });

    }

  });

  $('body').on('submit','#offsetForm',function(e){

      $form = $(this);

      $url = $(this).attr('action');

       $.ajax({
        url: $url,
        type: "POST",
        dataType: "json",
        data : $form.serialize(),
        success: function(data) {


            $text = data.result.PlateMakingProcess.machine_name;
            $('#'+data.result.formProcessId).parent().next().text($text);

            $('#closeModal').click();

            }
        });



      e.preventDefault();

  });

});