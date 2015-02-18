<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Quotation', array('controller' => 'quotation', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Create', array('controller' => 'quotation', 'action' => 'create')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>

<?php if(!empty($inquiry['Inquiry']['id'])) {

	echo $this->element('inquiry_quotation');

}else{ ?>

	<?php echo $this->Form->create('Quotation',array('url'=>(array('controller' => 'quotations','action' => 'add'))));?>
		<div class="row">
		    <div class="col-lg-12">
		        <div class="main-box clearfix body-pad">
					<div class="row" id="user-profile">
						<div class="col-lg-3 col-md-4 col-sm-4">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									
									<?php echo $this->Form->input('Company.id', array(
		                                'options' => array($companyData),
		                                'type' => 'select',
		                                'label' => false,
		                                'class' => 'form-control col-lg-4 required',
		                                'empty' => '---Select Company---',
		                                'id' => 'select_company'
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
												                        'readonly' => 'readonly',
												                        'label' => false,
												                        'id' => 'id'));
					                                            ?>
					                                            <div class="form-group">
																	<div class="col-lg-3">Quotation Name</div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('Quotation.name', array('class' => 'form-control item_type',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>
																 <div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['1']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.1.description', array('class' => 'form-control item_type test',
							                                                    'alt' => 'address1',
							                                                    'label' => false));
							                                            ?>
							                                            <?php 
							                                                echo $this->Form->input('QuotationField.1.custom_fields_id', array(
							                                                	'type' => 'hidden',
							                                                	'value' => '1',
							                                                    'label' => false));
							                                            ?>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-lg-3"><?php echo $customField['2']?></div>
																	<div class="col-lg-8">
																		<?php 
							                                                echo $this->Form->input('QuotationField.2.description', array('class' => 'form-control item_type test',
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
							                                                echo $this->Form->input('QuotationField.3.description', array('class' => 'form-control item_type test',
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
							                                                echo $this->Form->textarea('QuotationField.13.description', array('class' => 'form-control item_type',
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
	<form id="myform">
<label for="mobile_phone">Mobile phone: </label>
<input class="left phone-group" id="mobile_phone" name="mobile_phone.0.test">
<br/>
<label for="home_phone">Home phone: </label>
<input class="left phone-group" id="home_phone" name="mobile_phone.1.test">
<br/>
<label for="work_phone">Work phone: </label>
<input class="left phone-group" id="work_phone" name="mobile_phone.2.test">
<br/>
<input type="submit" value="Validate!">
</form>
	<script>
        // $("#QuotationCreateForm").validate();
  //      

   $("#QuotationCreateForm").validate( {
});
  $("[name*='data[QuotationField]']").each(function () {
        $(this).rules("add", {
            required: true
        });
    });






    </script>



<?php	} ?>

