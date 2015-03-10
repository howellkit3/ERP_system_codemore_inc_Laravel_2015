<style>
	<?php include('table.css'); ?>
</style>
<table style="width: 100%;" >
	<tr>
		<td>
			<table width= "100% " height ="100px" class = "tbl">
				<tr class = "row">
					<td align = "center" height = "40" class = "column">	
						<table>
							<tr>
								<td  height = "40">
									<?php
									echo $this->Html->image('koufu_sign.jpg', array(
															'fullBase' => true
															));
									?>
								</td>
								<td  height = "40">
									<center>
										KOU FU COLOR PRINTING CORP.<br>
										<font size ="1">
											Lot 4-5, Blk 3 Phase 2, Mountview Industrial Complex, Carmona, Cavite<br>
											Tel#: (046) 972-1111 to 13 Fax#: (046) 972-012
										</font>
									</center>
								</td>
							</tr>
						</table>
					</td>

					<td valign = "top" class = "column">
						<table style="width: 100%; cellspacing: 0; cellpadding: 0;" class = "tbl">
							<tr class = "row">
								<td colspan = "2" height= "25px" align ="center" bgcolor="black">
									<font color = "white">
										DELIVERY RECEIPT
									</font>		
								</td>
							</tr>
							<tr class = "row">
								<td height= "20px" class = "column4">
									  NO:
								</td>
								<td height= "20px" class = "column4">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td height= "20px" class = "column4">
									INV.NO.
								</td>
								<td height= "20px" class = "column4">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td height= "20px" class = "column4">
									DATE:
								</td>
								<td height= "20px" class = "column4">
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

	<tr class = "row">
		<td class = "column">

			<table style="width: 100%;  height: 20px;" class = "tbl">
				<tr >
					<td >
						CUSTOMER: <?php echo $companyName['Company']['company_name']; ?>
					</td>
						 
					<td >
						REF. NO.:
					</td>
				
				</tr>

				<tr>
					<td class = "column4">
						 ADDRESS: <?php echo $companyName['Address'][0]['address1']; ?>
					</td>
					
					<td class = "column4">
						 TIN: <?php echo $companyName['Company']['tin']; ?>
					</td>
					
				</tr>
			</table>
		</td>
	</tr>

	<tr >
		<td >

			<table style="width: 100%;  height: 15px;" class = "tbl">
				<tr class = "row">
					<td align ="center" bgcolor="black" width ="20%" height= "25px" class = "column">
						<font color = "white" size = "15px">
							P.O. #
						</font>
					</td>
						
					<td align ="center" bgcolor="black" width = "40%" height= "25px" class = "column">
						<font color = "white" size = "15px">
							ITEM
						</font>
					</td>
					<td align ="center" bgcolor="black" width = "25%" height= "25px" class = "column">
						<font color = "white" size = "13px">
							BUNDLES X (QTY/BUNDLE)
						</font>
					</td>
					<td align ="center" bgcolor="black" width = "15%" height= "25px" class = "column">
						<font color = "white" size = "15px">
							TOTAL QTY
						</font>
					</td>
				</tr>

				<tr class = "row">
					<td align ="center" class = "column2">
						<?php echo $ticketDetails['Quotation']['unique_id']; ?>
					</td>
						
					<td align ="center" class = "column2">
						<?php echo $ticketDetails['Product']['product_name']; ?>
					</td>
					<td align ="center" class = "column2">
						<?php echo $ticketDetails['QuotationField'][1]['description']; ?>
					</td>
					<td align ="center" class = "column2">
						<?php echo $ticketDetails['QuotationField'][1]['description']; ?>
					</td>
				</tr>

				<tr class = "row">
					<td class = "column2">
						&nbsp;
					</td>
						
					<td class = "column2">
						&nbsp;
					</td>
					<td class = "column2">
						&nbsp;
					</td>
					<td class = "column2">
						&nbsp;
					</td>	
				</tr>

				<tr class = "row">
					<td class = "column2">
						&nbsp;
					</td>
						
					<td class = "column2">
						&nbsp;
					<td class = "column2">
						&nbsp;
					</td>
					<td class = "column2">
						&nbsp;
					</td>
				</tr>

				<tr class = "row">
					<td class = "column2">
						&nbsp;
					</td>	
					<td class = "column2">
						&nbsp;
					</td>
					<td class = "column2">
						&nbsp;
					</td>
					<td class = "column2">
						&nbsp;
					</td>
				</tr>

				<tr class = "row">
					<td class = "column2">
						&nbsp;
					</td>		
					<td class = "column2">
						&nbsp;
					</td>
					<td class = "column2">
						&nbsp;
					</td>
					<td class = "column2">
						&nbsp;
					</td>
				</tr>

				<tr class = "row">
					<td class = "column2">
						&nbsp;
					</td>	
					<td class = "column2">
						&nbsp;
					</td>
					<td class = "column2">
						&nbsp;
					</td>
					<td class = "column2">
						&nbsp;
					</td>
				
				</tr>

				
			</table>
		</td>
	</tr>

	<tr>
		<td>
			<table style="width: 100%;  height: 25px;" class = "tbl">
				<tr class = "row">
					<td height="1" class = "column">
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
			<table style="width: 100%;  height: 25px;" class = "tbl">
				<tr class = "row">
					<td height="50" width ="20%" align ="center" valign = "top" class = "column3">
						PREPARED BY:
					</td>
					<td height="50" width ="20%" align ="center" valign = "top" class = "column3">
						CHECKED BY:	
					</td>
					<td height="50" width ="20%" align ="center" valign = "top" class = "column3">
						APPROVED BY:
					</td>
					<td height="50" width ="40%" colspan = "2" align ="center" valign = "top" class = "column3">
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



