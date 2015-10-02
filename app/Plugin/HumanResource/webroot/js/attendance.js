	var datetime = null,
	date = null;

	var update = function () {
		date = moment(new Date())
		datetime.val(date.format('MMMM-D-YYYY, HH:mm:ss'));
	};

	var updateTime = function(thisElement){

		    datetime = $('.time_input');
			update();
		    setInterval(update, 1000);

		    $('.item_type.autocomplete').change();
    	}
        function isEmptyObject(obj) {
          for (var key in obj) {
            if (Object.prototype.hasOwnProperty.call(obj, key)) {
              return false;
            }
          }
          return true;
        }
	var checkexisting = function(thisElement,date){

		$('.dynamic-input').remove();

        $('.appended-error').remove();

		$this = $(thisElement);

		$employee_id = $(thisElement).val();

        $date = $('#datetimepickerTime').val(); //date;

        
         var url = serverPath + "human_resource/attendances/findExisting/";

        // if ($date != '' && typeof $date != 'undefined') {
        //   var url = serverPath + "human_resource/attendances/findExisting/"+$employee_id+'/'+$date;
        // } else {

        //   var url =  serverPath + "human_resource/attendances/findExisting/"+$employee_id;
        // }

	  	$.ajax({
            type: "GET",
            url: url,
            data : {'employee_id' : $employee_id , 'date' : $date},
            dataType: "json",
            success: function(data) {
               
               $this.append($('<input class="dynamic-input"/>').attr('name','data[Attendance][id]').attr('value',data.id));
            	//$modal.find('#result_container').html(data);

            	$('.radio input').attr('disabled',false);

                if (typeof(data.in) === 'undefined' || isEmptyObject(data)) {

                    $('#categoryRadio1').click().attr('disabled',false).next().text('In');
                    $('#categoryRadio1').next().text('In');
                    $('#categoryRadio2').next().text('Out');

                } else {

                     if (data.in != '' && data.in != '00:00:00' && data.in !== null){
                        
                        $('#categoryRadio1').attr('disabled',true).next().text('Time-In: '+data.in);
                        $('#categoryRadio2').click();
                    
                        
                    } else {
                        
                        $('#categoryRadio2').attr('checked',false);
                        $('#categoryRadio1').click().attr('disabled',false).next().text('In');

                    }

                    if (data.out != '' && data.out != '00:00:00' && data.out !== null) {

                        $('#categoryRadio2').attr('disabled',true).next().text('Time-out: '+data.out);

                    } else {

                        $('#categoryRadio2').attr('checked',false);
                        $('#categoryRadio1').click().attr('disabled',false).next().text('In');

                       $('#AttendanceNotes').val('');

                    } 
                }
            	


            }
        });

	}


    var getEmployeeData = function(thisElement,attendance_id){

        $('.dynamic-input').remove();

        $('.appended-error').remove();

        $this = $(thisElement);

        $append_cont = $('#timeKeepAttendance #result_container_append');

        $append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');

        $date = $('#changeDate').val();

        $date2 = $this.parents('tbody').find('.time-in').text();

        var url = serverPath + "human_resource/attendances/getEmployeeData";

        if (typeof $date2 != 'undefined') {
           $date =  $date2;
        } 

        $.ajax({
            type: "POST",
            url: url,
            data : {'attendanceId' :attendance_id, 'date' : $date.trim() },
            dataType: "html",
            success: function(data) {

                if( $append_cont.html(data) ) {

                   //  updateTime();
                }

            }
        });

    }

	var viewAttandance = function(thisElement){

		$this = $(thisElement);

		var url = $this;

		var attendance_id = $this.data('id');

	  	$.ajax({
            type: "GET",
            url: url,
            dataType: "html",
            success: function(data) {
               
            	//console.log(data);

            }
        });

        return false;

	}
	

$(document).ready(function(){
    
    
    $('body').on('click','.view_attendance.table-link',function(e){

        $append_cont = $('#personalAttendance .result_append');

        $append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');

        //$('#personalAttendance').modal('open');

        $this = $(this);

        var url = $this.data('url');

        var attendance_id = $this.data('id');

        $.ajax({
            type: "GET",
            url: serverPath+'human_resource'+url,
            dataType: "html",
            success: function(data) {
               
                $append_cont.html(data);

                    $('.datepick').datepicker({
                        format: 'yyyy-mm-dd'
                        });

                   $(".autocomplete").select2();

            }
        });

        e.preventDefault();
    });  

    $('body').on('submit','#updateTimeForm',function(e){

        $url = $(this).attr('action');

        $.ajax({
            type: "POST",
            url: $url,
            data : $(this).serialize(),
            dataType: "json",
            success: function(data) {  

                $parent = $('.parent-tr-'+data.Attendance.id);
                
                $parent.find('.time-in').text(data.Attendance.in);
                 
                 if (data.Attendance.out != null) {

                    $parent.find('.time-out').text(data.Attendance.out);
                    $parent.find('.time-out').text(data.Attendance.out);
                    
                    if (data.Attendance.duration != '') {
                        $parent.find('.duration').text(data.Attendance.duration);
                    }
                    

                 }
                
                 if (data.Attendance.status == 'OnTime') {
                    $parent.find('.attendance-status').html('<span class="label label-success">OnTime</span>');
                 };
                 if (data.Attendance.status == 'Late') {
                    $parent.find('.attendance-status').html('<span class="label label-danger">&nbsp;&emsp;&emsp;Late&emsp;&emsp;&nbsp;</span>');
                 };
                 
                 $parent.find('.notes-td').text(data.Attendance.notes);
             
                //$('button[data-dismiss="modal"]').click();    

              
                if (data.Attendance.in != '') {
                    
                    $parent.find('.add-timekeep i')
                    .removeClass('.fa-sign-in')
                    .addClass('.fa-sign-out');

                }
                
                $('.close-modal').click();

            
            },
            error:function(data){

            }
        });

        e.preventDefault();
    });

    $('body').on('click','.view_attendance.table-link',function(e){

    	$append_cont = $('#personalAttendance .result_append');

    	$append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');

    	//$('#personalAttendance').modal('open');

    	$this =  $(this);

		var url = $this.data('url');

		var attendance_id = $this.data('id');

	  	$.ajax({
            type: "GET",
            url: serverPath+'human_resource'+url,
            dataType: "html",
            success: function(data) {
               
            	$append_cont.html(data);

                	$('.datepick').datepicker({
                    	format: 'yyyy-mm-dd'
                		});

            	   $(".autocomplete").select2();

            }
        });

    	e.preventDefault();
	});	 


        $('body').on('click','.modal-pagination a',function(e) {
     
            $append_cont = $('#personalAttendance .main-box-body');


            $date = $('#changeDate').val();

            $append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');


            $.ajax({
              url:getUrl,
              type: "GET",
              success:function(data){

                $append_cont.html(data);
              }
            });

            e.preventDefault();

     });

    $('body').on('submit','#AttendanceAjaxFindForm',function(e){

    	$append_cont = $('#personalAttendance .main-box-body');

    	$append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');

    	$this =  $(this);

		var url = $this.attr('action');
        

		$.ajax({
            type: "GET",
            url: url,
            data : $this.serialize(),
            dataType: "html",
            success: function(data) {
               
            	$append_cont.html(data);

            	// $('.datepick').datepicker({
             //    	format: 'yyyy-mm-dd'
            	// 	});

            	// $(".autocomplete").select2();

            }
        });

    	e.preventDefault();
    });


     
        $('.datepick').datepicker({
            format: 'yyyy-mm-dd',
           
        });

        $(".autocomplete").select2();


        // $('form').submit(function(e){

        // 	$('.appended-error').remove();

        // 	$return = true;
        	
        // 	$(this).find('input.required,select.required,textare.required').each(function(){

        // 		if ($(this).val() == '') {

        // 			$(this).after('<label class="error appended-error" >This field is required.</label>');

        // 			$return = false;
        // 		}

        // 	});

        // 	if ($return == false) {

        // 		e.preventDefault();
        // 	}

        // 	return $return;
        // });


     $("#datetimepickerTime,#AttendanceTime").datetimepicker( {
            format:'Y-m-d H:i',
        });

        $('body').on('submit','#TimeInAttendance',function(e){

        $('.error_appended').remove();
        
        $error = 0;

        $(this).find('input.required,select.required').each(function(){
        
            if ($(this).val() == '') {

                  $(this).after('<span class="error_appended" style="color:#D5292B; position:absolute"> This field is required </span>')
                  $error++;

              }

        });

        if ($('#AttendanceEmployeeId').val() == '') {
            
            $('#s2id_AttendanceEmployeeId').after('<span class="error_appended" style="color:#D5292B; position:absolute"> This field is required </span>');
            
            e.preventDefault();
        }
        
        if ($error > 0) {
           
            e.preventDefault();
        }
        
      
      });
    
    $('body').on('change','#datetimepickerTime',function(){
        
        var date = $(this).val();

        checkexisting('#AttendanceEmployeeId',date);

    });


});