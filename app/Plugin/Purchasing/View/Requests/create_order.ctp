<?php $this->Html->addCrumb('Request List', array('controller' => 'requests', 'action' => 'request_list')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'requests', 'action' => 'view',$requestId)); ?>
<?php $this->Html->addCrumb('Create Order', array('controller' => 'requests', 'action' => 'create_order',$requestId)); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						Create Purchase Order
					</h1>
					<?php 
						 echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'requests', 'action' => 'view',$requestId),array('class' =>'btn btn-primary pull-right','escape' => false));
					?>
				</header>

			</div>
		</div>

		<?php echo $this->Form->create('PurchaseOrder',array('url'=>(array('controller' => 'requests','action' => 'purchase_order'))));?>
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
	                                        ?>
										</div>
									</div>
									
									<div class="form-group">
	                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Supplier</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.supplier_id', array(
					                                'options' => array($supplierData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required',
					                                'empty' => '---Select Payment Term---'
					                                 )); 

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
	                                                					'id' => 'generate-poNumber' 
	                                                					));
	                                            echo $this->Form->input('PurchaseOrder.request_id',array( 
	                                            						'class' => 'form-control  required', 
	                                                					'label' => false,
	                                                					'type' => 'hidden',
	                                                					'value' => $requestId
	                                                					));
	                                        ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label"></label>
										<div class="col-lg-8">
											<div class="checkbox-nice">
												<input id="checkbox-1" type="checkbox" class="generate-poNumber">
												<label for="checkbox-1"> Generate PUO Number </label>
											</div>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Payment Terms</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.payment_term', array(
					                                'options' => array($paymentTermData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required ',
					                                'empty' => '---Select Payment Term---'
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Delivery Date</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('PurchaseOrder.delivery_date',array( 
	                                            						'class' => 'form-control datepick required', 
	                                                					'label' => false,
	                                                					'placeholder' => 'Delivery Date'  
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
					                                'readonly' => true,
					                                'value' => 'RQO'.$requestData['Request']['uuid']
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
					                                'readonly' => true,
					                                'value' => $type[$requestData['Request']['pur_type_id']]
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
												 echo $this->Html->link(' Cancel ', array('controller' => 'requests', 'action' => 'view',$requestId),array('class' =>'btn btn-default','escape' => false));
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