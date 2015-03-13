<?php echo $this->Html->script('Sales.inquiry');?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
			<div class="row" id="user-profile">
				<div class="col-lg-3 col-md-4 col-sm-4">
					<div class="main-box clearfix">
						<header class="main-box-header clearfix">
							<h1>
							<?php echo ucfirst($company['Company']['company_name']); ?>
							</h1>
							<?php 
                                echo $this->Form->input('company_id', array(
                                	'type' => 'hidden',
                                	'value' => $company['Company']['id'],
                                    'label' => false,
                                    'id' => 'company_id'
                                    ));
                            ?>
						</header>
						
						<div class="main-box-body clearfix">
							
							<div class="profile-stars">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
							</div>
							
							<div class="profile-since">
								<?php echo date('M d, Y', strtotime($inquiry['Inquiry']['created'])); ?>
							</div>
							
							<div class="profile-details">
								<ul class="fa-ul">
								<i class="fa fa-dedent"></i>
									<?php echo ucfirst($company['Company']['description']); ?>
								</ul>
							</div>
							<div class="profile-details">
								<ul class="fa-ul">
								<i class="fa fa-external-link-square"></i>
									<?php echo $company['Company']['website']; ?>
								</ul>
							</div>
							<div class="profile-details">
								<ul class="fa-ul">
									<i class="fa fa-phone"></i>
									<?php echo $company['Contact'][0]['number']; ?>
								</ul>
							</div>
							<div class="profile-details">
								<ul class="fa-ul">
									<i class="fa fa-home"></i>
									<?php echo ucfirst($company['Address'][0]['address1']); ?><br>
									State Povince :
									<?php echo ucfirst($company['Address'][0]['state_province']); ?><br>
									City :
									<?php echo ucfirst($company['Address'][0]['city']); ?>
								</ul>
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
								                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'review_inquiry',$inquiry['Inquiry']['id']),array('class' =>'btn btn-primary pull-right','escape' => false));
								                    ?>
								                    <br><br>
													<h4>
														We are pleased to submit our price quotation on your printing requirement under the following specifications:
													</h4>
												</header>
												<hr>
												<div class="main-box-body clearfix">
													<?php echo $this->Form->create('Quotation',array('url'=>(array('controller' => 'quotations','action' => 'add')),'class' => 'form-horizontal'));?>
														<?php 
			                                                echo $this->Form->input('Inquiry.id', array('class' => 'form-control item_type',
										                        'type' => 'hidden',
										                        'value' => !empty($inquiry['Inquiry']['id']) ? $inquiry['Inquiry']['id'] : '' ,
										                        'label' => false));
			                                            ?>
			                                            <!-- <div class="form-group">
															<div class="col-lg-3">Quotation Name</div>
															<div class="col-lg-8">
																<?php 
					                                                echo $this->Form->input('Quotation.name', array('class' => 'form-control item_type',
					                                                    'alt' => 'address1',
					                                                    'label' => false));
					                                            ?>
															</div>
														</div> -->
																 <div class="form-group">
																	<div class="col-lg-3"><span style="color:red">*</span> Item</div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('itemCategory', 
							                                                									array( 
							                                                						'type' => 'select',
							                                                						'options' => $category,
							                                                						'class' => 'form-control item_type', 
							                                                    					//'alt' => 'address1',
							                                                    					'label' => false,
							                                                    					'id' => 'itemCategory',
							                                                    					'empty' => '--Select Category--'
							                                                    					));
							                                            ?><br>
							                                            <?php 
							                                                echo $this->Form->input('itemType', 
							                                                									array( 
							                                                						'type' => 'select',
							                                                						'class' => 'form-control item_type', 
							                                                    					//'alt' => 'address1',
							                                                    					'label' => false,
							                                                    					'id' => 'itemType',
							                                                    					//'empty' => '--Select Type--' 
							                                                    					));
							                                            ?><br>
							                                             <?php 
							                                                echo $this->Form->input('product', 
							                                                									array( 
							                                                						'type' => 'select',
							                                                						'class' => 'form-control item_type', 
							                                                    					//'alt' => 'address1',
							                                                    					'label' => false, 
							                                                    					'id' => 'product',

							                                                    					'empty' => '--Select Product--'
							                                                    					));
							                                            ?>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['2']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.2.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.2.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '2',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['3']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.3.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.3.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '3',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['4']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.4.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.4.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '4',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>
													
																<div class="form-group">
																	<div class="col-lg-3"><b><?php echo $customField['11']?></b></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.11.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.11.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '11',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['5']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.5.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.5.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '5',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['6']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.6.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.6.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '6',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['7']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.7.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.7.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '7',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>											
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['8']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.8.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.8.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '8',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>				
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['9']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.9.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.9.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '9',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>											
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['10']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.10.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.10.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '10',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>											
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['12']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.12.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.12.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '12',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>										
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['13']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.13.description', array('class' => 'form-control item_type',
							                                                	'id'	=> 'CustomFieldId',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.13.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '13',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>
														<hr style="height:1px; border:none; color:#666666; background-color:#666666;">

														<div class="form-group">
															<div class="col-lg-3">
																<button type="submit" class="btn btn-success pull-right">Submit Quotation</button>

															</div>
															<div class="col-lg-3">
															<?php 
										                        echo $this->Html->link('Cancel', array('controller' => 'customer_sales', 'action' => 'review_inquiry',$inquiry['Inquiry']['id']),array('class' =>'btn btn-primary','escape' => false));
										                    ?>
															</div>
														</div>
													<?php echo $this->Form->end(); ?>
													<script>
												        $("#QuotationCreateForm").validate();
												    </script>
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