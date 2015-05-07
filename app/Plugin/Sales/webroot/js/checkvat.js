function vatprice(whatsection, thisElement){
   console.log(thisElement);
    var value = $('.' + whatsection);

    value = findValue(value, whatsection);


    //alert($(whatsection).val());

    // $(whatsection).find(':input').each(function() {
    //      var $this = $(whatsection),
    //         nameProp = $this.prop('name'),
    //         vatprice = $this.prop('class');

    //     if(vatprice == "unitprice")
    //     {
    //         alert($this.val());
    //     }else{
    //         alert('error');
    //     }
       
    // });
    // alert('asdfasad');
    // console.log(whatsection);
    // console.log(thisElement);

   

} 

function findValue($form, thisElement){
    console.log(thisElement);
    var $value = $form.find('.unitprice').val();
        
    if ($form.find('.unitprice').val() == ''){
         
        alert('Unit Price is Required.');
        $form.find('.unitprice').focus();
        $('input[type=checkbox]:checked').attr('checked',false);

    }else{
         
        var sum = 0;
        var index = 0;
        var total = 0;

        $("body").on('change','.checkvat', function(e){

             if ($(this).is(":checked")) {

                sum = $value * .12;
                total = (sum + parseFloat($value));
                //console.log($(this).parents('.row').find('.vatprice').attr('id'));
                $(this).parents('.row').find('.vatprice').val(total);

             } else {
                total = (parseFloat($value) - sum);
                //console.log($(this).parents('.row').find('.vatprice').attr('id'));
                $(this).parents('.row').find('.vatprice').val(''); 
             }

        });

        // if($form.find('.checkvat').is( ":checked" ) == true){
        //     console.log('checked');    
        //     sum = $value * .12;
        //     total = (sum + parseFloat($value));

        //     $form.find('.vatprice').val(total);
           
        // }
        // if($form.find('.checkvat').is( ":checked" ) == false){
        //      console.log('not checked');     
        //     total = (parseFloat($value) - sum);
            
        //     $form.find('.vatprice').val('');
           
        // }
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
        
        // if(input.is( ":checked" ) == false){
        //       alert('not');
        //     $total = (parseFloat($("#QuotationField4Description").val()) - sum);
            
        //     $("#QuotationField4Description").val($total);
           
        // }
        
}

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