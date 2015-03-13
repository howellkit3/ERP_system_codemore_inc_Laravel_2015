<html>
	<?php echo $this->Html->script('Accounting.accounting');?>
	<?php echo $this->Form->create('Accounting', array(
									'url'=>( array( 
										'controller' => 'salesInvoice',
										'action' => 'add')
									)), array( 
									'class' => 'form-horizontal'
								));
	?>
	<div class="row">
	    <div class="col-lg-12">
	        <div class="main-box">
	        	<header class="main-box-header clearfix">
	        	<h1>Create Sales Invoice</h1>
	   		 	</header>
	   		 	<div class="main-box-body clearfix">
	   		 		<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Invoice No.:</label>
	                    <div class="col-lg-9">
	                        <?php
	                           echo $this->Form->input('invoice_number', array(
	    												'value' => rand(0,999).'-'.time(),
	    												'readonly' => true,
								    					'alt' => 'type',
								    					'type' => 'text',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'id' => 'invoice_number'
														));
	                     
	                        ?>
	                    </div>

                	</div> <br><br>

                	<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Purchase No.:</label>
	                    <div class="col-lg-9">
	                        <?php
	                        	 echo $this->Form->input('sales_order_id', array(
                       								'type' => 'select',
    												'options' => $deliveryNo,

    												//'readonly' => true,
							    					//'alt' => 'type',
							    					
							    					'label' => false,
							   						'class' => 'form-control col-lg-4 required',
							    					'empty' => '--Select Purchase No.',
							    					'id' => 'sales_order_id'
													));
	                          
	                        ?>
	                    </div>
                	</div><br><br>

                	<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Delivery No.:</label>
	                    <div class="col-lg-9">
	                        <?php
	                         	 echo $this->Form->input('delivery_no', array(
	    												//'value' => 
	    												'readonly' => true,
								    					'alt' => 'type',
								    					'type' => 'text',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'id' => 'delivery_no'
														));
	                     
	                        ?>
	                    </div>
                	</div><br><br>

                	<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Company:</label>
	                    <div class="col-lg-9">
	                        <?php
	                          echo $this->Form->input('company_name', array(
	    												//'value' => 
	    												'readonly' => true,
								    					'alt' => 'type',
								    					'type' => 'text',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'id' => 'company_name'
														));
	                     
	                        ?>
	                    </div>
                	</div><br><br>

                	<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Product Name:</label>
	                    <div class="col-lg-9">
	                        <?php
	                          echo $this->Form->input('product_name', array(
	    												//'value' => 
	    												'readonly' => true,
								    					'alt' => 'type',
								    					'type' => 'text',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'id' => 'product_name'
														));
	                     
	                        ?>
	                    </div>
                	</div><br><br>

                	<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Ordered Quantity:</label>
	                    <div class="col-lg-9">
	                        <?php
	                          echo $this->Form->input('ordered_quantity', array(
	    												//'value' => 
	    												'readonly' => true,
								    					'alt' => 'type',
								    					'type' => 'text',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'id' => 'ordered_quantity'
														));
	                     
	                        ?>
	                    </div>
                	</div><br><br>

                	<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Price:</label>
	                    <div class="col-lg-9">
	                        <?php
	                          echo $this->Form->input('price', array(
	    												//'value' => 
	    												'readonly' => true,
								    					'alt' => 'type',
								    					'type' => 'text',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'id' => 'price'
														));
	                     
	                        ?>
	                    </div>
                	</div><br><br>

                	<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Delivered Date:</label>
	                    <div class="col-lg-9">
	                        <?php
	                          echo $this->Form->input('delivered_date', array(
	    												//'value' => 
	    												'readonly' => true,
								    					'alt' => 'type',
								    					'type' => 'text',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'id' => 'delivered_date'
														));
	                     
	                        ?>
	                    </div>
                	</div><br><br>

                	<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Quantity Delivered:</label>
	                    <div class="col-lg-9">
	                        <?php
	                          echo $this->Form->input('quantity_delivered', array(
	    												//'value' => 
	    												'readonly' => true,
								    					'alt' => 'type',
								    					'type' => 'text',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'id' => 'quantity_delivered'
														));
	                     
	                        ?>
	                    </div>
                	</div><br><br>

                	<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Accepted Quantity:</label>
	                    <div class="col-lg-9">
	                        <?php
	                          echo $this->Form->input('accepted_qty', array(
	    												//'value' => 
	    												'readonly' => true,
								    					'alt' => 'type',
								    					'type' => 'text',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'id' => 'accepted_qty'
														));
	                     
	                        ?>
	                    </div>
                	</div><br><br>

                	<div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Total Price:</label>
	                    <div class="col-lg-9">
	                        <?php
	                          echo $this->Form->input('total_price', array(
	    												//'value' => 
	    												//'readonly' => true,
								    					'alt' => 'type',
								    					'type' => 'text',
								    					'label' => false,
								   						'class' => 'form-control col-lg-4 required',
								    					'empty' => false,
								    					'id' => 'total_price'
														));
	                     
	                        ?>
	                    </div>
                	</div><br><br>
                	<div class="col-lg-3">
						<button type="submit" class="btn btn-success pull-right">Save</button>
					</div>

					<?php
                        echo $this->Html->link('Cancel', array('controller' => 'salesInvoice', 
                        									   'action' => 'index'), array(
                												'class' =>'btn btn-primary',
                												'escape' => false
                												));
	                 ?>


	   		 	</div>
	   		</div>
	   	</div>
	</div>
	

</html>


	

	

	

	

	

	

	

	

	