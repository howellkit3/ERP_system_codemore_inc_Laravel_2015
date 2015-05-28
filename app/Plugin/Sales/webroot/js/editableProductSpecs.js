$(document).ready(function() {

	$( "#sortable" ).sortable( { disabled: true } );

	$("body").on('click','.removeMe', function(e){
                    
        $(this).parents('.removeMeNow').remove();

        e.preventDefault();

    });

	//start//computation for outs,paper quantity and rate
	var quantitySpec = $('#ProductSpecificationQuantity').val();

    $("body").on('keyup','.rateMe', function(e){

        var rateval = $(this).val();

        if(rateval <= 0){
            alert('You must enter a positive number');
            $(this).val(1);
            return false;
        }
        var paperQtyVal = parseInt(quantitySpec) * parseInt(rateval);

        $(this).parents('.parentSection').find('.quantityMe').val(paperQtyVal);

        var outs = $(this).parents('.parentSection').find('.outsMe').val();
       
        var paperqty = parseInt(paperQtyVal) / parseInt(outs);

        $(this).parents('.parentSection').find('.paper_qtyMe').val(paperqty);
       
    });

    $("body").on('keyup','.outsMe', function(e){

        var outsval = $(this).val();

        if(outsval <= 0){

            alert('You must enter a positive number');
            $(this).val(1);
            return false;

        }
        
        var paperVal = $(this).parents('.parentSection').find('.quantityMe').val();

        if($.isNumeric(outsval)) {

            var paperQtyVal =  parseInt(paperVal) / parseInt(outsval);
            
            $(this).parents('.parentSection').find('.paper_qtyMe').val(paperQtyVal);

        }

    });

    $("body").on('blur','.outsMe', function(e){

        var outsval = $(this).val();

        if(!$.isNumeric(outsval)) {

            alert('You must enter a valid number');
            $(this).parents('.parentSection').find('.paper_qtyMe').val('empty');
            $(this).focus();

        }
    });

    $("body").on('keyup','.outs_1Me', function(e){

        var outs_1val = $(this).val();

        if(outs_1val <= 0){

            alert('You must enter a positive number');
            $(this).val(1);
            return false;

        }
        
        var outs = $(this).parents('.parentSection').find('.outsMe').val();
        var fullOuts = outs_1val * outs;

        var qty = $(this).parents('.parentSection').find('.quantityMe').val();
        var paperqty = parseInt(qty) / parseInt(fullOuts);
        $(this).parents('.parentSection').find('.paper_qtyMe').val(paperqty);

    });

    $("body").on('change','.groupMe', function(e){
        itemGroup = $(this).val();
       
        //$('#itemGroup'+dynamicId).attr('value',itemGroup);
        itemG = itemGroup;
        if(itemG  == 0){
            
            $(this).parents('.modal-body').find('.searchProductMe').attr('disabled','true');

        }else{
            
            $(this).parents('.modal-body').find('.searchProductMe').attr('disabled',false);
            $(this).parents('.modal-body').find('.searchProductMe').focus();
            var thisMe = $(this);

            $.ajax({
                type: "GET",
                url: serverPath + "sales/products/find_product_details/"+itemG+"/"+itemG,
                dataType: "html",
                success: function(groupdata) {
                    
                    thisMe.parents('.modal-body').find('.tableProductMe').html(groupdata); 
                }
            });
        }
        
    });

    $("body").on('keyup','.searchProductMe', function(e){
        var searchInput = $(this).val();
        var thisMe = $(this);
        if(searchInput){
            $.ajax({
                type: "GET",
                url: serverPath + "sales/products/product_search/"+itemGroup+"/"+searchInput+"/"+itemGroup,
                dataType: "html",
                success: function(data) {
                   
                    if(data){
                       
                        thisMe.parents('.modal-body').find('.tableProductMe').html(data); 
                    }else{
                         
                        thisMe.parents('.modal-body').find('.tableProductMe').html('<font color="red"><b>No result..</b></font>'); 
                    }
                    
                }
            });

        }
        
    });

    //method for clicking radio trigger
    $("body").on('change','.radioMe', function(e){
        var partName = $(this).val();
        
        if ($(this).is(":checked")) {
            console.log('rttes');
            $(this).parents('.dragField').find('.partnameMe').val(partName);
            $(this).parents('.modal-content').find('.close').trigger( 'click' );
           
        }
        
    });

    //checkbox fields
    $("body").on('change','.processMe', function(e){
        var processVal = $(this).val();
        var thisMe = $(this);
        $.ajax({
            url: serverPath + "sales/products/find_checkbox/"+processVal,
            type: "get",
            dataType: "json",
            success: function(data) {

            	thisMe.parents('.dragField').find('.checkMe').remove();
                //$//('.checkbox-nice1'+dynamicId).remove();
                
                $.each(data, function(key, value) {
                    var removeSpace = value.SubProcess.name;
                    var checkFieldNameNoSpace = removeSpace.replace(/\s+/g, "-");
                    thisMe.parents('.dragField').find('.check-itemMe').append('<div class="checkMe checkbox-nice1 checking" id="'+checkFieldNameNoSpace+'">\
                                            <input id="checkbox-inl-1" class="check-fields '+checkFieldNameNoSpace+' check'+checkFieldNameNoSpace+'" data-processId="'+processVal+'" data-id="'+value.SubProcess.id+'" data-name="'+removeSpace+'" type="checkbox">\
                                            <label> '+value.SubProcess.name+' </label>\
                                        </div>');

                }); 

            }
        });

    });

	//checkbox trigger
    var stepProcess = 0;
    $("body").on('change','.check-fields', function(e){
        var getMe = $(this).parents('.dragField').find('.getMe').val();
        if ($(this).is(":checked")) {
            stepProcess+=1;
            var checkFieldName = "data[ProductSpecificationProcess]["+getMe+"]["+$(this).attr('data-name')+"]";
            var checkFieldNameval = $(this).attr('data-name');
            var subProcessId = $(this).attr('data-id');
            var processId = $(this).attr('data-processId');
            checkFieldNameNoSpace = checkFieldNameval.replace(/\s+/g, "-");
            
            $(this).parents('.dragField').find('.check-fieldsMe').append('<div class="well span2 tile appendField appendField" id="field'+checkFieldNameNoSpace+'">\
                    <div class="input-group">\
                        <span class="input-group-addon">\
                            <i class="fa fa-reorder"></i>\
                        </span>\
                        <input type="text" name="'+stepProcess+'" value="'+checkFieldNameval+'" class="form-control" disabled="disabled" />\
                        <input type="hidden" name="data[ProductSpecificationProcess]['+getMe+'][]" value="'+subProcessId+'-'+processId+'" class="form-control dragFieldsName" />\
                    </div>\
                    <div class="input-group xbtn">\
                        <a href="#" data-field="'+checkFieldNameNoSpace+'" class="removeMe remove_sort_field'+getMe+' remove_sort_field pull-right">\
                            <i class="fa fa-times-circle fa-lg"></i>\
                        </a>\
                    </div>\
                </div>');

            $("body").on('click','.removeMe', function(e){
                           
                var removeField = $(this).parents('.appendField').find('.removeMe').attr('data-field');
                $(this).parents('.dropItem').find('.check'+removeField).attr('checked', false);
               	$(this).parents('.appendField').remove();

                e.preventDefault();

            });
		}
	});


});
function showEditFields(editMe,editMeBtn,fieldGrid,sortMe){

	$('.editAll').hide();
	$('.hideAll').show();
	$('.buttonSpecs').show();
	$('.editMe').prop('disabled',false);
	$('.editMeBtn').show();
	$('.fieldGrid').addClass('grid');
	//$('.sortMe').attr('id','sortable');
	$( "#sortable" ).sortable( { disabled: false } );
	$(".grid").sortable({
        tolerance: 'pointer',
        revert: 'invalid',
        placeholder: 'span2 well placeholder tile',
        forceHelperSize: true
    });
}
function hideEditFields(editMe,editMeBtn,fieldGrid,sortMe){

	$('.buttonSpecs').hide();
	$( "#sortable" ).sortable( "destroy" );
	$( ".grid" ).sortable( "destroy" );
	$('.editAll').show();
	$('.hideAll').hide();
	$('.editMe').prop('disabled',true);
	$('.editMeBtn').hide();
	$('.fieldGrid').removeClass('grid');
	$('.sortMe').attr('id','sortable1');
	
}