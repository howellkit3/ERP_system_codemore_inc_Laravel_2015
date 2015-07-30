function readURL(input,element) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

            $('.'+element).attr('style','background:url('+ e.target.result +')')

        }

        reader.readAsDataURL(input.files[0]);
    }
}
var checkexistingDept = function(thisElement){

    $('.dynamic-input').remove();

    $('.appended-error').remove();


    $this = $(thisElement);

    $employee_id = $(thisElement).val();

    $.ajax({
        type: "GET",
        url: serverPath + "human_resource/timekeeps/findExisting/"+$employee_id,
        dataType: "json",
        success: function(data) {
           
           $this.append($('<input class="dynamic-input"/>').attr('name','data[Attendance][id]').attr('value',data.id));
            //$modal.find('#result_container').html(data);

            $('.radio input').attr('disabled',false);

            if (data.type == 'in'){

                $('#categoryRadio1').attr('disabled',true).next().text('Time-In: '+data.time);
                $('#categoryRadio2').click();
            } else {
                $('#categoryRadio2').attr('checked',false);
                $('#categoryRadio1').click().attr('disabled',false).next().text('In')

            }


        }
    });

}

$(document).ready(function(){

$body = $('body');


$body.on('click','.btn.btn-success.upload-image',function(e){

    $('.image_profile input').click();

    e.preventDefault();
});

$( ".datepick" ).datepicker({
    format: 'yyyy-mm-dd', 
    changeYear: true,
    changeMonth: true,
    showMonthAfterYear: true, //this is what you are looking for
});

$(".autocomplete").select2();
//$('.datepick').datepicker({  format: 'yyyy-mm-dd'  });


});
