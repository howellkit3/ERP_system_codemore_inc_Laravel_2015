// $('.multi-field-wrapper').each(function() {
     
//     var $wrapper = $('.multi-fields', this);
    
//     $(".add-field", $(this)).click(function(e) {
    	 
//         $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
   
//     });

//     $('.multi-field .remove-field', $wrapper).click(function() {
//         if ($('.multi-field', $wrapper).length > 1)
//             $(this).parents('.multi-field').remove();
//     });
// });


/*    var count=1;
    var model = $(this).data('model');

    $(".add-field", $(this)).click(function(e){

        console.log(e);

        $cloneParent = $(this).parents('.cloneMe');
        
        $cloneParent.clone().insertAfter($cloneParent).attr("class","cloneMe" + count);
       
        $($cloneParent  + count + " :input").each(function(){
            $field = $(this).attr('alt');
            $(this).attr("name",'data['+model+']['+count+"]["+$field+"]");

            $(this).attr("id",$(this).attr("id") + count);
            });

        $(".remove-field" + count,$(this)).click(function(e){
            $(this).parents('.cloneMe').remove();
            //$(this).closest("div").remove();
        });

         count++;
    }); 
*/

function fieldReset($form, section)
{
    var count = $('.' + section).length;

    $form.find('select, input').each(function() {
        var $this = $(this),
            nameProp = $this.prop('name'),
            type = $this.prop('type'),
            origIndex = count-1,
            newIndex = count;
        if(type == "text")
        {
            $this.val('');
        }
        $this.prop('name', nameProp.replace("[0]", "[" + newIndex + "]"));
    });

    return $form;
}

function cloneData(whatSection)
{
    var data = $('.' + whatSection).first().clone();
    data = fieldReset(data, whatSection);
    $('.' + whatSection).last().after(data);
}