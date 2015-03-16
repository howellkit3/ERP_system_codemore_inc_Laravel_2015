<style>
<?php include('word.css'); ?>

</style>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<center>
				<header class="main-box-header clearfix">
					<h3>KOU FU COLOR PRINTING CORP.</h3>
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
							<?php echo !empty($quotation['Quotation']['company_id']) ? ucfirst($companyData[$quotation['Quotation']['company_id']]) : ucfirst($companyData[$inquiryId[$quotation['Quotation']['inquiry_id']]]) 
							?>
						</td>
						<td>
							No : <u><?php echo $quotation['Quotation']['unique_id'] ?></u>
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
							Dear 
						</td>
						<td>
							<?php echo ucfirst($contactInfo['ContactPerson']['firstname']) ?>
							<?php echo ucfirst($contactInfo['ContactPerson']['lastname']) ?>,
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
							Product Name
						</td>
						<td style="width:20px;">:</td>
						<td>
							<?php
								echo $productName['Product']['product_name'];
							?>
						</td>
					</tr>
					<?php foreach ($quotationFieldInfo as $key => $value) { ?>
						<tr>
							<td style="width:123px;">
								<?php echo $field[$value['QuotationField']['custom_fields_id']] ?>
							</td>
							<td style="width:20px;">:</td>
							<td>
								<?php echo $value['QuotationField']['description'] ?>
							</td>
						</tr>
					<?php } ?>
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
						<td>Approved by</td>
					</tr>
					<tr>
						<td style="width:335px;">
							Ms. Carryll Yu
							<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
						</td>

					</tr>
				</thead>
			</table >
			<p class = "doc">
				<font size ="9px">
					Doc No.: KFP-FR-MKT-07<br>
					REV. No.: 01
				</font>
			</p>
			<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
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
								
			</footer>
			<br><br>

			
			
									
		</div>

	</div>	
</div>