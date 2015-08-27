var init = function() {

  $('.mode_type:checked').next().click();
}
function loadSummary(){

    $month = $('#monthly #DeductionFrom').val();
      
    $amount = $('#DeductionAmount').val();

    $container = $('.computations');

    $container.html('<img src="'+serverPath+'/img/loader.gif"/>');

      $.ajax({
            type: "POST",
            url: serverPath + "human_resource/salaries/computeDeduction/",
            data: { 'range' :  $month ,'amount' :  $amount    },
            dataType: "html",
            success: function(data) {

                try {

                  $container.html(data);
                }   
                catch(e) {

                }

            }
        });

}

function loadDeduction (element){
  
    $month = $('#datepickerDateRange').val();
      
    $employee = $('#selectEmployee').val();

    $code = $('.searchEmployee').val();

    $this = $(element);

    $container = $('#result-cont');

    $container.html('<img src="'+serverPath+'/img/loader.gif"/>');
    
    $.ajax({
            type: "POST",
            url: serverPath + "human_resource/deductions/index/",
            data : {'employee_code' :  $code, 'employee_id' : $employee , 'date_range' :  $month  },
            dataType: "html",
            success: function(data) {
                try {

                  $container.html(data);
                }   
                catch(e) {

                }

            }
        });

}

init();

$(document).ready(function(){

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
      $('.mode_type').removeAttr('checked');
      $('.computations').empty();

      $('.day_type').hide().find('input').attr('disabled',false);

      $(this).prop('checked',true);

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

  $('body').on('click','.view_amortization',function(){

    $deductionId = $(this).data('id');

    $('#result_container').empty();

    $.ajax({
            type: "GET",
            url: serverPath + "human_resource/deductions/view_amortization/"+$deductionId,
            dataType: "html",
            success: function(data) {
              
              try {
                 $('#result_container').html(data);
              } catch (e) {

                console.log(e);
              }

            }
        });


  });

  $('body').on('click','.delete_Deduction',function(e){

      
    var url = $(this).attr('href');

    //$(this).attr('href',url+'?days='+range+'&&month='+month);

    swal({   title: "Delete Deduction",  
     text: "This will remove deduction info from employee. CLick OK to continue",  
     type: "info", 
     showCancelButton: true,   
     closeOnConfirm: false,   
     showLoaderOnConfirm: true, },
     function() {  
        //$(this).attr('href',url+'?days='+range+'&&month='+month);
        window.location.href =  url;
          
        var alert = $(".sweet-alert");

        var cancelButton = alert.find('.cancel');

        cancelButton.trigger("click");
      });


    e.preventDefault();



  });


  $('body').on('keyup','.searchEmployee',function(){

    loadDeduction();

  });

});