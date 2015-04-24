$(function(){
	

$('#CompoundSubstrateLayers').blur(function(){
	$('.substrate-layers').remove();
	var option = $(this).val();
	var selected = $(this).val();

	$inputs = '';
	var count = 1;
	for (i = 0; i < selected; i++) { 
		$inputs += '<div class="form-group substrate-layers"><label class="col-lg-2 control-label"><span style="color:red">*</span>Substrate  '+count+'</label>';
		$inputs += '<div class="col-lg-8"><input type="hidden" maxlength="120"  class="form-control layer" name="data[ItemGroupLayer][no][]" value="' + i + '"></div>';
		$inputs += '<div class="col-lg-8"><input type="text" maxlength="120" required = "required" placeholder = "Substrate name" class="form-control layer" name="data[ItemGroupLayer][substrate][]"></div></div>';

		count++;
	}


	$(this).parents('.form-group').after($inputs);
    return false;
});

});