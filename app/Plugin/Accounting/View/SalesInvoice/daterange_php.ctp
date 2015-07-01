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