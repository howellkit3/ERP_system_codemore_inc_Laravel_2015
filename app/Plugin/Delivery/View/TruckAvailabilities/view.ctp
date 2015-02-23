<?php echo $this->Html->script('Delivery.datepicker');?>
<?php echo $this->Form->create('TruckAvailabilities',array('url' => array('controller' => 'truckAvailabilities', 'action' => 'save')), array('class' => 'form-horizontal')); ?>

<div class="filter-block pull-right">

	<?php
		//pr($truckAvailability);
		//pr($truckId);
		if($scheduleInfo['Schedule']['status'] == "Pending") {

		
	        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Decline ', 
	        							array('controller' => 'truckAvailabilities', 
	        								  'action' => 'decline', 
	        								  $scheduleInfo['Schedule']['sales_order_id']),
	        							array('class' =>'btn btn-primary pull-right',
	        								  'escape' => false));

    ?>

    <?php

	        echo $this->Html->link('<i class="fa fa-check-square fa-lg"></i> Accept ', 
	        							array('controller' => 'truckAvailabilities', 
	        								  'action' => 'accept',
	        								  $scheduleInfo['Schedule']['sales_order_id']
	        								  ),
	        							array('class' =>'btn btn-primary pull-right',
	        								  'escape' => false));
    
    ?>
    
   
   <br><br>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
        	 <div class="main-box-body clearfix">
        		<header class="main-box-header clearfix">
	            <h1>Add Schedule</h1>

        		<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Purchase Number</label>
                    <div class="col-lg-9">

                    		 
                        <?php
                           echo $this->Form->input('sales_order_id', array(
    												'value' => $scheduleInfo['Schedule']['sales_order_id'],
    												'readonly' => true,
							    					'alt' => 'type',
							    					'type' => 'text',
							    					'label' => false,
							   						'class' => 'form-control col-lg-4 required',
							    					'empty' => false,
							    					'id' => 'unique_id'
													));
                        ?>
                        <span class="help-block" style= "color:white">space</span>
                    </div>
                </div> 

				<div class="form-group">
	    			<label for="inputPassword1" class="col-lg-2 control-label">Truck</label>
	    			<div class="col-lg-9">

	        		<?php
	           			echo $this->Form->input('truckPlateNumber', array(
												'type' => 'select',
												'options' => $truckId,
				    							'alt' => 'type',
				    							'label' => false,
				   								'class' => 'form-control col-lg-4 required',
				    							'empty' => '--Select Truck--',
												));
	        		?>
	        		<span class="help-block" style="color:white">space</span>
	    			</div>
				</div><br><br>

				
				<div class="form-group">
					<label for="inputPassword1" class="col-lg-2 control-label">From</label>
					<div class="col-lg-9"> 
						<div class="input-group">
							<div class="input-group input-append bootstrap-timepicker">
								<?php
									echo $this->Form->input('timeFrom', array( 
                       									
                       									'type' => 'text',
	                           							'alt' => 'type',
								    					'label' => false,
								   						'class' => 'form-control',
								    					'empty' => false,
								    					'id' => 'timepicker1'
														));
								?>
								<span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
							</div>
						</div>
						<span class="help-block" style="color:white">space</span>
					</div>
				</div>
			
				<div class="form-group">
					<label for="inputPassword1" class="col-lg-2 control-label">To</label>
					<div class="col-lg-9"> 
						<div class="input-group">
							<div class="input-group input-append bootstrap-timepicker">
								<?php
									echo $this->Form->input('timeTo', array( 
                       									
                       									'type' => 'text',
	                           							'alt' => 'type',
								    					'label' => false,
								   						'class' => 'form-control',
								    					'empty' => false,
								    					'id' => 'timepicker2'
														));
								?>
								<span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
							</div>
						</div>
						<span class="help-block" style="color:white">space</span>
					</div>
				</div>
						
				

				<div class="form-group">
	                <label for="inputPassword1" class="col-lg-2 control-label">Schedule</label>
	                <div class="col-lg-9"> 
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							   <?php
                           			echo $this->Form->input('schedule', array( 
                           									'value' => $scheduleInfo['Schedule']['schedule'],
                           									'type' => 'text',
		                           							'alt' => 'type',
									    					'label' => false,
									   						'class' => 'form-control',
									    					'empty' => false,
									    					'id' => 'datepickerDate'
															));
                        ?>
						</div>
						<span class="help-block" style="color:white">space</span>
	                </div>
	            </div>

	            <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Location</label>
                    <div class="col-lg-9">

                        <?php
                           echo $this->Form->input('location', array(
    												'value' => $scheduleInfo['Schedule']['location'],
    												'readonly' => true,
							    					'alt' => 'type',
							    					'type' => 'text',
							    					'label' => false,
							   						'class' => 'form-control col-lg-4 required',
							    					'empty' => false,
							    					'id' => 'unique_id'
													));
                        ?>
                        <span class="help-block" style= "color:white">space</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Quantity</label>
                    <div class="col-lg-9">

                        <?php
                        
                           echo $this->Form->input('quantity', array(
    												'value' => $scheduleInfo['Schedule']['quantity'],
    												'disabled' => true,
							    					'alt' => 'type',
							    					'type' => 'text',
							    					'label' => false,
							   						'class' => 'form-control col-lg-4 required',
							    					'empty' => false,
							    					'id' => 'unique_id'
													));
                        ?>
                        <span class="help-block" style= "color:white">space</span>
                    </div>
                </div>
                
                <div class="form-group">
					<div class="col-lg-3">
						<?php
							//pr($truckAvailability);exit();
							if(($truckAvailability['TruckAvailability']['sales_order_id'] == "") || ($scheduleInfo['Schedule']['status'] == "Pending")){
								$value = "Cancel";
						?>
								<button type="submit" class="btn btn-success pull-right">Save</button>
						<?php
							}
							else{
								$value = "Back";
							}

               			 ?>
								

					</div>
					<div class="col-lg-8">
						<?php 
	                        echo $this->Html->link($value, array('controller' => 'deliveries', 
	                        									   'action' => 'index',
	                        									   	),
	                        										array(
	                        												'class' =>'btn btn-primary',
	                        												'escape' => false
	                        												));
	                    ?>
					</div>
				</div>
                

			</div>
        </div>
    </div>
</div>
<?php }
else{
?>
<div class="row1">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
            <header class="main-box-header clearfix">

                <h2 class="pull-left"><b>Schedule</b></h2>
                
            </header>
            
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
   						<tbody>
   							<tr>
   								<td>Purchased Number</td>
   								<td><?php echo  $scheduleInfo['Schedule']['sales_order_id']; ?></td>
   							</tr>

   							<tr>
   								<td>Truck</td>
   								<td><?php echo  $scheduleInfo['Schedule']['quantity']; ?></td>
   							</tr>

   							<tr>
   								<td>Schedule</td>
   								<td><?php echo  $truckAvailability['TruckAvailability']['date']; ?></td>
   							</tr>

   							<tr>
   								<td>From</td>
   								<td><?php echo  $truckAvailability['TruckAvailability']['time_from']; ?></td>
   							</tr>

   							<tr>
   								<td>To</td>
   								<td><?php echo  $truckAvailability['TruckAvailability']['time_to']; ?></td>
   							</tr>

   							<tr>
   								<td>Location</td>
   								<td><?php echo  $truckAvailability['TruckAvailability']['location']; ?></td>
   							</tr>

   							<tr>
   								<td>Quantity</td>
   								<td><?php echo  $scheduleInfo['Schedule']['quantity']; ?></td>
   							</tr>
   						</tbody>

                    </table>
                    <hr>
                </div>
            </div>
    
        </div>
    </div>
</div>
<?php
	//echo  $scheduleInfo['Schedule']['sales_order_id']." ".$scheduleInfo['Schedule']['quantity'];
}
echo $this->Form->end(); ?>

