$(document).ready(function(){  

$('#WorkShiftFrom').change(function(){
        var timeElements = $(this).val().split(":");    
        var theHour = parseInt(timeElements[0]);
        var theMintute = timeElements[1];
        var newHour = theHour + 9;
        if (newHour > 24) {
            newHour = 0 + (newHour - 24);
        }
        $('#WorkShiftTo').val(newHour + ":" + theMintute+ ':00');

});    
$('.timepicker').timepicker({
    minuteStep: 5,
    showSeconds: true,
    showMeridian: false,
    disableFocus: false,
    showWidget: true
}).focus(function() {
    $(this).next().trigger('click');
});


$('.modal-content').hide();


var selectvalue = $('select').val();

$('select').click(function(){

    $modal = $(this).data('modal');

    $($modal).modal('show');

    $($modal+" .modal-content").show();

});
//tools
$body.on('click','.submit_breaktime',function(e){

	$modal = $(this);

	$name = $('#ToolsName').val();

    $ids = [];
    $append = '<ol>';

    $('.breaktime-checkbox:checked').each(function(){

        var name = $(this).next().text();
        var time = $(this).parents('.parent_li').find('.time').text();
        var id = $(this).val();

        $append += '<li> <i class="icon" data-id="'+id+'">X</i>'+name+' - ' + time +'</li>';

        $ids.push(id);

    });

    $('.selected_breaks').attr('style','display:block');

    $('#breakTimeIds').val($ids);

    $append += '</ol>';

    $('.selected_breaks .append').html($append);

	e.preventDefault();
})
.on('click','.selected_breaks .icon',function(){

        $(this).parent().remove();
        $remove_item = $(this).data('id');
        $category_selected = $('#breakTimeIds').val();
        $toArray = $category_selected.split(",");

        $categories = [];
        $.each($toArray,function(number,value){
            if (value != $remove_item) {
                $categories.push(value);
            }
         });
        $('#breakTimeIds').val($categories);

        if ($('.append li').length < 1) {
            $('.selected_breaks').attr('style','display:none');
        }


})
.on('click','button.tool_select',function(e){

	$('#selectTool').empty();

	   var tool_id = $(this).data('id');

	   var name = $(this).parents('tbody').find('.employee').text();

	   $append = $('<option/>').text(name).val(tool_id);

	   $('#selectTool').append($append);
       // return false;

});

});

