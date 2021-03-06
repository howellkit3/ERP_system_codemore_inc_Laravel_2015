<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Quotation', array('controller' => 'quotation', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Create', array('controller' => 'quotation', 'action' => 'create')); ?>
<?php  echo $this->Html->script('Sales.company_quotation');?>
<?php echo $this->Html->script('Sales.checkvat');?>
<?php echo $this->Html->script('Sales.sale-autocomplete');?>
<?php  echo $this->Html->script('Sales.create_ajax');?>
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
							Make Quotation
						</h1>
						<?php 
	                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'quotations', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
	                    ?>
					</header>
				</div>
			</div>
			<?php echo $this->Form->create('Quotation',array('url'=>(array('controller' => 'quotations','action' => 'add')))); ?>
				<div class="row">
					<div class="col-lg-12">
						<div class="main-box">
							<div class="top-space"></div>
							<div class="main-box-body clearfix">
								<div class="main-box-body clearfix">
									<div class="form-horizontal">


										<?php 
	                                        echo $this->Form->input('Company.id', array('class' => 'form-control item_type',
						                        'hidden' => 'hidden',
						                        'readonly' => 'readonly',
						                        'label' => false,
						                        'id' => 'id'));
	                                    ?>



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

										<div class="form-group" id="existing_items">
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Category</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('Quotation.item_category_holder_id', 
	                                                						array( 
	                                                						'options' => array($itemCategoryData),	
	                                                						'type' => 'select',
	                                                						'class' => 'form-control item_type categorylist required', 
	                                                    					'label' => false, 
	                                                    					'placeholder' => 'Item',
	                                                    					'empty' => '--Select Category--'
	                                                    					));
	                                            ?>
											</div>
										</div>

										<div class="form-group" id="existing_items">
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('Quotation.item_type_holder_id', 
	                                                						array( 
	                                                						'type' => 'select',
	                                                						'class' => 'form-control item_type jsoncat required', 
	                                                    					'label' => false, 
	                                                    					'id' => 'item_type_holder_id',
	                                                    					'placeholder' => 'Item',
	                                                    					'empty' => '--Select Type--'
	                                                    					));
	                                            ?>
											</div>
										</div>

										<div class="form-group" id="existing_items">
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Item</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('QuotationDetail.product_id', 
	                                                									array( 
	                                                						'type' => 'select',
	                                                						'class' => 'form-control item_type required', 
	                                                    					'label' => false,
	                                                    					'id' => 'txtProduct',
	                                                    					'id' => 'product_holder_id',
	                                                    					'placeholder' => 'Item',
	                                                    					'empty' => '--Select Item--'
	                                                    					));
	                                            ?>
											</div>
										</div>
	                                    
	                                     <div class="form-group">
	                                    	<label class="col-lg-2 control-label"><span style="color:red">*</span>Company</label>
											<div class="col-lg-8">
												<?php echo $this->Form->input('Company.id', array(
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required contacpersonlist quotations_attention_details',
					                                'options' => array($companyData),
					                                'empty' => '--Select Company--'  
					                             )); 

					                            ?>
											</div>
										</div>

	                                    <div class="form-group">
	                                    	<label class="col-lg-2 control-label">Attention</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('Quotation.attention_details', array(
                        								'type' => 'select',
                        								'class' => 'form-control item_type contacpersonlists',
	                                                    'label' => false,
	                                                    'placeholder' => 'Attention',
	                                                    'id' => 'QuotationAttentionDetails',
	                                                    'empty' => '--Select Contact Person--'));
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

				<section class="cloneMe quotationItemDetail">
					<div class="row">
						<div class="col-lg-12">
							<div class="main-box">
								<div class="top-space"></div>
								<div class="main-box-body clearfix">
									<div class="main-box-body clearfix">
										<div class="form-horizontal">
											<div class="form-group">
												<label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
												<div class="col-lg-2">
													<?php 
			                                            echo $this->Form->input('QuotationItemDetail.0.quantity', array(
                            								'class' => 'form-control item_type number required',
		                                                    'type' => 'text',
		                                                    'label' => false,
		                                                    'placeholder' => 'Quantity'));
		                                            ?>
													 
												</div>

												<div class="col-lg-6">
												<?php echo $this->Form->input('QuotationItemDetail.0.quantity_unit_id', array(
					                                'options' => array($unitData),  
					                                'label' => false,
					                                'class' => 'form-control required',
					                                'empty' => '---Select Unit---'
					                                 )); 

					                            ?>
												</div>

											</div>

											<div class="form-group">
												<label class="col-lg-2 control-label"><span style="color:red">*</span>Unit Price</label>

												<div class="col-lg-2">
												<?php echo $this->Form->input('QuotationItemDetail.0.unit_price_currency_id', array(
					                                'options' => array($currencyData),  
					                                'label' => false,
					                                'class' => 'form-control required currency-option',
					                                'empty' => '-Select Currency-'
					                                 ));  ?>

												</div>

												<div class="col-lg-3">
													<?php 
			                                            echo $this->Form->input('QuotationItemDetail.0.unit_price_proxy', array(
                            								'class' => 'form-control item_type unitprice number required vatEx',
		                                                    'data' => 'unitprice',
		                                                    'type' => 'text',
		                                                    'type' => 'hidden',
		                                                    'label' => false,
		                                                    'data-section' => 'quotationItemDetail',
		                                                    'placeholder' => 'Unit Price'));

			                                            echo $this->Form->input('QuotationItemDetail.0.unit_price', array(
                            								'class' => 'form-control item_type unitprice2 number required vatEx',
		                                                    'data' => 'unitprice2',
		                                                    'type' => 'text',
		                                                    'label' => false,
		                                                    'data-section' => 'quotationItemDetail',
		                                                    'placeholder' => 'Unit Price'));
		                                            ?>
													
												</div>

												<div class="col-lg-3">
													<?php echo $this->Form->input('QuotationItemDetail.0.unit_price_unit_id', array( 
						                                'options' => array($unitData),  
						                                'label' => false,
						                                'class' => 'form-control required',
						                                'empty' => '---Select Unit---'
						                                 )); 

						                            ?>
												</div>

											</div>

											<div class="form-group vat-section" style="display:none;">
												<label class="col-lg-2 control-label">Vat Option</label>
												<div class="col-lg-4">
													<?php 
														$vatType = array('Vatable Sale' => 'Vatable Sale',
																'Vat Exempt' => 'Vat Exempt',
																'Zero Rated Sale' => 'Zero Rated Sale');

														$vatTypeUSD = array(
																'Vat Exempt' => 'Vat Exempt',
																'Zero Rated Sale' => 'Zero Rated Sale');

														echo $this->Form->input('QuotationItemDetail.0.vat_status', array( 
							                                'options' => array($vatType),  
							                                'label' => false,
							                                'class' => 'form-control for-php required select-vat-status',
							                                'empty' => '---Select Vat Type---'
							                                 )); 

														echo $this->Form->input('QuotationItemDetail.0.vat_status', array( 
							                                'options' => array($vatTypeUSD),  
							                                'label' => false,
							                                'empty' => '---Select Vat Type---',
							                                'class' => 'form-control required for-usd'
							                                 ));

						                            ?>
													
												</div>

												<div class="col-lg-4 vat-option" style="display:none;">
													<?php 
			                                            echo $this->Form->input('QuotationItemDetail.0.vat_price', array(
                            								'class' => 'form-control item_type vatIn vatprice',
		                                                    'type' => 'text',
		                                                    'type' => 'hidden',
		                                                    'label' => false,
		                                                    'readonly' => 'readonly',
		                                                    'data-section' => 'quotationItemDetails',
		                                                    'placeholder' => 'Vat Price'));
		                                            ?>
													
		                                            <?php 
			                                            echo $this->Form->input('QuotationItemDetail.0.vat_price_proxy', array(
                            								'class' => 'form-control item_type vatIn2 vatprice2',
		                                                    'type' => 'text',
		                                                    'label' => false,
		                                                    'readonly' => 'readonly',
		                                                    'data-section' => 'quotationItemDetails',
		                                                    'placeholder' => 'Vat Price'));
		                                            ?>


												</div>
											</div>
												
											<div class="form-group vat-option" style="display:none;">
												<label class="col-lg-2 control-label"></label>
												<div class="col-lg-8">

													<input id="checkbox-1" class="checkEx vat-exclusive" type="checkbox" data-section='quotationItemDetail' name="[QuotationItemDetail][0][unit_price]"rel=".12" name ="togglecheckboxtext"><label>
													<font color="gray">&nbsp;Check to enable VAT Price   </font></label>


													&nbsp; &nbsp;
													
													<input id="checkbox-1" class="checkvat checkIn checkbox-nice vat-price" type="checkbox" data-section='quotationItemDetail' name="[QuotationItemDetail][0][vat_price]" rel=".12"><label><font color="gray">&nbsp; Click to Compute the Unit Price/VAT Exclusive</font></label>
														
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

				<div class="row">
					<div class="col-lg-12">
						<div class="main-box">
							<div class="top-space"></div>
							<div class="main-box-body clearfix">
								<div class="main-box-body clearfix">
									<div class="form-horizontal">

										<!-- <div class="frmSearch">
											<input type="text" id="search-box" placeholder="Country Name" />
											<div id="suggesstion-box"></div>
										</div> -->
										<!-- <div class="ui-widget">
										  <label for="tags">Tags: </label>
										  <input id="tags">
										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label">Color Sample</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('QuotationDetail.sample', array(
                        								'class' => 'form-control item_type color-autocomplete',
	                                                    'label' => false,
	                                                    'placeholder' => 'Sample'));
	                                            ?>
											</div>
											<div id="suggesstion-box"></div>
										</div> -->

										<div class="form-group">
											<label class="col-lg-2 control-label">Color</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('QuotationDetail.color', array(
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
	                                    	<label class="col-lg-2 control-label"><span style="color:red">*</span>Terms</label>
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
		                                            echo $this->Form->input('Quotation.validity', array(
	                    								'type' => 'text',
	                    								'class' => 'form-control item_type datepick',
	                                                    'label' => false,
	                                                    'placeholder' => 'Validity'));
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
		</div>
	</div>
	
	<script>
		
		jQuery(document).ready(function($){
			$("#QuotationCreateForm").validate();
			//datepicker
			$('.datepick').datepicker({
				format: 'yyyy-mm-dd'
			});
		
		});

	 </script>
		
<?php } ?>

