jQuery(document).ready(function($) {

	$('body').on('click','#EditMachine',function(e){

		$this = $(this);

		$url = $(this).data('url');

		$container = $('#result_cont');

	    $.ajax({
	        type: "GET",
	        url: serverPath + $url,
	        dataType: "html",

	        success: function(data) {

	            
	            $container.html(data);
	        }
	    });



		e.preventDefault();
	});

});