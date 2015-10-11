<?php $this->Html->addCrumb('Ware House', array('controller' => 'ware_house_systems', 'action' => 'index')); ?>
<div style="clear:both"></div>
<?php echo $this->element('ware_house_option');  ?>

<div class="row">
	<div class="col-lg-12">

		<div class="main-box">
			<?php echo $this->Session->flash(); ?>
			<header class="main-box-header clearfix">
				<h2>
					Receive of Receipts
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'receivings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
					
					<!-- <button style="margin-right:10px;" class="md-trigger btn btn-primary mrg-b-lg pull-right" data-modal="modal-1"><i class="fa fa-plus-circle fa-lg"></i> Add Customer</button> -->
					
					<div class="md-overlay"></div>

				</h2>
			</header>
			<?php echo $this->Form->create('ReceiveReceipts',array('url'=>(array('controller' => 'receivings','action' => 'receive_receipt')),'class' => 'form-horizontal'));?>
				<div class="main-box-body clearfix">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label">PO Number</label>
							<div class="col-lg-8">
								<?php 
	                                echo $this->Form->input('ReceiveReceipt.po_number', array('class' => 'form-control item_type',
	                                    'alt' => 'Address',
	                                    'label' => false,
	                                    'id' => 'address1'));
	                            ?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label">Item Name</label>
							<div class="col-lg-8">
								<?php 
	                                echo $this->Form->input('ReceiveReceipt.item_name', array('class' => 'form-control item_type',
	                                    'alt' => 'Address',
	                                    'label' => false,
	                                    'id' => 'address1'));
	                            ?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Supplier</label>
							<div class="col-lg-8">
							<?php 
	                            echo $this->Form->input('ReceiveReceipt.supplier_id', array(
	                                'options' => array($supplierData),
	                                'type' => 'select',
	                                'label' => false,
	                                'class' => 'form-control col-lg-4 required',
	                                'empty' => '---Select Supplier---',
	                                'id' => 'select_company'
	                                
	                                 ));
	                        ?>
							</div>
						</div>

						<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label"><span style="color:red">*</span> Item Type</label>
							<div class="col-lg-8">
							<?php 
	                            echo $this->Form->input('ReceiveReceipt.supplier_id', array(
	                                'options' => array($supplierData),
	                                'type' => 'select',
	                                'label' => false,
	                                'class' => 'form-control col-lg-4 required',
	                                'empty' => '---Select Item Type---' 
	                                
	                                 ));
	                        ?>
							</div>
						</div>		
						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label">No. Packs of Boxes</label>
							<div class="col-lg-8">
								<?php 
	                                echo $this->Form->input('ReceiveReceipt.pack_quantity', array('class' => 'form-control item_type',
	                                    'label' => false,
	                                    'id' => 'email'
	                                    ));
	                            ?>
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label">Quantity</label>
							<div class="col-lg-8">
								<?php 
	                                echo $this->Form->input('ReceiveReceipt.quantity', array('class' => 'form-control item_type',
	                                    'label' => false,
	                                    'id' => 'email'
	                                    ));
	                            ?>
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label">Lot/Batch No.</label>
							<div class="col-lg-8">
								<?php 
	                                echo $this->Form->input('ReceiveReceipt.lot', array('class' => 'form-control item_type',
	                                    'label' => false,
	                                    'id' => 'email'
	                                    ));
	                            ?>
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword1" class="col-lg-2 control-label"> Remarks</label>
							<div class="col-lg-8">
								<?php 
	                                echo $this->Form->textarea('ReceiveReceipt.remarks', array('class' => 'form-control item_type',
	                                    'alt' => 'Request Inquiry',
	                                    'label' => false,
	                                    'rows' => '6'));
	                            ?>
	                             
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button type="submit" class="btn btn-success">Submit</button>
							
								<?php 
			                        echo $this->Html->link('Cancel ', array('controller' => 'customer_sales', 'action' => 'inquiry'),array('class' =>'btn btn-primary ','escape' => false));
			                    ?>
							</div>
						</div>
					</form>
				</div>	
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>