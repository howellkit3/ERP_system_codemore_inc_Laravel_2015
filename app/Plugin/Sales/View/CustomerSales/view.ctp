<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'customer_sales', 'action' => 'view',$company['Company']['id'])); ?>

<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option'); ?><br><br>

<div class="row">
    <div class="col-lg-12">
        <!-- <div class="main-box clearfix body-pad"> -->
			<div class="row" id="user-profile">
				<div class="col-lg-3 col-md-4 col-sm-4">
					<div class="main-box clearfix">
						<header class="main-box-header clearfix">
							<h1 style="word-wrap:break-word">
							<?php echo ucfirst($company['Company']['company_name']); ?>
							</h1>
						</header>
						
						<div class="main-box-body clearfix">
							
							<!-- <div class="profile-stars">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
							</div> -->
							
							<div class="profile-since">
								<?php echo date('M d, Y', strtotime($company['Company']['created'])); ?>
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
								<i class="fa fa-book"></i>
									<?php echo $company['Company']['tin']; ?>
								</ul>
							</div>
							
							<div class="profile-details">
								<ul class="fa-ul">
								<i class="fa fa-calendar"></i>
									<?php echo $company['Company']['payment_term']; ?>
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
								<li><a href="#tab-products" data-toggle="tab">Products</a></li>
								<?php 
			                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
			                    ?>
							</ul>
							
							<div class="tab-content">
								<div class="tab-pane fade in active" id="tab-newsfeed">
								
									<div id="">
										<div class="story">
											
											<div class="story-content remove-pad">
												<header class="story-header">
													<div class="story-author">
														<div class="table-responsive">
															<a data-toggle="modal" href="#myModal" class="btn btn-primary mrg-b-lg pull-right"><i class="fa fa-plus-circle fa-lg">
								                       			 </i> Add Address</a>
															
															<table class="table table-striped table-hover">
										                        <thead>
										                            <tr>
										                            	<br><br>
										                                <th><a href="#"><span>Address</span></a></th>
										                                <th><a href="#"><span>City</span></a></th>
										                                <th><a href="#"><span>State Province</span></a></th>
										                                <th><a href="#"><span>Zip Code</span></a></th>
										                                <th><a href="#"><span>Country</span></a></th>
										                                <th><a href="#"><span>Created</span></a></th>
										                            </tr>
										                        </thead>

										                        <?php

											                		foreach($company['Address'] as $contactAddress) { ?>

												                        <tbody aria-relevant="all" aria-live="polite" role="alert">
												                         		<tr>
												                         			<td>
												                         				<?php 
												                         					if (!empty($contactAddress['address2'])) {
												                         						echo "(1)&nbsp";
												                         						echo ucfirst($contactAddress['address1']);
												                         						echo "<br>";
												                         						echo "(2)&nbsp";
												                         						echo ucfirst($contactAddress['address2']);
												                         					}else{
												                         						echo ucfirst($contactAddress['address1']);
												                         					}
												                         				?>
												                         			</td>
												                         			<td><?php echo ucfirst($contactAddress['city']); ?>
												                         			</td>
												                         			<td><?php echo ucfirst($contactAddress['state_province']); ?>
												                         			</td>
												                         			<td><?php echo $contactAddress['zip_code']; ?>
												                         			</td>
												                         			<td><?php echo $this->Country->countryList(ucfirst($contactAddress['country'])); ?>
												                         			</td>
												                         			<td>
												                         				<i class="fa fa-clock-o">
												                         				<?php echo date('M d, Y', strtotime($contactAddress['created']));
												                         				?>
												                         			</td>
												                         		</tr>
												                         </tbody>
										                        <?php } ?>
										                    </table>
														
														</div>
													</div>
													
												</header>
												
											</div>
										</div>
										
									</div>
									
								</div>
								
								<div class="tab-pane fade" id="tab-activity">
									
									<div class="table-responsive">
										<a data-toggle="modal" href="#myModalContact" class="btn btn-primary mrg-b-lg pull-right"><i class="fa fa-plus-circle fa-lg"></i> Add Contact Number</a>
										
										<table class="table table-striped table-hover">
					                        <thead>
					                            <tr>
					                                <th><a href="#"><span></span></a></th>
					                                <th><a href="#"><span>Number</span></a></th>
					                                <th><a href="#"><span>Created</span></a></th>
					                            </tr>
					                        </thead>

					                        <?php foreach($company['Contact'] as $contactNumber) { ?>
							                        <tbody aria-relevant="all" aria-live="polite" role="alert">
						                         		<tr>
						                         			<td>
						                         				<i class="fa fa-phone"></i>
						                         			</td>
						                         			<td>
						                         				<?php echo $contactNumber['number']; ?>
						                         			</td>
						                         			<td>
						                         				<i class="fa fa-clock-o">
						                         				<?php echo date('M d, Y', strtotime($contactNumber['created'])); 
						                         				?>
						                         			</td>
						                         		</tr>
							                        </tbody>
					                        <?php } ?>
					                    </table>
									</div>
								</div>
								
								<div class="tab-pane clearfix fade" id="tab-friends">
									<div class="table-responsive">
										<a data-toggle="modal" href="#myModalContactPerson" class="btn btn-primary mrg-b-lg pull-right"><i class="fa fa-plus-circle fa-lg"></i> Add Contact Person</a>
										
										<table class="table table-striped table-hover">
					                        <thead>
					                        	<br><br>
					                            <tr>
					                                <th><a href="#"><span>Name</span></a></th>
					                                <th><a href="#"><span>Position</span></a></th>
					                                <th><a href="#"><span>Email</span></a></th>
					                                <th><a href="#"><span>Contact</span></a></th>
					                                <th><a href="#"><span>Created</span></a></th>
					                               
					                            </tr>
					                        </thead>
					                        <?php 
					                        	$key= 0;
						                		foreach($contactPerson as $contactPersonData) { ?>
						                			
							                        <tbody aria-relevant="all" aria-live="polite" role="alert">
						                         		<tr>
						                         			<td>
						                         				<?php echo ucfirst($contactPersonData['ContactPerson']['lastname']); ?>,
																<?php echo ucfirst($contactPersonData['ContactPerson']['firstname']); ?> &nbsp;
																<?php echo ucfirst($contactPersonData['ContactPerson']['middlename']); ?>
						                         			</td>
						                         			<td>
						                         				<?php echo ucfirst($contactPersonData['ContactPerson']['position']); ?>
						                         			</td>
						                         			<td>
						                         				<?php echo $contactPersonData['Email'][$key]['email'];?>
						                         				<?php
											                        // echo $this->Html->link(' View Details ', array('controller' => 'customer_sales', 'action' => 'person',$contactPerson['id']),array('class' =>'btn btn-primary','escape' => false));
											                    ?>
						                         			</td>

						                         			<td>
						                         				<?php echo $contactPersonData['Contact'][$key]['number'];?>
						                         			</td>

						                         			<td>
						                         				<i class="fa fa-clock-o"></i>
						                         				<?php echo date('M d, Y', strtotime($contactPersonData['ContactPerson']['created'])); 
						                         				?>
						                         			</td>
						                         		</tr>
							                        </tbody>
					                        <?php  } $key++; ?>
					                    </table>
					                </div>
								</div>
								
								<div class="tab-pane fade" id="tab-chat">
									<div class="table-responsive">

										<a data-toggle="modal" href="#myModalEmail" class="btn btn-primary mrg-b-lg pull-right"><i class="fa fa-plus-circle fa-lg"></i> Add Email</a>
						
										<table class="table table-striped table-hover">
					                        <thead>
					                            <tr>
					                                <th><a href="#"><span></span></a></th>
					                                <th><a href="#"><span>Email</span></a></th>
					                                <th><a href="#"><span>Created</span></a></th>
					                            </tr>
					                        </thead>
					                        <?php
						                		foreach($company['Email'] as $contactEmail) { ?>
							                        <tbody aria-relevant="all" aria-live="polite" role="alert">
						                         		<tr>
						                         			<td>
						                         				<i class="fa fa-mail-reply-all"></i>
						                         			</td>
						                         			<td>
						                         				<?php echo $contactEmail['email']; ?>
						                         			</td>
						                         			<td>
						                         				<i class="fa fa-clock-o">
						                         				<?php echo date('M d, Y', strtotime($contactEmail['created'])); 
						                         				?>
						                         			</td>
						                         		</tr>
							                        </tbody>
					                        <?php } ?>
					                    </table>
									</div>
								</div>

								<div class="tab-pane fade" id="tab-products">
									<div class="table-responsive">
										<?php 
			                       			/* echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg">
			                       			 						</i> Add Product ', array( 
			                       			 						'controller' => 'products', 
			                       			 						'action' => 'create', 
			                       			 						$company['Company']['id']), array(
			                       			 						'class' =>'btn btn-primary pull-right',
			                       			 						'escape' => false
			                       			 						)); */
			                    		?>

			                    		<a data-toggle="modal" href="#myModalProduct" class="btn btn-primary mrg-b-lg pull-right"><i class="fa fa-plus-circle fa-lg"></i> Add Product</a><br><br>

										<table class="table table-striped table-hover">
					                        <thead>
					                            <tr>
					                                <th><a href="#"><span>Item Name</span></a></th>
					                                <th><a href="#"><span>Date Created</span></a></th>
					                                <th><a href="#"><span>Action</span></a></th>
					                   
					                            </tr>
					                        </thead>
					                         <?php
						                		foreach($company['Product'] as $companyProduct) { ?>
							                        <tbody aria-relevant="all" aria-live="polite" role="alert">
						                         		<tr>
						                         			
						                         			<td>
						                         				<?php echo $companyProduct['name']; ?>
						                         			</td>
						                         			<td>
						                         				<i class="fa fa-clock-o">
						                         				<?php echo date('M d, Y', strtotime($companyProduct['created'])); 
						                         				?>
						                         			</td>
						                         			<td>
						                         				<?php echo $this->Html->link('<span class="fa-stack">
																		                    <i class="fa fa-square fa-stack-2x"></i>
																		                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
																		                    </span> ', 
																		                    		array( 
																		                    'controller' => 'products', 
																		                    'action' => 'view',
																		                    $companyProduct['id'],
																		                    ), 
																		                    		array( 
																		                    'class' =>' table-link', 
																		                    'escape' => false,'title'=>'View Information'));
						                         					echo $this->Html->link('<span class="fa-stack">
													                    <i class="fa fa-square fa-stack-2x"></i>
													                    <i class="fa fa-plus-square fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Specs </font></span>
													                    </span>', array('controller' => 'products', 'action' => 'specification',$companyProduct['id']),array('class' =>' table-link','escape' => false,'title'=>'Add Specifications'
													                        ));
												                ?>
						                         			</td>

						                         		</tr>
							                        </tbody>
					                        <?php } ?> 
					                    </table>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- </div> -->
	</div>
</div>

<?php echo $this->element('modals'); ?>