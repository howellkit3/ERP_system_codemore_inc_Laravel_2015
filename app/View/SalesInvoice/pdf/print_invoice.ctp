<style>
<?php include('word.css'); ?>

</style>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<br><br><br><br><br>
			<table class="layout" style="line-height:15px;">
				<thead>
					<tr>	
						<td style="width:50px;"> </td>
						<td style="width:450px;"> </td>
						<td style="width:160px;"> </td>
					</tr>
					<tr>
						<td style="width:50px;"> </td>
						<td style="width:450px;"> </td>
						<td style="width:160px;"><?php echo $invoiceData['SalesInvoice']['sales_invoice_no']?></td>
					</tr>
					<tr>
						<td style="width:50px;"> </td>
						<td style="width:450px;"><?php echo ucfirst($companyData['Company']['company_name'])?></td>
						<td style="width:100px;text-align:right;"><?php echo (new \DateTime())->format('m/d/Y'); ?></td>
					</tr>
					<tr>
						<td style="width:50px;"> </td>
						<td style="width:450px;"> </td>
						<td style="width:100px;text-align:right;"><?php echo ucfirst($companyData['Company']['tin'])?></td>
					</tr>
					<tr>
						<td style="width:50px;"> </td>
						<td style="width:450px;"><?php echo ucfirst($companyData['Address'][0]['address1'])?></td>
						<td style="width:100px;text-align:right;"><?php echo ucfirst($paymentTermData[$clientData['Quotation']['payment_terms']])?></td>
					</tr>
				</thead>
			</table>
			<br><br>
			<table class="table table-bordered" style="line-height:20px;">
				<thead>
					<tr>
						<td style="width:100px;"><?php echo $clientData['ClientOrder']['po_number']?></td>
						<td class="td-heigth" style="width:250px;border:1px solid #FFFFFF;"><?php echo ucfirst($clientData['Product']['name'])?></td>
						<td class="td-heigth" style="width:110px;border:1px solid #FFFFFF;"><center><?php echo number_format($drData['DeliveryDetail']['quantity'])?></center></td>
						<td class="td-heigth" style="width:110px;border:1px solid #FFFFFF;text-align:right;">
							
							<?php echo number_format($clientData['QuotationItemDetail']['unit_price'],2)?> 
							
						</td>
						<td class="td-heigth" style="width:110px;border:1px solid #FFFFFF;text-align:right;">
							
							<?php $totalQty = $drData['DeliveryDetail']['quantity'] * $clientData['QuotationItemDetail']['unit_price']?>
							<?php echo number_format($totalQty,2) ?> 
								
						</td>
					</tr>
				</thead>
			</table>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<table class="table table-bordered" style="line-height:20px;">
				<thead>
					<tr>
						<td style="width:100px;"> </td>
						<td class="td-heigth" style="width:250px;border:1px solid #FFFFFF;">DR#<?php echo ucfirst($drData['Delivery']['dr_uuid'])?></td>
					</tr>
					<tr>
						<td style="width:100px;"> </td>
						<td class="td-heigth" style="width:250px;border:1px solid #FFFFFF;">REF#<?php echo ucfirst($drData['Delivery']['id'])?></td>
					</tr>
				</thead>
			</table>
			<br><br>
			<table class="layout" style="line-height:15px;">
				<thead>
					<tr>	
						<td style="width:660px;text-align:right;">
							<?php 
								if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 1){
									echo number_format($totalQty,2);
								}
							?>
						</td>
					</tr>
					<tr>	
						<td style="width:660px;text-align:right;"></td>
					</tr>
					<tr>	
						<td style="width:660px;text-align:right;">
							<?php 
								if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2){
									echo number_format($totalQty,2);
								}
							?>
						</td>
					</tr>
					<tr>	
						<td style="width:660px;text-align:right;">
							<?php 
								if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 1){
									$totalVat = $totalQty * .12;
									echo number_format($totalVat,2);
								}
							?>
						</td>
					</tr>
					<tr>	
						<td style="width:660px;text-align:right;">
							<?php 
								if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 1){
									$totalVat = $totalQty * .12;
									$fullVat = $totalQty + $totalVat;
									echo $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']];
									echo number_format($fullVat,2);
								}else{
									echo $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']];
									echo number_format($totalQty,2);
								}
							?>
						</td>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>