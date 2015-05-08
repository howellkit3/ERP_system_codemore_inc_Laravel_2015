$( document ).ready(function() {

	$('.datepick').datepicker({
			format: 'yyyy-mm-dd'
		});
	jQuery('.remove').hide();
	$("#QuotationIndexForm").validate();

	$("body").on('keyup','.quantityLimit', function(e){

		var quantityValue = $('#quantity').val();

		var fields = $('.quantityLimit');
		var total = '';
		var limit = '';
		var isText = $(this);
		var allVal = 0;
	
	    $(fields).each(function() {
	     	allVal += parseInt($(this).val());
	       /* var num = parseInt(this.value);
	          
			if (!isNaN(this.value)) {

				total = Number(total) + num;

			}

			if ( total > quantityValue ){

				// for max value
				var totalDeduction = parseInt(quantityValue) - parseInt(allVal);


				alert('Max Quantity');
				isText.val(totalDeduction);
				
			} else {

				$('.add-field , .remove-field').prop("disabled", false);
				
			} 
			if(allVal == quantityValue){

				$('.add-field , .remove-field').prop("disabled", true);
				
			} */

		});

		 if ( allVal > quantityValue ){

				var totalDeduction = parseInt(allVal) - parseInt(quantityValue);
				alert('Max Quantity');
				isText.val(isText.val() - totalDeduction);
				
		}
		if(allVal == quantityValue){

				$('.add-field , .remove-field').prop("disabled", true);
				
		}  else {
			$('.add-field , .remove-field').prop("disabled", false)
		}

	});
});
