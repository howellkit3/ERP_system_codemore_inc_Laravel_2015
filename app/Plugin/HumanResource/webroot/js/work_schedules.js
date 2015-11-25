 $(document).ready(function(){
  $('.employee-department input').attr('disabled',true);

  $('.category').click(function(){

    $this = $(this);

    $('.category-section').hide();

    $('.category-'+$this.val()).show().find('input').attr('disabled',false)

  });

  $('#checkbox-check').click(function(){

     $('.select_employee:checkbox').not(this).prop('checked', this.checked);
  });
    
    $body = $('body');
    
    $('.day_type').hide();
   
    $('.datepick').datepicker({
      format: 'yyyy-mm-dd'
    });

    $('.monthpicker').daterangepicker({});

    $(".autocomplete").select2();

    $('#chooseType').change(function(){

    $value = $(this).val();

    $('.day_type').hide().find('input').attr('disabled',true);

    if ($value != '') {

     $('#'+$value).show().find('input').attr('disabled',false);

    }

    }).trigger('change');

    $('#selectEmployee').change();

    $body.on('change','#selectEmployee',function(){

      $append_cont = $('.result-cont');

      if ($(this).val() != '') {

      $append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');

        $id = $(this).val();

             $.ajax({
                type: "GET",
                url: serverPath + "human_resource/work_schedules/findByEmployeeId/"+ $id ,
                dataType: "html",
                success: function(data) {
                
                   $append_cont.html(data)

                },
                error: function(){
                }
          });
      }
    });


    $body.on('submit','#search_schedules',function(e){

      $append_cont = $('.result-cont');

      $append_cont.html('<img src="'+serverPath+'/img/loader.gif"/>');
      
        $.ajax({
                type: "GET",
                url: serverPath + "human_resource/work_schedules/search_schedules/" ,
                dataType: "html",
                data: $('#search_schedules').serialize(),
                success: function(data) {
                
                 $append_cont.html(data)

                },
                error: function(){
                }
          });

      e.preventDefault();

    });


  $body.on('change','#SearchDepartment',function(e){

      $container = $('#result_employee');

      $container.html('<img src="'+serverPath+'/img/loader.gif"/>');

        $.ajax({
                type: "GET",
                url: serverPath + "human_resource/employees/searchEmployee" ,
                dataType: "html",
                data: {'departmentId' : $('#SearchDepartment').val() },
                success: function(data) {
                   
                   try {

                      $container.html(data);

                   } catch(e) {

                        $container.html('<span class="error-appended" style="color:red">Error Loading Page</span>');
                   } 
                 //$append_cont.html(data)

                },
                error: function(){
                }
          });

      e.preventDefault();

    })


});