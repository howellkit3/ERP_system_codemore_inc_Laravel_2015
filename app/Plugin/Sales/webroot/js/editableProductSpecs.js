function showEditFields(editMe,editMeBtn,fieldGrid,sortMe){

	$('.editAll').hide();
	$('.hideAll').show();
	$('.buttonSpecs').show();
	$('.editMe').prop('disabled',false);
	$('.editMeBtn').show();
	$('.fieldGrid').addClass('grid');
	$('.sortMe').attr('id','sortable');
	$( "#sortable" ).sortable();
	$(".grid").sortable({
        tolerance: 'pointer',
        revert: 'invalid',
        placeholder: 'span2 well placeholder tile',
        forceHelperSize: true
    });
}
function hideEditFields(editMe,editMeBtn,fieldGrid,sortMe){

	$('.buttonSpecs').hide();
	$( "#sortable" ).sortable( "destroy" );
	$( ".grid" ).sortable( "destroy" );
	$('.editAll').show();
	$('.hideAll').hide();
	$('.editMe').prop('disabled',true);
	$('.editMeBtn').hide();
	$('.fieldGrid').removeClass('grid');
	$('.sortMe').attr('id','sortable1');
	
}