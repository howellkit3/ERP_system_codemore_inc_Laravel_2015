function cloneDatarequest(whatSection, thisElement)
{      
    var parentSection = $(thisElement).parents('.' + whatSection);
    var data = $(parentSection).first().clone();
    data.find('.remove').show();
    modal_length = parseInt($('.modal-button').length);
   
   console.log(modal_length);
    data = fieldReset(data, whatSection);
    data.find('.modal-button').attr('data-modal',modal_length + 1);
    $('.' + whatSection).last().after(data);

    
    // $('.remove').show();

    if ($('.remove').length == 1) $('.remove').hide();
    $('.datepick').datepicker({
        format: 'yyyy-mm-dd'
    });
    
}
function fieldReset($form, section)
{

    var count = $('.' + section).length;
    
    // jQuery('.addressSection').addClass('io-'+count);
  
    $form.find('select, input,checkbox').each(function() {

        var $this = $(this),
            nameProp = $this.prop('name'),
            newIndex = count;
            type = $this.prop('type');
        if(type == "text")
        {
            $this.val('');
        }
         if(type == "checkbox")
        {
             $this.prop('checked', false);
        }
        //$this.prop('name', nameProp.replace("[0]", "[" + newIndex + "]"));
        $this.prop('name', nameProp.replace(/\[(\d+)\]/, function(str,p1){
            return '[' + (count) + ']'
        }));
         
       

    });
    
    return $form;
}


jQuery(document).ready(function($){
    var itemGroup = '';
    var counterData = 0;
    var dynamicId = "ItemGroup"+counterData;
    
    $("body").on('click','.modal-button', function(e){
        var modal = $(this).attr('href');
        var item =  $(this).data('modal');
        $(modal).attr('data-item',item);
    });
                
    $("body").on('change','.ItemGroup', function(e){

         //var counterData = parseInt($(this).attr('data'));
         
        // alert(counterData);
        itemGroup = $(this).val();

        var getCounter = $('.get-counter').val();
        //alert(itemGroup);
        // $('#itemGroup'+dynamicId).attr('value',itemGroup);
        // itemG = itemGroup;
        if(itemGroup == 0){
            
            $('.searchItem').attr('disabled',true);

        }else{

            $('.searchItem').attr('disabled',false);

            $.ajax({
                type: "GET",
                url: serverPath + "purchasing/requests/item_details/"+itemGroup+"/"+getCounter,
                dataType: "html",
                success: function(groupdata) {
                    
                    $('.tableProduct').html(groupdata); 

                    $("body").on('change','.selectSpecProduct', function(e){

                        $recentItem = $('#myModalItem').attr('data-item');

                         console.log($recentItem);

                    $parent = $("[data-modal="+$recentItem+"]").parent().parent();
                        
                        console.log($parent);
                        var idHolder = $(this).attr('data-holder');
                        var partName = $(this).val();
                        var itemModel = $(this).attr('name');
                        
                        var itemName = $(this).attr('data-name');
                        
                        if ($(this).is(":checked")) {
                           
                            $('.item_model').val(itemModel);
                            $parent.find('.item_name').val(itemName);
                            $('.item_id').val(partName);
                            $( '.close' ).trigger( 'click' );
                        }

                    });
                    
                }
            });
        }

    });
});