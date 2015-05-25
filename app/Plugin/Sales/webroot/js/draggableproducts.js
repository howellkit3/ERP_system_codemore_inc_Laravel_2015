
$(document).ready(function() {

    $("body").on('keyup','#ProductQuantity', function(e){

        var quantitySpec = $(this).val();

        if(!$.isNumeric(quantitySpec)) {

            alert('Quantity is required');
            $('#ProductQuantity').focus();
            return false;

        }

        if(quantitySpec <= 0){

            alert('You must enter a positive number');
            $('#ProductQuantity').val('');
            return false;

        }

    });

    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $("#sortable"); //Fields wrapper
    var label_button      = $(".add_field_button"); //Add button ID
    var part_button      = $(".add_part_button");
    var process_button      = $(".add_process_button");
  
    var x = 1; //initlal text box count
    
    $(label_button).click(function(e){ //on add input button click

        var countername = parseInt($(this).attr('data'));
        var varCounter = countername + 1;
        $(this).attr('data',parseInt(varCounter));
        var nameArray = $(this).parents('ul.sortable').find('li.ui-state-default').size();
        
        var realName = "data[Specification][speclabel]["+countername+"]";
        e.preventDefault();

        if(x < max_fields){ //max input box allowed

            x++; //text box increment
            //call label.ctp
            $.ajax({ 
                type: "GET", 
                url: serverPath + "sales/products/label/"+varCounter+"/"+realName, 
                dataType: "html", 
                success: function(labelDataField){ 

                    $(wrapper).append(labelDataField); 
                    $('.label'+varCounter).focus();

                } 
                
            });
            
        }

    });

    $(part_button).click(function(e){ //on add input button click

        var quantitySpec = $('#ProductQuantity').val();

        if(!$.isNumeric(quantitySpec)) {

            alert('Quantity is required');
            $('#ProductQuantity').focus();
            return false;

        }

        var countername = parseInt($(this).attr('data'));
        var varCounter = countername + 1;
        $(this).attr('data',parseInt(varCounter));
        var nameArray = $(this).parents('ul.sortable').find('li.ui-state-default').size();
        var dynamicId = "ItemGroup"+countername;
        var itemgroupName = "data[Specification][itemgroupName]["+countername+"]";
        var category = "data[Specification][cateogry]["+countername+"]";
        var item = "data[Specification][item]["+countername+"]";
        e.preventDefault();
        var itemG = 0;
        var itemC = 0;
        var itemT = 0;

        if(x < max_fields){ //max input box allowed

            x++; //text box increment

            //call part.ctp
            $.ajax({ 
                type: "GET", 
                url: serverPath + "sales/products/part/"+varCounter+"/"+quantitySpec+"/"+itemgroupName+"/"+dynamicId+"/"+category+"/"+item, 
                dataType: "html", 
                success: function(partDataField){ 

                    $(wrapper).append(partDataField); 
                    $('.edit-button'+varCounter).focus();

                    var itemGroup = '';
                    //start //triger of itemGroup,category and type dropdown
                    $("#"+dynamicId).change(function(e){

                        itemGroup = $(this).val();
                        $('#itemGroup'+dynamicId).attr('value',itemGroup);
                        itemG = itemGroup;
                        if(itemG  == 0){
                            console.log(itemG);
                            $('#product_search'+dynamicId).attr('disabled','true');
                        }else{
                            console.log(itemG);
                            $('#product_search'+dynamicId).attr('disabled',false);
                            $('#product_search'+dynamicId).focus();
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

                        }else{
                            $('.tableProduct'+dynamicId).html('');
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

            //start//quantity unit data
            $.ajax({
                url: serverPath + "sales/products/unit_dropdown",
                type: "get",
                dataType: "json",
                success: function(data) {

                    $('.dropUnit').append($("<option></option>").attr("value",0).text("---Select Unit---"));

                    $.each(data, function(key, value) {
                                  
                        $('.dropUnit')
                             .append($("<option></option>")
                             .attr("value",value.Unit.id)
                             .text(value.Unit.unit));
                       
                    });
                }
            });
           
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

    //$("body").on('change','#'+dynamicId, function(e){
    $(process_button).click(function(e){ //on add input button click

        var countername = parseInt($(this).attr('data'));
        var varCounter = countername + 1;
        $(this).attr('data',parseInt(varCounter));
        var nameArray = $(this).parents('ul.sortable').find('li.ui-state-default').size();
        var dynamicId = "Process"+countername;
        var realName = "speclabel["+countername+"]";
        var process = "data[Specification][process]["+countername+"]";
        e.preventDefault();

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
                                //$('.appendField'+dynamicId).remove();

                                $.each(data, function(key, value) {
                                    var removeSpace = value.SubProcess.name;
                                    var checkFieldNameNoSpace = removeSpace.replace(/\s+/g, "-");
                                    $('.check-item'+dynamicId).append('<div class="checkbox-nice1'+dynamicId+' checking" id="'+checkFieldNameNoSpace+dynamicId+'">\
                                                            <input id="checkbox-inl-1" class="check-fields'+dynamicId+' '+checkFieldNameNoSpace+' check'+checkFieldNameNoSpace+dynamicId+'" data-name="'+removeSpace+'" type="checkbox">\
                                                            <label> '+value.SubProcess.name+' </label>\
                                                        </div>');

                                }); 

                            }
                        });

                    });  

                    //checkbox trigger
                    $("body").on('change','.check-fields'+dynamicId, function(e){
                    //$('.check-fields'+dynamicId+' input[type=checkbox]').change(function(e) {
                        
                        //$('.appendField').remove();
                        if ($(this).is(":checked")) {
                            var checkFieldName = "data[Specification]["+$(this).attr('data-name')+"]";
                            var checkFieldNameval = $(this).attr('data-name');
                            checkFieldNameNoSpace = checkFieldNameval.replace(/\s+/g, "-");
                            console.log($(this));
                            $('.check-fields-sort'+dynamicId).append('<div class="well span2 tile appendField appendField'+dynamicId+'" id="field'+checkFieldNameNoSpace+dynamicId+'">\
                                                                <div class="input-group">\
                                                                    <span class="input-group-addon">\
                                                                        <i class="fa fa-reorder"></i>\
                                                                    </span>\
                                                                    <input type="text" name="'+checkFieldName+'" value="'+checkFieldNameval+'" class="form-control" readonly />\
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
            
            //processes data
            $.ajax({
                url: serverPath + "sales/products/find_process",
                type: "get",
                dataType: "json",
                success: function(data) {

                    $.each(data, function(key, value) {
                        //console.log(value);
                        $('#'+dynamicId)
                             .append($("<option></option>")
                             .attr("value",value.Process.id)
                             .text(value.Process.name));
                       
                    }); 
                      
                }
            });

            
        //}
    });

    //remove fields
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text

        var countername = parseInt($(".add_field_button").attr('data'));
       
        var varCounter = countername - 1;
        $(".add_field_button").attr('data', varCounter);

        e.preventDefault(); $(this).parents('li.ui-state-default').remove(); x--;
    });

    $(wrapper).on("click",".remove_part", function(e){ //user click on remove text

        var countername = parseInt($(".add_part_button").attr('data'));
       
        var varCounter = countername - 1;
        $(".add_part_button").attr('data', varCounter);
        
        e.preventDefault(); $(this).parents('li.ui-state-default').remove(); x--;
    });

    $(wrapper).on("click",".remove_process", function(e){ //user click on remove text

        var countername = parseInt($(".add_process_button").attr('data'));
       
        var varCounter = countername - 1;
        $(".add_process_button").attr('data', varCounter);
        
        e.preventDefault(); $(this).parents('li.ui-state-default').remove(); x--;
    });

    //sorting fields
    $( "#sortable" ).sortable();
    //$( "#sortable" ).disableSelection();

});

function encode_utf8(s) { 

 return unescape(encodeURIComponent(s)); 

}
function decode_utf8(s) { 

    return decodeURIComponent((s)); 

}
