<?php echo $this->Html->script('Sales.inquiry');?>
<?php  echo $this->Html->script('Sales.company_quotation');?>
<?php echo $this->Html->script('Sales.checkvat');?>
<?php  echo $this->Html->script('Sales.create_ajax');?>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						Make Quotation
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'review_inquiry',!empty($inquiry['Inquiry']['id']) ? $inquiry['Inquiry']['id'] : ''),array('class' =>'btn btn-primary pull-right','escape' => false));
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
					                        'value' => $company['Company']['id']));
                                       		 echo $this->Form->input('Inquiry.id', array('class' => 'form-control item_type', 'type' => 'hidden', 'value' => !empty($inquiry['Inquiry']['id']) ? $inquiry['Inquiry']['id'] : '' , 'label' => false));
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
												<?php 
													// echo $this->Form->input('Company.name', array(
					        //                         'type' => 'select',
					        //                         'label' => false,
					        //                         'class' => 'form-control required contacpersonlist',
					        //                         'options' => array($companyData),  
					        //                         'default' => $company['Company']['id'],

					        //                          )); 

					                            ?>
					                            <?php 

					                            	echo $this->Form->input('Company.id', array(
						                                'type' => 'hidden',
						                                'label' => false,
						                                'class' => 'form-control required contacpersonlist',  
						                                'value' => $company['Company']['id'],
						                                 )); 

					                            	echo $this->Form->input('Company.name', array(
						                                'type' => 'text',
						                                'label' => false,
						                                'readonly' => true,
						                                'class' => 'form-control required contacpersonlist', 
						                                'value' => $company['Company']['company_name'],
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
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Attention',
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
													                                'class' => 'form-control required',
													                                'empty' => '-Select Currency-'
													                                 )); 

				                            ?>
											</div>

											<div class="col-lg-3">
												<?php 
		                                            echo $this->Form->input('QuotationItemDetail.0.unit_price', array(
		                                            								'class' => 'form-control item_type unitprice number required',
								                                                    'data' => 'unitprice',
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
												
												<input id="checkbox-1" class="checkvat checkbox-nice vat-price" type="checkbox" data-section='quotationItemDetail' name="[QuotationItemDetail][0][vat_price]" rel=".12">
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
												<button type="submit" class="btn btn-primary pull-left">Submit Quotation</button>&nbsp;
												<?php 
							                        echo $this->Html->link('Cancel', array('controller' => 'quotations', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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

<div id="config-tool" class="closed">
	<a id="config-tool-cog">
		<i class="fa fa-pencil-square-o fa-lg"></i>
	</a>
	
	<div id="config-tool-options">
		<h4>Request Inquiry</h4>
		<div class="main-box-body clearfix">
			<form role="form">
				<div class="form-group">
					<label for="exampleInputEmail1">Inquiry</label>
					<?php 
		                echo $this->Form->textarea('Inquiry.quotes', array('class' => 'form-control item_type',
		                    'alt' => 'Request Inquiry',
		                    'label' => false,
		                    'value' => !empty($inquiry['Inquiry']['quotes']) ? $inquiry['Inquiry']['quotes'] : '' ,
		                    'readonly' => 'readonly'
		                    ));
		            ?>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Remarks</label>
					<?php 
		                echo $this->Form->textarea('Inquiry.remarks', array('class' => 'form-control item_type',
		                    'alt' => 'Request Inquiry',
		                    'label' => false,
		                    'value' => !empty($inquiry['Inquiry']['remarks']) ? $inquiry['Inquiry']['remarks'] : '',
		                    'readonly' => 'readonly'
		                    ));
		            ?>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
		
		// $("[name*='data[Quotation][product]']").each(function () {
		// $(this).rules("add", {
		//     required: true
		// });
		// });
		jQuery(document).ready(function($){
			$("#QuotationCreateForm").validate();
			//datepicker
			$('.datepick').datepicker({
				format: 'yyyy-mm-dd'
			});
			
});
	
    </script>

<?php echo $this->Html->script('Sales.create_ajax');?>