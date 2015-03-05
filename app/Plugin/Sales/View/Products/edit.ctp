<?php echo $this->element('sales_option'); ?><br><br>

<?php echo $this->Form->create('Product', array(
									'url'=>( array(
										'controller' => 'products',
										'action' => 'saveProduct'
											)
									)), array(
										 'class' => 'form-horizontal'
									 		));

?>
<?php echo $this->Html->script('Sales.item_type');?>

	<div class="row">
	    <div class="col-lg-12">
	        <div class="main-box">
        		<header class="main-box-header clearfix">
        			<h1>View Product</h1>
   		 		</header>
   		 		<center>
		 					
	        
		           	 <div class="main-box-body clearfix">
		                <div class="form-group">
		                    <label for="inputPassword1" class="col-lg-2 control-label">Company Name</label>

		                    <div class="col-lg-9">
		                    	<?php
		                           			echo $this->Form->input('companyId', array( 
		                           									'value' => $companyName['Company']['id'],
		                           									'type' => 'hidden',
				                           							'alt' => 'type',
											    					'label' => false,
											   						'class' => 'form-control'
											    					//'empty' => '--Select Category--'
											    					//'id' => 'co'
															));
		                        		?>
		                        <?php
		                           echo $companyName['Company']['company_name'];
		                        ?>


		                    </div>
		                </div> <br><br>
						 <div class="form-group">
			                <label for="inputPassword1" class="col-lg-2 control-label">Name</label>
			                <div class="col-lg-9">
								<div class="input-group">
									
									 <?php
									 	echo $this->Form->input('companyId', array( 
		                           									'value' => $productDetails['Product']['product_name'],
		                           									'type' => 'text',
				                           							'alt' => 'type',
											    					'label' => false,
											   						'class' => 'form-control'
											    					//'empty' => '--Select Category--'
											    					//'id' => 'co'
															));
		                 
		                        	?>
		                        <br>
								</div>
								<span class="help-block" style= "color:white">ex. MM/DD/YYYY</span>
			                </div>
			            </div>
	             
			          <?php foreach ($customField as $key => $value) { 
			          		$keyholder = "";
			          		if($key == 2){
			          			$keyholder = $key-2;

			          		}
			          		else if($key == 12){
			          			$keyholder = $key-4;
			          		}
			          		else{

			          			$keyholder = $key-3;

			          		}
			          	//pr($keyholder);?>
														
						 <div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label"><?php echo $customField[$key]?></label>

							<div class="col-lg-9">
								<div class="input-group">
								<?php echo $this->Form->input($customField[$key], array( 
		                           									'value' =>!empty($productDetails['ProductSpec'][$keyholder]['description']) ? $productDetails['ProductSpec'][$keyholder]['description'] : '' ,
		                           									'type' => 'text',
				                           							'alt' => 'type',
											    					'label' => false,
											   						'class' => 'form-control'
											    					//'empty' => '--Select Category--'
											    					//'id' => 'co'
															));
								?>
								</div>
	                       		<span class="help-block" style= "color:white">ex. MM/DD/YYYY</span>
							</div>
						 </div>
							<span class="help-block" style= "color:white">ex. MM/DD/YYYY</span>
						
						<?php }?>
						
						<span class="help-block" style= "color:white">ex. MM/DD/YYYY</span>
		              	<div class="form-group">
		              		<div class="col-lg-3">
								<?php echo $this->Form->input('Save', array( 
		                           									
		                           									'type' => 'submit',
				                           							'alt' => 'type',
											    					'label' => false,
											   						'class' => 'btn btn-primary'
											    					//'empty' => '--Select Category--'
											    					//'id' => 'co'
															));
								?>
							</div>
							
							<div class="col-lg-3">
								<?php 
			                        echo $this->Html->link('Cancel', 
			                        								array(
	                									   'controller' => 'customer_sales', 
	                									 	'action' => 'view',
	                									 	$productDetails['Product']['id']
			                        									),
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
	    	</center>
	    </div>
	</div>  
</div>

<?php echo $this->Form->end(); ?>
