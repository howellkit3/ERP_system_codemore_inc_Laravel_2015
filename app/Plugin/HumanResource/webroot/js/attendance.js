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

	var checkexisting = function(thisElement){

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
            		$('#categoryRadio1').click().attr('disabled',false).next().text('In');

                   // $('#AttendanceNotes').val('');

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
               
            	console.log(data);

            }
        });

        return false;

	}
	

$(document).ready(function(){
    
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

            var getUrl = $(this).attr('href');

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
                format: 'yyyy-mm-dd'
            });

        $(".autocomplete").select2();


        $('form').submit(function(e){

        	$('.appended-error').remove();

        	$return = true;
        	
        	$(this).find('input.required,select.required,textare.required').each(function(){

        		if ($(this).val() == '') {

        			$(this).after('<label class="error appended-error" >This field is required.</label>');

        			$return = false;
        		}

        	});

        	if ($return == false) {

        		e.preventDefault();
        	}
            console.log($return);

        	return $return;
        });

});