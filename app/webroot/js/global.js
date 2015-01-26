// $('.multi-field-wrapper').each(function() {
     
//     var $wrapper = $('.multi-fields', this);
    
//     $(".add-field", $(this)).click(function(e) {
    	 
//         $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
   
//     });

//     $('.multi-field .remove-field', $wrapper).click(function() {
//         if ($('.multi-field', $wrapper).length > 1)
//             $(this).parents('.multi-field').remove();
//     });
// });

$('.cloneMe').each(function(){

    var count=1;

    $(".add-field",$(this)).click(function(e){
        
        count++;

        //$(this).parent().before($(".cloneMe").clone().attr("class","cloneMe" + count));
        $('.cloneMe').clone().insertAfter(".cloneMe").attr("class","cloneMe" + count);
       
        //$(".cloneMe" + count).css("display","inline");
       
        $(".cloneMe" + count + " :input").each(function(){
            $(this).attr("name",$(this).attr("name") + "[" +count+"]");
            //alert(myElements.eq(i).attr("name"));
            $(this).attr("id",$(this).attr("id") + count);
            });

        $(".remove-field" + count,$(this)).click(function(e){
            $(this).parents('.cloneMe').remove();
            //$(this).closest("div").remove();
        });
    }); 
});

$('.cloneMe1').each(function(){

    var count=1;

    $(".add-field1",$(this)).click(function(e){
        
        count++;

        //$(this).parent().before($(".cloneMe").clone().attr("class","cloneMe" + count));
        $('.cloneMe1').clone().insertAfter(".cloneMe1").attr("class","cloneMe1" + count);
       
        //$(".cloneMe" + count).css("display","inline");
       
        $(".cloneMe1" + count + " :input").each(function(){
            $(this).attr("name",$(this).attr("name") + count);
            $(this).attr("id",$(this).attr("id") + count);
            });

        $(".remove-field" + count,$(this)).click(function(e){
            $(this).parents('.cloneMe1').remove();
            //$(this).closest("div").remove();
        });
    }); 
});

$('.cloneMe2').each(function(){

    var count=1;

    $(".add-field2",$(this)).click(function(e){
        
        count++;

        //$(this).parent().before($(".cloneMe").clone().attr("class","cloneMe" + count));
        $('.cloneMe2').clone().insertAfter(".cloneMe2").attr("class","cloneMe2" + count);
       
        //$(".cloneMe" + count).css("display","inline");
       
        $(".cloneMe2" + count + " :input").each(function(){
            $(this).attr("name",$(this).attr("name") + count);
            $(this).attr("id",$(this).attr("id") + count);
            });

        $(".remove-field" + count,$(this)).click(function(e){
            $(this).parents('.cloneMe2').remove();
            //$(this).closest("div").remove();
        });
    }); 
});

$('.cloneMe3').each(function(){

    var count=1;

    $(".add-field3",$(this)).click(function(e){
        
        count++;

        //$(this).parent().before($(".cloneMe").clone().attr("class","cloneMe" + count));
        $('.cloneMe3').clone().insertAfter(".cloneMe3").attr("class","cloneMe3" + count);
       
        //$(".cloneMe" + count).css("display","inline");
       
        $(".cloneMe3" + count + " :input").each(function(){
            $(this).attr("name",$(this).attr("name") + count);
            $(this).attr("id",$(this).attr("id") + count);
            });

        $(".remove-field" + count,$(this)).click(function(e){
            $(this).parents('.cloneMe3').remove();
            //$(this).closest("div").remove();
        });
    }); 
});

$('.cloneMe4').each(function(){

    var count=1;

    $(".add-field4",$(this)).click(function(e){
        
        count++;

        //$(this).parent().before($(".cloneMe").clone().attr("class","cloneMe" + count));
        $('.cloneMe4').clone().insertAfter(".cloneMe4").attr("class","cloneMe4" + count);
       
        //$(".cloneMe" + count).css("display","inline");
       
        $(".cloneMe4" + count + " :input").each(function(){
            $(this).attr("name",$(this).attr("name") + count);
            $(this).attr("id",$(this).attr("id") + count);
            });

        $(".remove-field" + count,$(this)).click(function(e){
            $(this).parents('.cloneMe4').remove();
            //$(this).closest("div").remove();
        });
    }); 
});

$('.cloneMe5').each(function(){

    var count=1;

    $(".add-field5",$(this)).click(function(e){
        
        count++;

        //$(this).parent().before($(".cloneMe").clone().attr("class","cloneMe" + count));
        $('.cloneMe5').clone().insertAfter(".cloneMe5").attr("class","cloneMe5" + count);
       
        //$(".cloneMe" + count).css("display","inline");
       
        $(".cloneMe5" + count + " :input").each(function(){
            $(this).attr("name",$(this).attr("name") + count);
            $(this).attr("id",$(this).attr("id") + count);
            });

        $(".remove-field" + count,$(this)).click(function(e){
            $(this).parents('.cloneMe5').remove();
            //$(this).closest("div").remove();
        });
    }); 
});
$('.cloneMe6').each(function(){

    var count=1;

    $(".add-field6",$(this)).click(function(e){
        
        count++;

        //$(this).parent().before($(".cloneMe").clone().attr("class","cloneMe" + count));
        $('.cloneMe6').clone().insertAfter(".cloneMe6").attr("class","cloneMe6" + count);
       
        //$(".cloneMe" + count).css("display","inline");
       
        $(".cloneMe6" + count + " :input").each(function(){
            $(this).attr("name",$(this).attr("name") + count);
            $(this).attr("id",$(this).attr("id") + count);
            });

        $(".remove-field" + count,$(this)).click(function(e){
            $(this).parents('.cloneMe6').remove();
            //$(this).closest("div").remove();
        });
    }); 
});

