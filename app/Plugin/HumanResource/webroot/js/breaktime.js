  $(document).ready(function(){  

 var updateTime = function(element1,element2,value){

        var times = '';
        var timeElements = $(element1).val().split(":");  


        var theHour = parseInt(timeElements[0]);
        var theMintute = timeElements[1];
        var newHour = theHour + parseInt(value);
        
        if (newHour > 24) {
            newHour = 0 + (newHour - 24);
        }

        times.newHour = newHour;
        times.theMintute = theMintute;

         $(element2).val(newHour + ":" + theMintute+ ':00');
    }


$('#BreaktimeDuration').on("input", function() {
    var dInput = this.value;
	updateTime('#BreaktimeFrom','#BreaktimeTo',dInput)
});

$('#BreaktimeFrom').change(function(){
        updateTime('#BreaktimeFrom','#BreaktimeTo',$('#BreaktimeDuration').val());
}); 


});