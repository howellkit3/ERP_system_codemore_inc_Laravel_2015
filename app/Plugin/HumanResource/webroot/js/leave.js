$(document).ready(function(){  

    $('body').on('click','.select-statusfs',function(e){

        var thisMe = $(this).val();
        $.ajax({
            type: "GET",
            url: serverPath + "human_resource/employees/search_by_department/"+DepartmentId+"/"+thisStatus+"/"+inputSearch,
            dataType: "html",
            success: function(data) {
               
                if(data){
                    $('.append-table-department').html(data); 
                }else{
                    $('.append-table-department').html('<font color="red"><b>No result..</b></font>'); 
                }
                
            }
        });
       
    });
});
