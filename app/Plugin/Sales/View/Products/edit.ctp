<?php echo $this->element('sales_option'); ?><br><br>

<?php echo $this->Form->create('Product', array(
									'url'=>( array(
										'controller' => 'products',
										'action' => 'saveProduct',)
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
	                           			echo $this->Form->input('productId', array( 
	                           									'value' => $productDetails['Product']['id'],
	                           									'type' => 'hidden',
			                           							'alt' => 'type',
										    					'label' => false,
										   						'class' => 'form-control'
										    					//'empty' => '--Select Category--'
										    					//'id' => 'co'
														));
		                       		?>
									
									 <?php
									 	echo $this->Form->input('productName', array( 
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

			            	?>
															
							 <div class="form-group">
								<label for="inputPassword1" class="col-lg-2 control-label"><?php echo $customField[$key]?></label>

								<div class="col-lg-9">
									<div class="input-group">
										<!-- <span class="input-group-addon"></span> -->
									<?php 
                                        echo $this->Form->input('QuotationField.'.$key.'.description', array('class' => 'form-control item_type test',
                                        	'value' =>!empty($productDetails['ProductSpec'][$keyholder]['description']) ? $productDetails['ProductSpec'][$keyholder]['description'] : '' ,
                                            'alt' => 'address1',
                                            'label' => false,
                                            'required' => true));
                                    ?><br>
                                    <?php 
                                        echo $this->Form->input('QuotationField.'.$key.'.custom_fields_id', array(
                                        	'type' => 'hidden',
                                        	'value' => $key,
                                            'label' => false));
                                        echo $this->Form->input('QuotationField.'.$key.'.id', array(
                                        	'type' => 'hidden',
                                        	'value' => !empty($productDetails['ProductSpec'][$keyholder]['id']) ? $productDetails['ProductSpec'][$keyholder]['id'] : '' ,
                                            'label' => false));
                                    ?>
                               		</div>

                               		<span class="help-block" style= "color:white">ex. MM/DD/YYYY</span>
								</div>
							</div>

							
						<?php }?>
	             		<br>
						
						
		              	<div class="form-group">
		              		
          					<div class="col-lg-2">
								<?php echo $this->Form->input('Save', array( 
																	'type' => 'submit',
				                           							'alt' => 'type',
											    					'label' => false,
											   						'class' => 'btn btn-primary pull-left'
										    					//'empty' => '--Select Category--'
										    					//'id' => 'co'
																));
								?>
									
								<?php 
			                        echo $this->Html->link('Cancel', array(
	                									   'controller' => 'products', 
	                									 	'action' => 'view',
	                									 	$companyName['Company']['id'],
	                									 	$productDetails['Product']['id']), array(
	        												'class' =>'btn btn-primary pull-right',
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
