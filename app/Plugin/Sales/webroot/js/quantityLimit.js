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

		});

		 if ( allVal > quantityValue ){

				var totalDeduction = parseInt(allVal) - parseInt(quantityValue);
				alert('Max Quantity');
				total = isText.val() - totalDeduction;
				isText.val(total);
				allVal = total;
				
		}
		if(allVal == quantityValue){

				$('.add-field , .remove-field').prop("disabled", true);
				
		}  else {
			$('.add-field , .remove-field').prop("disabled", false)
		}

	});
});
