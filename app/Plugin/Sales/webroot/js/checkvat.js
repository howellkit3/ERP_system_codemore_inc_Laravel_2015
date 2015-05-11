function vatprice(whatsection, thisElement){
    var value = $('.' + whatsection);

    value = findValue(value, thisElement);

} 

function findValue($form, thisElement){
   
    var $unit_value = thisElement.parents('.'+$form).find('.unitprice').val();
   
    if ($unit_value == ''){
         
        alert('Unit Price is Required.');
        thisElement.parents('.'+$form).find('.unitprice').focus();
        $('input[type=checkbox]:checked').attr('checked',false);

    }else{
         
        var sum = 0;
        var index = 0;
        var total = 0;

        $("body").on('change','.checkvat', function(e){

             if ($(this).is(":checked")) {

                sum = $unit_value * .12;
                total = (sum + parseFloat($unit_value));
                $(this).parents('.quotationItemDetail').find('.vatprice').val(total);

             } else {
                total = (parseFloat($unit_value) - sum);
                $(this).parents('.quotationItemDetail').find('.vatprice').val(''); 
             }

        });

        sum = $unit_value * .12;
        total = (sum + parseFloat($unit_value));
        thisElement.parents('.'+$form).find('.vatprice').val(total);

       
    }

     
    
}
function recalculate($thisElement) {
        console.log($thisElement);
        if($('input[type=checkbox]:checked') == true){
            alert('check');
            // sum = input.attr("rel") * $("#QuotationField4Description").val();
            // total = (sum + parseFloat($("#QuotationField4Description").val()));
            
            // $("#QuotationField4Description").val(total);
        }else{
           alert('not'); 
        }
      
}


$('body').on('click','.vat-price',function(){

    thisElement = $(this);

    whatSection = $(this).data('section');

    findValue(whatSection,thisElement);

});

$('.unitprice').keypress(function(){
    console.log($(this).val());
});

$('body').on('keyup','.unitprice',function(){
    
    $parents = $(this).parents('.quotationItemDetail');
    
    if ($parents.find('.vatprice').val() != '' && $(this).val() != '') {
         findValue($(this).data('section'),$parents.find('.vat-price'));
    }

    //console.log($(this).val());
});

     // $whatsection.find('input').each(function() {
     //    alert('test');
     //    var $this = $(this),
     //        nameProp = $this.prop('name'),
     //        newIndex = count,
     //        inputVal = $this.prop('class');
     //        console.log(inputVal);
     //    if(inputVal == "unitprice")
     //    {
     //        console.log($(this).val());
     //    }
        
     

    //     var sum = 0;
    //     var index = 0;
    //     var total = 0;
  
    // });
// }
// $('body').on('click','.vatprice',function(){

//     alert($(this).attr('name'));
// });
// $(document).ready(function() {

    // var sum = 0;
    // var index = 0;
    // var total = 0;
        
    // function recalculate(input) {

    //     if(input.is( ":checked" ) == true){

    //         sum = input.attr("rel") * $("#QuotationField4Description").val();
    //         total = (sum + parseFloat($("#QuotationField4Description").val()));
            
    //         $("#QuotationField4Description").val(total);
    //     }
        
    //     if(input.is( ":checked" ) == false){

    //         $total = (parseFloat($("#QuotationField4Description").val()) - sum);
            
    //         $("#QuotationField4Description").val($total);
           
    //     }
        
    // }

    // $(".Vat-check").change(function() {

    //    if ($('#QuotationItemDetail0UnitPrice').val()==''){
    //         alert('Unit Price is Required.');
    //         $('#QuotationField4Description').focus();
    //         $('input[type=checkbox]:checked').attr('checked',false);

    //     }else{
    //         var input = $( this );
    //         recalculate(input);
    //     }  

    // });

    // $form.find('select, input, checkbox').each(function() {
    //     console.log($form);
    //     var $this = $(this),
    //         nameProp = $this.prop('name'),
    //         newIndex = count;
    //         type = $this.prop('type');
    //     if(type == "text")
    //     {
    //         $this.val('');
    //     }
    //     if(type == "checkbox")
    //     {
    //         $this.prop('checked', false);
            
    //     }
    //     //$this.prop('name', nameProp.replace("[0]", "[" + newIndex + "]"));
    //     $this.prop('name', nameProp.replace(/\[(\d+)\]/, function(str,p1){
    //         return '[' + (count) + ']'
    //     }));
         
       

    // });
// });