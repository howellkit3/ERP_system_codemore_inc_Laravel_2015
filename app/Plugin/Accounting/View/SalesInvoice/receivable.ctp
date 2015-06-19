<?php $this->Html->addCrumb('Receivable', array('controller' => 'sales_invoice', 'action' => 'receivable')); ?>

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
								<li class="active"><a href="#tab-summary" data-toggle="tab">DR Summary</a></li>
								<li><a href="#tab-newsfeed" data-toggle="tab">PHP</a></li>
								<li><a href="#tab-activity" data-toggle="tab">USD</a></li>
								<li><a href="#tab-chat" data-toggle="tab">With Terms</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade in active" id="tab-summary">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><a href="#"><span>DR#</span></a></th>
													<th><a href="#"><span>USD</span></a></th>
													<th><a href="#"><span>PHP</span></a></th>
													<th><a href="#"><span>Customer</span></a></th>
													<th><a href="#"><span>Quantity</span></a></th>
													<th><a href="#"><span>SI#</span></a></th>
													<th><a href="#"><span>SA#</span></a></th>
													<th><a href="#"><span>Remarks</span></a></th>
													<th><a href="#"><span>Date</span></a></th>
												</tr>
											</thead>
											<tbody aria-relevant="all" aria-live="polite" role="alert">
												<?php foreach ($invoiceData as $key => $invoiceList) { ?>
													<tr class="">
														<td><?php echo $invoiceList['SalesInvoice']['dr_uuid']?></td>
														<td>
															<?php 
																if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 2) {
																	echo number_format($invoiceList['SalesInvoice']['unit_price'],2);
																}
															?>
														</td>
														<td>
															<?php 
																if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
																	echo number_format($invoiceList['SalesInvoice']['unit_price'],2);
																}
															?>
														</td>
														<td><?php echo $invoiceList['SalesInvoice']['company_id']?></td>
														<td><?php echo $invoiceList['SalesInvoice']['quantity']?></td>
														<td><?php echo $invoiceList['SalesInvoice']['sales_invoice_no']?></td>
														<td><?php echo $invoiceList['SalesInvoice']['statement_no']?></td>
														<td></td>
														<td>
															<?php echo date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])); ?>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>

								<div class="tab-pane fade " id="tab-newsfeed">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><a href="#"><span>Customer</span></a></th>
													<th><a href="#"><span>DR No.</span></a></th>
													<th><a href="#"><span>SI No.</span></a></th>
													<th><a href="#"><span>SA No.</span></a></th>
													<th><a href="#"><span>CM/DM</span></a></th>
													<th><a href="#"><span>Total Amount(PHP)</span></a></th>
													<th><a href="#"><span>Date</span></a></th>
												</tr>
											</thead>
											<tbody aria-relevant="all" aria-live="polite" role="alert">
												<?php if ($invoiceList['SalesInvoice']['company_id'] == 1) {?>
													<?php foreach ($invoiceData as $key => $invoiceList) { ?>
														<tr class="">
															<td><?php echo $invoiceList['SalesInvoice']['company_id'] ?></td>
															<td><?php echo $invoiceList['SalesInvoice']['dr_uuid'] ?></td>
															<td><?php echo $invoiceList['SalesInvoice']['sales_invoice_no'] ?></td>
															<td><?php echo $invoiceList['SalesInvoice']['statement_no'] ?></td>
															<td>-</td>
															<td>
																<?php 
																	$php = $invoiceList['SalesInvoice']['quantity'] * $invoiceList['SalesInvoice']['unit_price'];
																	echo number_format($php,2);
																?>
															</td>
															<td><?php echo date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])); ?></td>
														</tr>
													<?php } ?>
												<?php } ?>
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
													<th><a href="#"><span>DR#.</span></a></th>
													<th><a href="#"><span>SI#</span></a></th>
													<th><a href="#"><span>SA#.</span></a></th>
													<th><a href="#"><span>CM/DM</span></a></th>
													<th><a href="#"><span>Total Amount(USD)</span></a></th>
													<th><a href="#"><span>Date</span></a></th>
													<th><a href="#"><span>Action</span></a></th>
												</tr>
											</thead>
											<tbody aria-relevant="all" aria-live="polite" role="alert">
												<?php if ($invoiceList['SalesInvoice']['company_id'] == 2) {?>
													<?php foreach ($invoiceData as $key => $invoiceList) { ?>
														<tr class="">
															<td><?php echo $invoiceList['SalesInvoice']['company_id'] ?></td>
															<td><?php echo $invoiceList['SalesInvoice']['dr_uuid']?></td>
															<td><?php echo $invoiceList['SalesInvoice']['sales_invoice_no']?></td>
															<td><?php echo $invoiceList['SalesInvoice']['statement_no']?></td>
															<td>-</td>
															<td>
																<?php 
																	$php = $invoiceList['SalesInvoice']['quantity'] * $invoiceList['SalesInvoice']['unit_price'];
																	echo number_format($php);
																?>
															</td>
															<td><?php echo date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])); ?></td>
															<td></td>
														</tr>
													<?php } ?>
												<?php } ?>
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
													<th><a href="#"><span>PHP</span></a></th>
													<th><a href="#"><span>AVE. Conversion Rate(USD in PHP)</span></a></th>
													<th><a href="#"><span>Total Sales</span></a></th>
													<th><a href="#"><span>%</span></a></th>
													<th><a href="#"><span>Target</span></a></th>
													<th><a href="#"><span>No. of Days</span></a></th>
													<th><a href="#"><span>Terms</span></a></th>
													<th><a href="#"><span>Action</span></a></th>
												</tr>
											</thead>
											<tbody aria-relevant="all" aria-live="polite" role="alert">
												<tr class="">
													<td><?php echo $invoiceList['SalesInvoice']['company_id'] ?></td>
													<td></td>
													<td></td>
													<td></td>
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
<?php 
// echo "string";
// echo $this->element('sql_dump') ?>
