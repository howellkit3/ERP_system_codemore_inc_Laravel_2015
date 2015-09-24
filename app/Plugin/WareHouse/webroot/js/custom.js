function searchItem(element)  {

        $value = $(element).val();

        $select = $('#category_type').val();

        $container = $('#result-table');

        $container.html('<img src="'+serverPath+'/img/loader.gif"/>');

        $.ajax({
            type: "GET",
            url: serverPath + "ware_house/items/searchItem",
            data : {'search':$value, 'type':$select   },
            dataType: "html",
            success: function(data) {

               $container.html(data);
            }
     }); 
}


jQuery(function($){

    $('#category_type').change(function(){
        
        searchItem()
    });
     
});