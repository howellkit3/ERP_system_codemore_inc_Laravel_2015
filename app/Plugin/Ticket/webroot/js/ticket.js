$(document).ready(function(){

	$('body').on('click','.process_link',function(){

		$processId = $(this).data('processid');

		$productId = $(this).data('productid');

		$ticketUuid =  $(this).data('ticket_uuid');

    $product = $(this).data('product');

		$container = $('#result-table');

		$.ajax({
        url: serverPath + "ticket/ticketing_systems/find_process/"+$processId+'/'+$productId+'/'+$ticketUuid+'/'+$product,
        type: "GET",
        dataType: "html",
       // data : { 'processId' : $processId , 'subProcess' : $subProcess , 'ticketId' : $ticketUuid },
        success: function(data) {
            
           	$container.html(data); 
            
            }
        });
	});


  $('body').on('change','#JobTicketProcessMachine',function(){

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

         $container.find('#JobTicketProcessPaperGripper').val(data.Machine.paper_gripper);


         $container.find('#JobTicketProcessPlate').val(data.Machine.plate);


         $container.find('#JobTicketProcessPlateGripper').val(data.Machine.plate_gripper);

            }
        });

    }

  });

  $('body').on('submit','#offsetForm',function(e){

      $form = $(this);

       $.ajax({
        url: serverPath + "machines/save_process_to_ticket",
        type: "POST",
        dataType: "json",
        data : $form.serialize(),
        success: function(data) {

         $container.find('#JobTicketProcessPaperGripper').val(data.Machine.paper_gripper);


         $container.find('#JobTicketProcessPlate').val(data.Machine.plate);


         $container.find('#JobTicketProcessPlateGripper').val(data.Machine.plate_gripper);

            }
        });



      e.preventDefault();

  });

});