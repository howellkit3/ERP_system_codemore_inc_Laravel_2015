function ajaxCallSearchDepartment(inputSearch){

    $.ajax({
        type: "GET",
        url: serverPath + "human_resource/departments/search?department="+inputSearch,
        dataType: "html",
        success: function(data) {
           
            if(data){
                $('.append-table-department').html(data); 
            }else{
                $('.append-table-department').html('<font color="red"><b>No result..</b></font>'); 
            }
            
        }
    });

}

$(document).ready(function(){

    $('body').on('keyup','.searchDepartment',function(e){
       
        var inputSearch = $(this).val();
        //ajax function to search
        ajaxCallSearchDepartment(inputSearch);
       


    });


});