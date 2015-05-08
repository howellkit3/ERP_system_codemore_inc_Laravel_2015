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
		     
	    $(fields).each(function() {
	     
	        var num = parseInt(this.value);
	          
			if (!isNaN(this.value)) {

				total = Number(total) + num;

			}
	         
			if ( total > quantityValue ){
				
				console.log(total);
				alert('Max Quantity');
				isText.val('');
				exceed = total - quantityValue;

				console.log('max reached');

			} else {

				$('.add-field , .remove-field').prop("disabled", false);
				console.log('max not reached');

			}
			if(total == quantityValue){

				$('.add-field , .remove-field').prop("disabled", true);
				
			}

		});
	});
});
