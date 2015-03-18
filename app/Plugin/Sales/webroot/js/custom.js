jQuery(function($) {
    $('#datepickerDate').datepicker({
          format: 'mm-dd-yyyy'
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