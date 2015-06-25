$( document ).ready(function() {


	$("body").on('keyup','.quantityLimit', function(e){

		var quantityValue = parseInt($('#quantity').val());

		var myVal = $(this).attr('value');

		var realVal = $(this).val();
		var fields = $('.quantityLimit');
		var total = '';
		var limit = '';
		var isText = $(this);
		var allVal = 0;
		
	    //$($('.quantityLimit')).each(function() {
	     	allVal += parseInt($(this).val());
	     	
		//});
		console.log(allVal)
		console.log(quantityValue);
		if ( allVal > quantityValue ){

			alert('Max Quantity');
			isText.val(myVal);
			//allVal = total;
				
		}

		if (allVal <= 0){
			alert('Quantity should be greater than 0');
			isText.val(myVal);		
		}

	});

	$("body").on('keyup','.quantityLimitHolder', function(e){

		var quantityValue = $('#quantityHolder').val();

		//var RemainingValue = $('.quantityRemaining').text();

		//alert(RemainingValue);

		var myVal = $(this).attr('value');

		var realVal = $(this).val();
		var fields = $('.quantityLimitHolder');
		var total = '';
		var limit = '';
		var isText = $(this);
		var allVal = 0;
		
	    $($('.quantityLimitHolder')).each(function() {
	     	allVal += parseInt($(this).val());
	     	
		});
		
		console.log(allVal);
		if ( allVal > quantityValue ){

			alert('Max Quantity');
			isText.val(myVal);
			//allVal = total;
				
		}

		if (allVal <= 0){
			alert('Quantity should be greater than 0');
			isText.val(myVal);		
		}

	});

	$("body").on('keyup','.limitQuantity', function(e){
	
	var quantityValue = $(this).parents('.modal-body').find('.maxQuantity').val();

    var Value = $(this).parents('.modal-body').find('.limitQuantity').val();

    console.log(quantityValue); 

    var myVal = $(this).val();

    var isText = $(this);
   
      if ( parseInt(Value) > parseInt(quantityValue) ){

        alert('Max Quantity');
        isText.val(quantityValue);      
          
      }



	});

	// $("body").on('keyup','.quantityLimit', function(e){

   

 //    var allVal = 0;
 //    var isText = $(this);
 //    var quantityValue = $('#quantity').val();
 //    var Value = $('.quantityLimit').val();
 //      //alert(quantityValue);  

      
 //    if ( Value > quantityValue ){

 //        alert('Max Quantity');
 //        isText.val(quantityValue);

 //    }
    
 //  });

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
				//total = isText.val() - totalDeduction;
				isText.val(total);
				//allVal = total;
				
		}

		if (allVal <= 0){
			alert('Quantity should be greater than 0');
			isText.val(total);		
		}
		
	});

	$("body").on('blur','.quantity', function(e){

    var quantityValue = $(this).parents('.modal-body').find('.MaximumQuantity').val();

    var Value = $(this).parents('.modal-body').find('.quantity').val();

    //alert(quantityValue);

    console.log(Value);

    console.log(quantityValue); 

    var myVal = $(this).val();

    var isText = $(this);
    
   
      if ( parseInt(Value) > parseInt(quantityValue) ){

        alert('Max Quantity');
        isText.val(quantityValue);      
          
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
