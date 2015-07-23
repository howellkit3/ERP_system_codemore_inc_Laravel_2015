<?php $this->Html->addCrumb('Edit', array('controller' => 'purchase_orders', 'action' => 'edit',$purchaseOrderId)); ?>

<?php  echo $this->Html->script('Purchasing.create_order_selector');?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						Edit Purchase Order
					</h1>
					<?php 
						 echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'purchase_orders', 'action' => 'view',$purchaseOrderId),array('class' =>'btn btn-primary pull-right','escape' => false));
					?>
				</header>

			</div>
		</div>

		<?php echo $this->Form->create('PurchaseOrder',array('url'=>(array('controller' => 'purchase_orders','action' => 'edit',$purchaseOrderId))));?>
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Purchase Order Name</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('PurchaseOrder.name',array( 
	                                            						'class' => 'form-control', 
	                                                					'label' => false,
	                                                					'placeholder' => 'Purchase Order Name'  
	                                                					));
	                                            echo $this->Form->input('PurchaseOrder.id',array( 
	                                            						'class' => 'form-control', 
	                                                					'label' => false,
	                                                					'type' => 'hidden'  
	                                                					));
	                                            echo $this->Form->input('PurchaseOrder.version',array( 
	                                            						'class' => 'form-control', 
	                                                					'label' => false,
	                                                					'type' => 'hidden'  
	                                                					));
	                                        ?>
										</div>
									</div>
									
									<div class="form-group">
	                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Supplier</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.supplier_name', array(
					                                'type' => 'text',
					                                'label' => false,
					                                'disabled' => true,
					                                'class' => 'form-control required ',
					                                'value' => $purchaseOrderData['Supplier']['name']
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Contact Number</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.contact_id', array(
					                                'options' => array($contactData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required supplier-number',
					                                'empty' => '---Contact Number---',
					                                'default' => $purchaseOrderData['PurchaseOrder']['contact_id'],
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Contact Person</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.contact_person_id', array(
					                                'options' => array($supplierContactPersonData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required supplier-contact-person',
					                                'empty' => '---Contact Person---',
					                                'default' => $purchaseOrderData['PurchaseOrder']['contact_person_id']
					                                //'value' => $purchaseOrderData['SupplierContactPerson']['firstname'].' '.$purchaseOrderData['SupplierContactPerson']['lastname']
					                                 )); 
				                            	//pr($purchaseOrderData['PurchaseOrder']['contact_person_id']);die;
					                            ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">PUO No.</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('PurchaseOrder.po_number',array( 
	                                            						'class' => 'form-control  required', 
	                                                					'label' => false,
	                                                					'placeholder' => 'PUO Number',
	                                                					'id' => 'generate-poNumber' ,
	                                                					'disabled' => true
	                                                					));
	                                           
	                                        ?>
										</div>
									</div>

									<!-- <div class="form-group">
	                                	<label class="col-lg-2 control-label"></label>
										<div class="col-lg-8">
											<div class="checkbox-nice">
												<input id="checkbox-1" type="checkbox" class="generate-poNumber" disabled checked>
												<label for="checkbox-1"> Generate PUO Number </label>
											</div>
										</div>
									</div> -->

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Payment Terms</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.payment_term', array(
					                                'options' => array($paymentTermData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required ',
					                                'empty' => '---Select Payment Term---',
					                                'default' => $purchaseOrderData['PurchaseOrder']['payment_term']
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Delivery Date</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('PurchaseOrder.delivery_date_field',array( 
	                                            						'class' => 'form-control datepick required', 
	                                                					'label' => false,
	                                                					'placeholder' => 'Delivery Date',
	                                                					'value' => date("Y-m-d", strtotime($purchaseOrderData['PurchaseOrder']['delivery_date']))  
	                                                					));
	                                            
	                                        ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('PurchaseOrder.remarks',array( 
	                                            						'class' => 'form-control required', 
	                                                					'label' => false,
	                                                					'placeholder' => 'Remarks'  
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

			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<header class="main-box-header clearfix">
						
							<h2 class="pull-left">
								Request Purchase Detail
							</h2>
							
						</header>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									
									<div class="form-group">
	                                	<label class="col-lg-2 control-label">RQO No.</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.rqo_number', array(
					                                'type' => 'text',
					                                'label' => false,
					                                'class' => 'form-control required',
					                                'disabled' => true,
					                                'value' => 'RQO'.$purchaseOrderData['Request']['uuid']
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Type</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.pur_type_id', array(
					                                'type' => 'text',
					                                'label' => false,
					                                'class' => 'form-control required',
					                                'disabled' => true,
					                                'value' => $type[$purchaseOrderData['Request']['pur_type_id']]
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

			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									
									<div class="form-group">
	                                	<label class="col-lg-2 control-label"> </label>
										<div class="col-lg-8">
											
				                           	<button type="submit" class="btn btn-primary">Submit</button>
				                           	&emsp;
				                           	<?php 
												 echo $this->Html->link(' Cancel ', array('controller' => 'requests', 'action' => 'view',$purchaseOrderId),array('class' =>'btn btn-default','escape' => false));
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
	</div>
</div>
<script>
	$(document).ready(function() {

		$("#PurchaseOrderCreateOrderForm").validate();

		$('.datepick').datepicker({
			format: 'yyyy-mm-dd'
		});
	});
	// generate PO number
	$('.generate-poNumber').change(function(){

		var currentTime = new Date()
		var month = currentTime.getMonth() + 1
		var year = currentTime.getFullYear()
		var hour = currentTime.getHours()
		var minute = currentTime.getMinutes()
		var seconds = currentTime.getSeconds()

		year = year.toString().substr(2,2);

	    month = month + "";

	    hour = hour + "";

	    minute = minute + "";

	    seconds = seconds + "";

	    if (month.length == 1)
	    {
	        month = "0" + month;
	    }

	    if (hour.length == 1)
	    {
	        hour = "0" + hour;
	    }

	    if (minute.length == 1)
	    {
	        minute = "0" + minute;
	    }

	    if (seconds.length == 1)
	    {
	        seconds = "0" + seconds;
	    }
	    var ranDom = Math.floor(Math.random()*9000) + 1000;
	    var code = year.concat(month,ranDom);
	    
		if($(this).is( ":checked" ) == true){
			
            var data = "PUO-" + code;
           	// data.substr(0,-3);
			$('#generate-poNumber').val(data);
			
			$('#generate-poNumber').attr('readonly','true');
        }
        
        if($(this).is( ":checked" ) == false){
			
			$('#generate-poNumber').val('');
			$('#generate-poNumber').removeAttr("readonly");
           
        }
	
	});
</script>