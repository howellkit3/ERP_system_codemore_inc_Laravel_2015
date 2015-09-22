<style>
<?php include('word.css'); ?>

</style>
<br><br>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<center>
				<header class="main-box-header clearfix" >
					<img src="<?php echo Router::url('/', true) ?>img/koufu_logo.jpg" alt="logo" style="width:225px;height:40px;padding-bottom:10;"> <br>
					<label style="padding-bottom:8px; font-size:14px;">Lot 4-5 Blk 3 Ph2 Mountview Industrial Complex</label> <br>
					<label style="padding-bottom:8px; font-size:14px;">Brgy. Bancal Carmona Cavite</label><br>
					<label style="padding-bottom:8px; font-size:14px;">Tel: +632-5844928; &nbsp; +6346-4301576 &nbsp; Fax: +632-5844952</label><br><br>
						
					<label style="padding-bottom:8px; font-size:24px; font-style: arial;"><b>PRICE QUOTATION</label></b><br><br><br>
					
				</header>
			</center>

			<table class="layout" style ="line-height:5px;" >
				<thead>
					<tr>
						<td style="width:123px;font-family: Calibri;">Attention</td>
						<td style="width:20px;">:</td>
						<td style="width:400px;">
							<?php 
							// 	echo $quotation['Quotation']['attention_details']
								echo ucfirst($quotation['ContactPerson']['firstname']).' '.ucfirst($quotation['ContactPerson']['lastname'])
							?>
						</td>
						<td>
							No : <u>PQ-<?php echo $quotation['Quotation']['uuid'] ?></u>
						</td>
					</tr>
					<tr>
						<td style="width:123px;font-family: Calibri;">Company</td>
						<td style="width:20px;">:</td>
						<td> <?php echo !empty($quotation['Quotation']['company_id']) ? ucfirst($companyData[$quotation['Quotation']['company_id']]) : ucfirst($companyData[$inquiryId[$quotation['Quotation']['inquiry_id']]]) ?></td>
						<td>Date:
							<?php echo !empty($quotation['Quotation']['created']) ? date('Y/m/d', strtotime($quotation['Quotation']['created'])) : '' 
							?>
						</td>
					</tr>
					<tr>
						<td style="width:123px;font-family: Calibri;">Address</td>
						<td style="width:20px;">:</td>
						<td><?php echo !empty($quotation['Quotation']['company_id']) ? ucfirst($addressData[$quotation['Quotation']['company_id']])  : ucfirst($addressData[$inquiryId[$quotation['Quotation']['inquiry_id']]])  ?> 

							<?php if(!empty($cityData[$quotation['Quotation']['company_id']])){ echo ucfirst($cityData[$quotation['Quotation']['company_id']]);   }?>

							<?php if(!empty($provinceData[$quotation['Quotation']['company_id']])){ echo ucfirst($provinceData[$quotation['Quotation']['company_id']]);   }?>

						</td>
						<td>
						</td>
					</tr>
				</thead>
			</table>

			<br>

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
						<td style="padding-left: 0px;">
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
						<td height ="15px" valign ="top" class ="column3 col-md-8" style="border:1px solid #b2b2b2;  text-align:center"> 
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
						<td height ="15px" valign ="top" class = "column4 col-md-8" style="border:1px solid #b2b2b2;  text-align:center">
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
						<td height ="15px" class ="column2 col-md-8" style="border:1px solid #b2b2b2;  text-align:center">
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
						<td height ="15px" class ="column2 col-md-8" style="border:1px solid #b2b2b2; text-align:center">
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
					<?php $space = "  "?>
					<tr>
						<td>Respectfully,</td>
						<td style="width:270px;"><?php echo $space?></td>
						<td>Approved by:</td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td style="width:200px;">
							<?php echo ucfirst($user['User']['first_name']) ?>
							<?php echo ucfirst($user['User']['last_name'])?>
							<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
						</td>
						<td style="width:200px;"></td>

						<td style="width:200px;">
							<?php 

								echo ucfirst($approvedUser['User']['first_name']);
								echo ' ';
							 	echo ucfirst($approvedUser['User']['last_name']);

							?>
							<hr style="height:1px; border:none; text-align: left;  width: 200px; color:#b2b2b2; background-color:#b2b2b2;">
						</td>
					</tr>
				
			</table>

			<div style="display:inline-block; vertical-align: bottom;text-align:left; margin-left:30px;">
					<font size ="9px">
						Doc No.: KP-FR-SD1-002<br>
						REV. No.: 0<br>
						Effective 17 Aug 2015
					</font>				
			</div>
			<br><br>
				
		</div>

	</div>	
</div>