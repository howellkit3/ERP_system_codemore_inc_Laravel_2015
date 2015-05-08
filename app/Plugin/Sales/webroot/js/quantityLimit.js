$( document ).ready(function() {

		$("body").on('keyup','.quantityLimit', function(e){

			var quantityValue = $('#quantity').val();

			var fields = $('.quantityLimit');
			var total = '';
			var limit = '';
			     
		    $(fields).each(function() {
		     
		        var num = parseInt(this.value);
		          
				if (!isNaN(this.value)) {

					total = Number(total) + num;

				}
		         
				if ( total > quantityValue ){
					$('.add-field').hide();
					console.log(total);
					alert('Max Quantity');
					exceed = total - quantityValue;

					console.log('max reached');

				} else {

					console.log(total);
					$('.add-field').show();
					console.log('max not reached');

				}

			});
		});
});
