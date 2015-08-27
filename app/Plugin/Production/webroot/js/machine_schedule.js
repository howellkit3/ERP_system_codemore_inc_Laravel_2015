$(document).ready(function(){ 

	$('body').on('submit','#updateMachineSchedule',function(e){

        $url = $(this).attr('action');

        console.log($url);
        console.log('ajax');

        $.ajax({
            type: "POST",
            url: $url,
            data : $(this).serialize(),
            dataType: "json",
            success: function(data) {  

                $parent = $('.parent-div-'+data.JobTicket.id);
                
                $parent.find('.status-append').html('<span class="label label-success">Sheeter / Cutting</span>');
               
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

});