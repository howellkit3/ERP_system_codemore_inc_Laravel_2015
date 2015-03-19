jQuery(function($) {

    $('#generatedPoNumber').hide();
    $('#back').hide();
    $('#checkBack').hide();
    $('#datepickerDate').datepicker({
          format: 'mm/dd/yyyy'
    });

  $.ajax({
    url: serverPath + "sales/create_order/get_quotation_options",
    type: "POST",
     data: {"position": "1", "quotation": $("#quotationId").val()},
    //dataType: "json",
    success: function(data) {
            console.log(data);
            //alert(data);
            $("#quotations").html(data);

        }
    });

  $('#checkAdd').change(function(){
        
        $("#checkBack").show();
        $("#back").show();
        $("#po_number").val($('#generatePoNumber').val());
        $("#checkAdd").hide();
        $("#add").hide();
        
    });

    $('#checkBack').change(function(){
        $("#checkBack").hide();
        $("#back").hide();
        $("#po_number").val("");
        $("#checkAdd").show();
        $("#add").show();
    });


    $('#pages').hide();
        
    $('.multi-field-wrapper').each(function() {
        var $wrapper = $('.multi-fields', this);
        $(".add-field", $(this)).click(function(e) {
            $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
        });

        $('.multi-field .remove-field', $wrapper).click(function() {
            if ($('.multi-field', $wrapper).length > 1)
                $(this).parent('.multi-field').remove();
        });

        

    });
    $("#quotation li").on("click", function(){
        $("#position").val($(this).val());
        console.log($(this).val());
        $.ajax({
        url: serverPath + "sales/create_order/get_quotation_options",
        type: "POST",
         data: {"position": $(this).val(), "quotation": $("#quotationId").val()},
        //dataType: "json",
        success: function(data) {
                console.log(data);
                //alert(data);
                $("#quotations").html(data);

            }
        });

    });


  
});
function cloneData(whatSection, thisElement)
{
    var parentSection = $(thisElement).parents('.' + whatSection);

    var data = $(parentSection).first().clone();
    console.log(data);
    data = fieldReset(data, whatSection);
    $('.' + whatSection).last().after(data);

}
function fieldReset($form, section)
{
    var count = $('.' + section).length;
    
    $form.find('select, input').each(function() {
        var $this = $(this),
            nameProp = $this.prop('name'),
            newIndex = count;
            type = $this.prop('type');
        if(type == "text")
        {
            $this.val('');
        }
        //$this.prop('name', nameProp.replace("[0]", "[" + newIndex + "]"));
        $this.prop('name', nameProp.replace(/\[(\d+)\]/, function(str,p1){
            return '[' + (count) + ']'
        }));
         
       

    });
    
    return $form;
}