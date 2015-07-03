$(document).ready(function() {

	$("body").on('click','.add-gatepass', function(e){

	 	$(this).parents('.appendHelper').append('<div class="modal-body">\
                                            <div class="form-group">\
                                                <label class="col-lg-3 control-label"><span style="color:red">*</span>Helper Name</label>\
                                                <div class="col-lg-7">\
                                                    <input type="text" class="form-control item_type" name="data[GatePass][][name]" >\
                                                </div>\
                                                <div class="col-lg-1 plusbtn">\
                                                    <button type="button" class="remove-gatepass btn btn-danger"><i class="fa fa-minus"></i></button>\
                                                </div>\
                                            </div>\
                                        </div>');
	 	
	});

	$("body").on('click','.remove-gatepass', function(e){
		
		$(this).parents('.modal-body').remove();
	});
});