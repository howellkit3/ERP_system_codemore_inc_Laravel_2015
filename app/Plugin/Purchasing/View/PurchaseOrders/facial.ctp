<?php echo $this->Html->image('samples/icon-user-default.png',array('alt' => 'scarlet-159','class' => 'facial-detection'));  ?>

<script>
	jQuery(function($) {
	    $('.facial-detection').faceDetection({
	        complete: function (faces) {
	            console.log(faces);
	            console.log('test');
	        }
	    });
	});
</script> 