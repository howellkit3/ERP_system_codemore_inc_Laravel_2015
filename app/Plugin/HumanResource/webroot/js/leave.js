$(document).ready(function(){  

    // $('.from-date-range').datepicker({
    //     onSelect: function(dateText) {
    //         console.log(this.value);
    //     }
    // });

    $('body').on('change','.from-date-range',function(e){

        var thisMe = $(this).val();

        var plusDay = $('.dayrange').val(); 

        $('.date-to-range').attr('min',thisMe); 

        $.ajax({
            type: "GET",
            url: serverPath + "human_resource/leaves/getmaxdate/"+thisMe+"/"+plusDay,
            dataType: "json",
            success: function(data) {
               
                $('.date-to-range').attr('max',data ); 
                
            }
        });

    });

    $('body').on('change','#SearchEmployee',function(e){

         var thisMe = $(this).val();
         if (thisMe) {
            $('.leave-type-select').prop('disabled', false);
         }else{
            $('.leave-type-select').prop('disabled', true);
         };
    });

    $('body').on('change','.leave-type-select',function(e){

        var thisMe = $(this).val();

        var leaveID = $('.leaveID').val(); 

        $('.from-date-range').val(' '); 
        $('.date-to-range').val(' '); 

        var employeeId = $('#SearchEmployee option:selected').val(); 

        if (thisMe) {
          
            $('.date-leave').prop('readonly',false);

            $.ajax({
                type: "GET",
                url: serverPath + "human_resource/leaves/limit_hours/"+thisMe+"/"+employeeId+"/"+leaveID,
                dataType: "json",
                success: function(data) {

                    if (data.remaining == 0) {

                        $('.leave-type-select').val(''); 

                        $('.limit-hours').val(' '); 

                        $('.remaining-hours').val(' ');

                        $('.from-date-range').prop('readonly',true); 

                        $('.date-to-range').prop('readonly',true); 

                        ('.noted-range').html('Note : '+ 0 + ' Day/s');

                        alert('This Employee has no remaining hour for this type of Leave !');

                        return false;
                    }else{
                        $('.from-date-range').prop('readonly',false); 

                        $('.date-to-range').prop('readonly',false); 
                    };
                   
                    $('.limit-hours').val(data.limit); 

                    $('.remaining-hours').val(data.remaining); 

                    $('.dayrange').val(data.plus_day); 

                    $('.noted-range').html('Note : '+ data.plus_day + ' Day/s');
                    
                }
            });

        }else{
           
            $('.date-leave').prop('readonly',true);
            $('.date-leave').val(' ');
        };
        
       
    });
});
