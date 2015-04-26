//add and sorting js bienskie

$(document).ready(function() {

   $(".label-section").hide();
   $(".part-draggable-section").hide();
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $("#sortable"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
  
    var x = 1; //initlal text box count
        
    $(add_button).click(function(e){ //on add input button click

        $(".label-section").show();
        var countername = parseInt($(this).attr('data'));
        var varCounter = countername + 1;
        $(this).attr('data',parseInt(varCounter));
        var nameArray = $(this).parents('ul.sortable').find('li.ui-state-default').size();
        
        var realName = "speclabel["+countername+"]";
        e.preventDefault();

        if(x < max_fields){ //max input box allowed

            x++; //text box increment

           $(wrapper).append('<li class="ui-state-default"><section id="addlabelField"><div class="form-group"><div class="col-lg-8"><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="'+realName+'" class="form-control" type="text"></div></div><div class="col-lg-2"><a href="#" class="remove_field">Remove</a></div></div></section></li>'); //add input box
           
        }

    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        var countername = parseInt($(".add_field_button").attr('data'));
        console.log(countername);
        
        var varCounter = countername - 1;
        if(varCounter == 0){
            $(".label-section").hide();
        }
        $(".add_field_button").attr('data', varCounter);
        e.preventDefault(); $(this).parents('li.ui-state-default').remove(); x--;
    });

    //sorting fields
    $( "#sortable" ).sortable();
    //$( "#sortable" ).disableSelection();

    //parts section
    $(".add_part_button").click(function(e){
        $(".part-draggable-section").show();
    });


    $(".dropItem").hide();
    $("#ProductItemGroup").change(function(e){
        var itemGroup = $(this).val();
         
        if(itemGroup != undefined ){
            $(".dropItem").show();
        }
        if (!itemGroup) {
            $(".dropItem").hide();
        };
         
        $.ajax({
            url: serverPath + "sales/products/find_dropdown/"+itemGroup,
            type: "get",
            dataType: "json",
            success: function(data) {

                $.each(data, function(key, value) {
                     $('#itemType')
                         .append($("<option></option>")
                         .attr("value",key)
                         .text(value));
                });     
            }
        }); 
      
    });
});