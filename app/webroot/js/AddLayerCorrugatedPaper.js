$(function(){

	$("body").on('click','.addLayerNow', function(e){

	 	e.preventDefault();
	 	
	 	var layerVal = parseInt($(this).parents('.layerSection').find('.layersC').val());
	 	layerNew = layerVal + 1;
	 	$(this).parents('.layerSection').find('.layersC').val(layerNew);

	 	$(this).parents('.layerSection').find('.appendLayer').append('<div class="form-group newField">\
						 												<label class="col-lg-3 control-label">\
						 													<span style="color:red">*</span>Substrate\
						 												</label>\
																		<div class="col-lg-2">\
																			<input type="text" placeholder="Substrate Name" class="form-control required" name="data[ItemGroupLayer]['+layerVal+'][substrate]" />\
																		</div>\
																		<label class="col-lg-1 control-label">Flute</label>\
																		<div class="col-lg-2">\
																			<input type="text" placeholder="Flute" class="form-control" name="data[ItemGroupLayer]['+layerVal+'][flute]" />\
																		</div>\
																		<div class="col-lg-2">\
																			<button type="button" class="remove-field remove-layerMe btn btn-danger" ><i class="fa fa-minus" ></i></button>\
																		</div>\
			 														</div>');
	 	
	});

	$("body").on('click','.remove-layerMe', function(e){

	 	e.preventDefault();
	 	var layerVal = parseInt($(this).parents('.layerSection').find('.layersC').val());
	 	layerNew = layerVal - 1;
	 	$(this).parents('.layerSection').find('.layersC').val(layerNew);
	 	$(this).parents('.newField').remove();
	 	
	});

	$("body").on('click','.addCompundNow', function(e){

	 	e.preventDefault();
	 	
	 	var layerVal = parseInt($(this).parents('.compoundMe').find('.coumpundVal').val());
	 	layerNew = layerVal + 1;
	 	$(this).parents('.compoundMe').find('.coumpundVal').val(layerNew);

	 	$(this).parents('.form-horizontal').find('.compoundLayer').append('<div class="form-group newField">\
						 												<label class="col-lg-3 control-label">\
						 													<span style="color:red">*</span>Substrate\
						 												</label>\
																		<div class="col-lg-6">\
																			<input type="text" placeholder="Substrate Name" class="form-control required" name="data[ItemGroupLayer]['+layerVal+'][substrate]" />\
																		</div>\
																		<div class="col-lg-2">\
																			<button type="button" class="remove-field remove-CompoundMe btn btn-danger" ><i class="fa fa-minus" ></i></button>\
																		</div>\
			 														</div>');
	 	
	});

	$("body").on('click','.remove-CompoundMe', function(e){

	 	e.preventDefault();
	 	var layerVal = parseInt($(this).parents('.form-horizontal').find('.coumpundVal').val());
	 	layerNew = layerVal - 1;
	 	$(this).parents('.form-horizontal').find('.coumpundVal').val(layerNew);
	 	$(this).parents('.newField').remove();
	 	
	});









// $('#CorrugatedPaperLayers').blur(function(){
// 	$('.corrugatedPaper-layers').remove();
// 	var option = $(this).val();
// 	var selected = $(this).val();

// 	//alert ();

// 	$inputs = '';
// 	var count = 1;
// 	for (i = 0; i < selected; i++) { 

// 		if (count > 1){		

// 			$inputs += '<div class="form-group corrugatedPaper-layers"><label class="col-lg-2 control-label"></label>';
// 			$inputs += '<div class="col-lg-8 "><hr style="color:#99CC99"></div></div>';

// 		}

// 		$inputs += '<div class="form-group corrugatedPaper-layers"><label class="col-lg-3 control-label"><span style="color:red">*</span>Substrate  '+count+'</label>';
// 		$inputs += '<div class="col-lg-8"><input type="hidden" maxlength="120"  class="form-control layer" name="data[ItemGroupLayer][no][]" value="' + i + '"></div>';
// 		$inputs += '<div class="col-lg-7"><input type="text" maxlength="120" required = "required" placeholder = "Substrate name" class="form-control layer" name="data[ItemGroupLayer][substrate][]"></div></div>';

// 	//	$inputs += '<div class="col-lg-8"><input type="hidden" maxlength="120"  class="form-control layer" name="data[ItemGroupLayer][no][]" value="' + i + '"></div>';
// 		$inputs += '<div class="form-group corrugatedPaper-layers"><label class="col-lg-3 control-label"><span style="color:red">*</span>Flute  '+count+'</label>';
// 		$inputs += '<div class="col-lg-7"><input type="text" maxlength="120" required = "required" placeholder = "Flute" class="form-control layer" name="data[ItemGroupLayer][flute][]"></div></div>';
			
// 		count++;
// 	}

// 	$(this).parents('.form-group').after($inputs);
//     return false;
// });

// $('body').on('click','.remove-layers',function(){

// 		var parent = $(this).parent().parent().parent().parent();

// 		//console.log(parent.attr('class'));
		
// 		parent.find('.remove-field').val('true');

// 		if (parent.find('.remove-field').length > 1) {

// 			alert('i entered if');
// 				//parent.attr('style','display:none');
// 				parent.remove();
// 		} else {

// 			//alert('i entered else');
// 			parent.remove();
// 		}
		
// 		var layer = 1;

// 		$('.substrate-layers:visible').each(function(){

// 				$(this).find('.control-label').first().html('<span style="color:red">*</span>Substrate '+layer++);
// 		});

// 		$('#CorrugatedPaperLayers').val($('.substrate-layers:visible').length);
// });

});