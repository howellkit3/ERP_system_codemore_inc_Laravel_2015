<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
			<div class="row" id="user-profile">
				<div class="col-lg-3 col-md-4 col-sm-4">
					<div class="main-box clearfix">
						<header class="main-box-header clearfix">
							<h1>
							<?php echo $company['Company']['company_name']; ?>
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
							
							<div class="profile-since">
								<?php echo date('M d, Y', strtotime($inquiry['Inquiry']['created'])); ?>
							</div>
							
							<div class="profile-details">
								<ul class="fa-ul">
								<i class="fa fa-dedent"></i>
									<?php echo $company['Company']['description']; ?>
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
									<?php echo $company['Address'][0]['address1']; ?><br>&emsp;&nbsp;
									<?php echo $company['Address'][0]['state_province']; ?><br>&emsp;&nbsp;
									<?php echo $company['Address'][0]['city']; ?>
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
													<h4>We are pleased to submit our price quotation on your printing requirement under the following specifications:</h4>
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
														<section class="cloneMe1 quotation_section">
															<div class="form-group">

																<div class="col-lg-3">
																	<?php 
						                                                echo $this->Form->input('QuotationField.0.label', array(
											                                'options' => array($customField),
											                                'type' => 'select',
											                                'label' => false,
											                                'class' => 'form-control col-lg-4',
											                                'empty' => '---Select Label---',
											                                'id'	=> 'CustomFieldId'
											                                 ));
						                                            ?>
																</div>
																<div class="col-lg-8">
																	<?php 
						                                                echo $this->Form->input('QuotationField.0.description', array('class' => 'form-control item_type',
						                                                    'alt' => 'address1',
						                                                    'label' => false));
						                                            ?>
																</div>
																
															</div>
														</section>
														<div class="form-group">
															<div class="col-lg-3">
																<button type="button" class="add-field6 table-link danger btn btn-success" onclick="cloneInquiry('quotation_section',this)"> <i class="fa fa-plus"> Add Field</i></button>
															</div>
															<div class="col-lg-8">
																
															</div>
														</div>
														
														
														<hr style="height:1px; border:none; color:#666666; background-color:#666666;">

														<div class="form-group">
															<div class="col-lg-3">
																<button type="submit" class="btn btn-success">Submit Quotation</button>
															</div>
															<div class="col-lg-8">
																
															</div>
														</div>
													<?php echo $this->Form->end(); ?>
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