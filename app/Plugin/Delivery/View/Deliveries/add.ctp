<?php echo $this->Html->script('Delivery.datepicker');?>
<?php echo $this->element('deliveries_options'); ?><br><br>
<?php echo $this->Form->create('Delivery', array(
									'url'=>( array( 
										'controller' => 'deliveries',
										'action' => 'delivery_info')
									)), array( 
									'class' => 'form-horizontal'
								));
?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
        	<header class="main-box-header clearfix">
        	<h1>Add Delivery Information</h1>
   		 	</header>
    
           	 <div class="main-box-body clearfix">
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


                    </div>
                </div> <br><br>

                <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Quantity Need to be Deliver</label>
                    <div class="col-lg-9">
                        <?php
                           echo $this->Form->input('qty', array(
    												'value' => $scheduleInfo['Schedule']['quantity'],
    												'readonly' => true,
							    					'alt' => 'type',
							    					'type' => 'text',
							    					'label' => false,
							   						'class' => 'form-control col-lg-4 required',
							    					'empty' => false,
							    					'id' => 'qty'
													));
                        ?>


                    </div>
                </div> <br><br>
                

	            <div class="form-group">
	                <label for="inputPassword1" class="col-lg-2 control-label">Delivered Date</label>
	                <div class="col-lg-9"> 
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							   <?php
                           			echo $this->Form->input('delivered_date', array( 
                           									'value' => $scheduleInfo['Schedule']['schedule'],
                           									'type' => 'text',
		                           							'alt' => 'type',
									    					'label' => false,
									   						'class' => 'form-control',
									    					'empty' => false,
									    					'id' => 'delivered_date'
									    	
									    
													));
                        ?>
						</div>
						<span class="help-block">ex. MM/DD/YYYY</span>
	                </div>
	            </div>

	    
	            <div class="form-group">
	                <label for="inputPassword1" class="col-lg-2 control-label">Delivered Quantity</label>
	                <div class="col-lg-9">
						<div class="input-group">
							<span class="input-group-addon"></span>
							 <?php
                           			echo $this->Form->input('del_quantity', array( 
                           									'type' => 'text',
		                           							'alt' => 'type',
									    					'label' => false,
									   						'class' => 'form-control',
									    					'empty' => false,
									    					'required' => 'true'
									    		
													));
                        ?>
						</div>
						<span class="help-block" style= "color:white">XXXX</span>
	                </div>
	            </div>

	            <div class="form-group">
	                <label for="inputPassword1" class="col-lg-2 control-label">Quantity Accepted</label>
	                <div class="col-lg-9">
						<div class="input-group">
							<span class="input-group-addon"></span>
							 <?php
                           			echo $this->Form->input('qty_accepted', array( 
                           									'type' => 'text',
		                           							'alt' => 'type',
									    					'label' => false,
									   						'class' => 'form-control',
									    					'empty' => false,
									    					'required' => 'true'
									    		
													));
                        ?>
						</div>
						<span class="help-block" style= "color:white">XXXX</span>
	                </div>
	            </div>

	            <div class="form-group">
	                <label for="inputPassword1" class="col-lg-2 control-label">Quantity Rejected</label>
	                <div class="col-lg-9">
						<div class="input-group">
							<span class="input-group-addon"></span>
							 <?php
                           			echo $this->Form->input('qty_rejected', array( 'type' => 'text',
		                           							'alt' => 'type',
									    					'label' => false,
									   						'class' => 'form-control',
									    					'empty' => false,
									    					
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
	                        echo $this->Html->link('Cancel', array('controller' => 'deliveries', 
	                        									   'action' => 'index'),
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
