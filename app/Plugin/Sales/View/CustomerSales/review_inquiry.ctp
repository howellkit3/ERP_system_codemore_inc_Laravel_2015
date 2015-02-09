<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Inquiry', array('controller' => 'customer_sales', 'action' => 'inquiry')); ?>
<?php $this->Html->addCrumb('Review', array('controller' => 'customer_sales', 'action' => 'review_inquiry',$inquiry['Inquiry']['id'])); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>

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
									State Province :
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
								<li class="active"><a href="#tab-newsfeed" data-toggle="tab">Request Inquiry</a></li>
							</ul>
							
							<div class="tab-content">
								<div class="tab-pane fade in active" id="tab-newsfeed">
									
									<div class="table-responsive">
										<div class="col-lg-12">
											<div class="main-box">
												<header class="main-box-header clearfix">
													<h2></h2>
													<div class="filter-block pull-right">
														<?php 
									                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'inquiry'),array('class' =>'btn btn-primary pull-right','escape' => false));
									                    ?>
									                    <?php
									                        echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Make Quotation ', array('controller' => 'quotations', 'action' => 'create',$inquiry['Inquiry']['id']),array('class' =>'btn btn-primary pull-right','escape' => false));
									                       
									                    ?>

									                </div>
												</header>
												
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