  $(document).ready(function(){

    $(".monthpick").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
      });


    $body = $('body');


    $body.on('click','.compute_salary',function(e){


      $type = $(this).data('type');


       $container = $('#'+$type+'-result-cont');
   

      $container.html('<img src="'+serverPath+'/img/loader.gif"/>');

    	$date = $('#changeDate').val();

      $year = $('#changeDateYear').val();

        $.ajax({
            type: "GET",
            url: serverPath + "human_resource/salaries/getSalaries/",
            data: { 'type' :  $type ,'month' :  $date , 'year' : $year  },
            dataType: "html",
            success: function(data) {

                try {

                    $container.html(data);
                }   
                catch(e) {

                }

            }
        }); 
  	

		    e.preventDefault();
    });




    $body.on('click','#SSSReports',function(e){

      var url = $(this).attr('href');
      
      var month = $('#changeDate').val();

      $(this).attr('href',url+'?month='+month);
    });
    
   $body.on('click','#exportMonthlyReport',function(e){

      var url = $(this).attr('href');
      
      var month = $('#changeDate').val();

      $(this).attr('href',url+'?month='+month);
    });

  $body.on('click','#exportYearlyReport',function(e){

      var url = $(this).attr('href');
      
      var year = $('#changeDateYear').val();

      $(this).attr('href',url+'?year='+year);
    });

  });