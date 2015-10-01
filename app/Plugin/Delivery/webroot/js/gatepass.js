$(document).ready(function() {



	$("body").on('click','.redirectMe', function(e){
		var one = $('.one').val();
		var two = $('.two').val();
		var three = $('.three').val();
		
		var myarray = 1; // more efficient than new Array()
			
		$('.gatefield').each(function(){
		    var val = $(this).val();
		    if(val == ''){
		    	myarray = 0 ;
		    }
		    
		});
		
		if(myarray == 1){
			window.setTimeout(function() {
			    window.location.href = serverPath + "delivery/deliveries/view/"+one+"/"+two+"/"+three;
			}, 3000);
		}
		
	});

	$("body").on('click','.add-gatepass', function(e){
		var thisMe = $(this);
	 	
	 	$.ajax({
			url: serverPath + "deliveries/find_assistant/",
			type: "get",
			async: false,
			dataType: "json",
			success: function(data) {

				$.each(data, function(key, value) {

					if (value.id == selected) {
						$option = "<option class='option-append' selected value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";	
					} else {
						$option = "<option class='option-append'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
					}
				     $('.helper').append($option);
				});			
			}
		});
	
	});

	$("body").on('click','.remove-gatepass', function(e){
		
		$(this).parents('.modal-body').remove();
	});

	$("body").on('click','.check-ref-uuid', function(e){
		var thisMe = $(this);
		if (thisMe.is(':checked')) {
	       thisMe.parent().find('.ref-uuid').prop('disabled',false);
	    }else{
	    	thisMe.parent().find('.ref-uuid').prop('disabled',true);
	    }
	});
});