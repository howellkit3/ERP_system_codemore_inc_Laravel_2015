<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Quotation', array('controller' => 'quotation', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Create', array('controller' => 'quotation', 'action' => 'create')); ?>
<?php echo $this->Html->script('Sales.company_quotation');?>
<style type="text/css">#QuotationField12Description{background-color:#fff;}</style>
<div style="clear:both"></div>


        
<?php echo $this->element('sales_option');?><br><br>

<?php if(!empty($inquiry['Inquiry']['id'])) {

	echo $this->element('inquiry_quotation');

}
else{ ?>

	<?php echo $this->Form->create('Quotation',array('url'=>(array('controller' => 'quotations','action' => 'add'))));?>
		<div class="row">
		    <div class="col-lg-12">
		        <div class="main-box clearfix body-pad">
					<div class="row" id="user-profile">
						<div class="col-lg-3 col-md-4 col-sm-4">
							<div class="main-box clearfix">
							
					
								<header class="main-box-header clearfix"><span style="color:red" id = "message">PLEASE CHOOSE A COMPANY!</span>
									
									<?php echo $this->Form->input('Company.id', array(
		                                'options' => array($companyData),
		                                'type' => 'select',
		                                'label' => false,
		                                'class' => 'form-control required',
		                                'empty' => '---Select Company---',
		                                'id' => 'select_company'
		                                 )); 

		                            ?>
									
								</header>
								
								<div class="main-box-body clearfix">
									
								<!-- 	<div class="profile-stars">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o"></i>
									</div> -->
									
									<div class="profile-details">
										<?php 
			                                echo $this->Form->input('Address.address1', array('class' => 'form-control item_type',
			                                    'alt' => 'Address',
			                                    'label' => false,
			                                    'readonly' => 'readonly',
			                                    'id' => 'address1',
			                                    'placeholder' => 'Address'));
			                            ?>
									</div>
									<div class="profile-details">
										<?php 
			                                echo $this->Form->input('Contact.contact', array('class' => 'form-control item_type',
			                                    'alt' => 'Contact',
			                                    'label' => false,
			                                    'readonly' => 'readonly',
			                                    'id' => 'contact',
			                                    'placeholder' => 'Contact'
			                                    ));
			                            ?>
									</div>
									<div class="profile-details">
										<?php 
			                                echo $this->Form->input('Email.email', array('class' => 'form-control item_type',
			                                    'alt' => 'Email',
			                                    'label' => false,
			                                    'readonly' => 'readonly',
			                                    'id' => 'email',
			                                    'placeholder' => 'Email'
			                                    ));
			                            ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-9 col-md-8 col-sm-8">
							<div class="main-box clearfix">
								<div class="tabs-wrapper profile-tabs">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab-newsfeed" data-toggle="tab">Make Quotation</a></li>
									</ul>
									
									<div class="tab-content">
										<div class="tab-pane fade in active" id="tab-newsfeed">
											
											<div class="table-responsive">
												<div class="col-lg-12">
													<div class="main-box">
														<header class="main-box-header clearfix">
															<?php 
										                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'quotations', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
										                    ?>
										                    <br><br>
															<h4>
																We are pleased to submit our price quotation on your printing requirement under the following specifications:
															</h4>
														</header>
														
														<div class="main-box-body clearfix">
															<div class="form-horizontal">
																<?php 
					                                                echo $this->Form->input('Company.id', array('class' => 'form-control item_type',
													                        'hidden' => 'hidden',
													                        
													                        'label' => false,
													                        'id' => 'id'));
					                                            ?>

																<div class="form-group" id="existing_items">
																	
																	<div class="col-lg-8">
																		<div class="col-lg-5"><span style="color:red">*</span> Item</div>
																		<?php 
							                                                echo $this->Form->input('txtproduct', 
							                                                									array( 
							                                                						'type' => 'text',
							                                                						'class' => 'form-control item_type required', 
							                                                    					//'alt' => 'address1',
							                                                    					'label' => false, 
							                                                    					'id' => 'txtProduct',

							                                                    					//'empty' => '--Select Product--'
							                                                    					));
							                                            ?>
																		<?php 
							                                                echo $this->Form->input('product', 
							                                                									array( 
							                                                						'type' => 'select',
							                                                						'class' => 'form-control item_type', 
							                                                    					//'alt' => 'address1',
							                                                    					'label' => false, 
							                                                    					'id' => 'selectProduct',
							                                                    					'empty' => '--Select Product--'
							                                                    					));
							                                           	 	?>
																	</div>
																</div>
																 <div class="form-group">
																		<div class="col-lg-8">
																			<div class="col-lg-5">
																			</div>
														    				<?php 
								                                                echo $this->Form->checkbox('checkAdd', array('id' => 'checkAdd')). 
								                                                						" <font color='blue' style='position: relative;top: -2px;' ><span id='add'>Click to Search Product</span></font>";
								                                            ?>
								                                             <?php 
								                                                echo $this->Form->checkbox('checkBack', array('id' => 'checkBack')). 
								                                                						"<font color='blue' style='position: relative;top: -2px;'><span id='back'> Back</span></font>";
								                                            ?>
							                                            </div>
							                                       </div>

							                                       <div class="form-group">
								                                       <div class="col-lg-8">
																			<div class="col-lg-5">Size</div>
																			<?php 
								                                                echo $this->Form->input('QuotationField.2.description', array( 
									                                                						'type' => 'text',
									                                                						'class' => 'form-control item_type required', 
									                                                    					'label' => false, 
									                                                    					'alt' => 'address1',
								                                                    					));

								                                            ?>
								                                             <?php 
						                                                		echo $this->Form->input('QuotationField.2.custom_fields_id', array(
														                                                	'type' => 'hidden',
														                                                	'value' => 2,
														                                                    'label' => false));
						                                            		?>
																			
																		</div>
																	</div>
																<div class = "cloneFields">
							                                       <div class="form-group">
								                                       <div class="col-lg-8">
																			<div class="col-lg-5">Qty</div>
																			<?php 
								                                                echo $this->Form->input('QuotationField.3.description', array( 
									                                                						'type' => 'text',
									                                                						'class' => 'form-control item_type cloneMe required ' , 
									                                                    					'label' => false, 
									                                                    					'alt' => 'address1',
								                                               
								                                                    					));
								                                            ?>
								                                             <?php 
						                                                		echo $this->Form->input('QuotationField.3.custom_fields_id', array(
														                                                	'type' => 'hidden',
														                                                	'value' => 3,
														                                                    'label' => false));
						                                            		?>
																			
																		</div>
																	</div>

																	<div class="form-group">
																		<div class="col-lg-8">
																			<div class="col-lg-5">Unit Price</div>
																			<?php 
								                                                echo $this->Form->input('QuotationField.4.description', array( 
								                                                						'type' => 'text',
								                                                						'class' => 'form-control item_type cloneMe required ', 
								                                                    					'label' => false, 
								                                                    					'alt' => 'address1',
								                                                    				
								                                                    					));

								                                            ?>
								                                             <?php 
						                                                		echo $this->Form->input('QuotationField.4.custom_fields_id', array(
														                                                	'type' => 'hidden',
														                                                	'value' => 4,
														                                                    'label' => false));
						                                            		?>
																		
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-lg-8">
																			<div class="col-lg-5">Vat Price</div>
																			<?php 
								                                                echo $this->Form->input('QuotationField.5.description', array( 
								                                                						'type' => 'text',
								                                                						'class' => 'form-control item_type cloneMe required ', 
								                                                    					'label' => false, 
								                                                    					'alt' => 'address1',
								                                                    					));
								                                            ?>
								                                             <?php 
						                                                		echo $this->Form->input('QuotationField.5.custom_fields_id', array(
														                                                	'type' => 'hidden',
														                                                	'value' => 5,
														                                                    'label' => false));
						                                            		?>
																		</div>
																	</div>

																	<div class="form-group">
																		<div class="col-lg-8">
																			<div class="col-lg-5">Material</div>
																			<?php 
								                                                echo $this->Form->input('QuotationField.6.description', array( 
								                                                						'type' => 'text',
								                                                						'class' => 'form-control item_type cloneMe required ', 
								                                                    					'label' => false, 
								                                                    					'alt' => 'address1',
								                                                    					
								                                                    					));
								                                            ?>
								                                             <?php 
						                                                		echo $this->Form->input('QuotationField.6.custom_fields_id', array(
														                                                	'type' => 'hidden',
														                                                	'value' => 6,
														                                                    'label' => false));
						                                            		?>
																		</div>
																	</div>
																	 
						                                            <?php
						                                            	echo $this->Form->button("<i class ='fa fa-plus'></i>", array(
						                                            										"type" => "button",
																											"class" => "add-field1 table-link danger btn btn-success",
																											"onclick" => "cloneInput('cloneFields', this)",
																											"label" =>false
																								));
						                                            ?>

						                                            <?php	
																		echo $this->Form->button("<i class ='fa fa-minus'></i>", array(
																										"type" => "button",
																										"class" => "remove-field btn btn-danger",
																										"onclick" => "removeClone('cloneFields')",
																										"label" =>false,
																										"id" => 'minus'

																									));
					                                            	?>
					                                            </div>

																<?php foreach ($customField as $key => $value) {?>
															
																	 <div class="form-group" >
																		<div class="col-lg-8">
																			<?php
																				if($value == 'Validity'){
																					$datepick = 'datepick';
																					$readonly = 'readonly';
																				}
																				else{
																					$datepick = '';
																					$readonly ='';
																				}
																			?>
																			<div class="col-lg-5">
																				<span style="color:red"></span>
																				<?php echo $value; ?>
																			</div>

																			<?php
								                                                echo $this->Form->input('QuotationField.'.($key).'.description', array('class' => 'form-control 
															                                                	item_type '.$datepick.' test ',
															                                                	'readonly' => $readonly,
															                                                    'alt' => 'address1',
															                                                    'label' => false));
								                                            ?>
								                                            <?php 
						                                                		echo $this->Form->input('QuotationField.'.($key).'.custom_fields_id', array(
														                                                	'type' => 'hidden',
														                                                	'value' => ($key),
														                                                    'label' => false));
						                                            		?>
																	</div>
																</div>
															<?php }?>
														
																<hr style="height:1px; border:none; color:#666666; background-color:#666666;">

																<div class="form-group">
																	<div class="col-lg-3">
																		<button type="submit" class="btn btn-success pull-right">Submit Quotation</button>
																	</div>
																	<div class="col-lg-8">
																		<?php 
													                        echo $this->Html->link('Cancel', array('controller' => 'quotations', 'action' => 'index'),array('class' =>'btn btn-primary','escape' => false));
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo $this->Form->end(); ?>

	<script>

	
		$("#QuotationCreateForm").validate();
		// $("[name*='data[Quotation][product]']").each(function () {
		// $(this).rules("add", {
		//     required: true
		// });
		// });
		jQuery(document).ready(function($){
			//datepicker
			$('.datepick').datepicker({
				format: 'yyyy-mm-dd'
			});
			
});
	
    </script>



<?php	} ?>

