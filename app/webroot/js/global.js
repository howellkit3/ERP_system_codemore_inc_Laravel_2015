// function validateForm($form)
// {
//     var validator = $( "#CompanyAddForm" ).validate();
//     validator.form();
// }


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

function cloneData(whatSection, thisElement)
{   
    var parentSection = $(thisElement).parents('.' + whatSection);
    var data = $(parentSection).first().clone();
    data.find('.remove').show();
    data = fieldReset(data, whatSection);
    $('.' + whatSection).last().after(data);
    // $('.remove').show();

    if ($('.remove').length == 1) $('.remove').hide();
    
}

function cloneInputTable(whatSection, thisElement) {

    var data =  $('.'+whatSection).last().clone();
    var buttons = $('.'+whatSection).next().last().clone();
    data = fieldReset(data, whatSection);
    $('.'+whatSection).parents('table').append(data).append(buttons);

    //datepicker
    $('.datepick').datepicker({'refresh' : true , format: 'yyyy-mm-dd'});

}
function removeCloneInputTable(whatSection)
{   
     $('.' + whatSection).last().remove();
     $('.' + whatSection).next().last().remove();  
}
function removeClone(whatSection)
{   
     $('.' + whatSection).last().remove(); 
}

function fieldResetContact($form, section)
{
    var count = $('.' + section).length;
   
    $form.find('select, input, textarea').each(function() {
        var $this = $(this),
            nameProp = $this.prop('name'),
            type = $this.prop('type'),
            origIndex = count-1,
            newIndex = count;
        if(type == "text")
        {
            $this.val('');
        }

        $this.prop('name', nameProp.replace(/\[(\d+)\]/g, function(str,p1){
          
            console.log(nameProp);
            // if(this is second occurence)
            //     then
                    return '[' + (count) + ']'
            // endIf
        }));
        //$this.prop('name', nameProp.replace("[0]", "[" + newIndex + "]"));
        //$this.prop('name', nameProp.replace("[0]",function(str,p1){return '[' + newIndex + ']'}));
        //console.log(nameProp);
    });
    
    return $form;

        //$this.prop('name', nameProp.replace(/\[(\d+)\]$/,function(str,p1){ return '[' + newIndex + ']'; }));
      
}

function cloneContactData(whatSection, thisElement)
{
    var parentSection = $(thisElement).parents('.' + whatSection);

    var data = $(parentSection).first().clone();
     data.find('.remove-field.btn.btn-danger.remove').show();
    data.find('.remove-field.btn.btn-danger').show();
    data = fieldResetContact(data, whatSection);
    $('.' + whatSection).last().after(data);
}
function cloneInquiry(whatSection, thisElement)
{   
    //var parentSection = $(thisElement).parents('.' + whatSection);
    //console.log(parentSection);
    var data = $('.' + whatSection).first().clone();
    data = fieldResetContact(data, whatSection);
    $('.' + whatSection).last().after(data);
}

