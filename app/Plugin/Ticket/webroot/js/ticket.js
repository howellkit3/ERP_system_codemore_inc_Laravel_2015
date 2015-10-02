$(document).ready(function(){

	$('body').on('click','.process_link',function(){

		$processId = $(this).data('processid');

		$productId = $(this).data('productid');

		$ticketUuid =  $(this).data('ticket_uuid');

		$.ajax({
        url: serverPath + "ticket/ticketing_systems/find_process/"+$processId+'/'+$productId+'/'+$ticketUuid,
        type: "GET",
        dataType: "html",
       // data : { 'processId' : $processId , 'subProcess' : $subProcess , 'ticketId' : $ticketUuid },
        success: function(data) {
            
           	// $container.html(data); 
            
            }
        });
	});

});