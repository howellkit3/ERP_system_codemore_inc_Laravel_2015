<center>
	<?php
		echo $this->Html->image('post_processing_icon.jpg', array(
								'alt' => 'Process'
								)) ."<br>";
	?>
	Your Request is in Process. Please wait for the Confirmation <br>
	<?php
 		echo $this->Html->link('Back', array(
								'controller' => 'sales_orders', 
					    		'action' => 'index',
					   				),array(
								'class' =>'btn btn-primary',
								'escape' => false
                    						));
	?>
	
</center>