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