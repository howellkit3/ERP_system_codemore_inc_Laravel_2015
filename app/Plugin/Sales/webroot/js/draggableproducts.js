
$(document).ready(function() {
    
    $("body").on('keyup','.stockQuantity', function(e){
        var quantitySpec = parseInt($('#ProductSpecificationQuantity').val());
        var stockQuantity = $(this).val();
        if (stockQuantity < 0) {
            alert('You must enter a positive number.!');
            $('.stockQuantity').focus();
            $(this).val('');
            return false;
        }else{
           
            if(!stockQuantity){
                stockQuantity = 0;
            }
            partTotal = parseInt(quantitySpec) - parseInt(stockQuantity);
            $('.allQuantity').val(partTotal);
            $('.allPaperQuantity').val(partTotal);
        }
        if(stockQuantity >= quantitySpec){
            $(this).val(quantitySpec - 1);
            var newVal = quantitySpec - 1;
            partTotal = parseInt(quantitySpec) - parseInt(newVal);
            $('.allQuantity').val(partTotal);
            $('.allPaperQuantity').val(partTotal);
            alert('Stocks must be lower than quantity!');
            
        }
        
    });

    $("body").on('click','.checkMaterial', function(e){
        var nameMaterial = $('.material').val();
        var quantitySpec = $('#ProductSpecificationQuantity').val();
        if(quantitySpec == 0){
            alert('Quantity must be not equal to zero.');
            $('#ProductSpecificationQuantity').val('');
            $('#ProductSpecificationQuantity').focus();
            return false;
        }

        var fieldAppend = $('.appendField').size();
        
        if(fieldAppend == 0){
            alert('Select process for product.');
            $('#checkbox-inl-1').focus();
            $('.processMe').focus();
            
            return false;
        }
       
        if(!nameMaterial){

            $('.material').each(function(){
           
                if(!$(this).val()){
                    alert('Please select material in part section!');
                    $('.modalMaterial').focus();
                    return false;
                }
            });
            
        }else{
            //console.log('sumbit');
            $('#ProductSpecificationForm').submit();
        }

    });
    
    $("body").on('keyup','#ProductSpecificationQuantity', function(e){
        var quantitySpec = $(this).val();
        $('.stockQuantity').val('');
        $('#ProductSpecificationQuantity').attr('value',quantitySpec);
        $('#ProductSpecificationQuantity').attr('data',quantitySpec);
        $('.allQuantity').val(quantitySpec);
        $('.allPaperQuantity').val(quantitySpec);
        
        if(!$.isNumeric(quantitySpec)) {

            //alert('Quantity is required');
            $('#ProductSpecificationQuantity').focus();
            
            $('.stockQuantity').prop('readonly', true);
            //return false;

        }

        if(quantitySpec <= 0){

            alert('You must enter a positive number');
            $('#ProductSpecificationQuantity').val('');
            //return false;

        }else{
            $('.stockQuantity').prop('readonly', false);
        }
       
    });

    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $("#sortable"); //Fields wrapper
    var component_button     = $(".add_field_button"); //Add button ID
    var part_button      = $(".add_part_button");
    var process_button      = $(".add_process_button");
    
    var x = 1; //initlal text box count

    var submitCount = 0;
    submitButton(submitCount);

    $(component_button).click(function(e){ //on add input button click
        submitCount++;
        submitButton(submitCount);
        var countername = parseInt($(this).attr('data'));

        var varCounter = countername + 1;
        $(this).attr('data',parseInt(varCounter));
        var nameArray = $(this).parents('ul.sortable').find('li.ui-state-default').size();
        
        var realName = "data[ProductSpecificationComponent]["+countername+"][name]";
        

        if(x < max_fields){ //max input box allowed

            x++; //text box increment
            //call label.ctp
            $.ajax({ 
                type: "GET", 
                url: serverPath + "sales/products/component/"+varCounter+"/"+realName, 
                dataType: "html", 
                success: function(componentDataField){ 
                    
                    $(wrapper).append(componentDataField); 
                    $('.label'+varCounter).focus();

                } 
                
            });
            
        }

    });
    
    $(part_button).click(function(e){ //on add input button click
        submitCount++;
        submitButton(submitCount);
        var quantitySpec = $('#ProductSpecificationQuantity').val();
        var stockQuantity = $('.stockQuantity').val();
        partQuantity = parseInt(quantitySpec) - parseInt(stockQuantity);

        //if(!$.isNumeric(quantitySpec)) {

            //alert('Quantity is required');
            //$('#ProductSpecificationQuantity').focus();
            //return false;

        //}

        var counterData = parseInt($(this).attr('data'));
        var varCounter = counterData + 1;
        $(this).attr('data',parseInt(varCounter));
        var nameArray = $(this).parents('ul.sortable').find('li.ui-state-default').size();
        var dynamicId = "ItemGroup"+counterData;
        var itemgroupName = "data[Specification][itemgroupName]["+counterData+"]";
        var category = "data[Specification][cateogry]["+counterData+"]";
        var item = "data[Specification][item]["+counterData+"]";
        e.preventDefault();
        var itemG = 0;
        var itemC = 0;
        var itemT = 0;
        if(x < max_fields){ //max input box allowed

            x++; //text box increment

            //call part.ctp
            $.ajax({ 
                type: "GET", 
                url: serverPath + "sales/products/part/"+varCounter+"/"+partQuantity+"/"+itemgroupName+"/"+dynamicId+"/"+category+"/"+item+"/"+counterData, 
                dataType: "html", 
                success: function(partDataField){ 

                    $(wrapper).append(partDataField); 
                    $('.edit-button'+varCounter).focus();

                    var itemGroup = '';
                    //start //triger of itemGroup,category and type dropdown
                    $("body").on('change','#'+dynamicId, function(e){
                        itemGroup = $(this).val();

                        $('#itemGroup'+dynamicId).attr('value',itemGroup);
                        itemG = itemGroup;
                        if(itemG  == 0){
                            
                            $('#product_search'+dynamicId).attr('disabled','true');
                        }else{
                            
                            $('#product_search'+dynamicId).attr('disabled',false);
                            $('#product_search'+dynamicId).focus();

                            $.ajax({
                                type: "GET",
                                url: serverPath + "sales/products/find_product_details/"+itemG+"/"+dynamicId,
                                dataType: "html",
                                success: function(groupdata) {
                                    
                                    $('.tableProduct'+dynamicId).html(groupdata); 
                                    
                                }
                            });
                        }
                        

                    });

                    $("body").on('keyup','#product_search'+dynamicId, function(e){
                        var searchInput = $(this).val();
                        if(searchInput){
                            $.ajax({
                                type: "GET",
                                url: serverPath + "sales/products/product_search/"+itemGroup+"/"+searchInput+"/"+dynamicId,
                                dataType: "html",
                                success: function(data) {
                                    //console.log(data);
                                    if(data){
                                        $('.tableProduct'+dynamicId).html(data); 
                                    }else{
                                        $('.tableProduct'+dynamicId).html('<font color="red"><b>No result..</b></font>'); 
                                    }
                                    
                                }
                            });

                        }
                        
                    });
                    
                    //method for clicking radio trigger
                    $("body").on('change','.selectSpecProduct'+dynamicId, function(e){
                        var partName = $(this).val();
                        console.log(partName);
                        if ($(this).is(":checked")) {
                            //part1 = decode_utf8(partName);
                            //part = encode_utf8(partName);
                            //console.log(part);
                            $('.part_name'+varCounter).val(partName);
                            $( '.close' ).trigger( 'click' );
                            $('.allFieldPart'+varCounter).show();
                            $('.materialName'+varCounter).show();
                            $('.edit-button'+varCounter).html('<i class="fa fa-pencil fa-lg"></i>&emsp; Edit Material &nbsp;</button>');
    
                        }
                        
                    });

                } 
                
            });
            
            if (counterData != 0) {
                process_button.trigger( 'click' );
            }

            //start//computation for outs,paper quantity and rate
            $("body").on('keyup','.outs'+varCounter, function(e){

                var outsval = $(this).val();

                if(outsval <= 0){

                    alert('You must enter a positive number');
                    $(this).val(1);
                    return false;

                }
                
                var paperVal = $('.quantity'+varCounter).val();

                if($.isNumeric(outsval)) {

                    var paperQtyVal =  parseInt($('.quantity'+varCounter).val()) / parseInt(outsval);
                    $('.paper_qty'+varCounter).val(paperQtyVal);

                }

            });
            $("body").on('blur','.outs'+varCounter, function(e){

                var outsval = $(this).val();

                if(!$.isNumeric(outsval)) {

                    alert('You must enter a valid number');
                    $('.paper_qty'+varCounter).val('empty');
                    $(this).focus();

                }
            });
            $("body").on('keyup','.rate'+varCounter, function(e){

                var rateval = $(this).val();

                if(rateval <= 0){
                    alert('You must enter a positive number');
                    $(this).val(1);
                    return false;
                }
                var paperQtyVal = parseInt(quantitySpec) * parseInt(rateval);
                $('.quantity'+varCounter).val(paperQtyVal);
                var outs = $('.outs'+varCounter).val();
               
                var paperqty = parseInt(paperQtyVal) / parseInt(outs);
                $('.paper_qty'+varCounter).val(paperqty);
                

            });
            $("body").on('keyup','.outs_1'+varCounter, function(e){

                var outs_1val = $(this).val();

                if(outs_1val <= 0){

                    alert('You must enter a positive number');
                    $(this).val(1);
                    return false;

                }
                
                var outs = $('.outs'+varCounter).val();
                var fullOuts = outs_1val * outs;
                var qty = $('.quantity'+varCounter).val();
                var paperqty = parseInt(qty) / parseInt(fullOuts);
                $('.paper_qty'+varCounter).val(paperqty);

            });
            //end//computation for outs,paper quantity and rate

        }

    });

    $(process_button).click(function(e){ //on add input button click
        e.preventDefault();
        submitCount++;
        submitButton(submitCount);
        var countername = parseInt($(this).attr('data'));

        var varCounter = countername + 1;
        $(this).attr('data',parseInt(varCounter));
        var nameArray = $(this).parents('ul.sortable').find('li.ui-state-default').size();
        var dynamicId = "Process"+countername;
        var realName = "speclabel["+countername+"]";
        var process = "data[ProductSpecificationProcess]["+countername+"][process]";
       
        $.ajax({ 
            type: "GET", 
            url: serverPath + "sales/products/process/"+process+"/"+dynamicId, 
            dataType: "html", 
            success: function(processDataField){ 
                $(wrapper).append(processDataField); 
                $('#'+dynamicId).focus();

                //checkbox fields
                $("body").on('change','#'+dynamicId, function(e){
                    var processVal = $(this).val();
                    
                    $.ajax({
                        url: serverPath + "sales/products/find_checkbox/"+processVal,
                        type: "get",
                        dataType: "json",
                        success: function(data) {
                            $('.checkbox-nice1'+dynamicId).remove();
                            
                            $.each(data, function(key, value) {
                                var removeSpace = value.SubProcess.name;
                                var checkFieldNameNoSpace = removeSpace.replace(/\s+/g, "-");
                                $('.check-item'+dynamicId).append('<div class="checkbox-nice1'+dynamicId+' checking" id="'+checkFieldNameNoSpace+dynamicId+'">\
                                                        <input id="checkbox-inl-1" class="check-fields'+dynamicId+' '+checkFieldNameNoSpace+' check'+checkFieldNameNoSpace+dynamicId+'" data-processId="'+processVal+'" data-id="'+value.SubProcess.id+'" data-name="'+removeSpace+'" type="checkbox">\
                                                        <label> '+value.SubProcess.name+' </label>\
                                                    </div>');

                            }); 

                        }
                    });

                });  

                //checkbox trigger
                var stepProcess = 0;
                $("body").on('change','.check-fields'+dynamicId, function(e){
                    
                    if ($(this).is(":checked")) {
                        stepProcess+=1;
                        var checkFieldName = "data[ProductSpecificationProcess]["+countername+"]["+$(this).attr('data-name')+"]";
                        var checkFieldNameval = $(this).attr('data-name');
                        var subProcessId = $(this).attr('data-id');
                        var processId = $(this).attr('data-processId');
                        checkFieldNameNoSpace = checkFieldNameval.replace(/\s+/g, "-");
                        
                        $('.check-fields-sort'+dynamicId).append('<div class="well span2 tile appendField appendField'+dynamicId+'" id="field'+checkFieldNameNoSpace+dynamicId+'">\
                                                            <div class="input-group">\
                                                                <span class="input-group-addon">\
                                                                    <i class="fa fa-reorder"></i>\
                                                                </span>\
                                                                <input type="text" name="'+stepProcess+'" value="'+checkFieldNameval+'" class="form-control" disabled="disabled" />\
                                                                <input type="hidden" name="data[ProductSpecificationProcess]['+countername+'][]" value="'+subProcessId+'-'+processId+'" class="form-control dragFieldsName" />\
                                                            </div>\
                                                            <div class="input-group xbtn">\
                                                                <a href="#" data-field="'+checkFieldNameNoSpace+'" class="remove_sort_field'+dynamicId+' remove_sort_field pull-right">\
                                                                    <i class="fa fa-times-circle fa-lg"></i>\
                                                                </a>\
                                                            </div>\
                                                        </div>');

                        $("body").on('click','.remove_sort_field'+dynamicId, function(e){
                           
                            var removeField = $(this).parents('.appendField').find('.remove_sort_field'+dynamicId).attr('data-field');
                           // var removeCheck = $(this).parents('section .dropItem').find('#check'+removeField+dynamicId).attr('data-name');
                            $('#field'+removeField+dynamicId).remove();
                            $('.check'+removeField+dynamicId).prop('checked', false);
                            e.preventDefault();

                        });

                    e.preventDefault();
                    } else {  

                        $('#field'+checkFieldNameNoSpace+dynamicId).remove();
                        
                    }

                   

                    //for sortable fields from checkbox
                    $(".grid").sortable({
                        tolerance: 'pointer',
                        revert: 'invalid',
                        placeholder: 'span2 well placeholder tile',
                        forceHelperSize: true
                        
                    });
                    
                }); 

            } 
            
        });
       
    });

    component_button.trigger( 'click' ); 
    part_button.trigger( 'click' );
    process_button.trigger( 'click' );
    
    
    //remove fields
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        submitCount--;
        submitButton(submitCount);
        var countername = parseInt($(".add_field_button").attr('data'));
       
        var varCounter = countername - 1;
        $(".add_field_button").attr('data', varCounter);

        e.preventDefault(); $(this).parents('li.ui-state-default').remove(); x--;
    });

    $(wrapper).on("click",".remove_part", function(e){ //user click on remove text
        submitCount--;
        submitButton(submitCount);
        var countername = parseInt($(".add_part_button").attr('data'));
       
        var varCounter = countername - 1;
        $(".add_part_button").attr('data', varCounter);
        
        e.preventDefault(); $(this).parents('li.ui-state-default').remove(); x--;
    });

    $(wrapper).on("click",".remove_process", function(e){ //user click on remove text
        submitCount--;
        submitButton(submitCount);
        var countername = parseInt($(".add_process_button").attr('data'));
       
        var varCounter = countername - 1;
        $(".add_process_button").attr('data', varCounter);
        
        e.preventDefault(); $(this).parents('li.ui-state-default').remove(); x--;
    });

    //sorting fields
    $( "#sortable" ).sortable(function(e){
      
    });
    //$( "#sortable" ).disableSelection();
   

});

function submitButton(count) { 

    // if(count >= 3){
    //     $('.submitButton').show();
    // }else{
    //     $('.submitButton').hide();
    // } 

}
function encode_utf8(s) { 

 return unescape(encodeURIComponent(s)); 

}
function decode_utf8(s) { 

    return decodeURIComponent((s)); 

}

