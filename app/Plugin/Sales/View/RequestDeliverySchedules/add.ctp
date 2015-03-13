<?php echo $this->Html->script('Sales.custom');?>
<?php echo $this->element('sales_option');?><br><br>
 <?php echo $this->Form->create('RequestDeliverySchedule', array(
																'url'=>( array(
																	'controller' => 'requestDeliverySchedules',
																	'action' => 'add')
																)), array(
														  		'class' => 'form-horizontal'
												 		));
?>
	<div class="row">
	    <div class="col-lg-12">
	        <div class="main-box">
	  	        			<header class="main-box-header clearfix">
	                	<h1>Add Schedule</h1>
	           		 	</header>
	            
			           	 <div class="main-box-body clearfix">
			                <div class="form-group">
			                    <label for="inputPassword1" class="col-lg-2 control-label">Purchase Number</label>
			                    <div class="col-lg-9">
			                        <?php
			                           echo $this->Form->input('sales_order_id', array(
			    												'value' => $quotationId['Quotation']['unique_id'],
			    												'readonly' => true,
										    					'alt' => 'type',
										    					'type' => 'text',
										    					'label' => false,
										   						'class' => 'form-control col-lg-4 required',
										    					'empty' => false,
										    					'id' => 'unique_id'
																));
			                        ?>


			                    </div>
			                </div> <br><br>

				            <div class="form-group">
				                <label for="inputPassword1" class="col-lg-2 control-label">Schedule</label>
				                <div class="col-lg-9"> 
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										   <?php
			                           			echo $this->Form->input('schedule', array( 
			                           									'type' => 'text',
					                           							'alt' => 'type',
												    					'label' => false,
												   						'class' => 'form-control',
												    					'empty' => false,
												    					'id' => 'datepickerDate',
												    					'required' => true
												    	
												    
																));
			                        ?>
									</div>
									<span class="help-block">ex. MM/DD/YYYY</span>
				                </div>
				            </div>

				    
				            <div class="form-group">
				                <label for="inputPassword1" class="col-lg-2 control-label">Location</label>
				                <div class="col-lg-9">
									<div class="input-group">
										<span class="input-group-addon"></span>
										 <?php
			                           			echo $this->Form->input('location', array( 
			                           									'type' => 'text',
					                           							'alt' => 'type',
												    					'label' => false,
												   						'class' => 'form-control',
												    					'empty' => false,
												    					'value' => $companyName['Address'][0]['address1']
																		));
			                        ?>
									</div>
									<span class="help-block">ex. Street, Baranggay, Municipality, Provinve, Country</span>
				                </div>
				            </div>

				            <div class="form-group">
				                <label for="inputPassword1" class="col-lg-2 control-label">Quantity</label>
				                <div class="col-lg-9">
									<div class="input-group">
										<span class="input-group-addon"></span>
										 <?php
			                           			echo $this->Form->input('quantity', array( 
			                           									'type' => 'text',
					                           							'alt' => 'type',
												    					'label' => false,
												   						'class' => 'form-control',
												    					'empty' => false,
												    					'value' => $quantity['QuotationField'][1]['description']
																		));
			                        ?>
									</div>
									<span class="help-block" style= "color:white">ex. MM/DD/YYYY</span>
				                </div>
				            </div>

			              	<div class="form-group">
								<div class="col-lg-3">
									<button type="submit" class="btn btn-success pull-right">Save</button>
								</div>
								<div class="col-lg-8">
									<?php 
										$action = "";
										$plugin ="";
										$controller ="";

										if($path == "ticket") {
											$controller = "jobTicketSummaries";
											$action = "index"."/".$quotationId['Quotation']['unique_id'];
											$plugin = "ticket";

										}
										else{
											$controller = "sales_orders";
											$action = "index";
											$plugin = "sales";
										}

				                        echo $this->Html->link('Cancel', array(
				                        										'controller' => $controller, 
				                        									   'action' => $action,
				                        									   	'plugin' => $plugin),
		                        										 array(
		                        												'class' =>'btn btn-primary',
		                        												'escape' => false
		                        												));
				                    ?>
								</div>
							</div>

			            </div>
	        	<?php
	        		//}
	        	?>

	        </div>
	    </div>  
	</div>
<?php echo $this->Form->end(); ?>