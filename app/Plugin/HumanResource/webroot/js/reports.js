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


    $body.on('click','#filterEmp',function(e){

      $type = $(this).data('type');

      $container = $('#'+$type+'-result-cont');
   
      $container.html('<img src="'+serverPath+'/img/loader.gif"/>');

      $status = $('#status').val();



      $.ajax({
            type: "GET",
            url: serverPath + "human_resource/salaries/reports_filter/",
            data: { 'status' :  $status , 'type' : $type  },
            dataType: "html",
            success: function(data) {

                try {

                    $container.html(data);
                }   
                catch(e) {

                  console.loG(e);
                }

            }
        }); 
    

        e.preventDefault();

    });

    $body.on('click','#SSSReports',function(e){

      var url = $(this).attr('href');
      
      var status = $('#status').val();

      $(this).attr('href',url+'?status='+status);
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

     $body.on('click','#exportReport',function(e){

      var url = $(this).data('url');
        
      var status = $('#status').val();

      $(this).attr('href',url+'?status='+status);

    });
    
    $body.on('click','#item_type_pagination a',function(e){

      $result_cont = $(this).parents('#item_type_pagination').data('result');

      $url = $(this).attr('href');

      $( $result_cont ).html('<img class="loading" src="'+serverPath+'/img/loader.gif"/>');

       $.ajax({
            type: "GET",
            url:  $url,
            dataType: "html",
            success: function(data) {

                try {

                    $( $result_cont ).html($(data).find('#sss-result-cont').html());
                }   
                catch(e) {

                   $( $result_cont ).html('<label style="color:red">There\'s an error loading data</label>');
                  console.log(e);
                }

            }
        }); 


      e.preventDefault();
     
    });

    $body.on('click','#SSSMonthlyContribution',function(e){

      $url = serverPath+'human_resource/salaries/sss_get_contibution';

      $month = $('#tab-contribution #changeDate').val();

      $result_cont = $('#sss-contribution-result-cont'); 

      $result_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');

      $.ajax({
            type: "GET",
            url:  $url,
            data : {'month' :  $month },
            dataType: "html",
            success: function(data) {

                try {
                  
                  $result_cont.html($(data).find('#sss-result-cont').html());
                }   
                catch(e) {

                   $result_cont.html('<label style="color:red">There\'s an error loading data</label>');
                  console.log(e);
                }

            }
        }); 
    });

    $body.on('click','#SSSContributionReports',function(e){


      var url = $(this).data('url');
      
      var month = $('#tab-contribution #changeDate').val();

      $(this).attr('href',url+'?month='+month);


    });

  });