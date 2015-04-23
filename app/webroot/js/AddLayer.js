$(function(){
	

$('#CompoundSubstrateLayers').blur(function(){
	$('.substrate-layers').remove();
	var option = $(this).val();
	var selected = $(this).val();

	$inputs = '';
	var count = 1;
	for (i = 0; i < selected; i++) { 
		$inputs += '<div class="form-group substrate-layers"><label class="col-lg-2 control-label"><span style="color:red">*</span>Layer  '+count+'</label>';
		$inputs += '<div class="col-lg-8"><input type="text" id="SubstrateName" maxlength="120"  class="form-control layer" name="data[Substrate][name]['+i+']"></div></div>';
		count++;
	}


	$(this).parents('.form-group').after($inputs);
    return false;
});

});