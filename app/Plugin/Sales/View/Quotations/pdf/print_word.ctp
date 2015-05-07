<style>
<?php include('word.css'); ?>

</style>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<center>
				<header class="main-box-header clearfix">
					<h3>Kou Fu Packaging Corp.</h3>
					<h6 style="font-family: Calibri;">Lot 4-5, Blk 3 Phase 2, Mountview Industrial Complex, Bancal, Carmona, Cavite</h6>
					<h6>Tel#: (046) 972-1111 to 13 Fax#: (046) 972-0120</h6><br>
					<h3>Price Quotation</h3>
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
			<table class="layout">
				<thead>
					<tr>
						<td style="width:20px;">
							Dear :&nbsp; <?php echo ucfirst($quotation['ContactPerson']['firstname']).' '.ucfirst($quotation['ContactPerson']['lastname']) ?> &nbsp;
						</td>
						<td>
							<?php //echo ucfirst($contactInfo['ContactPerson']['firstname']) ?>
							<?php //echo ucfirst($contactInfo['ContactPerson']['lastname']) ?>
						</td>
					</tr>
				</thead>
			</table>
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
						 <?php echo $quotation['ProductDetail']['name']?>
						</td>
					</tr>
					<tr>
						<td style="width:123px;">
							Size
						</td>
						<td style="width:20px;">:</td>
						<td>
							<?php echo $quotation['QuotationDetail']['size'] ?>
						</td>
					</tr>
					
					
				</thead>
			</table>


								<table  class = "layout">
								<?php foreach ($quotation['QuotationItemDetail'] as $itemDetail){ ?>
								
										<tr>
											<td width ="123px" height ="35px" valign ="top" class ="column3 col-md-8"> 
												<div class="col-lg-12">QTY 
												</div>
											</td>
											<td style="width:20px;">:</td>	
											<td height ="35px" valign ="top" class ="column3 col-md-8" style="border:1px solid #000;  text-align:center"> 
												<div class="col-lg-12">
													<?php echo $itemDetail['quantity'];?> 

													<?php
													 echo !empty($units[$itemDetail['quantity_unit_id']]) ? $units[$itemDetail['quantity_unit_id']] : '' ?> 

												</div>
											</td>	
											
										</tr>

										<tr >
											<td height ="35px" valign ="top" class ="column3 col-md-8"> 
												<div class="col-lg-12">Unit Price 
												</div>
											</td>
											<td style="width:20px;">:</td>
											<td height ="35px" valign ="top" class = "column4 col-md-8" style="border:1px solid #000;  text-align:center">
												<div class="col-lg-12" >
													<?php echo $itemDetail['unit_price'];?> 

													<?php
													 echo !empty($currencies[$itemDetail['unit_price_currency_id']]) ? $currencies[$itemDetail['unit_price_currency_id']] : '' ?> 
												</div>
											</td>
											
										</tr>

										<tr>
											<td height ="35px" valign ="top" class ="column3 col-md-8"> 
												<div class="col-lg-12">Vat Price
												</div>
											</td>
											<td style="width:20px;">:</td>
											<td height ="40px" class ="column2 col-md-8" style="border:1px solid #000;  text-align:center">
												<div class="col-lg-12">
													<?php echo $itemDetail['vat_price'];?> 
												</div>
											</td>
											
										</tr>

										<tr>
											<td height ="35px" valign ="top" class ="column3 col-md-8"> 
												<div class="col-lg-12">Material

												</div>
											</td>
											<td style="width:20px;">:</td>
											<td height ="30px" class ="column2 col-md-8" style="border:1px solid #000; text-align:center">
												<div class="col-lg-12">
													<?php echo $itemDetail['material'];?> 
												</div>
											</td>
											
										</tr>

									
								<?php } ?>
								</table>


			<table class="layout">
				<thead>
					<tr>
						<td style="width:123px;">
							Validity
						</td>
						<td style="width:20px;">:</td>
						<td>
							 <?php echo !empty($quotation['Quotation']['validity']) ? date('M d, Y', strtotime($quotation['Quotation']['validity'])) : 'No validity date'; ?>
						</td>
					</tr>
					<tr>
						<td style="width:123px;">
							Remarks
						</td>
						<td style="width:20px;">:</td>
						<td>
							<?php echo $quotation['QuotationDetail']['remarks']?>
						</td>
					</tr>
					
					
				</thead>
			</table>
			
			<table class="layout">
				<thead>
					<tr>
						<td>Respectfully,</td>
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
				<thead>
					<tr>
						<td style="width:500px;">
							<div style="display:inline-block; vertical-align:top; border-bottom: 1px solid #b2b2b2;width:335px">
								Approved by <br/><br>
								Ms. Carryll Yu
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