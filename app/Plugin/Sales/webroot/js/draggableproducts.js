
$(document).ready(function() {

    $("body").on('keyup','#ProductQuantity', function(e){

        var quantitySpec = $(this).val();

        if(!$.isNumeric(quantitySpec)) {

            alert('Quantity is requred');
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

            alert('Quantity is requred');
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

                    //start //triger of itemGroup,category and type dropdown
                    $("#"+dynamicId).change(function(e){

                        var itemGroup = $(this).val();
                        $('#itemGroup'+dynamicId).attr('value',itemGroup);
                        itemG = itemGroup;
                        
                        $('.selectProductcategory'+dynamicId+' option[value!=""]').remove();
                        $('.selectProductItem'+dynamicId+' option[value!=""]').remove();

                        $.ajax({
                            url: serverPath + "sales/products/find_dropdown/"+itemGroup,
                            type: "get",
                            dataType: "json",
                            success: function(data) {
                                
                                $.each(data.CategoryName, function(key, value) {
                                  
                                    $('.selectProductcategory'+dynamicId)
                                         .append($("<option></option>")
                                         .attr("value",value.ItemCategoryHolder.id)
                                         .text(value.ItemCategoryHolder.name));
                                   
                                });
                                $.each(data.TypeName, function(key, value) {
                                  
                                    $('.selectProductItem'+dynamicId)
                                         .append($("<option></option>")
                                         .attr("value",value.ItemTypeHolder.id)
                                         .text(value.ItemTypeHolder.name));
                                }); 
                                  
                            }
                        }); 
                       
                    });
                    $('.selectProductcategory'+dynamicId).change(function(e){
                        var cat = $(this).val();
                        $('#itemGroupCategory'+dynamicId).attr('value',cat);
                        itemC = cat; 
                    });
                    $('.selectProductItem'+dynamicId).change(function(e){
                        var type = $(this).val(); 
                        $('#itemGroupType'+dynamicId).attr('value',type);
                        itemT = type; 
                    });
                    //end //triger of itemGroup,category and type dropdown
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

            //start//FILTER FIELD from all dropdown
            $('body').on('change', '.selectProductcategory'+dynamicId+',.selectProductItem'+dynamicId, function(){
               e.preventDefault();
                if(itemG != 0){
                    
                    if(itemC != 0){
                       
                        if(itemT != 0){
                            $('.optionValue'+dynamicId).remove();
                            $('#productTableInModal'+dynamicId).show(); 
                            //search product with itemGroup,itemCategory and iteType
                            $.ajax({
                                url: serverPath + "sales/products/find_product_details/"+itemG+"/"+itemC+"/"+itemT,
                                type: "get",
                                dataType: "json",
                                contentType: "application/json; charset=utf-8",
                                success: function(data) {
                                    // console.log(data);
                                    
                                    if(data == ''){
                                        
                                        $('.tableProduct'+dynamicId)
                                                 .append($("<p class='noresult"+dynamicId+"'>No Result..</p>"));
                                        
                                    } else {
                                        $('.noresult'+dynamicId).hide();
                                        $.each(data, function(key, value) {
                                            //console.log(value);
                                            
                                            if(itemG == 1){
                                                $('.noresult'+dynamicId).hide();
                                                $('.tableProduct'+dynamicId)
                                                    .append($("<tr class='optionValue"+dynamicId+"'>\
                                                                <td>\
                                                                    <input type='radio' value='"+value.GeneralItem.name+"' class='selectSpecProduct"+dynamicId+"' name='optionsRadios'>\
                                                                </td>\
                                                                <td>'"+value.GeneralItem.uuid+"'</td>\
                                                                <td>'"+value.GeneralItem.name+"'</td>\
                                                               </tr>"));
                                             
                                            }
                                            if(itemG == 2){
                                                $('.noresult'+dynamicId).hide();
                                                $('.tableProduct'+dynamicId)
                                                    .append($("<tr class='optionValue"+dynamicId+"'>\
                                                                <td>\
                                                                    <input type='radio' value='"+value.Substrate.name+"' class='selectSpecProduct"+dynamicId+"' name='optionsRadios'>\
                                                                </td>\
                                                                <td>'"+value.Substrate.uuid+"'</td>\
                                                                <td>'"+value.Substrate.name+"'</td>\
                                                               </tr>"));
                                             
                                            }
                                            if(itemG == 3){
                                                $('.noresult'+dynamicId).hide();
                                                $('.tableProduct'+dynamicId)
                                                    .append($("<tr class='optionValue"+dynamicId+"'>\
                                                                <td>\
                                                                    <input type='radio' value='"+value.CompoundSubstrate.name+"' class='selectSpecProduct"+dynamicId+"' name='optionsRadios'>\
                                                                </td>\
                                                                <td>'"+value.CompoundSubstrate.uuid+"'</td>\
                                                                <td>'"+value.CompoundSubstrate.name+"'</td>\
                                                                </tr>"));
                                             
                                            }
                                            if(itemG == 4){
                                                $('.noresult'+dynamicId).hide();
                                                $('.tableProduct'+dynamicId)
                                                    .append($("<tr class='optionValue"+dynamicId+"'>\
                                                                <td>\
                                                                    <input type='radio' value='"+value.CorrugatedPaper.name+"' class='selectSpecProduct"+dynamicId+"' name='optionsRadios'>\
                                                                </td>\
                                                                <td>'"+value.CorrugatedPaper.uuid+"'</td>\
                                                                <td>'"+value.CorrugatedPaper.name+"'</td>\
                                                              </tr>"));
                                             
                                            }
                                            
                                        });

                                        //method for clicking radio trigger
                                        $("body").on('change','.selectSpecProduct'+dynamicId, function(e){
                                            var partName = $(this).val();
                                            if ($(this).is(":checked")) {
                                                $('.part_name'+varCounter).val(partName);
                                                $( '.close' ).trigger( 'click' );
                                                $('.allFieldPart'+varCounter).show();
                                                $('.materialName'+varCounter).show();
                                                $('.edit-button'+varCounter).html('<i class="fa fa-pencil fa-lg"></i>&emsp; Edit Material &nbsp;</button>');

                                                

                                                
                                            }
                                            
                                        });

                                    }
                                   
                                      
                                }
                            });
                        }
                    }
                }
                if(itemG == 0){
                    $('.optionValue'+dynamicId).remove();
                }
               
            });
            //end//FILTER FIELD from all dropdown

            //pagination
            //how much items per page to show  
            var show_per_page = 5;  
            //getting the amount of elements inside content div optionValue"+dynamicId
            var number_of_items = $('.optionValue'+dynamicId).size(); 
            console.log(number_of_items);
            console.log('test'); 
            //calculate the number of pages we are going to have  
            var number_of_pages = Math.ceil(number_of_items/show_per_page);  
          
            //set the value of our hidden input fields  
            $('.current_page').val(0);  
            $('.show_per_page').val(show_per_page);  
          
            //now when we got all we need for the navigation let's make it '  
          
            /* 
            what are we going to have in the navigation? 
                - link to previous page 
                - links to specific pages 
                - link to next page 
            */  
            var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';  
            var current_link = 0;  
            while(number_of_pages > current_link){  
                navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';  
                current_link++;  
            }  
            navigation_html += '<a class="next_link" href="javascript:next();">Next</a>';  
          
            $('.page_navigation').html(navigation_html);  
          
            //add active_page class to the first page link  
            $('.page_navigation .page_link:first').addClass('active_page');  
          
            //hide all the elements inside content div  
            $('.tableProduct'+dynamicId).children().css('display', 'none');  
          
            //and show the first n (show_per_page) elements  
            $('.tableProduct'+dynamicId).children().slice(0, show_per_page).css('display', 'block'); 
        }

    });

    $(process_button).click(function(e){ //on add input button click

        var countername = parseInt($(this).attr('data'));
        var varCounter = countername + 1;
        $(this).attr('data',parseInt(varCounter));
        var nameArray = $(this).parents('ul.sortable').find('li.ui-state-default').size();
        var dynamicId = "Process"+countername;
        var realName = "speclabel["+countername+"]";
        var process = "data[Specification][process]["+countername+"]";
        e.preventDefault();

        if(x < max_fields){ //max input box allowed

            x++; //text box increment

            //call process.ctp
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
                                $('.appendField'+dynamicId).remove();

                                $.each(data, function(key, value) {
                                    var removeSpace = value.SubProcess.name;
                                    var checkFieldNameNoSpace = removeSpace.replace(/\s+/g, "-");
                                    $('.check-item'+dynamicId).append('<div class="checkbox-nice1'+dynamicId+'">\
                                                            <input id="checkbox-inl-1" class="check-fields '+checkFieldNameNoSpace+'" data-name="'+value.SubProcess.name+'" type="checkbox">\
                                                            <label for="checkbox-inl-1"> '+value.SubProcess.name+' </label>\
                                                        </div>');

                                }); 

                            }
                        });

                    });  

                } 
                
            });

            //checkbox trigger
            $("body").on('change','.check-fields', function(e){

                var checkFieldName = "data[Specification]["+$(this).attr('data-name')+"]";
                var checkFieldNameval = $(this).attr('data-name');
                checkFieldNameNoSpace = checkFieldNameval.replace(/\s+/g, "-");
                //$('.appendField').remove();
                if ($(this).is(":checked")) {
                    console.log($(this));
                    
                    $('.check-fields-sort'+dynamicId).append('<div class="well span2 tile appendField'+dynamicId+'" id="'+checkFieldNameNoSpace+dynamicId+'">\
                                                        <a href="#" data-field="'+checkFieldNameNoSpace+'" class="remove_sort_field pull-right">\
                                                            <i class="fa fa-times-circle fa-lg"></i>\
                                                        </a>\
                                                        <div class="input-group">\
                                                            <span class="input-group-addon">\
                                                                <i class="fa fa-reorder"></i>\
                                                            </span>\
                                                            <input type="text" name="'+checkFieldName+'" value="'+checkFieldNameval+'" class="form-control" readonly />\
                                                        </div>\
                                                    </div>');
                } else {  

                    $('#'+checkFieldNameNoSpace+dynamicId).remove();
                    
                }
                
            }); 

            $("body").on('click','.remove_sort_field', function(e){
                e.preventDefault();
                var removeField = $(this).attr('data-field');
                
                $('#'+removeField).remove();
                $('.'+removeField).prop('checked', false);
            });
            
            //for sortable fields from checkbox
            $(".grid").sortable({
                tolerance: 'pointer',
                revert: 'invalid',
                placeholder: 'span2 well placeholder tile',
                forceHelperSize: true
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

            
        }
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

