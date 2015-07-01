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