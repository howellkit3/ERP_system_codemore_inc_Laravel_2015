
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

            $(wrapper).append('<li class="ui-state-default">\
                                <section class="dragField">\
                                    <header class="main-box-header dragHeader clearfix">\
                                        <h2 class="pull-left">Label</h2>\
                                        <a href="#" class="remove_field pull-right">\
                                            <i class="fa fa-times-circle fa-fw fa-lg"></i>\
                                        </a>\
                                    </header>\
                                    <div class="form-group">\
                                        <div class="col-lg-2"></div>\
                                        <div class="col-lg-8">\
                                            <div class="input-group">\
                                                <span class="input-group-addon"><i class="fa fa-reorder"></i></span>\
                                                <input name="'+realName+'" class="form-control label'+varCounter+'" type="text">\
                                            </div>\
                                        </div>\
                                    </div>\
                                </section>\
                            </li>'); //add input box
            $('.label'+varCounter).focus();
           
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
        var cateogry = "data[Specification][cateogry]["+countername+"]";
        var item = "data[Specification][item]["+countername+"]";
        e.preventDefault();
        var itemG = 0;
        var itemC = 0;
        var itemT = 0;

        if(x < max_fields){ //max input box allowed

            x++; //text box increment

            $(wrapper).append('<li class="ui-state-default">\
                                <section class="dragField">\
                                    <header class="main-box-header dragHeader clearfix">\
                                        <h2 class="pull-left">Part</h2>\
                                        <a href="#" class="remove_part pull-right">\
                                            <i class="fa fa-times-circle fa-fw fa-lg"></i>\
                                        </a>\
                                    </header>\
                                    <div class="form-group">\
                                        <label class="col-lg-2 control-label">Material</label>\
                                        <div class="col-lg-6 materialName'+varCounter+'" style="display:none;">\
                                                <input type="text" class="form-control part_name'+varCounter+'" name="material_name" readonly />\
                                            </div>\
                                        <div class="col-lg-3">\
                                            <button type="button" data-toggle="modal" href="#myModal'+varCounter+'" class="btn btn-primary edit-button'+varCounter+'">\
                                            <i class="fa fa-plus-circle fa-lg"></i> Select Material</button>\
                                        </div>\
                                    </div>\
                                    <section class="allFieldPart'+varCounter+'" style="display:none;">\
                                        <div class="form-group">\
                                            <label class="col-lg-2 control-label">Part</label>\
                                            <div class="col-lg-3">\
                                                <input type="text" value="'+varCounter+'" class="form-control" name="part'+varCounter+'" readonly />\
                                            </div>\
                                            <label class="col-lg-2 control-label">Rate</label>\
                                            <div class="col-lg-3">\
                                                <input type="number" value="'+varCounter+'" class="form-control rate'+varCounter+'" name="rate'+varCounter+'" />\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-lg-2 control-label">Size</label>\
                                            <div class="col-lg-3">\
                                                <input type="text" class="form-control" name="size'+varCounter+'" />\
                                            </div>\
                                            <label class="col-lg-1 control-label left-text">mm &emsp;&emsp; x</label>\
                                            <div class="col-lg-3">\
                                                <input type="number" class="form-control" name="size_1'+varCounter+'" />\
                                            </div>\
                                            <label class="col-lg-1 control-label left-text">mm</label>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-lg-2 control-label">Quantity</label>\
                                            <div class="col-lg-2">\
                                                <input type="number" value="'+quantitySpec+'" class="form-control quantity'+varCounter+'" name="quantity'+varCounter+'" readonly />\
                                            </div>\
                                            <div class="col-lg-3">\
                                                <select class="form-control dropUnit" name="quantity_unit'+varCounter+'" />\
                                                    <option value=""></option>\
                                                </select>\
                                            </div>\
                                            <label class="col-lg-1 control-label">Paper Qty</label>\
                                            <div class="col-lg-2">\
                                                <input type="text" value="'+quantitySpec+'" class="form-control paper_qty'+varCounter+'" name="paper_qty'+varCounter+'" readonly />\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-lg-2 control-label">Color</label>\
                                            <div class="col-lg-8">\
                                                <input type="text" class="form-control" name="color'+varCounter+'" />\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-lg-2 control-label">Outs</label>\
                                            <div class="col-lg-2">\
                                                <input type="number" value="1" class="form-control number outs'+varCounter+'" name="outs'+varCounter+'"/>\
                                            </div>\
                                            <label class="col-lg-1 control-label">x</label>\
                                            <div class="col-lg-2">\
                                                <input type="number" value="1" class="form-control outs_1'+varCounter+'" name="outs_1'+varCounter+'" />\
                                            </div>\
                                        </div>\
                                    </section>\
                                    <div class="modal fade" id="myModal'+varCounter+'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\
                                        <div class="modal-dialog specModal">\
                                            <div class="modal-content">\
                                                <div class="modal-header">\
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
                                                    <h4 class="modal-title">Material</h4>\
                                                </div>\
                                                <div class="modal-body">\
                                                    <div class="form-group">\
                                                        <div class="col-lg-2"></div>\
                                                        <div class="col-lg-7">\
                                                            <div class="input-group">\
                                                                <span class="input-group-addon"><i class="fa fa-reorder"></i></span>\
                                                                <select name="'+itemgroupName+'" class="form-control select-group productItemGroup" id="'+dynamicId+'">\
                                                                    <option value="0">--Select Item Group--</option>\
                                                                    <option value="1">General Items</option>\
                                                                    <option value="2">Substrates</option>\
                                                                    <option value="3">Compound Substrates</option>\
                                                                    <option value="4">Corrugated Papers</option>\
                                                                </select>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                    <section class="dropItem">\
                                                        <div class="form-group">\
                                                            <div class="col-lg-2"></div>\
                                                            <div class="col-lg-7">\
                                                                <div class="input-group">\
                                                                    <span class="input-group-addon"><i class="fa fa-reorder"></i></span>\
                                                                    <select name="'+cateogry+'" class="form-control selectProductcategory'+dynamicId+'">\
                                                                        <option value="">--Select Category--</option>\
                                                                    </select>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                        <div class="form-group">\
                                                            <div class="col-lg-2"></div>\
                                                            <div class="col-lg-7">\
                                                                <div class="input-group">\
                                                                    <span class="input-group-addon"><i class="fa fa-reorder"></i></span>\
                                                                    <select name="'+item+'" class="form-control selectProductItem'+dynamicId+'">\
                                                                        <option value="">--Select Item--</option>\
                                                                    </select>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </section>\
                                                    <section id="productTableInModal'+dynamicId+'" style="display:none;">\
                                                        <div class="table-responsive">\
                                                            <header class="main-box-header clearfix">\
                                                                <h1 class="pull-left">Product List</h1>\
                                                                <div class="filter-block pull-right">\
                                                                    <div class="form-group pull-left">\
                                                                        <input placeholder="Search..." id="hint" name="q" class="form-control" type="search" />\
                                                                        <i class="fa fa-search search-icon"></i>\
                                                                    </div>\
                                                                </div>\
                                                            </header>\
                                                            <section class="scrollsection">\
                                                                <input type="hidden" class="current_page" />\
                                                                <input type="hidden" class="show_per_page" />\
                                                                <table class="table table-striped table-hover">\
                                                                    <thead>\
                                                                        <tr>\
                                                                            <th><a href="#"><span>Select</span></a></th>\
                                                                            <th><a href="#"><span>Item Number</span></a></th>\
                                                                            <th><a href="#"><span>Name</span></a></th>\
                                                                        </tr>\
                                                                    </thead>\
                                                                    <tbody class="tableProduct'+dynamicId+'" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >\
                                                                    </tbody>\
                                                                </table>\
                                                            </section>\
                                                        </div>\
                                                    </section>\
                                                    <div class="form-group">\
                                                        <div class="col-lg-10"></div>\
                                                        <div class="col-lg-2">\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </section>\
                               </li>'); //add input box
                $('.edit-button'+varCounter).focus();
               
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
            //end//quantity unit data 

            // url: serverPath + "sales/products/unit_dropdown",
            //     method: 'GET', $this->request->data('id');
            //     data: "?id=" + idHolder + "&item=434534",
            //     type: "get",

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

            $(wrapper).append('<li class="ui-state-default">\
                                <section class="dragField">\
                                    <header class="main-box-header dragHeader clearfix">\
                                        <h2 class="pull-left">Process</h2>\
                                        <a href="#" class="remove_process pull-right">\
                                            <i class="fa fa-times-circle fa-fw fa-lg"></i>\
                                        </a>\
                                    </header>\
                                    <div class="form-group">\
                                        <div class="col-lg-2"></div>\
                                        <div class="col-lg-7">\
                                            <div class="input-group">\
                                                <span class="input-group-addon"><i class="fa fa-reorder"></i></span>\
                                                <select name="'+process+'" class="form-control select-group" id="'+dynamicId+'">\
                                                    <option value="">--Select Process--</option>\
                                                </select>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <section class="dropItem">\
                                        <div class="form-group">\
                                            <div class="col-lg-2"></div>\
                                            <div class="col-lg-4">\
                                                <section class="check-item">\
                                                </section>\
                                            </div>\
                                            <div class="col-lg-4">\
                                                <div class="row grid span8 check-fields-sort">\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </section>\
                                </section>\
                               </li>'); //add input box
                $('#'+dynamicId).focus();

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

                $("#"+dynamicId).change(function(e){
                    var processVal = $(this).val();
                    console.log();
                    
                    $.ajax({
                        url: serverPath + "sales/products/find_checkbox/"+processVal,
                        type: "get",
                        dataType: "json",
                        success: function(data) {
                            $('.checkbox-nice1').remove();
                            $('.appendField').remove();
                            $.each(data, function(key, value) {
                                 
                                $('.check-item').append('<div class="checkbox-nice1">\
                                                        <input id="checkbox-inl-1" class="check-fields" data-name="'+value.SubProcess.name+'" type="checkbox">\
                                                        <label for="checkbox-inl-1"> '+value.SubProcess.name+' </label>\
                                                    </div>');

                            }); 

                            //checkbox trigger
                            $("body").on('change','.check-fields', function(e){

                                var checkFieldName = "data[Specification]["+$(this).attr('data-name')+"]";
                                var checkFieldNameval = $(this).attr('data-name');
                                checkFieldNameNoSpace = checkFieldNameval.replace(/\s+/g, "-");
                                //$('.appendField').remove();
                                if ($(this).is(":checked")) {
                                    console.log(checkFieldNameval);
                                    // $('.check-fields-sort').append('<div class="well span2 tile appendField" id="'+checkFieldNameNoSpace+'">\
                                    //                                     <div class="input-group">\
                                    //                                         <span class="input-group-addon">\
                                    //                                             <i class="fa fa-reorder"></i>\
                                    //                                         </span>\
                                    //                                         <input type="text" name="'+checkFieldName+'" value="'+checkFieldNameval+'" class="form-control" readonly />\
                                    //                                     </div>\
                                    //                                 </div>');
                                } else {  

                                    $('#'+checkFieldNameNoSpace).remove();
                                    
                                }
                                
                            });
                              
                        }
                    });

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


function previous(){  
  
    var new_page = parseInt($('.current_page').val()) - 1;  
    //if there is an item before the current active link run the function  
    if($('.active_page').prev('.page_link').length==true){  
        go_to_page(new_page);  
    }  
  
}  
  
function next(){  
    
    var new_page = parseInt($('.current_page').val()) + 1; 
   
    //if there is an item after the current active link run the function  
    if($('.active_page').next('.page_link').length==true){  
        go_to_page(new_page);  
    }  
  
}  
function go_to_page(page_num){  
    //get the number of items shown per page  
    var show_per_page = parseInt($('.show_per_page').val());  
  
    //get the element number where to start the slice from  
    start_from = page_num * show_per_page;  
  
    //get the element number where to end the slice  
    end_on = start_from + show_per_page;  
  
    //hide all children elements of content div, get specific items and show them  
    $('.tableProduct'+dynamicId).children().css('display', 'none').slice(start_from, end_on).css('display', 'block');  
  
    /*get the page link that has longdesc attribute of the current page and add active_page class to it 
    and remove that class from previously active page link*/  
    $('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');  
  
    //update the current page input field  
    $('.current_page').val(page_num);  
} 