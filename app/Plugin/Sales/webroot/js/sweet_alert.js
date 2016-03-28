jQuery(function($){




    $('.approvedQuotation').click(function () {
        //var data1 = 1;
        var data = $(this).attr('data');
        
        swal({
            title: "Are you sure?",
            text: "You want to approve this Quotation ",
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
                    url: serverPath + "sales/quotations/approved/"+data,
                    type: "POST",
                    data: {
                        "id": data,
                    },

                    success: function(data) {
                        swal("Successful!","Quotation approved.", "success");
                        location.reload(true);
                        //console.log(data);                   
                    }

                });

            } else {
                swal("Cancelled", "Transaction error.", "error");
            }
        });
    });
    
    $('.terminateQuotation').click(function () {
        //var data1 = 1;
        var data = $(this).attr('data');
        var datauuid = $(this).attr('data-uuid');
        
        swal({
            title: "Are you sure?",
            text: "You want to terminate this Quotation ",
            type: "warning",
            showCancelButton: true,
            timer: 2000,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, terminate it!",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false 
        },
        function (isConfirm) {

            if (isConfirm) {

                $.ajax({
                    url: serverPath + "sales/quotations/terminated/"+data,
                    type: "POST",
                    data: {
                        "id": data,
                    },

                    success: function(data) {
                        swal("Successful!","Quotation terminated.", "success");
                        location.reload(true);
                        //console.log(data);                   
                    }

                });

            } else {
                swal("Cancelled", "Transaction error", "error");
            }
        });
    });
});