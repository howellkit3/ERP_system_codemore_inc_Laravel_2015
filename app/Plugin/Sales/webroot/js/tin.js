jQuery(function($){


 jQuery(document).ready(function($){

        //masked inputs
        $("#CompanyTin").mask("999-999-999-999");
        jQuery('.remove').hide();
        jQuery("#CompanyAddForm").validate();

    });

});