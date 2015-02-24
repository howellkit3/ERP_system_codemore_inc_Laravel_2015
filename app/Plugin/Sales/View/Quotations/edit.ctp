<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Quotation', array('controller' => 'quotation', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Edit', array('controller' => 'quotation', 'action' => 'edit',$quotationId,$companyId)); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>

<?php echo $this->Form->create('Quotation',
	array('url'=> array('controller' => 'quotations','action' => 'edit',$quotationId,$companyId),'type' => 'post'));?>
	<div class="row">
	    <div class="col-lg-12">
	        <div class="main-box clearfix body-pad">
				<div class="row" id="user-profile">
					<div class="col-lg-3 col-md-4 col-sm-4">
						<div class="main-box clearfix">
							<header class="main-box-header clearfix">
								<h1>
								<?php 
									echo $this->Form->input('Company.company_name', array('class' => 'form-control item_type',
	                                    'alt' => 'Address',
	                                    'label' => false,
	                                    'readonly' => 'readonly',
	                                    'id' => 'address1',
	                                    'placeholder' => 'Address'));

	                            ?>
								</h1>
							</header>
							
							<div class="main-box-body clearfix">
								
								<div class="profile-stars">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								
								<div class="profile-details">
									<?php 
		                                echo $this->Form->input('Address.0.address1', array('class' => 'form-control item_type',
		                                    'alt' => 'Address',
		                                    'label' => false,
		                                    'readonly' => 'readonly',
		                                    'id' => 'address1',
		                                    'placeholder' => 'Address'));
		                            ?>
								</div>
								<div class="profile-details">
									<?php 
		                                echo $this->Form->input('Contact.0.number', array('class' => 'form-control item_type',
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
		                                echo $this->Form->input('Email.0.email', array('class' => 'form-control item_type',
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
									                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'quotations', 'action' => 'view',$quotationId,$companyId),array('class' =>'btn btn-primary pull-right','escape' => false));
									                    ?>
									                    <br><br>
														<h4>
															We are pleased to submit our price quotation on your printing requirement under the following specifications:
														</h4>
													</header>
													
													<div class="main-box-body clearfix">
														<div class="form-horizontal">
															<?php 
				                                                echo $this->Form->input('Quotation.id', array('class' => 'form-control item_type',
				                                                	'hidden' => 'hidden',
											                        'readonly' => 'readonly',
											                        'label' => false,
											                        'id' => 'id'));
				                                            ?>
				                                            <div class="form-group">
																<div class="col-lg-3">Quotation Name</div>
																<div class="col-lg-8">
																	<?php 
						                                                echo $this->Form->input('Quotation.name', array('class' => 'form-control item_type required',
						                                                    'alt' => 'address1',
						                                                    'label' => false));
						                                            ?>
																</div>
															</div>
															<?php 
																foreach ($this->request->data['QuotationField'] as $key => $value) { 
																	$name="data[QuotationField][".$key."][label]";
																	$id="QuotationField".$key."label";
																	$name2="data[QuotationField][".$key."][description]";
																	$id2="QuotationField".$key."description";
																	$hiddenName="data[QuotationField][".$key."][id]";
																	$hiddenId="QuotationField".$key."id"; ?>
																
																<section class="cloneMe1 quotation_section">
																	<div class="form-group">
																		<div class="col-lg-3">
																			<?php 
																				//pr($customField[$value['custom_fields_id']]);die;
																				echo $this->Form->input('QuotationField.0.id', array(
																				'hidden' => 'hidden',
																				'label' => false,
																				'name' => $hiddenName,
													                            'id' => $hiddenId,
													                            'value' => !empty($value['id']) ? $value['id'] : ''));
																				echo $customField[$value['custom_fields_id']];
								                                     //             echo $this->Form->input('QuotationField.0.label', array(
													                                // 'options' => array($customField),
													                                // 'type' => 'select',
													                                // 'label' => false,
													                                // 'class' => 'form-control col-lg-4 required',
													                                // 'empty' => '---Select Label---',
													                                // 'default' => !empty($value['custom_fields_id']) ? $value['custom_fields_id'] : '',
													                                // 'name' => $name,
													                                // 'id' => $id
													                                //  ));
								                                            ?>
																		</div>
																		<div class="col-lg-8">
																			<?php 
								                                                echo $this->Form->input('QuotationField.0.description', array('class' => 'form-control item_type required',
								                                                    'label' => false,
								                                                    'name' => $name2,
								                                                    'id' => $id2,
								                                                    'value' => !empty($value['description']) ? $value['description'] : ''));
								                                            ?>
																		</div>
																	</div>
																</section>

															<?php } ?>

															
															
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
$("#QuotationEditForm").validate();
</script>


