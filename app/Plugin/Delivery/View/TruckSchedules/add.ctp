<?php echo $this->Html->script('Delivery.datepicker');?>
<?php echo $this->Form->create('TruckSchedules',array('url' => array('controller' => 'truckSchedules', 'action' => 'save')), array('class' => 'form-horizontal')); ?>


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
                <table align = "center" style="table-layout: fixed; width: 100%; border: 0; cellspacing: 0; cellpadding: 0;">
                	<tr>
                		<td rowspan = "5" valign = "top" align = "center">
							<div class="form-group">
				    			<label for="inputPassword1" class="col-lg-2 control-label">Truck</label>
				    			<div class="col-lg-9">

					        		<?php
					           			echo $this->Form->input('truck_plate_number', array(
																'type' => 'select',
																'options' => $truckId,
								    							'alt' => 'type',
								    							'label' => false,
								    							'id' => 'truck_plate_number',
								   								'class' => 'form-control col-lg-4 required',
								    							'empty' => '--Select Truck--',
																));
					        		?>
					        		<span class="help-block" style="color:white">space</span>
				        		
				        			<p id = "table-schedule" align ="center">
				        				
				        			</p>
				    			</div>
							</div>
							 
						</td>
						
					</tr>

					<tr>
						
						<td>
			                <div class="form-group">
			                    <label for="inputPassword1" class="col-lg-2 control-label">Quantity</label>
			                    <div class="col-lg-9">

			                        <?php
			                        
			                           echo $this->Form->input('quantity', array(
			    												'value' => $scheduleInfo['Schedule']['quantity'],
			    												
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
				
                		</td>
                	</tr>

	            	<tr>
	            		
	            		<td>
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
						</td>
					</tr>

					<tr>
						
						<td>
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
						</td>
					</tr>
				</table>
					
                <div class="form-group">
					<div class="col-lg-3">
						<button type="submit" class="btn btn-success pull-right">Save</button>
					</div>

					<div class="col-lg-8">
						<?php 
	                        echo $this->Html->link('Cancel', array( 
	                        						'controller' => 'schedules', 
	                        						'action' => 'view',
	                        						$scheduleInfo['Schedule']['sales_order_id'] 
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

<?php
	//echo  $scheduleInfo['Schedule']['sales_order_id']." ".$scheduleInfo['Schedule']['quantity'];
echo $this->Form->end(); ?>
<script>
		$("#TruckSchedulesAddForm").validate();
		// $("[name*='data[QuotationField]']").each(function () {
		// $(this).rules("add", {
		//     required: true
		// });
		// });
</script>

