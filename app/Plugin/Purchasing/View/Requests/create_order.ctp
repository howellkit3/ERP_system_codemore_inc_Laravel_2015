<?php $this->Html->addCrumb('Request List', array('controller' => 'requests', 'action' => 'request_list')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'requests', 'action' => 'view',$requestId)); ?>
<?php $this->Html->addCrumb('Create Order', array('controller' => 'requests', 'action' => 'create_order',$requestId)); ?>

<?php  echo $this->Html->script('Purchasing.create_order_selector');?>

<?php  echo $this->Html->script('Purchasing.modal_clone');?>

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
					                                'class' => 'form-control required supplier-select',
					                                'empty' => '---Select Payment Term---'
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Contact Number</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.contact_id', array(
					                                //'options' => array($supplierData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required supplier-number',
					                                'empty' => '---Contact Number---'
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Contact Person</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.contact_person_id', array(
					                                //'options' => array($supplierData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required supplier-contact-person',
					                                'empty' => '---Contact Person---'
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

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('PurchaseOrder.remarks',array( 
	                                            						'class' => 'form-control', 
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

									<hr>
									
									<?php foreach ($requestItem as $key => $value) { ?>
										

										<?php $dataPlus = $key + 1; ?>

										<?php 
						    				echo $this->Form->input('RequestItemIdHolder.'.$key.'.id', array(
												'class' => 'form-control',
						                        'label' => false,
						                        'type' => 'hidden',
						                        'placeholder' => 'Size',
						                        'value' => $value['RequestItem']['id']));
						                ?>
								               

										<div class="form-group" >
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Item</label>
											<div class="col-lg-5">

												<?php $dataPlus = $key + 1; ?>

								                <input type="text" class="form-control item_name required" name="data[RequestItem][<?php echo $key ?>][nameToShow]" value="<?php echo $value['RequestItem']['name'] ?>" readonly>

								                <input type="hidden" class="form-control item_name required" name="data[RequestItem][<?php echo $key ?>][name]" value="<?php echo $value['RequestItem']['name'] ?>" readonly>

								                <?php 
								                    echo $this->Form->input('RequestItem.'.$key.'.foreign_key', 
																	array( 
														'class' => 'form-control item_id required', 
														'type' => 'hidden',
								    					'label' => false,
								    					'readonly' => 'readonly',
								    					'value' => $value['RequestItem']['foreign_key']
								    					));
								                ?>

								                <?php 
								                    echo $this->Form->input('RequestItem.'.$key.'.model', 
																	array( 
														'class' => 'form-control item_model required ', 
														'type' => 'hidden',
								    					'label' => false,
								    					'readonly' => 'readonly',
								    					'value' => $value['RequestItem']['model']
								    					));
								                    echo $this->Form->input('RequestItem.'.$key.'.request_uuid', 
																	array( 
														'class' => 'form-control item_model required ', 
														'type' => 'hidden',
								    					'label' => false,
								    					'readonly' => 'readonly',
								    					'value' => $value['RequestItem']['request_uuid']
								    					));
								                ?>

								        	</div>

											<div class="col-lg-4">

												<a data-toggle="modal" href="#myModalItem" data-modal="<?php echo $dataPlus ?>" class="modal-button btn btn-primary mrg-b-lg pull-left  "><i class="fa fa-search-plus fa-lg"></i> Select Item</a>

												&emsp;
												<button type="button" class="add-field1  table-link danger btn btn-success " onclick="cloneDatarequest('cloneMe', this)"><i class="fa fa-plus"></i></button>
												<!-- <button type="button" class="add-field1sd proxy-counter add-request-section table-link danger btn btn-success" ><i class="fa fa-plus"></i></button> -->
												
												<?php 
													if ($key == 0 ) { 
														$newClass = 'hide-remove';
													}else{
														$newClass = ' ';
													}
												?>
													<button type="button" class="remove remove-purchase-order btn btn-danger <?php echo $newClass ?>"><i class="fa fa-minus" ></i></button>
											
											</div>

										</div>

										<div class="form-group">

											<label class="col-lg-2 control-label">Size</label>
											<div class="col-lg-3">
												<?php 
								                    echo $this->Form->input('RequestItem.'.$key.'.size1', array(
														'class' => 'form-control item_type required',
								                        'label' => false,
								                        'placeholder' => 'Size',
								                        'disabled' => false,
								                        'type' => 'number',
								                        'value' => $value['RequestItem']['size1']));
								                ?>
											</div>

											<div class="col-lg-3">
												<?php 
													echo $this->Form->input('RequestItem.'.$key.'.size1_unit_id', array(
								                        'options' => array($unitData),  
								                        'label' => false,
								                        'class' => 'form-control required',
								                        'empty' => '---Select Unit---',
								                        'disabled' => false,
								                        'value' => $value['RequestItem']['size1_unit_id']
								                         )); 
													
								                ?>

											</div>

											<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label"> </label>
											<div class="col-lg-3">
												<?php 
													echo $this->Form->input('RequestItem.'.$key.'.size2', array(
														'class' => 'form-control item_type required',
								                        'label' => false,
								                        'placeholder' => 'Size',
								                        'disabled' => false,
								                        'type' => 'number',
								                        'value' => $value['RequestItem']['size2']));

								                ?>
											</div>

											<div class="col-lg-3">
												<?php 
													echo $this->Form->input('RequestItem.'.$key.'.size2_unit_id', array(
								                        'options' => array($unitData),  
								                        'label' => false,
								                        'class' => 'form-control required',
								                        'empty' => '---Select Unit---',
								                        'disabled' => false,
								                        'default' => $value['RequestItem']['size2_unit_id']
								                         )); 

								                ?>
											</div>

											<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label"> </label>
											<div class="col-lg-3">
												<?php 
													echo $this->Form->input('RequestItem.'.$key.'.size3', array(
														'class' => 'form-control item_type required',
								                        'label' => false,
								                        'placeholder' => 'Size',
								                        'disabled' => false,
								                        'type' => 'number',
								                        'value' => $value['RequestItem']['size3']));

								                ?>
											</div>

											<div class="col-lg-3">
												<?php 
													echo $this->Form->input('RequestItem.'.$key.'.size3_unit_id', array(
								                        'options' => array($unitData),  
								                        'label' => false,
								                        'class' => 'form-control required',
								                        'empty' => '---Select Unit---',
								                        'disabled' => false,
								                        'default' => $value['RequestItem']['size3_unit_id']
								                         )); 

								                ?>
											</div>

											<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
											<div class="col-lg-3">
												<?php 
													echo $this->Form->input('RequestItem.'.$key.'.quantity', array(
														'class' => 'form-control item_type number required',
														'type' => 'number',
								                        'label' => false,
								                        'disabled' => false,
								                        'placeholder' => 'Quantity',
								                        'value' => $value['RequestItem']['quantity']));

								                ?>
											</div>

											<div class="col-lg-3">
												<?php 
													echo $this->Form->input('RequestItem.'.$key.'.quantity_unit_id', array(
								                        'options' => array($unitData),  
								                        'label' => false,
								                        'disabled' => false,
								                        'class' => 'form-control required',
								                        'empty' => '---Select Unit---',
								                        'default' => $value['RequestItem']['quantity_unit_id']
								                         )); 

								                ?>
											</div>

										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Price</label>
											<div class="col-lg-3">
												<?php 
													echo $this->Form->input('RequestItem.'.$key.'.unit_price', array(
														'class' => 'form-control item_type number required',
														'type' => 'number',
								                        'label' => false,
								                        'placeholder' => 'Price'));

								                ?>
											</div>

											<div class="col-lg-3">
												<?php 
													echo $this->Form->input('RequestItem.'.$key.'.unit_price_unit_id', array(
								                        'options' => array($currencyData),  
								                        'label' => false,
								                        'class' => 'form-control required',
								                        'empty' => '---Select Unit---'
								                         )); 

								                ?>
											</div>

										</div>

										<hr>
									<?php } ?>

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

<div class="modal fade" id="myModalItem" role="dialog" data-item="" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog specModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Material</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-reorder"></i></span>
                            <select  class="form-control select-group ItemGroup" >
                                <option value="0">--Select Item Group--</option>
                                <option value="1">General Items</option>
                                <option value="2">Substrates</option>
                                <option value="3">Compound Substrates</option>
                                <option value="4">Corrugated Papers</option>
                            </select>
                        </div>
                    </div>
                </div>

                <header class="main-box-header clearfix">
                    <h1 class="pull-left">Item List</h1>
                    <div class="filter-block pull-right">
                        <div class="form-group">

                            <input placeholder="Search..."  class="form-control searchItem" type="search" disabled="disabled" />
                            <i class="fa fa-search search-icon"></i>
                         
                        </div>  
                    </div>
                </header>

                <input type="hidden" class="current_page" />

                <input type="hidden" class="show_per_page" />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><a href="#"><span>Select</span></a></th>
                            <th style="width:200px;"><a href="#"><span>Item Number</span></a></th>
                            <th><a href="#"><span>Name</span></a></th>
                        </tr>
                    </thead>
                    <tbody class="tableProduct" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >
                    </tbody>

                    <tbody class="Itemtable" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >
                    </tbody>
                </table>

                <div class="table-responsive">
                    <header class="main-box-header clearfix">
                        <h1 class="pull-left">Item List</h1>
                        <div class="filter-block pull-right">
                            <div class="form-group pull-left">

                            </div>
                        </div>
                    </header>
                </div>

                <div class="form-group">
                    <div class="col-lg-10"></div>
                    <div class="col-lg-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="md-overlay"></div>	


<?php echo $this->element('item_modal'); ?>

<script>
	$(document).ready(function() {

		$(".hide-remove").hide();

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

	$("body").on('keyup','.searchItem', function(e){
	        var searchInput = $(this).val();
	        var thisMe = $(this);
	        var itemGroup = $('.ItemGroup').val();

	        if(searchInput != ''){

	            thisMe.parents('.modal-body').find('.tableProduct').hide();
	            thisMe.parents('.modal-body').find('.Itemtable').show();
	            //alert('hide');

	        }else{
	            thisMe.parents('.modal-body').find('.tableProduct').show();
	            thisMe.parents('.modal-body').find('.Itemtable').hide();
	            //alert('show');
	        }

	        if(searchInput){
	            $.ajax({
	                type: "GET",
	                url: serverPath + "purchasing/requests/product_search/"+itemGroup+"/"+searchInput+"/"+itemGroup,
	                dataType: "html",
	                success: function(data) {
	                   
	                    if(data){
	                       
	                        thisMe.parents('.modal-body').find('.Itemtable').html(data); 
	                    }else{
	                         
	                        thisMe.parents('.modal-body').find('.Itemtable').html('<font color="red"><b>No result..</b></font>'); 
	                    }
	                    
	                }
	            });

	        }
	        
	    });

</script>
