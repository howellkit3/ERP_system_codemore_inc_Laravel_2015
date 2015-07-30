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