
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

function removeClone(whatSection)
{   
     $('.' + whatSection).last().remove(); 
   
}

$('#bukatutup').click(function() {
    alert("sdfadsf");
    $('#target').toggle('slow');
});