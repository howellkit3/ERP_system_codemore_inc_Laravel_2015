<?php $this->Html->addCrumb('Receivable', array('controller' => 'sales_invoice', 'action' => 'receivable')); ?>
<?php  echo $this->Html->script('Accounting.date_range');?>
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
								<li class="active">
									<a href="#tab-summary" class="dr" data-toggle="tab">DR Summary</a>
								</li>
								<li>
									<a href="#tab-newsfeed" class="php" data-toggle="tab">PHP</a>
									
								</li>
								<li><a href="#tab-activity" class="usd" data-toggle="tab">USD</a></li>
								<li><a href="#tab-chat" class="term" data-toggle="tab">With Terms</a></li>
							</ul>
							<input name="report" type="hidden" value="1" class="form-control appendreport" >
							<div class="tab-content">

								<div class="tab-pane fade in active" id="tab-summary">
									
		                            <?php echo $this->Form->create('SalesInvoice',array('url'=>(array('controller' => 'sales_invoice','action' => 'dr_summary',1)),array('class' => 'form-inline')));?>

		                            	<button type="submit" class="form-export-btn btn btn-success pull-right"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
			                            
										<div class="form-group col-md-3 pull-left">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input placeholder="Date Filter" name="from_date" data="1" type="text" class="form-control myDateRange datepickerDateRange" id="datepickerDateRange" >
											</div>
										</div>
										<button type="button" class="clear-date btn btn-success pull-left"><i class="fa fa-eraser fa-lg"></i> Clear</button>
									<?php echo $this->Form->end(); ?>	
		                            <br><br><br>

									<div class="table-responsive">
										
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><a href="#"><span>Date</span></a></th>
													<th><a href="#"><span>DR#</span></a></th>
													<th><a href="#"><span>USD</span></a></th>
													<th><a href="#"><span>PHP</span></a></th>
													<th><a href="#"><span>Customer</span></a></th>
													<th><a href="#"><span>Quantity</span></a></th>
													<th><a href="#"><span>SI#</span></a></th>
													<th><a href="#"><span>SA#</span></a></th>
													<th><a href="#"><span>Remarks</span></a></th>
												</tr>
											</thead>
											<tbody aria-relevant="all" class="dateRangeAppend-dr" aria-live="polite" role="alert" style="display:none;">
											</tbody>
											<tbody aria-relevant="all" class="dr-report" aria-live="polite" role="alert">
												<?php foreach ($invoiceData as $key => $invoiceList) { ?>
													<tr class="">
														<td>
															<?php echo date('m/d/Y', strtotime($invoiceList['SalesInvoice']['created'])); ?>
														</td>
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
														<td><?php echo $companyData[$invoiceList['SalesInvoice']['company_id']]?></td>
														<td><?php echo $invoiceList['SalesInvoice']['quantity']?></td>
														<td><?php echo $invoiceList['SalesInvoice']['sales_invoice_no']?></td>
														<td><?php echo $invoiceList['SalesInvoice']['statement_no']?></td>
														<td></td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>

								<div class="tab-pane fade " id="tab-newsfeed">
									<?php
		                               //echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> Export ', array('controller' => 'sales_invoice', 'action' => 'dr_summary',2),array('class' =>'btn btn-primary pull-right','escape' => false));
		                            ?>
		                            <?php echo $this->Form->create('SalesInvoice',array('url'=>(array('controller' => 'sales_invoice','action' => 'dr_summary',2)),array('class' => 'form-inline')));?>

		                            	<button type="submit" class="form-export-btn btn btn-success pull-right"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
			                            
										<div class="form-group col-md-3 pull-left">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input placeholder="Date Filter" name="from_date" data="1" type="text" class="form-control myDateRange datepickerDateRange" id="datepickerDateRange" >
											</div>
										</div>
										<button type="button" class="clear-date btn btn-success pull-left"><i class="fa fa-eraser fa-lg"></i> Clear</button>
									<?php echo $this->Form->end(); ?>

		                            <br><br><br>
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
											<tbody aria-relevant="all" class="dateRangeAppend-php" aria-live="polite" role="alert" style="display:none;">
											</tbody>
											<tbody aria-relevant="all" class="php-report" aria-live="polite" role="alert">
												<?php foreach ($invoiceData as $key => $invoiceList) { ?>
													<?php if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) { ?>
														<tr class="">
															<td><?php echo $companyData[$invoiceList['SalesInvoice']['company_id']]?></td>
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
									<?php
		                               // echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> Export ', array('controller' => 'sales_invoice', 'action' => 'dr_summary',3),array('class' =>'btn btn-primary pull-right','escape' => false));
		                            ?>
		                            <?php echo $this->Form->create('SalesInvoice',array('url'=>(array('controller' => 'sales_invoice','action' => 'dr_summary',3)),array('class' => 'form-inline')));?>

		                            	<button type="submit" class="form-export-btn btn btn-success pull-right"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
			                            
										<div class="form-group col-md-3 pull-left">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input placeholder="Date Filter" name="from_date" data="1" type="text" class="form-control myDateRange datepickerDateRange" id="datepickerDateRange" >
											</div>
										</div>
										<button type="button" class="clear-date btn btn-success pull-left"><i class="fa fa-eraser fa-lg"></i> Clear</button>
									<?php echo $this->Form->end(); ?>
		                            <br><br><br>
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
												</tr>
											</thead>
											<tbody aria-relevant="all" class="dateRangeAppend-usd" aria-live="polite" role="alert" style="display:none;">
											</tbody>
											<tbody aria-relevant="all" class="usd-report" aria-live="polite" role="alert">
												<?php foreach ($invoiceData as $key => $invoiceList) { ?>
													<?php if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 2) {?>
														<tr class="">
															<td><?php echo $companyData[$invoiceList['SalesInvoice']['company_id']]?></td>
															<td><?php echo $invoiceList['SalesInvoice']['dr_uuid']?></td>
															<td><?php echo $invoiceList['SalesInvoice']['sales_invoice_no']?></td>
															<td><?php echo $invoiceList['SalesInvoice']['statement_no']?></td>
															<td>-</td>
															<td>
																<?php 
																	$usd = $invoiceList['SalesInvoice']['quantity'] * $invoiceList['SalesInvoice']['unit_price'];
																	echo number_format($usd,2);
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
								<div class="tab-pane fade" id="tab-chat">
									<?php
		                               // echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> Export ', array('controller' => 'sales_invoice', 'action' => 'dr_summary',4),array('class' =>'btn btn-primary pull-right','escape' => false));
		                            ?>
		                            <?php echo $this->Form->create('SalesInvoice',array('url'=>(array('controller' => 'sales_invoice','action' => 'dr_summary',4)),array('class' => 'form-inline')));?>

		                            	<button type="submit" class="form-export-btn btn btn-success pull-right"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
			                            
										<div class="form-group col-md-3 pull-left">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input placeholder="Date Filter" name="from_date" data="1" type="text" class="form-control myDateRange datepickerDateRange" id="datepickerDateRange" >
											</div>
										</div>
										<button type="button" class="clear-date btn btn-success pull-left"><i class="fa fa-eraser fa-lg"></i> Clear</button>
									<?php echo $this->Form->end(); ?>
		                            <br><br><br>
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><a href="#"><span>Customer</span></a></th>
													<th><a href="#"><span>PHP</span></a></th>
													<th>
														<a href="#">
															<center>
																<font size="1">AVE. Conversion Rate<br>(USD in PHP)</font>
																<font size="1">44.221 = $1</font>
															</center>
														</a>
													</th>
													<th><a href="#"><span>Total Sales</span></a></th>
													<th><a href="#"><span>%</span></a></th>
													<th><a href="#"><span>Target</span></a></th>
													<th><a href="#"><span>Terms</span></a></th>
													<th><a href="#"><span>Due Date</span></a></th>
												</tr>
											</thead>
											<tbody aria-relevant="all" class="dateRangeAppend-term" aria-live="polite" role="alert" style="display:none;">
											</tbody>
											<tbody aria-relevant="all" class="term-report" aria-live="polite" role="alert">
												<?php foreach ($invoiceData as $key => $invoiceList) { ?>

													<tr class="">
														<td><?php echo $companyData[$invoiceList['SalesInvoice']['company_id']]?></td>
														<td>
															<?php 
																if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
																	echo number_format($invoiceList['SalesInvoice']['unit_price'],2);
																}
															?>
														</td>
														<td>
														<?php if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 2) { ?>
																<center>
																	<table>
																		<tr>
																			<td class="text-center">
																				<?php 
																					echo '$';
																					echo number_format($invoiceList['SalesInvoice']['unit_price'],2);
																				?>
																			</td>
																			<td class="text-center">
																				<?php 
																					$phpTotal = 44.221 * $invoiceList['SalesInvoice']['unit_price'];
																					echo 'PHP';
																					echo number_format($phpTotal,2);
																				?>
																			</td>
																		</tr>
																	</table>
																</center>
															<?php } ?>
														</td>
														<td>
															<?php 
																if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
																	echo 'PHP';
																	echo number_format($invoiceList['SalesInvoice']['unit_price'],2);
																	
																}else{
																	$phpTotal = 44.221 * $invoiceList['SalesInvoice']['unit_price'];
																	echo 'PHP';
																	echo number_format($phpTotal,2);
																} 
															?>
														</td>
														<td>
															<?php 
																$totalSale = 0;
																foreach ($invoiceData as $key => $invoice) { 
																	if ($invoice['SalesInvoice']['unit_price_currency_id'] == 1) {
																		$totalSale = $totalSale + $invoice['SalesInvoice']['unit_price'];
																		
																	}else{
																		$phpTotal = 44.221 * $invoice['SalesInvoice']['unit_price'];
																		$totalSale = $totalSale + $phpTotal;
																		
																	}
																}
																
																if ($invoiceList['SalesInvoice']['unit_price_currency_id'] == 1) {
																		$fulltotalSale = $totalSale /  $invoiceList['SalesInvoice']['unit_price'];
																		echo number_format($fulltotalSale,2);
																		
																}else{
																	$phpTotal = 44.221 * $invoiceList['SalesInvoice']['unit_price'];
																	$fulltotalSale = $totalSale /  $phpTotal;
																	echo number_format($fulltotalSale,2);
																	
																}
																
															?>
														</td>
														<td></td>
														<td><?php echo $paymentTermData[$invoiceList['SalesInvoice']['payment_terms']]?></td>
														<td><?php echo date('m/d/Y', strtotime($invoiceList['SalesInvoice']['schedule'])); ?></td>
													</tr>
												<?php  } ?>
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

<script>
		
	jQuery(document).ready(function($){

		$("#SalesInvoiceReceivableForm").validate();
		
		$('.daterange').datepicker({
			format: 'yyyy-mm-dd'
		});
		$('.datepickerDateRange').daterangepicker();

		// $(document).on('myCustomEvent', function () {
		//     console.log('test');
		// });

		// $('.datepickerDateRange').daterangepicker({
		// 	// .. //
		// 	function(start, end) {
		// 	    //$('#dateRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		// 	    console.log('test');
		// 	    $(document).trigger('myCustomEvent');
		// 	}
		// });
	
	});


</script>

<style>
	.tabs-wrapper .nav-tabs {
	  /*//margin-bottom: -20px;*/
	}

	.myDateRange{
		cursor: pointer; 
		cursor: hand;
	}
</style>