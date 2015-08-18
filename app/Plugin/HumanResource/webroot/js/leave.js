$(document).ready(function(){  

    $('body').on('change','.leave-type-select',function(e){

        var thisMe = $(this).val();
        console.log(thisMe);
        if (thisMe) {
            console.log('meron');
            $('.date-leave').prop('readonly',false);


            $.ajax({
                type: "GET",
                url: serverPath + "human_resource/leaves/limit_hours/"+thisMe,
                dataType: "json",
                success: function(data) {
                    console.log(data);

                    var addDays = data / 8;
                    console.log(addDays);
                    // if(data){
                    //     $('.append-table-department').html(data); 
                    // }else{
                    //     $('.append-table-department').html('<font color="red"><b>No result..</b></font>'); 
                    // }
                    
                }
            });

            $('.datepickerDateRange').daterangepicker({

                locale: {
                  format: 'YYYY-MM-DD'
                },
                limit : '3 days'

            });

        }else{
            console.log('wala');
            $('.date-leave').prop('readonly',true);
            $('.date-leave').val(' ');
        };
        
       
    });
});
