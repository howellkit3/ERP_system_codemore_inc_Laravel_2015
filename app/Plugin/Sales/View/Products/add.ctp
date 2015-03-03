<?php echo $this->Form->create('Product', array(
																'url'=>( 
														  array(
																'controller' => 'products',
																'action' => 'add'
															))),
														  array(
														  		'class' => 'form-horizontal'
													 		));

?>
<?php echo $this->Html->script('Sales.item_type');?>
	<div class="row">
	    <div class="col-lg-12">
	        <div class="main-box">
	  	        			<header class="main-box-header clearfix">
	                	<h1>Add Schedule</h1>
	           		 	</header>
	            
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
				                <label for="inputPassword1" class="col-lg-2 control-label">Item</label>
				                <div class="col-lg-9"> 
									<div class="input-group">
										<span class="input-group-addon"></span>
										   <?php
			                           			echo $this->Form->input('item_category', array( 
			                           									'options' => $itemCategory,
			                           									'type' => 'select',
					                           							'alt' => 'type',
												    					'label' => false,
												   						'class' => 'form-control',
												    					'empty' => '--Select Category--',
												    					'id' => 'item_category'
																));
			                        		?>
			                        	<span class="input-group-addon"></span>
			                        		 <?php
			                           			echo $this->Form->input('item_type', array( 
			                           									'type' => 'select',
					                           							'alt' => 'type',
												    					'label' => false,
												   						'class' => 'form-control',
												    					'empty' =>'--Select Type--',
												    					'id' => 'item_type'
																));
			                        		?>
									</div>
									<span class="help-block" style= "color:white">ex. MM/DD/YYYY</span>
				                </div>
				            </div>

				    
				            <div class="form-group">
				                <label for="inputPassword1" class="col-lg-2 control-label">Name</label>
				                <div class="col-lg-9">
									<div class="input-group">
										<span class="input-group-addon"></span>
										 <?php
			                           			echo $this->Form->input('productName', array( 
			                           									'type' => 'text',

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
				                <label for="inputPassword1" class="col-lg-2 control-label">Remarks</label>
				                <div class="col-lg-9">
									<div class="input-group">
										<span class="input-group-addon"></span>
										 <?php
			                           			echo $this->Form->input('remarks', array( 
			                           									'type' => 'textarea',
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

	        </div>
	    </div>  
	</div>
<?php echo $this->Form->end(); ?>