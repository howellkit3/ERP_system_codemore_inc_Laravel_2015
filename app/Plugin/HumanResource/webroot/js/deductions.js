$(document).ready(function(){


function loadSummary(){


      $month = $('#monthly #DeductionFrom').val();
      
      $amount = $('#DeductionAmount').val();

     $container = $('.computations');

      $.ajax({
            type: "POST",
            url: serverPath + "human_resource/salaries/computeDeduction/",
            data: { 'range' :  $month ,'amount' :  $amount ,   },
            dataType: "json",
            success: function(data) {

                try {

                    $html = '<header class="clearfix"><h2 class="pull-left"><b>Summary</b> </h2><div class="clearfix"></div> </header><br>';

                    $html += '<table class="table table-bordered"><thead><tr><th><span>Date</span></th><th><span>Amount</span></th><th><span>Deduction</span></th></tr></thead>';
                    
                    $keys = 0;

                    $.each(data, function(id,fields) {
                      $html += '<tr><td>'+fields.date+'</td><td>'+fields.less+'</td><td>'+fields.deduction+'</td></tr>'; 

                      $keys++;    
                    });

                    $html += '</tbody></table>';

                    $html += '<input type="hidden" name="data[Deduction][pay_split]" value="'+$keys+'">';


                  $container.html($html);
                }   
                catch(e) {

                }

            }
        });

}

$('.autocomplete').select2();

$( ".datepick" ).datepicker({
   format: 'yyyy-mm-dd' 
});

 $('.datepickerDateRange').daterangepicker();
 //datepicker
        $('.datepick').datepicker({
            
            changeYear: false,
            autoClose: true,
            
        });

        $("#HolidayDate").click(function() {

            $(".datepicker-days .day").click(function() {
                $('.datepicker').hide();
            });

        });

        $('.datepickerDateRange').daterangepicker();

        $('body').on('click','.mode_type',function(e){

            $('.computations').empty();

            $('.day_type').hide().find('input').attr('disabled',false);
            if ($(this).val() == 'once') {
                $('#daily').attr('style','display:block').find('input').attr('disabled',false);
                 $('#monthly').find('input').attr('disabled',true);
            }

            if ($(this).val() == 'installment') {
                $('#monthly').attr('style','display:block').find('input').attr('disabled',false);
                $('#daily').find('input').attr('disabled',true);
            }

        }).trigger('click');


 $('body').on('keyup','#DeductionAmount',function(e){

   	 	if ($('.mode_type:checked').val() == 'installment'){
          loadSummary();  
   	 }
  });

  $('body').on('click','.ranges .applyBtn ',function(e){
  
    if ($('#DeductionAmount').val() != ''){
      loadSummary();  
    }
     
  });

});