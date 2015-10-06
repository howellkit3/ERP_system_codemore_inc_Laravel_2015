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

});