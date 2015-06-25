jQuery(function($){
    $('.approvedQuotation').click(function () {
        //var data1 = 1;
        var data = $(this).attr('data');
        console.log(data);
        swal({
            title: "Are you sure?",
            text: "You want to print the DR Summary report ",
            type: "warning",
            showCancelButton: true,
            timer: 2000,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, print it!",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false 
        },
        function (isConfirm) {

            if (isConfirm) {

                $.ajax({
                    url: serverPath + "sales/quotations/approved/"+data,
                    type: "POST",
                    data: {
                        "id": data,
                    },

                    success: function(data) {
                        swal("Successful!","Printing DR Summary report.", "success");
                        location.reload(true);
                        //console.log(data);                   
                    }

                });

            } else {
                swal("Cancelled", "Printing DR Summary report", "error");
            }
        });
    });

    
});