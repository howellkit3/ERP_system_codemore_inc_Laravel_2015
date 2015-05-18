//add and sorting js bienskie
function test(){

}

$(document).ready(function() {

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

           $(wrapper).append('<li class="ui-state-default"><section class="dragField"><div class="form-group"><div class="col-lg-2"></div><div class="col-lg-7"><div class="input-group"><span class="input-group-addon"><i class="fa fa-reorder"></i></span><input name="'+realName+'" class="form-control" type="text"></div></div><div class="col-lg-2"><a href="#" class="remove_field">Remove</a></div></div></section></li>'); //add input box
           
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
                                    <div class="form-group">\
                                        <div class="col-lg-2"></div>\
                                        <div class="col-lg-1">Material</div>\
                                        <div class="col-lg-6">\
                                            <button type="button"data-toggle="modal" href="#myModal'+varCounter+'" class="btn btn-primary">\
                                            <i class="fa fa-plus-circle fa-lg"></i> Select Material</button>\
                                        </div>\
                                        <div class="col-lg-2">\
                                            <a href="#" class="remove_part">Remove</a>\
                                        </div>\
                                    </div>\
                                    <div class="form-group">\
                                        <div class="col-lg-2"></div>\
                                        <div class="col-lg-1">Part</div>\
                                        <div class="col-lg-6">\
                                            <input type="text" class="form-control" name="part'+varCounter+'" />\
                                        </div>\
                                    </div>\
                                    <div class="form-group">\
                                        <div class="col-lg-2"></div>\
                                        <div class="col-lg-1">Part Name</div>\
                                        <div class="col-lg-6">\
                                            <input type="text" class="form-control part_name'+varCounter+'" name="part_name" />\
                                        </div>\
                                    </div>\
                                    <div class="form-group">\
                                        <div class="col-lg-2"></div>\
                                        <div class="col-lg-1">Rate</div>\
                                        <div class="col-lg-6">\
                                            <input type="text" class="form-control" name="rate'+varCounter+'" />\
                                        </div>\
                                    </div>\
                                    <div class="form-group">\
                                        <div class="col-lg-2"></div>\
                                        <div class="col-lg-1">Size</div>\
                                        <div class="col-lg-2">\
                                            <input type="text" class="form-control" name="size'+varCounter+'" />\
                                        </div>\
                                        <div class="col-lg-1 sizeWith">mm x</div>\
                                        <div class="col-lg-2">\
                                            <input type="text" class="form-control" name="size_1'+varCounter+'" />\
                                        </div>\
                                    </div>\
                                    <div class="form-group">\
                                        <div class="col-lg-2"></div>\
                                        <div class="col-lg-1">Quantity</div>\
                                        <div class="col-lg-2">\
                                            <input type="text" value="'+quantitySpec+'" class="form-control quantity'+varCounter+'" name="quantity'+varCounter+'" readonly />\
                                        </div>\
                                        <div class="col-lg-2">\
                                            <select class="form-control dropUnit" name="quantity_unit'+varCounter+'" />\
                                                <option value=""></option>\
                                            </select>\
                                        </div>\
                                        <div class="col-lg-1">Paper Qty</div>\
                                        <div class="col-lg-1">\
                                            <input type="text" value="'+quantitySpec+'" class="form-control paper_qty'+varCounter+'" name="paper_qty'+varCounter+'" readonly />\
                                        </div>\
                                    </div>\
                                    <div class="form-group">\
                                        <div class="col-lg-2"></div>\
                                        <div class="col-lg-1">Color</div>\
                                        <div class="col-lg-6">\
                                            <input type="text" class="form-control" name="color'+varCounter+'" />\
                                        </div>\
                                    </div>\
                                    <div class="form-group">\
                                        <div class="col-lg-2"></div>\
                                        <div class="col-lg-1">Outs</div>\
                                        <div class="col-lg-2">\
                                            <input type="text" value="1" class="form-control number outs'+varCounter+'" name="outs'+varCounter+'"/>\
                                        </div>\
                                        <div class="col-lg-1 sizeWith">x</div>\
                                        <div class="col-lg-2">\
                                            <input type="text" value="1" class="form-control" name="outs_1'+varCounter+'" />\
                                        </div>\
                                    </div>\
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
                                                            <table class="table table-striped table-hover">\
                                                                <thead>\
                                                                    <tr>\
                                                                        <th><a href="#"><span>Select</span></a></th>\
                                                                        <th><a href="#"><span>Item Number</span></a></th>\
                                                                        <th><a href="#"><span>Name</span></a></th>\
                                                                    </tr>\
                                                                </thead>\
                                                                <tbody class="tableProduct'+dynamicId+'" aria-relevant="all" aria-live="polite" role="alert" >\
                                                                </tbody>\
                                                            </table>\
                                                        </div>\
                                                        <hr>\
                                                        <div class="form-group">\
                                                            <div class="col-lg-10"></div>\
                                                            <div class="col-lg-2">\
                                                                <button type="button" class="btn btn-primary">\
                                                                <i class="fa fa-thumbs-o-up"></i> Pick Item</button>\
                                                            </div>\
                                                        </div>\
                                                    </section>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </section>\
                               </li>'); //add input box
            
             //quantity unit data
            $.ajax({
                url: serverPath + "sales/products/unit_dropdown",
                type: "get",
                dataType: "json",
                success: function(data) {

                    $('.dropUnit').append($("<option></option>").attr("value",0).text("-Select Unit-"));

                    $.each(data, function(key, value) {
                                  
                        $('.dropUnit')
                             .append($("<option></option>")
                             .attr("value",value.Unit.id)
                             .text(value.Unit.unit));
                       
                    });
                }
            });

            //computation for outs and paper quantity
            $("body").on('keyup','.outs'+varCounter, function(e){

                var outsval = $(this).val();
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

            //FILTER FIELD
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
                                                //console.log(partName);
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
                                        <div class="col-lg-2">\
                                            <a href="#" class="remove_process">Remove</a>\
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
                    $('.checkbox-nice1').remove();
                    $('.appendField').remove();
                    $.ajax({
                        url: serverPath + "sales/products/find_checkbox/"+processVal,
                        type: "get",
                        dataType: "json",
                        success: function(data) {
                           
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
                                $('.appendField').remove();
                                if ($(this).is(":checked")) {
                                    //console.log(checkFieldNameval);
                                    $('.check-fields-sort').append('<div class="well span2 tile" class="appendField" id="'+checkFieldNameNoSpace+'">\
                                                                        <div class="input-group">\
                                                                            <span class="input-group-addon">\
                                                                                <i class="fa fa-reorder"></i>\
                                                                            </span>\
                                                                            <input type="text" name="'+checkFieldName+'" value="'+checkFieldNameval+'" class="form-control" readonly />\
                                                                        </div>\
                                                                    </div>');
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

//backup
// <input type="text" name="itemGroup" value="0" id="itemGroup'+dynamicId+'" />\
// <input type="text" name="itemGroupCategory" value="0" id="itemGroupCategory'+dynamicId+'" />\
// <input type="text" name="itemGroupType" value="0" id="itemGroupType'+dynamicId+'" />\