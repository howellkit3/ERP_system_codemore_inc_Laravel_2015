function readURL(input,element) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

            $('.'+element).attr('style','background:url('+ e.target.result +')')

        }

        reader.readAsDataURL(input.files[0]);
    }
}


$('body').on('click','.btn.btn-success.upload-image',function(e){


	$('.image_profile input').click();

	e.preventDefault();
});