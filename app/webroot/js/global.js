
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
        $(nameProp).removeProp("name");
        console.log(nameProp);
        $this.prop('name', nameProp.replace("[0]", "[" + newIndex + "]"));
        //console.log(nameProp);
    });

    return $form;
}

function cloneData(whatSection, thisElement)
{
    
    var parentSection = $(thisElement).parents('.' + whatSection);

    //console.log($(parentSection).attr('class'));

    var data = $(parentSection).first().clone();
    data = fieldReset(data, whatSection);
    $('.' + whatSection).last().after(data);
}

function removeClone(whatSection)
{   
     $('.' + whatSection).last().remove(); 
   
}

function fieldResetArray($form, section)
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
        console.log(nameProp);
    });

    return $form;
}

function cloneDataArray(whatSection, thisElement)
{
    
    var parentSection = $(thisElement).parents('.' + whatSection);

    //console.log($(parentSection).attr('class'));

    var data = $(parentSection).first().clone();
    data = fieldResetArray(data, whatSection);
    $('.' + whatSection).last().after(data);
}

// $(document).ready(function() {
//     $('.add-field').click(counter);
// });

// counter = function() {
//     var value = $('#text').val();

//     if (value.length == 0) {
//         $('#wordCount').html(0);
//         return;
//     }

//     var regex = /\s+/gi;
//     var wordCount = value.trim().replace(regex, ' ').split(' ').length;

//     $('#wordCount').html(wordCount);
// };
