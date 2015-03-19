<?php echo $this->element('sales_option'); ?><br>
<?php echo $this->Html->script('Sales.custom');?>
<?php echo $this->Form->create('CreateOrder',array('url'=>(array('controller' => 'create_order','action' => 'insert')),'class' => 'form-horizontal'));?>

<ul class="nav nav-tabs" id ="quotation">
	<?php
		for($x = 0; $x < $count; $x++){
			if($x == 0){
				$class = "active";

			}
			else{
				$class ="";
			}
	?>
			<li class = "<?php echo $class; ?>" value ="<?php echo $x+1;?>"><a href="#<?php echo $x;?>" data-toggle="tab">Quotation <?php echo $x+1;?> </a></li>
	<?php
		}
	?>						
</ul>
<?php 
    echo $this->Form->input('quotationId', array( 
        						'type' => 'hidden',
        						'value' => $quotationData['Quotation']['id'],
        						'class' => 'form-control item_type required', 
            					'label' => false, 
            					'id' => 'quotationId',
        					));
?>
<?php 
    echo $this->Form->input('position', array( 
        						'type' => 'hidden',
        						'value' => 1,
        						'class' => 'form-control item_type required', 
            					'label' => false, 
            					'id' => 'position',
        					));
?>
<?php 
    echo $this->Form->input('quotationNumber', array( 
        						'type' => 'hidden',
        						'value' => $quotationData['Quotation']['unique_id'],
        						'class' => 'form-control item_type required', 
            					'label' => false, 
            					'id' => 'quotationNumber',
        					));
?>
<?php 
    echo $this->Form->input('companyId', array( 
        						'type' => 'hidden',
        						'value' => $companyData['Company']['id'],
        						'class' => 'form-control item_type required', 
            					'label' => false, 
            					'id' => 'companyId',
        					));
?>
<?php 
    echo $this->Form->input('generatePoNumber', array( 
        						'type' => 'hidden',
        						'value' => 'PO-'.time(),
        						'class' => 'form-control item_type required', 
            					'label' => false, 
            					'id' => 'generatePoNumber',
        					));
?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
			<div class="form_group">
				<div class="col-lg-12 col-md-4 col-sm-4">
					<div class="main-box clearfix">
						<h1>Create Order</h1>
						<div class="col-lg-12">
							<div class="form-group" >
								<div class="col-lg-3">PO Number</div>
								<div class="col-lg-8">
									<?php 
							            echo $this->Form->input('po_number', array( 
							                						'type' => 'text',
							                						'class' => 'form-control item_type required', 
							                    					'label' => false, 
							                    					'id' => 'po_number',
							                					));
							        ?>
									
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3"></div>
								<div class="col-lg-8">
				    			<?php 
                                    echo $this->Form->checkbox('checkAdd', array('id' => 'checkAdd')). 
                                    						" <font color='blue' style='position: relative;top: -2px;' ><span id='add'>Click to Generated PO Number</span></font>";
                                ?>
                                 <?php 
                                    echo $this->Form->checkbox('checkBack', array('id' => 'checkBack')). 
                                    						"<font color='blue' style='position: relative;top: -2px;'><span id='back'> Back</span></font>";
                                ?>
                                </div>

                            </div>
						</div>


						<p id ="quotations">
						</p>

						<div class="col-lg-12">
							<div class="form-group" >
								<div class="col-lg-3">Delivery Date</div>
								<div class="col-lg-8">
									<?php
			                           	echo $this->Form->input('delivery_date', array( 
		                           									'type' => 'text',
				                           							'alt' => 'type',
											    					'label' => false,
											   						'class' => 'form-control',
											    					'empty' => false,
											    					'id' => 'datepickerDate'
												    	
												    
																));
			                       	?>
									
								</div>
							</div>
							<div class="col-lg-3"></div>
							<span class="help-block">ex. MM/DD/YYYY</span>
						</div>

						<div class="form-group">
							<div class="col-lg-3">
								<button type="submit" class="btn btn-success pull-right">Submit Quotation</button>
							</div>
							<div class="col-lg-8">
								<?php 
			                        echo $this->Html->link('Cancel', array(
			                        							'controller' => 'quotations', 
			                        							'action' => 'view',
			                        							$quotationData['Quotation']['id'], 
			                        							$companyData['Company']['id']), array(
			                        								'class' =>'btn btn-primary','escape' => false
			                        							));
			                    ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<?php echo $this->Form->end(); ?>