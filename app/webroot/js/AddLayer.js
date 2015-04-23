$(function(){
	
$('#CompoundSubstrateLayer').change(function(){
	$('.option-append').remove();
	var option = $(this).val();
	var selected = $('#CompoundSubstrateLayer').val();

    $("form-control layer")
        .last()
        .clone()
        .appendTo($("body"))
        .find("input").attr("name",function(i,oldVal) {
            return oldVal.replace(/\[(\d+)\]/,function(_,m){
                return "[" + (+m + 1) + "]";
            });
        });
    return false;
});
);



});

		

	}).trigger('change');