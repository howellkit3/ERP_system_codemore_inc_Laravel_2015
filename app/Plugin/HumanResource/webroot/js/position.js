function ajaxCallSearchPosition(inputSearch){

    $.ajax({
        type: "GET",
        url: serverPath + "human_resource/positions/search?position="+inputSearch,
        dataType: "html",
        success: function(data) {
           
            if(data){
                $('.append-table-position').html(data); 
            }else{
                $('.append-table-position').html('<font color="red"><b>No result..</b></font>'); 
            }
            
        }
    });

}

$(document).ready(function(){

    $('body').on('keyup','.searchPosition',function(e){
       
        var inputSearch = $(this).val();
        //ajax function to search
        ajaxCallSearchPosition(inputSearch);
    
    });


});