$(document).ready(function(){ 

	$('body').on('submit','#updateMachineSchedule',function(e){

        $url = $(this).attr('action');

        $.ajax({
            type: "POST",
            url: $url,
            data : $(this).serialize(),
            dataType: "json",
            success: function(data) {  

                $parent = $('.parent-div-'+data.JobTicket.id);
                
                $parent.find('.status-append').html('<span class="label label-success">data.JobTicket.id</span>');
               
                $('.close').click();

            },
            error:function(data){

            }
        });

        e.preventDefault();
    });

	$('body').on('click','.remove-section',function(e){

        $(this).parents('.data-section').remove();

    });

    $('body').on('click','.close-modal',function(e){

        $('.close').click();

    });

    $('body').on('click','.view_full_ticket_details.table-link',function(e){

        $append_cont = $('#ticketDataFullDetails .result_append');

        $append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');

        //$('#personalAttendance').modal('open');

        $this =  $(this);

        var url = $this.data('url');
        
        var attendance_id = $this.data('id');

        $.ajax({
            type: "GET",
            url: serverPath+'production'+url,
            dataType: "html",
            success: function(data) {
               
                $append_cont.html(data);
 
            }
        });

        e.preventDefault();
    });

    $('body').on('change','.departmentProcess',function(e){

        var thisMe = $(this);

        var thisVal = $(this).val();

        $.ajax({
            type: "GET",
            url: serverPath + "production/machines/getMachineData/"+thisVal,
            dataType: "json",
            success: function(data) {
                
                thisMe.parents('.process-layer').find(".machine-append [value]").remove();
                thisMe.parents('.process-layer').find('.machine-append').append('<option value="">-- Select Machine --</option>');

                $.each(data, function(key, value) { 
                    //console.log(value);
                    //if (value.Machine.id == selected) {
                        $option = "<option class='option-append' value="+value.Machine.id+">"+value.Machine.no+"</option>";    
                    //} else {
                    //$option = "<option class='option-append'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
                   // }
                    thisMe.parents('.process-layer').find('.machine-append').append($option);
                });         
        }
        });

        e.preventDefault();

    });

});