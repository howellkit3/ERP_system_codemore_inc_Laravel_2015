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
	     	allVal = $('.quantityLimit').val();
	        var num = parseInt(this.value);
	          
			if (!isNaN(this.value)) {

				total = Number(total) + num;

			}
	         
			if ( total > quantityValue ){

				// for max value
				var totalDeduction = parseInt(quantityValue) - parseInt(allVal);

				console.log(quantityValue);
				console.log(allVal);
				console.log(totalDeduction);

				alert('Max Quantity');
				isText.val(totalDeduction);
				
			} else {

				$('.add-field , .remove-field').prop("disabled", false);
				
			}
			if(total == quantityValue){

				$('.add-field , .remove-field').prop("disabled", true);
				
			}

		});
	});
});
