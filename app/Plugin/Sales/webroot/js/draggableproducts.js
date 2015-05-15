//add and sorting js bienskie

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

        var countername = parseInt($(this).attr('data'));
        var varCounter = countername + 1;
        $(this).attr('data',parseInt(varCounter));
        var nameArray = $(this).parents('ul.sortable').find('li.ui-state-default').size();
        var dynamicId = "ItemGroup"+countername;
        var itemgroupName = "data[Specification][itemgroupName]["+countername+"]";
        var cateogry = "data[Specification][cateogry]["+countername+"]";
        var item = "data[Specification][item]["+countername+"]";
        e.preventDefault();

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
                                                    <section id="productTableInModal" style="display:none;">\
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
                                                                        <th><a href="#"><span>Item Category</span></a></th>\
                                                                        <th><a href="#"><span>Item Type</span></a></th>\
                                                                        <th><a href="#"><span>Created</span></a></th>\
                                                                    </tr>\
                                                                </thead>\
                                                                <tbody aria-relevant="all" aria-live="polite" role="alert" >\
                                                                    <tr>\
                                                                        <td>radio button</td>\
                                                                        <td>fasdfadf</td>\
                                                                        <td>fasdfsdf</td>\
                                                                        <td>fsdfsdaf</td>\
                                                                        <td>fsdfsd</td>\
                                                                    </tr>\
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

            $("#"+dynamicId).change(function(e){

                var itemGroup = $(this).val();
                $('#itemGroup'+dynamicId).attr('value',itemGroup);
                if (itemGroup == 0){ $('#productTableInModal').hide(); } else{ $('#productTableInModal').show(); }

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
            console.log();
            if($('#'+dynamicId) != 0){
                if($('.selectProductcategory'+dynamicId)){
                    if(){

                    }
                }
            }
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
                                    console.log(checkFieldNameval);
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