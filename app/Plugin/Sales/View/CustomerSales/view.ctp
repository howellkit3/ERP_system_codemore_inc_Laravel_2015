<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'customer_sales', 'action' => 'view',$company['Company']['id'])); ?>

<div style="clear:both"></div>

<?php echo $this->element('sales_option'); ?>

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
								<?php echo date('M d, Y', strtotime($company['Company']['created'])); ?>
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
							
							
						</div>
						
					</div>
				</div>
				
				<div class="col-lg-9 col-md-8 col-sm-8">
					<div class="main-box clearfix">
						<div class="tabs-wrapper profile-tabs">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab-newsfeed" data-toggle="tab">Address</a></li>
								<li><a href="#tab-activity" data-toggle="tab">Phone</a></li>
								<li><a href="#tab-chat" data-toggle="tab">Email</a></li>
								<li><a href="#tab-friends" data-toggle="tab">Contact Person</a></li>
							</ul>
							
							<div class="tab-content">
								<div class="tab-pane fade in active" id="tab-newsfeed">
									
									<div id="">
										<div class="story">
											
											<div class="story-content remove-pad">
												<header class="story-header">
													<div class="story-author">
														<table class="table table-striped table-hover">
									                        <thead>
									                            <tr>
									                                <th><a href="#"><span>Address(1)</span></a></th>
									                                <th><a href="#"><span>Address(1)</span></a></th>
									                                <th><a href="#"><span>City</span></a></th>
									                                <th><a href="#"><span>State Province</span></a></th>
									                                <th><a href="#"><span>Zip Code</span></a></th>
									                                <th><a href="#"><span>Country</span></a></th>
									                            </tr>
									                        </thead>
									                        <?php
										                		foreach($company['Address'] as $contactAddress) { ?>
											                        <tbody aria-relevant="all" aria-live="polite" role="alert">
											                         		<tr>
											                         			<td><?php echo $contactAddress['address1']; ?>
											                         			</td>
											                         			<td><?php echo $contactAddress['address2']; ?>
											                         			</td>
											                         			<td><?php echo $contactAddress['city']; ?>
											                         			</td>
											                         			<td><?php echo $contactAddress['state_province']; ?>
											                         			</td>
											                         			<td><?php echo $contactAddress['zip_code']; ?>
											                         			</td>
											                         			<td><?php echo $contactAddress['country']; ?>
											                         			</td>
											                         		</tr>
											                         </tbody>
									                        <?php }?>
									                    </table>
														
													</div>
													
												</header>
												
											</div>
										</div>
										
									</div>
									
								</div>
								
								<div class="tab-pane fade" id="tab-activity">
									
									<div class="table-responsive">
										<?php 
											foreach($company['Contact'] as $contactNumber) { ?>
												<table class="table">
													<tbody>
														
														<tr>
															<td class="text-center">
																<i class="fa fa-phone"></i>
															</td>
															<td>
																<?php echo $contactNumber['number']; ?>
															</td>
															<td class="pull-right">
																<?php echo date('M d, Y', strtotime($contactNumber['created'])); ?>
															</td>
														</tr>
													
													</tbody>
												</table>
												<hr style="height:1px; border:none; color:#666666; background-color:#666666;">
										<?php } ?>
										
									</div>
									
								</div>
								
								<div class="tab-pane clearfix fade" id="tab-friends">
									<?php 
										foreach($company['ContactPerson'] as $contactPerson) { ?>
											<ul class="widget-users row">
												
												<li class="col-md-8">
													<div class="details">
														<div class="name">
															<a href="#" class"user-link">
																<?php echo $contactPerson['lastname']; ?>,
																<?php echo $contactPerson['firstname']; ?> &nbsp;
																<?php echo $contactPerson['middlename']; ?>
															</a>
														</div>
														<div class="time">
															<i class="fa fa-clock-o"></i> Created: <?php echo date('M d, Y', strtotime($contactPerson['created'])); ?>
														</div>
														
													</div>
												</li>
												<li class="col-md-4">
													<div class="type">
														<?php

									                        echo $this->Html->link(' View Details ', array('controller' => 'customer_sales', 'action' => 'person',$contactPerson['id']),array('class' =>'btn btn-primary','escape' => false));
									                       
									                    ?>
													</div>
												</li>
											</ul>
											
											<hr style="height:1px; border:none; color:#666666; background-color:#666666;">
									<?php } ?>

								</div>
								
								<div class="tab-pane fade" id="tab-chat">
									<div class="table-responsive">
										<?php 
											foreach($company['Email'] as $contactEmail) { ?>
											<table class="table">
												<tbody>
													
													<tr>
														<td class="text-center">
															<i class="fa fa-mail-reply-all"></i>
														</td>
														<td >
															<?php echo $contactEmail['email']; ?>
														</td>
														<td class="pull-right">
															<?php echo date('M d, Y', strtotime($contactEmail['created'])); ?>
														</td>
													</tr>
														
												</tbody>
											</table>
											<hr style="height:1px; border:none; color:#666666; background-color:#666666;">
										<?php } ?>	
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