jQuery(function($){
    $('.approvedLeave').click(function () {
        //var data1 = 1;
        var data = $(this).attr('data');
        
        swal({
            title: "Are you sure?",
            text: "You want to approve this Leave ",
            type: "warning",
            showCancelButton: true,
            timer: 2000,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, approve it!",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false 
        },
        function (isConfirm) {

            if (isConfirm) {

                $.ajax({
                    url: serverPath + "human_resource/leaves/approved/"+data,
                    type: "POST",
                    data: {
                        "id": data,
                    },

                    success: function(data) {
                        swal("Successful!","Leave approved.", "success");
                        location.reload(true);
                        //console.log(data);                   
                    }

                });

            } else {
                swal("Cancelled", "Transaction error.", "error");
            }
        });
    });
    
});