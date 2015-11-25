$(document).ready(function(){ 

    $('body').on('click','#TicketProcessScheduleViewForm .btn-success',function(e){

      $this = $(this);


      $this.parents('form').submit(function(e){

      

        if ($this.parents('form').find('.error:visible').length > 0) {

        } else {

         $processName = $this.parents('.panel-default').find('.panel-heading a').text();

         $processName = $processName.trim();

         $productionDate = $this.parents('form').find('input[name="data[TicketProcessSchedule][production_date]"]').val();

         $process = $this.parents('form').find('select[name="data[TicketProcessSchedule][department_process_id]"] option:selected');

         $machines  = $this.parents('form').find('select[name="data[TicketProcessSchedule][machine_id]"] option:selected');

         $notes  = $this.parents('form').find('textarea[name="data[TicketProcessSchedule][remarks]"]').val();

         $operator = $this.parents('form').find('select[name="data[TicketProcessSchedule][operator]"] option:selected');


         if ( $machines.val() != '') {
            $machines =  $machines.text();
         } else {
            $machines = '';
         }
        
        if ( $process.val() != '') {
            $process = $process.text();
         } else {
            $process = '';
         }
         if ( $operator.val() != '') {
            $operator = $operator.text();
         } else {
            $operator = '';
         }

        swal({   
            title: $processName ,   
            text: "Production Date : "+ $productionDate +" \n Process : "+ $process +" \n Machine : "+ $machines +" \n Notes : "+  $notes +" \n Operator : "+  $operator  +"",   
            type: "info",
            showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, 
        }, function(){   

                $url = $this.parents('form').attr('action');

                  $.ajax({
                    type: "POST",
                    url: $url,
                    data : $this.parents('form').serialize(),
                    dataType: "json",
                    success: function(data) {  

                        if (data == 1) {

                                 swal("Process Set Succefully");  
                        }

                    },
                    error:function(data){

                    }
                });
            });

        }
     

        e.preventDefault();
      });

   


     //   });

       // e.preventDefault();

    });
   


    $('.datepicker').datepicker({
       format: 'yyyy-mm-dd'
    });

    $('.timepicker').timepicker({
            minuteStep: 5,
            showSeconds: true,
            showMeridian: false,
            disableFocus: false,
            showWidget: true,
            template: 'modal'
        }).focus(function() {
            $(this).next().trigger('click');
        });

        
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

    $('body').on('change','.select_process',function(e){

        var thisMe = $(this);

        var thisVal = $(this).val();

        $('.load').remove();

        $container = thisMe.parents('.parent-collapse');


       thisMe.after('<img class="load" src="'+serverPath+'/img/loader.gif"/>');

        $.ajax({
            type: "GET",
            url: serverPath + "production/machines/getMachineData/"+thisVal,
            dataType: "json",
            success: function(data) {
                    
                 $container.find(".machine_data").empty();
                $container.find('.machine_data').append('<option value="">-- Select Machine --</option>');

                $.each(data, function(key, value) { 
                    //console.log(value);
                    //if (value.Machine.id == selected) {
                        $option = "<option class='option-append' value="+value.Machine.id+">"+value.Machine.no+"</option>";    
                    //} else {
                    //$option = "<option class='option-append'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
                   // }
                     $container.find('.machine_data').append($option);
                });  
                $('.load').remove();       
        }
        });

        e.preventDefault();

    });

});