<?php echo $this->Html->script('Delivery.datepicker');?>
<?php echo $this->Form->create('Schedule',array('url'=>(array('controller' => 'schedules',
												'action' => 'save')
														)
												),
												array('class' => 'form-horizontal'
													 )
												);
?>
<div class="filter-block pull-right">

	<?php

        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Decline ', 
        							array('controller' => 'quotations', 
        								  'action' => 'index'
        								  ),
        							array('class' =>'btn btn-primary pull-right',
        								  'escape' => false));

    ?>

    <?php

        echo $this->Html->link('<i class="fa fa-check-square fa-lg"></i> Accept ', 
        							array('controller' => 'quotations', 
        								  'action' => 'index'
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
					<div class="col-lg-3">
						<button type="submit" class="btn btn-success pull-right">Save</button>
					</div>
					<div class="col-lg-8">
						<?php 
	                        echo $this->Html->link('Cancel', array('controller' => 'deliveries', 
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
<?php echo $this->Form->end(); ?>
