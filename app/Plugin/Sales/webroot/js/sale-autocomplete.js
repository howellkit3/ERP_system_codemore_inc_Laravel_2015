$(document).ready(function() { 

	$("body").on('keyup','.color-autocomplete', function(e){
        var searchInput = $(this).val();
        console.log(searchInput);
        $.ajax({
            type: "GET",
            url: serverPath + "sales/quotations/color_autocomplete/"+searchInput,
            //dataType: "html",
            //type: "GET",
			dataType: "json",
            success: function(data) {
            	console.log(data);
     //            if(data){
     //            	console.log(data);
     //            	$('#suggesstion-box').show();
					// $('#suggesstion-box').html(data);
					// $('#search-box').css('background','#FFF');
                	
     //            } 

              	$( '#tags' ).autocomplete({
			      	source: data
			    });
              
            }
        });

    });

      // var availableTags = [
		    //   "ActionScript",
		    //   "AppleScript",
		    //   "Asp",
		    //   "BASIC",
		    //   "C",
		    //   "C++",
		    //   "Clojure",
		    //   "COBOL",
		    //   "ColdFusion",
		    //   "Erlang",
		    //   "Fortran",
		    //   "Groovy",
		    //   "Haskell",
		    //   "Java",
		    //   "JavaScript",
		    //   "Lisp",
		    //   "Perl",
		    //   "PHP",
		    //   "Python",
		    //   "Ruby",
		    //   "Scala",
		    //   "Scheme"
		    // ];
		    // $( "#tags" ).autocomplete({
		    //   source: availableTags
		    // });

});