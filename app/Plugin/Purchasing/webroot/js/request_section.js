jQuery(document).ready(function($){
				
	$("body").on('click','.add-request-section', function(e){
		 	
		var getCounter = $('.get-counter').val();

		$.ajax({ 
            type: "GET", 
            url: serverPath + "purchasing/requests/request_section/"+getCounter, 
            dataType: "html", 
            success: function(requestSection){ 
                
                $('.cloneMe').append(requestSection); 

	            var itemGroup = '';
			    var counterData = 0;
			    var dynamicId = "ItemGroup"+counterData;
			                    
			    $("body").on('change','.ItemGroup', function(e){

			         //var counterData = parseInt($(this).attr('data'));
			         
			        // alert(counterData);
			        itemGroup = $(this).val();

			        var getCounter = $('.get-counter').val();
			        //alert(itemGroup);
			        // $('#itemGroup'+dynamicId).attr('value',itemGroup);
			        // itemG = itemGroup;
			        if(itemGroup == 0){
			            
			            $('.searchItem').attr('disabled',true);

			        }else{

			            $('.searchItem').attr('disabled',false);

			            $.ajax({
			                type: "GET",
			                url: serverPath + "purchasing/requests/item_details/"+itemGroup+"/"+getCounter,
			                dataType: "html",
			                success: function(groupdata) {
			                    
			                    $('.tableProduct').html(groupdata); 
			                    
			                }
			            });
			        }
			        

			    });

			    $("body").on('change','.selectSpecProduct', function(e){
	                console.log($(this).attr('data-name'));
	                var idHolder = $(this).attr('data-holder');
	                var partName = $(this).val();
			        var itemModel = $(this).attr('name');

			        
			        var itemName = $(this).attr('data-name');
			        console.log(idHolder);
			      
			        if ($(this).is(":checked")) {
			           
			            $('.item_model'+getCounter).val(itemModel);
			            $('.item_name'+getCounter).val(itemName);
			            $('.item_id'+getCounter).val(partName);
			            $( '.close' ).trigger( 'click' );
		        	}

	            });

			    // var proxycounter = $('.get-counter').attr('data');
			    // if(proxycounter != 0){
			    	getCounter++;
                	$('.get-counter').val(getCounter);
			    // }
	          	

	        }

            
        });
		//$('.fieldproxy').hide();
		 	
	});

	// $('.add-request-section').trigger( 'click' );

 //    $('.get-counter').val(1);

	

});