jQuery(function($){
	$('#itemCategory').prop('disabled', true);
	$("#itemType").prop('disabled', true);
	$("#selectProduct").prop('disabled', true);
	$("#txtProduct").prop('disabled', true);
	$("#selectProduct").hide();
	$("#checkBack").hide();
	$("#back").hide();
	$("#minus").hide();
	
	$('#checkAdd').change(function(){
		$("#selectProduct").show();
		$("#checkBack").show();
		$("#back").show();
		$("#txtProduct").hide();
		$("#checkAdd").hide();
		$("#add").hide();
		
	});

	$('#checkBack').change(function(){
		$("#selectProduct").hide();
		$("#checkBack").hide();
		$("#back").hide();
		$("#txtProduct").show();
		$("#checkAdd").show();
		$("#add").show();
	});
	

	$('#select_company').change(function(){
		
		$("#selectProduct").prop('disabled', false);
		$("#txtProduct").prop('disabled', false);
		$("#message").css("color", "white");
		
		
		var option = $(this).val();
		
		$.ajax({
		url: serverPath + "sales/customer_sales/find_data/"+option,
		type: "get",
		dataType: "json",
		success: function(data) {
			console.log(data);
			if (data.length == 0){
				$('#address1').val('');
				$('#contact').val('');	
				$('#email').val('');	
			}else{
				$('#address1').val(data.Address[0].address1);
				$('#contact').val(data.Contact[0].number);	
				$('#email').val(data.Email[0].email);
				$('#id').val(data.Company.id);

			}
			
		}
		}).done(function(){
				$.ajax({
				url: serverPath + "sales/products/get_product/"+$('#select_company').val(),
				type: "GET",
				dataType: "json",
				success: function(data) {
					$('.option_append_item').remove();
						$.each(data,function(i,name) {

							$('#selectProduct').append($('<option class="option_append_item">').text(name).attr('value',i));

						});
					
					}
			});

		});
			
	});
	$('#itemCategory').change(function(){
		

		var option = $(this).val();
		
		$("#loading").clone().show().addClass("loading_event").insertAfter($(this)); //ajax loader
		$.ajax({
			url: serverPath + "sales/products/get_type/"+option,
			type: "GET",
			dataType: "json",
			success: function(data) {
				$('.option_append').remove();
					$.each(data,function(i,name) {
						console.log(name);
						$('#itemType').append($('<option class="option_append">').text(name).attr('value',i));



					});	
				
				}
		}).done(function(){

				$("#loading").clone().show().addClass("loading_event").insertAfter($('#product')); //ajax loader
				$.ajax({
				url: serverPath + "sales/products/get_product/"+$('#itemType').val()+"/"+$('#select_company').val(),
				type: "GET",
				dataType: "json",
				success: function(data) {
					$('.option_append_item').remove();
						$.each(data,function(i,name) {

							$('#product').append($('<option class="option_append_item">').text(name).attr('value',i));

						});
					
					}
			});

		});
			
	});

	$('#itemType').change(function(){
			var option = $(this).val();
			$.ajax({
			url: serverPath + "sales/products/get_product/"+$('#itemType').val()+"/"+$('#select_company').val(),
			type: "GET",
			dataType: "json",
			success: function(data) {
				$('.option_append_item').remove();
					$.each(data,function(i,name) {
						
						$('#product').append($('<option class="option_append_item">').text(name).attr('value',i));

					});
				
				}
			});

		});

	$('#selectProduct').change(function(){
		

		var option = $(this).val();
		
			$.ajax({
			url: serverPath + "sales/products/get_product_spec/"+option,
			type: "GET",
			dataType: "json",
			success: function(data) {
					if (data.length == 0){
						$('#QuotationField2Description').val('');
						$('#QuotationField4Description').val('');	
						$('#QuotationField5Description').val('');
						$('#QuotationField6Description').val('');
						$('#QuotationField7Description').val('');
						$('#QuotationField8Description').val('');
						$('#QuotationField9Description').val('');
						$('#QuotationField10Description').val('');
						$('#QuotationField12Description').val('');
					}else{
						$('#QuotationField2Description').val(data[0]['ProductSpec']['description']);
						$('#QuotationField4Description').val(data[1]['ProductSpec']['description']);	
						$('#QuotationField5Description').val(data[2]['ProductSpec']['description']);
						$('#QuotationField6Description').val(data[3]['ProductSpec']['description']);
						$('#QuotationField7Description').val(data[4]['ProductSpec']['description']);
						$('#QuotationField8Description').val(data[5]['ProductSpec']['description']);
						$('#QuotationField9Description').val(data[6]['ProductSpec']['description']);
						$('#QuotationField10Description').val(data[7]['ProductSpec']['description']);
						$('#QuotationField12Description').val(data[8]['ProductSpec']['description']);

					}
				
				}
			});

		});
	$(".maskedPhone").mask("(99)-999-9999");
	$(".maskedPhone2").mask("(99)-999-9999");
	$('.form-group.addButton').wrapAll('<div class="addValues"></div>');

	$('body').on('click','.remove-contact-person',function(e){
		
		var contactId = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: "You want to delete this contact? ",
            type: "warning",
            showCancelButton: true,
            timer: 2000,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, approve it!",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false 
        },
        function (isConfirm) {

            if (isConfirm) {
				
				$.ajax({
                    url: serverPath + "sales/customer_sales/remove_contact/"+contactId,
                    success: function(data) {

                    	if (data == 1) {
							swal("Successful!","Contact Person deleted.", "success");
                        location.reload(true);
                    	}  else {
                    		swal("Cancelled", "Transaction error.", "error");
                    	}
                        //console.log(data);                   
                    }

                });

                return false;

            } else {
                swal("Cancelled", "Transaction error.", "error");
            }
        });
		e.preventDefault();
	});
	
});

function cloneInput(whatSection, thisElement)
{
	 var count2 = $('.' + whatSection).length;
     console.log(count2 + 1);
 	$("#minus").show();
 	$name = $('.main-box-body .cloneFields input').last().attr('name');
 	var count = $name.match(/\d+/)[0];
 	console.log( $name );

    var parentSection = $(thisElement).parents('.' + whatSection);
	var data = $(parentSection).first().clone();
    data = fieldResetInput(data, whatSection,count);
    $('.' + whatSection).last().after(data);

    $("#qty").val(count2+1);
    $("#uprice").val(count2+1);
    $("#material").val(count2+1);
    
}



    function fieldResetInput($form, section,count)
{
	// var count2 = $('.' + section).length;
 //    console.log(count2 + 1);

    $form.find('select, input').each(function() {
        var $this = $(this),
            nameProp = $this.prop('name'),

            newIndex = count;
            type = $this.prop('type');

        if(type == "text")
        {
            $this.val('');
        }
 
    
    var input = count;
    if ($(this).attr('type') != 'hidden') {
    		count_now  = count++;
    }
        $this.prop('name', nameProp.replace(/\[(\d+)\]/, function(str,p1){ 
         return '[' + (count_now + 14) + ']' 
        }));
    });
    
    return $form;
   
}
