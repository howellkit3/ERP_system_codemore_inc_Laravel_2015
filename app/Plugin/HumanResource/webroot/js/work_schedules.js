    $(document).ready(function(){
           	$('.day_type').hide();
           $('.datepick').datepicker({
                format: 'yyyy-mm-dd'
            });

           $('.monthpicker').daterangepicker({});

           $(".autocomplete").select2();

           $('#chooseType').change(function(){

           		$value = $(this).val();

           		$('.day_type').hide().attr('disabled',true);
	           	
	           	if ($value != '') {
	           	
	           			$('#'+$value).show().attr('disabled',false);
	           		
	           	}

           });
    });