<?php echo $this->element('account_option'); ?>

<div class="row">
	<div class="col-lg-12">		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
					<h1 class="pull-left">
						Report List
					</h1>
					<div class="filter-block pull-right">
						<?php 
	                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'sales_invoice', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
	                    ?>
                    </div>
				</header>
			</div>
		</div>	                   
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="main-box clearfix">
						<div class="tabs-wrapper profile-tabs">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab-newsfeed" data-toggle="tab">PHP</a></li>
								<li><a href="#tab-activity" data-toggle="tab">USD</a></li>
								<li><a href="#tab-chat" data-toggle="tab">With Terms</a></li>
								<li><a href="#tab-friends" data-toggle="tab">VAT Summary</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade in active" id="tab-newsfeed">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><a href="#"><span>Customer</span></a></th>
													<th><a href="#"><span>DR No.</span></a></th>
													<th><a href="#"><span>SI No.</span></a></th>
													<th><a href="#"><span>SA No.</span></a></th>
													<th class="text-center"><a href="#"><span>Status</span></a></th>
													<th><a href="#"><span>Action</span></a></th>
												</tr>
											</thead>
											<tbody aria-relevant="all" aria-live="polite" role="alert">
												<tr class="">
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="tab-activity">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><a href="#"><span>Customer</span></a></th>
													<th><a href="#"><span>DR No.</span></a></th>
													<th class="text-center"><a href="#"><span>Status</span></a></th>
													<th><a href="#"><span>Action</span></a></th>
												</tr>
											</thead>
											<tbody aria-relevant="all" aria-live="polite" role="alert">
												<tr class="">
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="tab-chat">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><a href="#"><span>Customer</span></a></th>
													<th><a href="#"><span>DR No.</span></a></th>
													<th class="text-center"><a href="#"><span>Status</span></a></th>
													<th><a href="#"><span>Action</span></a></th>
												</tr>
											</thead>
											<tbody aria-relevant="all" aria-live="polite" role="alert">
												<tr class="">
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="tab-friends">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><a href="#"><span>Customer</span></a></th>
													<th><a href="#"><span>DR No.</span></a></th>
													<th class="text-center"><a href="#"><span>Status</span></a></th>
													<th><a href="#"><span>Action</span></a></th>
												</tr>
											</thead>
											<tbody aria-relevant="all" aria-live="polite" role="alert">
												<tr class="">
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
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
