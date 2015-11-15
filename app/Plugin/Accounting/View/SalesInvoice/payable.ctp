<?php $this->Html->addCrumb('Payable', array('controller' => 'sales_invoice', 'action' => 'payable')); ?>
<?php  echo $this->Html->script('Accounting.date_range_payables');?>
<?php  echo $this->Html->script('Accounting.company-filter');?>
<?php echo $this->element('account_option'); ?>

<div class="row">
	<div class="col-lg-12">		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
					<h1 class="pull-left">
						Payables
					</h1>
					
				</header>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="main-box clearfix">
						<div class="tabs-wrapper profile-tabs">
							<ul class="nav nav-tabs">
							<!-- 	<li class="active">
									<a href="#tab-summary" class="dr" data-toggle="tab">Payables</a>
								</li> -->
								
							</ul>
							<input name="report" type="hidden" value="1" class="form-control appendreport" >
							<div class="tab-content">

								<div class="tab-pane fade in active" id="tab-summary">
									
		                            <?php echo $this->Form->create('SalesInvoice',array('url'=>(array('controller' => 'sales_invoice','action' => 'payables_print')),array('class' => 'form-inline')));?>

		                            	<button type="submit" class="form-export-btn btn btn-success pull-right"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
			                            
										<div class="form-group col-md-3 pull-left">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input placeholder="Date Filter" name="from_date" data="1" type="text" class="form-control myDateRange datepickerDateRange" id="datepickerDateRange" >
											</div>
										</div>

										<button type="button" class="clear-date btn btn-success pull-left"><i class="fa fa-eraser fa-lg"></i> Clear</button>

										<div class="form-group col-md-3 pull-left">
											<div class="input-group">

										<?php 
												echo $this->Form->input('RequestItem.category', array(
							                        'options' => $supplierName,  
							                        'label' => false,
							                        'class' => 'form-control company-filter',
							                        'empty' => '---Select Category---'
							                         )); 
							                ?>
							                </div>
										</div>

									<?php echo $this->Form->end(); ?>	
		                            <br><br><br>

									<div class="table-responsive">
										
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><a href="#"><span>Supplier</span></a></th>
													<th><a href="#"><span>PUR#</span></a></th>
													<th><a href="#"><span>SI#</span></a></th>
													<th><a href="#"><span>DR#</span></a></th>
													<th><a href="#"><span>Date Delivered</span></a></th>
													<th><a href="#"><span>Item Name</span></a></th>
													<th><a href="#"><span>DR Qty</span></a></th>
													<th><a href="#"><span>Good</span></a></th>
													<th><a href="#"><span>Reject</span></a></th>
													<th><a href="#"><span>Unit Price</span></a></th>
													<th><a href="#"><span>Total Amount</span></a></th>
													<th><a href="#"><span>Received</span></a></th>
												</tr>
											</thead>
											<tbody aria-relevant="all" class="dateRangeAppend-dr" aria-live="polite" role="alert" style="display:none;">
											</tbody>
											<tbody aria-relevant="all" class="dr-report" aria-live="polite" role="alert">
												<?php    foreach ($receivedItemData as $key => $receivedOrderDataList) {  ?>
													<tr class="">
														<td>
															<?php echo $supplierName[$purchaseOrderSupplier[$receivedOrderDataList['DeliveredOrder']['purchase_orders_id']]]; ?>
														</td>

														<td>
															<?php echo $purchaseOrderPONum[$receivedOrderDataList['DeliveredOrder']['purchase_orders_id']]; ?>
														</td>

														<td>

														<?php echo $receivedOrderDataList['DeliveredOrder']['si_num']?>

														</td>
														<td>
															<?php echo $receivedOrderDataList['DeliveredOrder']['dr_num']?>
														</td>
														<td>
															<?php echo $receivedOrderDataList['DeliveredOrder']['created']?>
														</td>
														<td>
															<?php echo !empty($receivedOrderDataList['DeliveredOrder']['item_name']) ? $receivedOrderDataList['DeliveredOrder']['item_name'] : " " ?>
														</td>
														<td>
														<?php 

														if(!empty($receivedOrderDataList['ReceivedItem']['reject_quantity'])){
															
															$quantityHolder = $receivedOrderDataList['ReceivedItem']['quantity'] + $receivedOrderDataList['ReceivedItem']['reject_quantity'];

														}else{

															$quantityHolder = $receivedOrderDataList['ReceivedItem']['quantity'];

														}

														echo $quantityHolder?>

														</td>

														<td><?php echo $receivedOrderDataList['ReceivedItem']['quantity']?></td>

														<td><?php echo $receivedOrderDataList['ReceivedItem']['reject_quantity']?>
														</td>

														<td><?php echo $receivedOrderDataList['ReceivedItem']['unit_price']?>
														</td>

														<td><?php echo $receivedOrderDataList['ReceivedItem']['unit_price']* $quantityHolder ?>
														</td>

														<td><?php echo $userName[$receivedOrderDataList['DeliveredOrder']['created_by']] ?>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>

									<div class="paging" id="item_type_pagination">
					                    <?php
					                    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
					                    echo $this->Paginator->numbers(array('separator' => ''));
					                    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
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

<script>
		
	jQuery(document).ready(function($){

		$("#SalesInvoiceReceivableForm").validate();
		
		$('.daterange').datepicker({
			format: 'yyyy-mm-dd'
		});
		$('.datepickerDateRange').daterangepicker();
	
	});


</script>