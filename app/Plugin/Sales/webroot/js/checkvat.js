$(document).ready(function() {

    var sum = 0;
    var index = 0;
    var total = 0;
        
    function recalculate(input) {

        if(input.is( ":checked" ) == true){

            sum = input.attr("rel") * $("#QuotationField4Description").val();
            total = (sum + parseFloat($("#QuotationField4Description").val()));
            
            $("#QuotationField4Description").val(total);
        }
        
        if(input.is( ":checked" ) == false){

            $total = (parseFloat($("#QuotationField4Description").val()) - sum);
            
            $("#QuotationField4Description").val($total);
           
        }
        
    }

    $(".Vat-check").change(function() {
       if ($('#QuotationField4Description').val()==''){
            alert('Unit Price is Required.');
            $('#QuotationField4Description').focus();
            $('input[type=checkbox]:checked').attr('checked',false);

        }else{
            var input = $( this );
            recalculate(input);
        }  

    });
});