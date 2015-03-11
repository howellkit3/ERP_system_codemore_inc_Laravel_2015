<html>
	<?php echo $this->element('deliveries_options'); ?><br><br>
	<center>
		<?php
			if($scheduleInfo['Schedule']['status'] == "Pending"){
		?>
			<h1>This Delivery Schedule is still Pending </h1><br>
			   <?php
                  echo $this->Html->link('<i class="fa fa-check-square fa-lg"></i> Create Schedule ', 
                        array('controller' => 'truckSchedules', 
                            'action' => 'add',
                            $scheduleInfo['Schedule']['sales_order_id']
                            ),
                        array('class' =>'btn btn-primary',
                            'escape' => false));


                ?> 

		<?php
			}
			else if($scheduleInfo['Schedule']['status'] == "Accepted"){
		?>
			<h1>Please approve this Delivery Schedule </h1><br>
		<?php
				echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i> Click to Approved ', array(
				        	'controller' => 'Schedules', 
				        	'action' => 'update_status',
				        	$scheduleInfo['Schedule']['sales_order_id']
				        	
				        	),
				        	array('class' =>'btn btn-primary',
				        		'escape' => false
				        		));
			}
		?>
	</center>
</html>