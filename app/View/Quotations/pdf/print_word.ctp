<style>
<?php include('word.css'); ?>

</style>
<br><br>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<center>
				<header class="main-box-header clearfix" >
					<h1 style="padding-bottom:10px;">Kou Fu Packaging Corporation</h1>
					<h5 style="padding-bottom:8px;">Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h5>
					<h6>
						Tel: +63(2)5844928 &nbsp; Fax: +63(2)5844952
						<!-- Tel: +63(46)4301576 / +63(46)9721111<br>
						+63(2)5844928 / +63(2)5844929<br>
						+63(2)5844947 Local: 302<br>

						Fax: +63(2)5844952 / +63(46)9720120<br>
						Mobile: +63(917)8922637<br>
						Taiwan: +886 922565185<br> -->
					</h6><br>
				</header>
			</center>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:123px;font-family: Calibri;">Attention</td>
						<td style="width:20px;">:</td>
						<td style="width:400px;">
							<?php 
							// 	echo $quotation['Quotation']['attention_details']
								echo !empty($quotation['Quotation']['company_id']) ? ucfirst($companyData[$quotation['Quotation']['company_id']]) : ucfirst($companyData[$inquiryId[$quotation['Quotation']['inquiry_id']]]) 
							?>
						</td>
						<td>
							No : <u>PQ-<?php echo $quotation['Quotation']['uuid'] ?></u>
						</td>
					</tr>
					<tr>
						<td></td>
						<td style="width:20px;"></td>
						<td>
							___________________________________________________
						</td>
						<td>Date:
							<?php echo !empty($quotation['Quotation']['created']) ? date('Y/m/d', strtotime($quotation['Quotation']['created'])) : '' 
							?>
						</td>
					</tr>
				</thead>
			</table>
			<?php if (!empty($quotation['ContactPerson']['firstname']) || !empty($quotation['lastname']['firstname']) ) { ?>
				<table class="layout">
					<thead>
						<tr>
							<td style="width:20px;">
								Dear <?php echo ucfirst($quotation['ContactPerson']['firstname']).' '.ucfirst($quotation['ContactPerson']['lastname']) ?>,&nbsp;
							</td>
							
						</tr>
					</thead>
				</table>
			<?php } ?>
			<table class="layout">
				<thead>
					<tr>
						<td style="padding-left: 126px;">
							We are pleased to submit our price quotation on your printing requirement under the following <br>specifications:
						</td>
					</tr>
				</thead>
			</table>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:123px;">
							Item
						</td>
						<td style="width:20px;">:</td>
						<td>
						 <?php echo $quotation['Product']['name']?>
						</td>
					</tr>
					<?php if (!empty($quotation['QuotationDetail']['size']) ) { ?>
						<tr>
							<td style="width:123px;">
								Size
							</td>
							<td style="width:20px;">:</td>
							<td>
								<?php echo $quotation['QuotationDetail']['size'] ?>
							</td>
						</tr>
					<?php } ?>
					
				</thead>
			</table>


			<table  class = "layout">
				
				<tr>
					<td width ="123px" height ="15px" valign ="top" class ="column3 col-md-8"> 
						<div class="col-lg-12">Quantity
						</div>
					</td>
					<td style="width:20px;">:</td>
					<?php foreach ($quotation['QuotationItemDetail'] as $itemDetail){ ?>	
						<td height ="15px" valign ="top" class ="column3 col-md-8" style="border:1px solid #000;  text-align:center"> 
							<div class="col-lg-12">
								<?php echo (!empty($itemDetail['quantity']) && is_numeric($itemDetail['quantity'])) ? number_format($itemDetail['quantity']) : '';
								?>
								<?php
								 echo !empty($units[$itemDetail['quantity_unit_id']]) ? $units[$itemDetail['quantity_unit_id']] : '' ?> 
							</div>
						</td>
					<?php } ?>	
					
				</tr>

				<tr >
					<td height ="15px" valign ="top" class ="column3 col-md-8"> 
						<div class="col-lg-12">Unit Price 
						</div>
					</td>
					<td style="width:20px;">:</td>
					<?php foreach ($quotation['QuotationItemDetail'] as $itemDetail){ ?>
						<td height ="15px" valign ="top" class = "column4 col-md-8" style="border:1px solid #000;  text-align:center">
							<div class="col-lg-12" >
								<?php
								 echo !empty($currencies[$itemDetail['unit_price_currency_id']]) ? $currencies[$itemDetail['unit_price_currency_id']] : '' ?>
								<?php echo (!empty($itemDetail['unit_price']) && is_numeric($itemDetail['unit_price'])) ? number_format($itemDetail['unit_price'],4) : '';?> 
								/
								<?php
								 echo !empty($units[$itemDetail['unit_price_unit_id']]) ? $units[$itemDetail['unit_price_unit_id']] : '' ?>
							</div>
						</td>
					<?php } ?>	
				</tr>

				<tr>
					<td height ="15px" valign ="top" class ="column3 col-md-8"> 
						<div class="col-lg-12">Vat Price
						</div>
					</td>
					<td style="width:20px;">:</td>
					<?php foreach ($quotation['QuotationItemDetail'] as $itemDetail){ ?>
						<td height ="15px" class ="column2 col-md-8" style="border:1px solid #000;  text-align:center">
							<div class="col-lg-12">
								<?php echo (!empty($itemDetail['vat_price']) && is_numeric($itemDetail['vat_price'])) ? number_format($itemDetail['vat_price'],4) : '';
								?>
							</div>
						</td>
					<?php } ?>
				</tr>

				<tr>
					<td height ="15px" valign ="top" class ="column3 col-md-8"> 
						<div class="col-lg-12">Material

						</div>
					</td>
					<td style="width:20px;">:</td>
					<?php foreach ($quotation['QuotationItemDetail'] as $itemDetail){ ?>
						<td height ="15px" class ="column2 col-md-8" style="border:1px solid #000; text-align:center">
							<div class="col-lg-12">
								<?php echo $itemDetail['material'];?> 
							</div>
						</td>
					<?php } ?>
				</tr>

			</table>
			<table class="layout">
				<thead>
					<?php if (!empty($quotation['QuotationDetail']['color']) ) { ?>
						<tr>
							<td style="width:123px;">
								Color
							</td>
							<td style="width:20px;">:</td>
							<td>
							 <?php echo $quotation['QuotationDetail']['color']?> 
							</td>
						</tr>
					<?php } ?>
					<?php if (!empty($quotation['QuotationDetail']['process']) ) { ?>
						<tr>
							<td style="width:123px;">
								Process
							</td>
							<td style="width:20px;">:</td>
							<td>
							 <?php echo $quotation['QuotationDetail']['process']?>
							</td>
						</tr>
					<?php } ?>
					<?php if (!empty($quotation['QuotationDetail']['packaging']) ) { ?>
					<tr>
						<td style="width:123px;">
							Packaging
						</td>
						<td style="width:20px;">:</td>
						<td>
						 <?php echo $quotation['QuotationDetail']['packaging']?>
						</td>
					</tr>
					<?php } ?>
					<?php if (!empty($quotation['QuotationDetail']['other_specs']) ) { ?>
						<tr>
							<td style="width:123px;">
								Other Specs
							</td>
							<td style="width:20px;">:</td>
							<td>
							 <?php echo $quotation['QuotationDetail']['other_specs']?>
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td style="width:123px;">
							Terms
						</td>
						<td style="width:20px;">:</td>
						<td>
						 <?php echo !empty($paymentTerm[$quotation['Quotation']['payment_terms']]) ? $paymentTerm[$quotation['Quotation']['payment_terms']]: '' ?>
						</td>
					</tr>
					
				</thead>
			</table>


			<table class="layout">
				<thead>
					<?php if (!empty($quotation['QuotationDetail']['validity']) ) { ?>
						<tr>
							<td style="width:123px;">
								Validity
							</td>
							<td style="width:20px;">:</td>
							<td>
								<?php 
								   	if (!empty($quotation['Quotation']['validity']) 
								   		&& $this->DateFormat->isValidDateTimeString($quotation['Quotation']['validity'])){
								   	
								   		echo date('M d, Y', strtotime($quotation['Quotation']['validity']));
								   	} else {

								   		echo 'No validity date';
								   	} 
								?>
							</td>
						</tr>
					<?php } ?>
					<?php if (!empty($quotation['QuotationDetail']['remarks']) ) { ?>
						<tr>
							<td style="width:123px;">
								Remarks
							</td>
							<td style="width:20px;">:</td>
							<td>
								<?php echo $quotation['QuotationDetail']['remarks']?>
							</td>
						</tr>
					<?php } ?>
					
				</thead>
			</table>
			<br><br>
			<table class="layout">
				<thead>
					<tr>
						<td>Respectfully,</td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td style="width:335px;">
							<?php echo ucfirst($user['User']['first_name']) ?>
							<?php echo ucfirst($user['User']['last_name'])?>
							<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
						</td>
					</tr>
				</thead>
			</table>
			<table class="layout">
				<?php if(!empty($approvedUser)){ ?>
					<thead>
						<tr>
							<td style="width:500px;">
								<div style="display:inline-block; vertical-align:top; border-bottom: 1px solid #b2b2b2;width:335px">
									Approved by :<br/><br><br><br>
									<?php
								
										echo ucfirst($approvedUser['User']['first_name']);
										echo ' ';
									 	echo ucfirst($approvedUser['User']['last_name']);
										
									?>
									<!-- <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;"> -->
								</div>
								<div style="display:inline-block; vertical-align:top; border-bottom: 1px solid #b2b2b2;width:335px">
								</div>
								<div style="display:inline-block; vertical-align: bottom;text-align:right; margin-right:150px;">
									<font size ="9px">
										Doc No.: KFP-FR-MKT-07<br>
										REV. No.: 01	
									</font>				
								</div>
							</td>

						</tr>
					</thead>
				<?php 
					}else{
						echo "Note: Not yet approved. ";
					}
				?>
			</table >
			
			<!-- <hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
			<center>
				<header class="main-box-header clearfix">
					<h4>Acceptance Slip</h4>
				</header>
			</center>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:335px;text-align:center;">Send to manager</td>
						<td style="padding-left: 150px;">Date:_____________________</td>
					</tr>
				</thead>
			</table>
			<center>
				<header class="main-box-header clearfix para">
					<center>
					<p align ="justify">
						<font size ="15px">I do hereby accept the price and other details submitted on your price quotation no.<?php echo $quotation['Quotation']['unique_id'] ?><br> Also, I do hereby authorize your company to proceed with and supply the work described above.
						</font>
					</p>
					</center>
				</header>
			</center>
			<table class="layout" >
				<thead>
					<tr>
						<td>Authorized by:_________________</td>
						<td style="padding-left: 270px;">Position:_________________</td>
					</tr>
					<tr>
						<td> </td>
						<td style="padding-left: 285px;">Date:_________________</td>
					</tr>
				</thead>
			</table>
			<footer >
				<table class ="tables-css">
					<tr>
						<td class ="footer">

							<font size = "12px">
								<?php echo (new \DateTime())->format('l, F d, Y '); ?>
							</font>
						</td>
						<td class ="footer">
							&nbsp;&nbsp;&nbsp;
						</td>
						<td class ="footer">
							&nbsp;&nbsp;&nbsp;
						</td>
						<td class = "footer2">
							<font size = "12px">
							
							Page 1 of 1
							</font>

						</td>
					</tr>
				</table>
								
			</footer> -->
			<br><br>

			
			
									
		</div>

	</div>	
</div>