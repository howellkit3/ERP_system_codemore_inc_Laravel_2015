<style type="text/css">#QuotationField12Description{background-color:#fff;}</style>
<div style="clear:both"></div>
      
<?php echo $this->element('purchasings_option'); ?><br><br>

<?php if(!empty($inquiry['Inquiry']['id'])) {

	echo $this->element('inquiry_quotation');

} else { ?>
	
	<div class="row">
		<div class="col-lg-12">
			
			<div class="row">
				<div class="col-lg-12">
					<header class="main-box-header clearfix">
							                    
						<h1 class="pull-left">
							Create Purchase Request
						</h1>
						<?php 
	                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'requests', 'action' => 'create'),array('class' =>'btn btn-primary pull-right','escape' => false));
	                    ?>
					</header>

				</div>
			</div>
			<?php echo $this->Form->create('Request',array('url'=>(array('controller' => 'requests','action' => 'create'))));?>
				<div class="row">
					<div class="col-lg-12">
					  <div class="main-box">
						<div class="top-space"></div>
							<div class="main-box-body clearfix">
								<div class="main-box-body clearfix">
									<div class="form-horizontal">

	                                    <div class="form-group">
											<label class="col-lg-2 control-label">Name</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('Request.name', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Request Name'));
	                                            ?>
											</div>
										</div>

										<div class="form-group" id="existing_items">
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('Request.pur_type_id', 
	                                                						array( 
	                                                						'options' => array($purchasingTypeData),	
	                                                						'type' => 'select',
	                                                						'class' => 'form-control item_type categorylist required', 
	                                                    					'label' => false, 
	                                                    					'placeholder' => 'Item',
	                                                    					'empty' => '--Select Category--'
	                                                    					));
	                                            ?>
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword1" class="col-lg-2 control-label"> Remarks</label>
											<div class="col-lg-8">
												<?php 
												echo $this->Form->textarea('Request.remarks', array('class' => 'form-control item_type',
												'alt' => 'Request Inquiry',
												'label' => false,
												'rows' => '6'));
												?>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					

					<div class="main-box">
						<div class="top-space"></div>
							<header class="main-box-header clearfix">
							                    
									<h1 class="pull-left">
										Purchase Item
									</h1>

								</header>
							<div class="main-box-body clearfix">
								<div class="main-box-body clearfix">
									<div class="form-horizontal">
										<div class="form-group" >
											
												<label class="col-lg-2 control-label"><span style="color:red">*</span>Item</label>
												<div class="col-lg-6">
													<?php 
		                                                echo $this->Form->input('PurchasingItem.name', 
		                                                									array( 
		                                                						'options' => array($itemData),  
		                                                						'class' => 'form-control item_type required item_name', 
		                                                    					'label' => false,
		                                                    					'readonly' => 'readonly',
		                                                    					'placeholder' => 'Item',
		                                                    					));
		                                            ?>


		                                        </div>
											

											<div class="col-lg-2">

												<a data-toggle="modal" href="#myModalItem" class="btn btn-primary mrg-b-lg pull-right  "><i class="fa fa-search-plus fa-lg"></i> Select Item</a>

											</div>

											<button type="button" class="add-field  table-link danger btn btn-success" onclick="cloneContactData('contactPersonNumber_section', this)"><i class="fa fa-plus"></i></button>

										</div>
										<section id="appending_items">
										<div class="form-group">
											<label class="col-lg-2 control-label">Size</label>
											<div class="col-lg-1">
												<?php 
		                                            echo $this->Form->input('PurchasingItem.size1', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Size'));
	                                            ?>
											</div>
											<div class="col-lg-1">
													<?php 
													echo $this->Form->input('PurchasingItem.size1_unit_id', array(
						                                'options' => array($unitData),  
						                                'label' => false,
						                                'class' => 'form-control required',
						                                'empty' => '---Select Unit---'
						                                 )); 
						                        ?>

						                         <?php 
		                                                echo $this->Form->input('PurchasingItem.foreign_key', 
		                                                									array( 
		                                                						'class' => 'form-control item_id required item_id', 
		                                                						'type' => 'hidden',
		                                                    					'label' => false,
		                                                    					'readonly' => 'readonly',
		                                                    					'placeholder' => 'Item',
		                                                    					));
		                                            ?>



		                                            <?php 
		                                                echo $this->Form->input('PurchasingItem.model', 
		                                                									array( 
		                                                						'class' => 'form-control item_model required item_id', 
		                                                						'type' => 'hidden',
		                                                    					'label' => false,
		                                                    					'readonly' => 'readonly',
		                                                    					'placeholder' => 'Item',
		                                                    					));
		                                            ?>

											</div>
											<label class="col-lg-1 sizeWith">&emsp;&emsp;x </label>
											<div class="col-lg-1"> 
												<?php 
		                                            echo $this->Form->input('PurchasingItem.size2', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Size'));
	                                            ?>
											</div> 
											<div class="col-lg-1">
												<?php 
													echo $this->Form->input('PurchasingItem.size2_unit_id', array(
						                                'options' => array($unitData),  
						                                'label' => false,
						                                'class' => 'form-control required',
						                                'empty' => '---Select Unit---'
						                                 )); 
						                        ?>
											</div>
											<label class="col-lg-1 sizeWith">&emsp;&emsp;x </label>
											<div class="col-lg-1"> 
												<?php 
		                                            echo $this->Form->input('PurchasingItem.size3', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Size'));
	                                            ?>
											</div>
											
											<div class="col-lg-1">
												<?php 
													echo $this->Form->input('PurchasingItem.size3_unit_id', array(
						                                'options' => array($unitData),  
						                                'label' => false,
						                                'class' => 'form-control required',
						                                'empty' => '---Select Unit---'
						                                 )); 

						                        ?>
											</div> 
										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
											<div class="col-lg-3">
												<?php 
													echo $this->Form->input('PurchasingItem.quantity', array(
		                                            								'class' => 'form-control item_type number required',
		                                            								'type' => 'number',
								                                                    'label' => false,
								                                                    'data' => 0,
								                                                    'placeholder' => 'Quantity',
								                                                    'value' => 0));

						                        ?>
											</div>
											<div class="col-lg-2">
												<?php 
													echo $this->Form->input('PurchasingItem.quantity_unit_id', array(
						                                'options' => array($unitData),  
						                                'label' => false,
						                                'class' => 'form-control required',
						                                'empty' => '---Select Unit---'
						                                 )); 

						                        ?>
											</div>

											
												
											
										</div>
										
										
										</section>

										<section id="appending_place">
										</section>
	                                   
										<div class="form-group">
											<div class="col-lg-2"></div>
												<div class="col-lg-8">
												<?php echo $this->Form->submit('Submit Request',array('class' => 'btn btn-primary','div' => false,'name' => 'submit','value' => 'pending')); ?>

												&nbsp;
												<?php echo $this->Html->link('<button type="submit" class="btn btn-default">Cancel</button>', array('controller' => 'quotations', 'action' => 'index'),array('escape' => false));
												?>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				</div>
			
	

	<?php echo $this->element('item_modal'); ?>


	<script>
		
	jQuery(document).ready(function($){
		$("#QuotationCreateForm").validate();
			//datepicker
			$('.datepick').datepicker({
				format: 'yyyy-mm-dd'
			});
			
	});

	$(document).ready(function(){
		$("body").on('click','.add-field', function(e){
			var html = $("#appending_items").html();
			//alert(html);

	   
	       $(this).parents('.form-horizontal').find('#appending_place').append('<div id = "idhover">\
	       	<div class="form-horizontal removeItem">\
	       																	<br><br>\
	       																<div class="form-group " >\
						 												<label class="col-lg-2 control-label">\
						 													<span style="color:red">*</span>Item\
						 												</label>\
																		<div class="col-lg-6">\
																			<input type="readonly" placeholder="Item" class="form-control required"  />\
																		</div>\
																		<div class="col-lg-2">\
																			<a data-toggle="modal" href="#myModalItem" class="btn btn-primary mrg-b-lg pull-right  "><i class="fa fa-search-plus fa-lg"></i> Select Item</a>\
																		</div>\
																		<div class="col-lg-2">\
																		<button type="button" class="add-field table-link danger btn btn-success" ><i class="fa fa-plus"></i></button>\
																		<button type="button" class="remove-field  btn btn-danger" ><i class="fa fa-minus" ></i></button>\
																		</div>\
			 														</div>\
			 														' + html +
			 														'</div>');


	    });
	});

	$("body").on('click','.remove-field', function(e){
		 	
		 	$(this).parents('.removeItem').remove();
		 	
		});

	$("body").on('hover','#idhover', function(e){
		 	
		 	$(this).parents('.removeItem').remove();
		 	
		});


	 </script>
		
<?php } ?>

