<?php echo $this->element('sales_option'); ?><br><br>

<?php echo $this->Form->create('Product', array(
									'url'=>( array(
										'controller' => 'products',
										'action' => 'add'
											)
									)), array(
										 'class' => 'form-horizontal'
									 		));

?>
<?php echo $this->Html->script('Sales.item_type');?>

	<div class="row">
	    <div class="col-lg-12">
	        <div class="main-box">
	        	<?php 
           			 echo $this->Html->link('<i class="fa fa-pencil  fa-lg">
           			 						</i> Edit', array( 
           			 						'controller' => 'products', 
           			 						'action' => 'edit',
           			 						$companyName['Company']['id'],
           			 						$productDetails['Product']['id']
           			 						), array(
           			 						'class' =>'btn btn-primary pull-right',
           			 						'escape' => false
           			 						));
        		?>
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
			                           			echo $productDetails['Product']['product_name']
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
								<label for="inputPassword1" class="col-lg-2 control-label"><?php echo $customField[$key]?></label><br>

								<div class="col-lg-9">
									<?php echo !empty($productDetails['ProductSpec'][$keyholder]['description']) ? $productDetails['ProductSpec'][$keyholder]['description'] : '' ; ?>

                               		<span class="help-block" style= "color:white">ex. MM/DD/YYYY</span>
								</div>
							</div>
								<span class="help-block" style= "color:white">ex. MM/DD/YYYY</span>
							
						<?php }?>
							
							<span class="help-block" style= "color:white">ex. MM/DD/YYYY</span>
			              	<div class="form-group">
								
								<div class="col-lg-3">
									<?php 
				                        echo $this->Html->link('Cancel', 
				                        								array(
	                    									   'controller' => 'customer_sales', 
	                    									 	'action' => 'view',
	                    									 	$companyName['Company']['id'] 
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
