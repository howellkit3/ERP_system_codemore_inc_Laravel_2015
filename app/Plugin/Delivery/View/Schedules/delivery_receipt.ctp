<table>
	<tr>
		<td>
			<table border = 1>
				<tr >
					<td colspan="2" align = "center">
						<header class="main-box-header clearfix">
								<h1>
									<?php
									echo $this->Html->image('koufu_sign.jpg', array(
															'alt' => 'Process'
									));
									?>
									Kou Fu Packaging Corp.
								</h1>
								<h5>Lot 4-5, Blk 3 Phase 2, Mountview Industrial Complex, Carmona, Cavite</h5>
								<h6>Tel#: (046) 972-1111 to 13 Fax#: (046) 972-0120</h6><br>				
						</header>
					</td>

					<td valign = "top">
						<table border = "1" style="width: 100%; border: 0; cellspacing: 0; cellpadding: 0;">
							<tr>
								<td colspan = "2" height = "40" align ="center" bgcolor="black">
									<font color = "white">
										DELIVERY RECEIPT
									</font>		
								</td>
							</tr>
							<tr>
								<td height = "40">
									  NO:
								</td>
								<td height = "40">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td height = "40">
									INV.NO.
								</td>
								<td height = "40">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td height = "40">
									DATE:
								</td>
								<td height = "40">
									<?php
									 	echo date("M-d-Y");
									?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

			</table>
		</td>
	</tr>

	<tr>
		<td>

			<table border = 1 style="width: 100%; border: 0; cellspacing: 0; cellpadding: 0;">
				<tr>
					<td>
						CUSTOMER: <?php echo $companyName['Company']['company_name']; ?>
					</td>
						 REF. NO.:
					<td >
						
					</td>
				
				</tr>

				<tr>
					<td>
						ADDRESS: <?php echo $companyName['Address'][0]['address1']; ?>
						
					</td>
					
					<td >
						 TIN: <?php echo $companyName['Company']['tin']; ?>
					</td>
					
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td>

			<table style="width: 100%;" border = 1 style="width: 100%; border: 0; cellspacing: 0; cellpadding: 0;">
				<tr>
					<td align ="center" bgcolor="black" width ="20%">
						<font color = "white">
							P.O. #
						</font>
					</td>
						
					<td align ="center" bgcolor="black" width = "40%">
						<font color = "white">
							ITEM
						</font>
					</td>
					<td align ="center" bgcolor="black" width = "25%">
						<font color = "white">
							BUNDLES X (QTY/BUNDLE)
						</font>
					</td>
					<td align ="center" bgcolor="black" width = "15%">
						<font color = "white">
							TOTAL QTY
						</font>
					</td>
				</tr>

				<tr>
					<td align ="center">
						<?php echo $ticketDetails['Quotation']['unique_id']; ?>
					</td>
						
					<td align ="center">
						<?php echo $ticketDetails['Product']['product_name']; ?>
					</td>
					<td align ="center">
						<?php echo $ticketDetails['QuotationField'][1]['description']; ?>
					</td>
					<td align ="center">
						<?php echo $ticketDetails['QuotationField'][1]['description']; ?>
					</td>
				</tr>

				<tr>
					<td>
						&nbsp;
					</td>
						
					<td >
						&nbsp;
					</td>
					<td >
						&nbsp;
					</td>
					<td >
						&nbsp;
					</td>	
				</tr>

				<tr>
					<td>
						&nbsp;
					</td>
						
					<td >
						&nbsp;
					<td >
						&nbsp;
					</td>
					<td >
						&nbsp;
					</td>
				</tr>

				<tr>
					<td>
						&nbsp;
					</td>
						
					<td >
						&nbsp;
					<td >
						&nbsp;
					</td>
					<td >
						&nbsp;
					</td>
				</tr>

				<tr>
					<td>
						&nbsp;
					</td>
						
					<td >
						&nbsp;
					<td >
						&nbsp;
					</td>
					<td >
						&nbsp;
					</td>
				</tr>

				<tr>
					<td>
						&nbsp;
					</td>
						
					<td >
						&nbsp;
					<td >
						&nbsp;
					</td>
					<td >
						&nbsp;
					</td>
				
				</tr>

				
			</table>
		</td>
	</tr>

	<tr>
		<td>

			<table border = 1 style="width: 100%; border: 0; cellspacing: 0; cellpadding: 0;">
				<tr>
					<td height="1">
						<font size= "1">
							White- Customer's Copy&nbsp;<br>
							Yellow- Accounting&nbsp;<br>
							Blue & Pink-Delivery&nbsp;<br>
						</font>
					</td>
				</tr>
				
			</table>
		</td>
	</tr>

	<tr>
		<td>

			<table style=" width: 100%;" border = 1>
				<tr>
					<td height="100" width ="20%" align ="center" valign = "top">
						PREPARED BY:
					</td>
					<td height="100" width ="20%" align ="center" valign = "top">
						CHECKED BY:	
					</td>
					<td height="100" width ="20%" align ="center" valign = "top">
						APPROVED BY:
					</td>
					<td height="100" width ="40%" colspan = "2" align ="center" valign = "top">
						RECEIVED BY:<br><br><br><br>
						<font size = "1">
							PRINT NAME & SIGN / DATE
						</font>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>



