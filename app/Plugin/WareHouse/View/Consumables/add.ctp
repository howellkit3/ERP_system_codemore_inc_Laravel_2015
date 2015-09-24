<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Consumables', array('controller' => 'consumables', 'action' => 'index')); ?>

<?php $this->Html->addCrumb('Add', array('controller' => 'consumables', 'action' => 'add')); ?>
<div style="clear:both"></div>
<?php  echo $this->element('ware_house_option');?>
<br>
<?php echo $this->Form->create('Item', array(
									'url'=>( array(
										'controller' => 'products',
										'action' => 'add')
										)), array(
										'class' => 'form-horizontal'
									 ));

?>
<?php echo $this->Html->script('Sales.item_type');?>
	<div class="row">
	    <div class="col-lg-12">
	        <div class="main-box">
	  	        		<header class="main-box-header clearfix">
	                	<h1>Add Consumables</h1>
	           		 	</header>
	            
			           	 <div class="main-box-body clearfix">
			             <?php echo $this->Form->create('Item',array('url' => array('controller' => 'consumables', 'action' => 'add') )); ?>
			             <div class="form-group">
				                <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> Item</label>
				                <div class="col-lg-9"> 
									
										   <?php
			                           			
			                           			echo $this->Form->input('item_category', array(
			                           									'type' => 'hidden', 
			                           									'value' => '1',
					                           							'alt' => 'type',
												    					'label' => false,
												   						'class' => 'form-control',
																));
			                        	
			                           			echo $this->Form->input('name', array( 
					                           							'alt' => 'type',
												    					'label' => false,
												   						'class' => 'form-control',
																));
			                        		?>
										<span class="help-block" style= "color:white"> &nbsp </span>
				            </div>


			            	</div>
			            	<div class="form-group">
				                <label for="inputPassword1" class="col-lg-2 control-label"><span style="color:red">*</span> User/ Departments</label>
				                <div class="col-lg-9"> 
									<?php 

										echo $this->Form->input('department_id',
																array( 
																		'options' => $departments,
					                           							'alt' => 'type',
												    					'label' => false,
												   						'class' => 'form-control',
												   						'empty' => '--- Select Department ---'
																));
			                        ?>
										<span class="help-block" style= "color:white"> &nbsp </span>
				               </div>
				           </div>
			            	
			            	<div class="form-group">
				                <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> Description</label>
				                <div class="col-lg-9"> 
										   <?php
			                           		
			                           		echo $this->Form->input('description', array( 
					                           							'alt' => 'type',
												    					'label' => false,
												   						'class' => 'form-control',
																));
			                        		?>
											<span class="help-block" style= "color:white"> &nbsp </span>
				           		 </div>
				        	</div>
				    
		             		<div class="form-group">
				                <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> Supplier </label>
				                <div class="col-lg-9"> 
										   <?php
			                           		
			                           		$suppliers = array_merge($suppliers,array('other' => 'Other'));

			                           		echo $this->Form->input('supplier', array(
			                           									'options' => $suppliers, 
					                           							'alt' => 'type',
												    					'label' => false,
												   						'class' => 'form-control',
												   						'empty' => '--- Select Supplier---'
																));
			                        		?>
											<span class="help-block" style= "color:white"> &nbsp </span>
				                </div>
				        	</div>
				        

				        <div class="form-group">
				                <label for="inputPassword1" class="col-lg-2 control-label"> <span style="color:red">*</span> Remaining Stocks </label>
				                <div class="col-lg-9"> 
										   <?php 

										   echo $this->Form->input('remainig_stocks', array( 
					                           							'alt' => 'type',
					                           							'type' => 'number',
												    					'label' => false,
												   						'class' => 'form-control',
																));
			                        		?>
										<span class="help-block" style= "color:white"> &nbsp </span>
				                </div>
				        	</div>
				        
							
			              	<div class="form-group">
								<div class="col-lg-3">
									<button type="submit" class="btn btn-success pull-left">Save</button> &nbsp 
									<?php 
				                        echo $this->Html->link('Cancel', array('controller' => 'consumables', 'action' => 'index'),
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
<?php echo $this->Form->end(); ?>
