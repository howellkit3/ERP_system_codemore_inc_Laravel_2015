<?php $this->Html->addCrumb('Accounting', array('controller' => 'sales_invoice', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'sales_invoice', 'action' => 'view',$invoiceId)); ?>

<?php echo $this->element('account_option'); ?>

<div class="filter-block pull-right">

	<?php 
		echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> Export ', array(
        	'controller' => 'sales_invoice', 
        	'action' => 'print_invoice',
        	//'ext' => 'pdf',
        	$invoiceId),
        	array('class' =>'btn btn-info pull-right ','escape' => false));
	?>

	<?php 

	if($invoiceData['SalesInvoice']['status'] == 0 ){

		echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> Change to Invoice ', array(
        	'controller' => 'sales_invoice', 
        	'action' => 'change_to_invoice',
        	$invoiceId),
        	array('class' =>'btn btn-info pull-right ','escape' => false));

	}
	?>
	<br><br>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix">
					<h1>Kou Fu Packaging Corporation</h1>
					<h5>Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h5>
					<h6>
						Tel: +63(2)5844928  &emsp;Fax: +63(2)5844952
					</h6><br>
					<h2>SALES INVOICE</h2><br>
				</header>
			</center>

			<div class="main-box-body clearfix">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<div class="col-lg-2"></div>
						<div class="col-lg-6"></div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							NO : <?php echo $invoiceData['SalesInvoice']['sales_invoice_no']?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">&emsp;
							SOLD TO
						</div>
						<div class="col-lg-6">
							:&emsp;
							<?php echo ucfirst($companyData['Company']['company_name'])?>
						</div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							DATE : <?php echo (new \DateTime())->format('m/d/Y'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">&emsp;
							BUSINESS STYLE
						</div>
						<div class="col-lg-6">:&emsp;</div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							TIN : <?php echo ucfirst($companyData['Company']['tin'])?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">&emsp;
							ADDRESS
						</div>
						<div class="col-lg-6">
							:&emsp;<?php echo ucfirst($companyData['Address'][0]['address1'])?>
						</div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							TERMS : <?php echo ucfirst($paymentTermData[$clientData['ClientOrder']['payment_terms']])
							?>
						</div>
					</div>
				</form>

				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td><center><b>P.O NO.</b></center></td>
								<td><center><b>DESCRIPTION</b></center></td>
								<td><center><b>QUANTITY</b></center></td>
								<td><center><b>PRICE</b></center></td>
								<td><center><b>AMOUNT</b></center></td>
							</tr>
							
							<tr>
								<td><center><?php echo $clientData['ClientOrder']['po_number']?></center></td>
								<td><center><?php echo ucfirst($clientData['Product']['name'])?></center></td>
								<td><center><?php echo number_format($drData['DeliveryDetail']['quantity'])?></center></td>
								<td><center><?php echo number_format($clientData['QuotationItemDetail']['unit_price'],4)?></center></td>
								<td>
									<center>
										<?php 

											if(!empty($drData['DeliveryDetail']['quantity'])){

											  	$totalQty = $drData['DeliveryDetail']['quantity'] * $clientData['QuotationItemDetail']['unit_price'];
											}else{

												$totalQty = $clientData['ClientOrderDeliverySchedule'][0]['quantity'] * $clientData['QuotationItemDetail']['unit_price'];
											}

											echo number_format($totalQty,4) ;
										?>
									</center>
								</td>
							</tr>
							<tr>
								<td>-</td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
							</tr>
							<tr>
								<td></td>
								<td>DR#<?php echo ucfirst($drData['Delivery']['dr_uuid'])?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							
						</thead>
					</table>
				</div>
				<div class="col-lg-5 pull-right">
					<div class="table-responsive">
						<table class="table ">
							<thead>
								<tr>
									<td><b>VATABLE SALE</b></td>
									<td>
										<?php 
											if($clientData['QuotationItemDetail']['vat_status'] == 'Vatable Sale' || $clientData['QuotationItemDetail']['unit_price_currency_id'] == 2){
												$totalVat = ($totalQty * .12) + $totalQty;
												echo number_format($totalVat,4);
												//echo number_format((float)$totalQty, 4, '.', '');
											}else{
												echo "-";
											}
										?>
									</td>
								</tr>
								<tr>
									<td><b>VAT EXEMPT</b></td>
									<td>
										<?php 
											if($clientData['QuotationItemDetail']['vat_status'] == 'Vat Exempt'){
												
												echo number_format($totalQty,4);
												//echo number_format((float)$totalQty, 4, '.', '');
											}else{
												echo "-";
											}
										?>
									</td>
								</tr>
								<tr>
									<td><b>ZERO RATED SALE</b></td>
									<td>
										<?php 
											if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 1 || $clientData['QuotationItemDetail']['vat_status'] == 'Zero Rated Sale'){
												echo number_format($totalQty,4);
											}else{
												echo "-";
											}
										?>
									</td>
								</tr>
								<tr>
									<td><b>12% VAT</b></td>
									<td>
										<?php 
											if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2){
												$totalVat = $totalQty * .12;
												echo number_format($totalVat,4);
											}else{
												echo "-";
											}
										?>
									</td>
								</tr>
								<tr>
									<td><b>TOTAL AMOUNT DUE</b></td>
									<td>
										<?php 
											if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2){
												$totalVat = $totalQty * .12;
												$fullVat = $totalQty + $totalVat;
												echo $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']] . " ";
												echo number_format($fullVat,4);
												
											}else{
												echo $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']] . " ";
												echo number_format($totalQty,4);
											}
										?>
									</td>
								</tr>
								
							</thead>
						</table>
					</div>
				</div>
				<br><br><br><br><br><br><br><br><br><br>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td>
									<center>
										<b>PREPARED BY</b><br><br>
										<?php echo strtoupper($approved['User']['first_name'])?> <?php echo strtoupper($approved['User']['last_name'])?>
									</center>
								</td>
								<td>
									<center>
										<b>APPROVED BY</b><br><br>
										EMMA L. GOLFO
									</center>
								</td>
								<td>
									<center><b>RECEIVED BY</b></center>
								</td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>