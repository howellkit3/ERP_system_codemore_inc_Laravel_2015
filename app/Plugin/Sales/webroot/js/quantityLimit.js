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
	$("body").on('keyup','#quantity', function(e){

		$('.error-appended').remove();

			$orginalLimit = $('.original_quantity').data('quantity');

			$this = $(this);

			if ($this.val() > 0 && $this.val() < $orginalLimit) {
				$(this).after('<label id="CompanyCompanyName-error" style="color:#FF0000" class="error-appended" for="CompanyCompanyName"> You cannnot enter less than ' + $orginalLimit + '</label>');
				//$this.val($orginalLimit);

				//get total
		

				
			}

			if ($this.val() > 0 ) {
				$unit_price = $('#unit_price').val();

				$total_price = parseFloat($this.val()) *  parseFloat($unit_price);

				$('#unit_price_total').val($total_price.toFixed(2)) 


				if ($('#ClientOrderDeliverySchedule0DeliveryType').val() == 'Once') {

					$('#totalQuantity').val($this.val());
				}
			}	

			
	}).trigger('keyup');

	$("#QuotationIndexForm").submit(function(e) {


		if ($('.error-appended').length > 0) {

			$('html, body').animate({
			scrollTop: ($('.error-appended').offset().top - 300)
			}, 100);

			return false;
			e.preventDefault();
		}

	});

});
