  $(document).ready(function(){

    $(".monthpick").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
      });


    $body = $('body');


    $body.on('click','#computeSalaries',function(e){

      $container = $('#monthly-result-cont');

      $container.html('<img src="'+serverPath+'/img/loader.gif"/>');

    	$date = $('#changeDate').val();
      
      $type = $(this).data('type');

  		if ($date != '') {

        $.ajax({
            type: "GET",
            url: serverPath + "human_resource/salaries/getSalaries/",
            data: { 'type' :  $type ,'month' :  $date , 'year' : ''  },
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

		    e.preventDefault();
    });

    $body.on('click','#SSSReports',function(e){

      var url = $(this).attr('href');
      
      var month = $('#changeDate').val();

      $(this).attr('href',url+'?month='+month);
    });
    

  });