 $(document).ready(function() {
    // $("body").on('change','.checkvat', function(e){
    //      var unit_value = parseFloat($(this).parents('.quotationItemDetail').find('.unitprice').val());
    //      var thisMe = $(this);
    //      if ($(this).is(":checked")) {
    //         console.log('check');
    //         sum = unit_value * .12;
    //         total = (sum + parseFloat(unit_value));
    //         $(this).parents('.quotationItemDetail').find('.vatprice').val(total);

    //      } else {
    //         console.log('uncheck');
    //         sum = unit_value * .12;
    //         total = (parseFloat(unit_value) - sum);
    //         thisMe.parents('.quotationItemDetail').find('.vatprice').attr('value', ' '); 
    //      }
    // });
});


function vatprice(whatsection, thisElement){
    var value = $('.' + whatsection);
    
    value = findValue(value, thisElement);

} 

function findValue($form, thisElement){


   
    var $unit_value = thisElement.parents('.'+$form).find('.unitprice').val();
    var $vat_value = thisElement.parents('.'+$form).find('.vatIn').val();

   // alert($form);
   
    if ($unit_value == '' && $vat_value == '' ){
         //alert($vat_value);
        alert('Unit Price is Required.');
        thisElement.parents('.'+$form).find('.unitprice').focus();
        thisElement.attr('checked',false);

    }else if($unit_value != '' && $form == 'quotationItemDetail'){
         
        var sum = 0;
        var index = 0;
        var total = 0;

        sum = $unit_value * .12;
        total = (sum + parseFloat($unit_value));
        thisElement.parents('.'+$form).find('.vatprice').val(total);

         if (thisElement.is(":checked")) {
            console.log('check');
            sum = $unit_value * .12;
            total = (sum + parseFloat($unit_value));
            thisElement.parents('.quotationItemDetail').find('.vatprice').val(total);

         } else {
            console.log('uncheck');
            sum = $unit_value * .12;
            total = (parseFloat($unit_value) - sum);
            thisElement.parents('.quotationItemDetail').find('.vatprice').val(' '); 
         }

    }else if($vat_value != '' || $form == 'quotationItemDetails'){

        var sum = 0;
        var index = 0;
        var total = 0;

        if($form != 'quotationItemDetail' ){

            $form = 'quotationItemDetail';

        }

        quotient = $vat_value / 1.12;
        thisElement.parents('.'+$form).find('.unitprice').val(quotient);

         if (thisElement.is(":checked")) {
            var $vat_value = thisElement.parents('.'+$form).find('.vatIn').val();
            console.log('check');
            console.log($vat_value);
            quotient = $vat_value / 1.12;
            //total = (sum + parseFloat($unit_value));
            thisElement.parents('.quotationItemDetail').find('.unitprice').val(quotient);

         } else {
            console.log('uncheck');
            quotient = $vat_value / 1.12;
           // total = (parseFloat($unit_value) - sum);
            thisElement.parents('.quotationItemDetail').find('.unitprice').val(quotient); 
         }
  
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

$('body').on('change','.currency-option',function(){

    thisElement = $(this);

    thisVal = $(this).val();

    if (thisVal) {
        if(thisVal == 2){
            thisElement.parents('.form-horizontal').find('.vat-section').show();
            thisElement.parents('.form-horizontal').find('.for-php').show();
            thisElement.parents('.form-horizontal').find('.for-usd').hide();
            thisElement.parents('.form-horizontal').find('.select-vat-status').val('');
            thisElement.parents('.form-horizontal').find('.for-usd').removeClass('dsplayShow');
        }

        if(thisVal == 1){
            thisElement.parents('.form-horizontal').find('.vat-section').show();
            thisElement.parents('.form-horizontal').find('.for-php').hide();
            thisElement.parents('.form-horizontal').find('.for-usd').show();
            thisElement.parents('.form-horizontal').find('.vat-option').hide();
            thisElement.parents('.form-horizontal').find('.for-usd').removeClass('dsplayShow1');

            
        }
    }else{
        thisElement.parents('.form-horizontal').find('.vat-section').hide();
        thisElement.parents('.form-horizontal').find('.for-php').hide();
        thisElement.parents('.form-horizontal').find('.for-usd').hide();
        thisElement.parents('.form-horizontal').find('.vat-option').hide();
    };
    // if(thisVal == 'Vatable Exempt' || thisVal == 'Vatable Exempt'){

    //     thisElement.parents('.form-horizontal').find('.vat-option').hide();
    // }

});

$('body').on('change','.select-vat-status',function(){

    thisElement = $(this);

    thisVal = $(this).val();

    if (thisVal) {
        if(thisVal == 'Vatable Sale'){

            thisElement.parents('.form-horizontal').find('.vat-option').show();
        }

        if(thisVal == 'Vat Exempt' || thisVal == 'Zero Rated Sale'){

            thisElement.parents('.form-horizontal').find('.vat-option').hide();
        }
    }else{
        thisElement.parents('.form-horizontal').find('.vat-option').hide();
    };
});



$('.unitprice').keypress(function(){
    console.log($(this).val());
});

$('body').on('keyup','.vatprice',function(){

    $parents = $(this).parents('.quotationItemDetail');
    
    if ($parents.find('.unitprice').val() != '' && $(this).val() != '' ) {
         findValue($(this).data('section'),$parents.find('.vat-price'));

    }

});

$('body').on('keyup','.unitprice',function(){
    
    $parents = $(this).parents('.quotationItemDetail');
    
    if ($parents.find('.vatprice').val() != '' && $(this).val() != '' ) {
         findValue($(this).data('section'),$parents.find('.vat-price'));
    }

    //console.log($(this).val());
});

$('body').on('change','.checkEx',function(){
    if($(this).is(":checked")) {
        var checkboxtext =  $('.checkEx').next('label').text();
        $(this).parents('.form-horizontal').find('.checkEx').next('label').text('Check to disable VAT Price');
        //$(this).parents('.form-horizontal').find(".vatEx").prop('readonly', true);
        $(this).parents('.form-horizontal').find(".vatIn").prop('readonly', false);
        $(this).parents('.form-horizontal').find('.vatEx').val("");
        $(this).parents('.form-horizontal').find('.vatIn').val("");
        $(".checkvat").attr("checked", false);
  
    }else{
        $(this).parents('.form-horizontal').find('.checkEx').next('label').text('Check to enable VAT Price');
        //$(this).parents('.form-horizontal').find(".vatEx").prop('readonly', false);
        $(this).parents('.form-horizontal').find(".vatIn").prop('readonly', true);
        $(this).parents('.form-horizontal').find('.vatIn').val("");
        $(this).parents('.form-horizontal').find('.vatEx').val("");
        $(".checkvat").attr("checked", false);
    }

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