<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Quotation', array('controller' => 'quotation', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Create', array('controller' => 'quotation', 'action' => 'create')); ?>
<?php  echo $this->Html->script('Sales.company_quotation');?>
<?php echo $this->Html->script('Sales.checkvat');?>
<style type="text/css">#QuotationField12Description{background-color:#fff;}</style>
<div style="clear:both"></div>


        
<?php echo $this->element('sales_option');?><br><br>

<?php if(!empty($inquiry['Inquiry']['id'])) {

	echo $this->element('inquiry_quotation');

} else { ?>
	
	<div class="row">
		<div class="col-lg-12">
			
			<div class="row">
				<div class="col-lg-12">
					<header class="main-box-header clearfix">
							                    
						<h1 class="pull-left">
							Edit Quotation
						</h1>
						<?php 

	                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'quotations', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
	                    ?>
					</header>

				</div>
			</div>
			<?php echo $this->Form->create('Quotation',array('url'=>(array('controller' => 'quotations','action' => 'add'))));?>
				<div class="row">
					<div class="col-lg-12">
						<div class="main-box">
							<div class="top-space"></div>
							<div class="main-box-body clearfix">
								<div class="main-box-body clearfix">
									<div class="form-horizontal">
										
	                                    <?php 
	                                        echo $this->Form->input('Quotation.id', array('class' => 'form-control item_type',
						                        'hidden' => 'hidden',
						                        'readonly' => 'readonly',
						                        'label' => false,
						                        'id' => 'id'));
	                                    ?>

	                                     <?php 
	                                        echo $this->Form->input('Company.id', array('class' => 'form-control item_type',
						                        'hidden' => 'hidden',
						                        'readonly' => 'readonly',
						                        'label' => false,
						                        'id' => 'id'));
	                                    ?>

	                                    <?php 
	                                        echo $this->Form->input('QuotationItemDetail.0.id', array('class' => 'form-control item_type',
						                        'hidden' => 'hidden',
						                        'readonly' => 'readonly',
						                        'label' => false,
						                        'id' => 'id'));
	                                    ?>
	                                    <?php if(!empty($this->request->data['Quotation']['name'])){  ?>
	                                    	<div class="form-group">
												<label class="col-lg-2 control-label">Name</label>
												<div class="col-lg-8">
													<?php 
			                                            echo $this->Form->input('Quotation.name', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'placeholder' => 'Quotation Name'));
		                                            ?>
												</div>
											</div>
	                                    <?php } ?>
	                                    
	                                    <div class="form-group" id="existing_items">
											<label class="col-lg-2 control-label">Category</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('Quotation.item_category_holder_id', 
	                                                									array( 
	                                                						'options' => array($itemCategoryData),
	                                                						'type' => 'select',
	                                                						'class' => 'form-control item_type categorylist required', 
	                                                    					'label' => false, 
	                                                    					'placeholder' => 'Item',
	                                                    					'empty' => '--Select Category--',
	                                                    					'default' => $this->request->data['Quotation']['item_category_holder_id']
	                                                    					));
	                                                
	                                            ?>
											</div>
										</div>

										<div class="form-group" id="existing_items">
											<label class="col-lg-2 control-label">Type</label>
											<div class="col-lg-8">
												<?php 
													
													 echo $this->Form->input('Quotation.item_type_holder_id', 
	                                                									array( 
	                                                						//'value' => array($itemTypeData),
	                                                						'options' => array($itemTypeData),	
	                                                						'type' => 'select',
	                                                						'class' => 'form-control item_type jsoncat required', 
	                                                    					'label' => false, 
	                                                    					'id' => 'item_type_holder_id',
	                                                    					'placeholder' => 'Item',
	                                                    					'empty' => '--Select Type--',
	                                                    					'default' => $this->request->data['Quotation']['item_type_holder_id']
	                                                    					));
	                                            ?>
											</div>
										</div>

										<div class="form-group" id="existing_items">
											<label class="col-lg-2 control-label">Item</label>
											<div class="col-lg-8">
												<?php 
													
	                                                echo $this->Form->input('QuotationDetail.product_id', 
	                                                									array( 
	                                                						'options' => array($productData),				
	                                                						'type' => 'select',
	                                                						'class' => 'form-control item_type required', 
	                                                    					'label' => false,
	                                                    					//'id' => 'txtProduct',
	                                                    					'id' => 'product_holder_id',
	                                                    					'placeholder' => 'Item',
	                                                    					'empty' => '--Select Item--',
	                                                    					'default' => $quotationData['QuotationDetail']['product_id']

	                                                    					));
	                                            ?>
											</div>
										</div>

	                                    <div class="form-group">
	                                    	<label class="col-lg-2 control-label">Company</label>
											<div class="col-lg-8">
												<?php echo $this->Form->input('Quotation.company_id', array(
					                                'options' => array($companyData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required contacpersonlist',
					                                'empty' => '---Select Company---',
					                                'id' => 'select_company'
					                                 )); 

					                            ?>
											</div>
										</div>

	                                    <div class="form-group">
	                                    	<label class="col-lg-2 control-label">Attention</label>
											<div class="col-lg-8">
												<?php 
													echo $this->Form->input('Quotation.attention_details',array('id' => 'quotations_attention_details','type' => 'hidden'));
	                                           
		                                            echo $this->Form->input('Quotation.attention_details', array(
		                                            								'type' => 'select',
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'default' => $this->request->data['Quotation']['attention_details']
								                                                    //'empty' => '--Select Contact Person--'
								                                                    
								                                                    ));
		                                            //pr($this->request->data['Quotation']['attention_details']);exit();
	                                            ?>

											</div>
										</div>


										
	                                	<div class="form-group">
	                                		<label class="col-lg-2 control-label">Size</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('QuotationDetail.size', array(
		                                            								'class' => 'form-control item_type',
								                                                    'type' => 'text',
								                                                    'label' => false,
								                                                    'placeholder' => 'Size'));
	                                            ?>
												  
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php foreach ($itemDetailData as $key => $itemDetailDetails) { ?>
				<?php 
                    
                    echo $this->Form->input('QuotationItemDetail.id', array('class' => 'form-control item_type',
                        'hidden' => 'hidden',
                        'readonly' => 'readonly',
                        'label' => false,
                        'name' => 'data[IdHolder]['.$key.'][id]',
                        'value' => $itemDetailDetails['QuotationItemDetail']['id'],
                        'id' => 'id'));
                ?>
			
				<section class="cloneMe quotationItemDetail">
					
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box">
								<div class="top-space"></div>
								<div class="main-box-body clearfix">
									<div class="main-box-body clearfix">
										<div class="form-horizontal">
											<div class="form-group">
												<label class="col-lg-2 control-label">Quantity</label>
												<div class="col-lg-2">
													<?php 
			                                            echo $this->Form->input('QuotationItemDetail.0.quantity', array(
                            								'class' => 'form-control item_type',
		                                                    'type' => 'text',
		                                                    'label' => false,
		                                                    'value' => $itemDetailDetails['QuotationItemDetail']['quantity'],
		                                                    'name' => 'data[QuotationItemDetail]['.$key.'][quantity]',
		                                                    'placeholder' => 'Quantity'));
		                                            ?>
													 
												</div>
												<div class="col-lg-6">
												<?php echo $this->Form->input('QuotationItemDetail.0.quantity_unit_id', array(
					                                'options' => array($unitData),  
					                                'label' => false,
					                                'default' => $itemDetailDetails['QuotationItemDetail']['quantity_unit_id'],
					                                'name' => 'data[QuotationItemDetail]['.$key.'][quantity_unit_id]',
					                                'class' => 'form-control required',
					                                'empty' => '---Select Unit---'
					                                 )); 

					                            ?>
												</div>
											</div>

											<div class="form-group">
												<label class="col-lg-2 control-label">Unit Price</label>
												<div class="col-lg-2">
												<?php echo $this->Form->input('QuotationItemDetail.0.unit_price_currency_id', array(
					                                'options' => array($currencyData),  
					                                'label' => false,
					                                'default' => $itemDetailDetails['QuotationItemDetail']['unit_price_currency_id'],
					                                'class' => 'form-control',
					                                'name' => 'data[QuotationItemDetail]['.$key.'][unit_price_currency_id]',
					                                'empty' => '---Select Currency---'
					                                 )); 

					                            ?>
												</div>
												<div class="col-lg-3">
													<?php 
			                                            echo $this->Form->input('QuotationItemDetail.0.unit_price', array(
                            								'class' => 'form-control item_type unitprice vatEx number  ',
		                                                    'data' => 'unitprice',
		                                                    'type' => 'text',
		                                                    'label' => false,
		                                                    'value' => $itemDetailDetails['QuotationItemDetail']['unit_price'],
		                                                    'name' => 'data[QuotationItemDetail]['.$key.'][unit_price]',
		                                                    'data-section' => 'quotationItemDetail',
		                                                    'placeholder' => 'Unit Price'));
		                                            ?>
													
												</div>
												<div class="col-lg-3">
						                            <?php echo $this->Form->input('QuotationItemDetail.0.unit_price_unit_id', array(
						                                'options' => array($unitData),  
						                                'label' => false,
						                                'default' => $itemDetailDetails['QuotationItemDetail']['unit_price_unit_id'],
						                                'class' => 'form-control',
						                                'name' => 'data[QuotationItemDetail]['.$key.'][unit_price_unit_id]',
						                                'empty' => '---Select Currency---'
						                                 )); 

					                            	?>
												</div>

												

											</div>

											<div class="form-group">
												<label class="col-lg-2 control-label">Vat Price</label>
												<div class="col-lg-8">
													<?php 
			                                            echo $this->Form->input('QuotationItemDetail.0.vat_price', array(
			                                            								'class' => 'form-control item_type vatIn vatprice',
									                                                    'type' => 'text',
									                                                    'label' => false,
									                                                    'value' => $itemDetailDetails['QuotationItemDetail']['vat_price'],
									                                                    'id' => 'QuotationItemDetail'.$key.'VatPrice',
									                                                    'name' => 'data[QuotationItemDetail]['.$key.'][vat_price]',
									                                                    'readonly' => 'readonly',
									                                                    'placeholder' => 'Vat Price'));
		                                            ?>
													
												</div>
											</div>
												
											<div class="form-group">
												<label class="col-lg-2 control-label"></label>
												<div class="col-lg-8">
												<?php if(!empty($itemDetailDetails['QuotationItemDetail']['vat_price'])){ 
													$ckeckName = 'data[QuotationItemDetail]['.$key.'][vat_priceC]';
													?>
													<input id="checkbox-1" class="checkEx vat-exclusive" type="checkbox" data-section='quotationItemDetail' name="[QuotationItemDetail][0][unit_price]"rel=".12" name ="togglecheckboxtext"><label>
													<font color="gray"> Check to enable VAT Price   </font></label>


													&nbsp &nbsp

													<input id="checkbox-1" class="checkvat checkbox-nice vat-price" type="checkbox" name="<?php echo $ckeckName; ?>" rel=".12" data-section='quotationItemDetail' checked="checked">

												<?php } else { ?>

													<input id="checkbox-1" class="checkvat checkbox-nice vat-price" type="checkbox" name="[QuotationItemDetail][0][vat_priceC]" data-section='quotationItemDetail' rel=".12" >

												<?php } ?>	
													<font color="gray"> Click to Compute the Unit Price with VAT </font>
														
												</div>
											</div>

											<div class="form-group">
												<label class="col-lg-2 control-label">Material</label>
												<div class="col-lg-8">
													<?php 
			                                            echo $this->Form->input('QuotationItemDetail.0.material', array(
			                                            								'class' => 'form-control item_type',
									                                                    'alt' => 'address1',
									                                                    'type' => 'text',
									                                                    'label' => false,
									                                                    'name' => 'data[QuotationItemDetail]['.$key.'][material]',
									                                                    'value' => $itemDetailDetails['QuotationItemDetail']['material'],
									                                                    'placeholder' => 'Material'));
		                                            ?>
													
												</div>
											</div>

											<div class="form-group">
												<label class="col-lg-2 control-label"></label>
													<div class="col-lg-8">
													 	<button type="button" data-model='Address' class="add-field table-link danger btn btn-success" onclick="cloneData('quotationItemDetail',this)"> <i class="fa fa-plus"></i></button>
													
														<button type="button" class="remove btn btn-danger" onclick="removeClone('quotationItemDetail')" id ="minus"><i class="fa fa-minus"></i> </button>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</section>
			<?php } ?>


				<div class="row">
					<div class="col-lg-12">
						<div class="main-box">
							<div class="top-space"></div>
							<div class="main-box-body clearfix">
								<div class="main-box-body clearfix">
									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-lg-2 control-label">Color</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('QuotationDetail.color', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Color'));
		                                            
		                                            echo $this->Form->input('QuotationDetail.id', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Color'));
	                                            ?>
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label">Process</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('QuotationDetail.process', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Process'));
	                                            ?>
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label">Packaging</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('QuotationDetail.packaging', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Packaging'));
	                                            ?>
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label">Other Specs</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('QuotationDetail.other_specs', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Other Specs'));
	                                            ?>
											</div>
										</div>

										<div class="form-group">
	                                    	<label class="col-lg-2 control-label">Terms</label>
											<div class="col-lg-8">
												<?php echo $this->Form->input('Quotation.payment_terms', array(
					                                'options' => array($paymentTermData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required contacpersonlist2',
					                                'empty' => '---Select Payment Term---',
					                                 )); 

					                            ?>
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label">Validity</label>
											<div class="col-lg-8">
												<?php 
													if ($this->request->data['Quotation']['validity']) {
														echo $this->Form->input('Quotation.validity', array(
	                        								'type' => 'text',
	                        								'class' => 'form-control item_type datepick',
		                                                    'label' => false,
		                                                    'placeholder' => 'Validity',
		                                                    'value' => date("Y-m-d", strtotime($this->request->data['Quotation']['validity']))
		                                                    ));
													} else {

			                                            echo $this->Form->input('Quotation.validity', array(
	                        								'type' => 'text',
	                        								'class' => 'form-control item_type datepick',
		                                                    'label' => false,
		                                                    'placeholder' => 'No validity date'
		                                                    ));
													}
	                                            ?>
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label">Remarks</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('QuotationDetail.remarks', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Remarks'));
	                                            ?>
											</div>
										</div>
										
										<div class="form-group">
											<div class="col-lg-2"></div>
											<div class="col-lg-8">
												<?php echo $this->Form->submit('Submit Quotation',array('class' => 'btn btn-primary','div' => false,'name' => 'submit','value' => 'pending')); ?>

												&nbsp;
												
												<?php echo $this->Form->submit('Save as Draft',array('class' => 'btn btn-warning','div' => false,'name' => 'submit','value' => 'draft')); ?>
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
			<?php echo $this->Form->end(); ?>
<!-- 		</div>
	</div>
 -->

	<script>
		
		
		jQuery(document).ready(function($){
			$("#QuotationCreateForm").validate();
			//datepicker
			$('.datepick').datepicker({
				format: 'yyyy-mm-dd'
			});
			

	});

	 </script>

<?php echo $this->Html->script('Sales.create_ajax');?>


<?php } ?>

