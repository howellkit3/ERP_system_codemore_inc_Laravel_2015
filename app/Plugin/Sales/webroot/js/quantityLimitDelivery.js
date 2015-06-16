$( document ).ready(function() {

	var quantityValue = $('#quantity').val();

	$("body").on('keyup','.quantityLimit', function(e){

		var myVal = $(this).attr('value');

		var realVal = $(this).val();
		var fields = $('.quantityLimit');
		var total = '';
		var limit = '';
		var isText = $(this);
		var allVal = 0;
		
	    $($('.quantityLimit')).each(function() {
	     	allVal += parseInt($(this).val());
	     	//alert(quantityValue);
		});
		
		console.log(allVal);
		if ( allVal > quantityValue ){

			alert('Max Quantity');
			isText.val(myVal);
			allVal = total;
				
		}

	});

	$("body").on('keyup','.limitQuantity', function(e){
	
		var myVal = $(this).attr('value');
		var realVal = $(this).val();
		var fieldValue = $(this).parents('.modal-body').find('.maxQuantity').val();
		var total = '';
		var limit = '';
		var isText = $(this);
		var allVal = 0;
		//alert(fieldValue); 
		
		if ( realVal > fieldValue ){

			alert('Max Quantityd');
			isText.val(myVal);
			allVal = total;
				
		}

	});

	$("body").on('keyup','.addquantityLimit', function(e){

		var allVal = 0;
		var isText = $(this);
		var quantityValue = $('#quantity').val();
		
	    $($('.quantityLimit')).each(function() {
	     	allVal += parseInt($(this).val());
	     
		});
	   
	    allVal += parseInt(isText.val());
	    
		if ( allVal > quantityValue ){

				var totalDeduction = parseInt(allVal) - parseInt(quantityValue);
				alert('Max Quantity');
				total = isText.val() - totalDeduction;
				isText.val(total);
				allVal = total;
				
		}
		
	});

	var allFieldsVal = 0;
	$('.quantityLimit').each(function() {
     	allFieldsVal += parseInt($(this).val());
     
	});
	
	if ( allFieldsVal == quantityValue ){
		
		$('.addSchedButton').attr('disabled','disabled');
	}

	$("body").on('click','.buttonEdit', function(e){

		$(this).parents('.tab-container').find('.editable').attr('readonly', false);
    	$(this).parents('.tab-container').find('button.editable').attr('disabled', false);
    	$(this).html('Cancel');
    	$(this).addClass('Cancel');
    
    	
    	$("body").on('click','.Cancel', function(e){
	    	$(this).parents('.tab-container').find('.editable').attr('readonly', true);
	    	$(this).parents('.tab-container').find('button.editable').attr('disabled', true);
	    	$(this).html('Edit');
	    	$(this).removeClass('Cancel');
	    });
    	
    });

});
