$(function($) {
    $("#hint").autocomplete({                        
        source:'/koufu_system/sales/quotations/ajax_search', 
        minLength:1                  
    });   
});     