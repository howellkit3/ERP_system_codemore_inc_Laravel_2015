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
							Make Quotation
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
	                                        echo $this->Form->input('Company.id', array('class' => 'form-control item_type',
						                        'hidden' => 'hidden',
						                        'readonly' => 'readonly',
						                        'label' => false,
						                        'id' => 'id'));
	                                    ?>



	                                    <div class="form-group">
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Name</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('Quotation.name', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Quotation Name'));
	                                            ?>
											</div>
										</div>

	                                    
	                                     <div class="form-group">
	                                    	<label class="col-lg-2 control-label"><span style="color:red">*</span>Company</label>
											<div class="col-lg-8">
												<?php echo $this->Form->input('Company.id', array(
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required contacpersonlist',
					                                'options' => array($companyData),
					                                'empty' => '--Select Company--'  
					                             )); 

					                            ?>
											</div>
										</div>



	                                    <div class="form-group">
	                                    	<label class="col-lg-2 control-label"><span style="color:red">*</span>Attention</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('Quotation.attention_details', array(
		                                            								'type' => 'select',
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Attention',
								                                                    'empty' => '--Select Contact Person--'));
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
												<label class="col-lg-2 control-label">Quantity</label>
												<div class="col-lg-2">
													<?php 
			                                            echo $this->Form->input('QuotationItemDetail.0.quantity', array(
			                                            								'class' => 'form-control item_type number',
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
												<label class="col-lg-2 control-label">Unit Price</label>
												<div class="col-lg-2">
													<?php 
			                                            echo $this->Form->input('QuotationItemDetail.0.unit_price', array(
			                                            								'class' => 'form-control item_type unitprice number',
									                                                    'data' => 'unitprice',
									                                                    'type' => 'text',
									                                                    'label' => false,
									                                                    'placeholder' => 'Unit Price'));
		                                            ?>
													
												</div>

												<div class="col-lg-6">
												<?php echo $this->Form->input('QuotationItemDetail.0.unit_price_currency_id', array(
														                                'options' => array($currencyData),  
														                                'label' => false,
														                                'class' => 'form-control',
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
			                                            								'class' => 'form-control item_type vatprice',
									                                                    'type' => 'text',
									                                                    'label' => false,
									                                                    'readonly' => 'readonly',
									                                                    'placeholder' => 'Vat Price'));
		                                            ?>
													
												</div>
											</div>
												
											<div class="form-group">
												<label class="col-lg-2 control-label"></label>
												<div class="col-lg-8">
													<!-- <div class="checkbox-nice"> -->
														
														<input id="checkbox-1" class="checkvat checkbox-nice" type="checkbox" name="[QuotationItemDetail][0][vat_price]" rel=".12" onclick="vatprice('quotationItemDetail',this)">
														<font color="gray"> Click to Compute the Unit Price with VAT </font>
														<!-- <label><font color="gray"> Click to Compute the Unit Price with VAT </font></label> -->
													<!-- </div> -->
													<?php 
			                                            // echo $this->Form->input('QuotationItemDetail.0.vat_price', array(
			                                            // 								'class' => 'item_type Vat-check',
									                                      //               'alt' => 'address1',
									                                      //               'type' => 'checkbox',
									                                      //               'rel' => .12,
									                                      //               'value' => 'VAT Exempted',
									                                      //               'label' => false,
									                                      //               'placeholder' => 'Vat Price'))."<font color='gray' style='position: relative;top: -2px;' >Click to Compute the Unit Price with VAT</font>";
		                                            ?>
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
											<label class="col-lg-2 control-label">Proccess</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('QuotationDetail.process', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Proccess'));
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

<?php echo $this->Html->script('Sales.create_ajax');?>


<?php } ?>

