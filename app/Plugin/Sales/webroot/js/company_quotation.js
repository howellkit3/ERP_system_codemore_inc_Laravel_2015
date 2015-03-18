jQuery(function($){
	$('#itemCategory').prop('disabled', true);
	$("#itemType").prop('disabled', true);
	$("#selectProduct").prop('disabled', true);
	$("#txtProduct").prop('disabled', true);
	$("#selectProduct").hide();
	$("#checkBack").hide();
	$("#back").hide();
	
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
							console.log(name);
							$('#selectProduct').append($('<option class="option_append_item">').text(name).attr('value',i));

						});
					
					}
			});

		});
			
	});
	$('#itemCategory').change(function(){
		

		var option = $(this).val();
		
		
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
				$.ajax({
				url: serverPath + "sales/products/get_product/"+$('#itemType').val()+"/"+$('#select_company').val(),
				type: "GET",
				dataType: "json",
				success: function(data) {
					$('.option_append_item').remove();
						$.each(data,function(i,name) {
							console.log(name);
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
						console.log(name);
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

					console.log(data);
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
	
});

function cloneInput(whatSection, thisElement)
{
	var count = $('.' + whatSection).children().length;
    console.log(count);
    var parentSection = $(thisElement).parents('.' + whatSection);
	var data = $(parentSection).first().clone();

	for(x = count; x > 0; x--){
		console.log(x);
    	data = fieldResetInput(data, whatSection);
	}

    $('.' + whatSection).last().after(data);
    
}
function fieldResetInput($form, section)
{
    var count = $('.' + section).children().length;
    //console.log(count);
    
    $form.find('select, input').each(function() {
        var $this = $(this),
            nameProp = $this.prop('name'),

            newIndex = count;
            type = $this.prop('type');

        if(type == "text")
        {
            $this.val('');
        }
  
    	console.log(nameProp);
        $this.prop('name', nameProp.replace(/\[(\d+)\]/, function(str,p1){	
        	return '[' + (count + 14 ) + ']' 
        }));
    });
    
    return $form;
   
}