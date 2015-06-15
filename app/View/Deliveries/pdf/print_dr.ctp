<style>
<?php include('word.css'); ?>

</style>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<table class="layout">
				<thead>
					<tr>
						<td>
							<img src="<?php echo $this->Html->url('/', true) ?>img/koufu.png" class="" width="90" style="width:90;">
						</td>
						<td style="width:60px;"> </td>
						<td>
							<center>
								<h2 style="font-size:25px;padding-bottom:10px;">Kou Fu Packaging Corporation</h2>
								<h4 style="font-family: Arial;padding-bottom:8px;">Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h4>
								<h4>Tel#: +63(2)5844928 Fax#: +63(2)5844952</h4>
							</center>
						</td>
					</tr>
				</thead>
			</table>
			<center>
				<h3>Delivery Receipt</h3>
			</center><br>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:15px;"> </td>
						<td style="width:80px;font-family: Calibri;"><b>CUSTOMER</b></td>
						<td style="width:20px;">:</td>
						<td style="width:330px;">
							<?php echo ucfirst($companyData['Company']['company_name'])?>
						</td>
						<td>
							Delivery No. : <u><?php echo $drData['Delivery']['dr_uuid']?></u>
						</td>
					</tr>
					<tr>
						<td style="width:15px;"> </td>
						<td style="width:80px;font-family: Calibri;"><b>ADDRESS</b></td>
						<td style="width:20px;">:</td>
						<td style="width:330px;">
							<?php echo ucfirst($companyData['Address'][0]['address1'])?>
						</td>
						<td>
							Invoice No. : <u></u>
						</td>
					</tr>
					<tr>
						<td style="width:15px;"> </td>
						<td style="width:80px;font-family: Calibri;"><b>TIN</b></td>
						<td style="width:20px;">:</td>
						<td style="width:330px;">
							<?php echo ucfirst($companyData['Company']['tin'])?>
						</td>
						<td>
							Date : <?php echo (new \DateTime())->format('l, F d, Y '); ?>
						</td>
					</tr>
				</thead>
			</table>
			<br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<td class="td-heigth" style="width:20px;border:1px solid #FFFFFF;"></td>
						<td class="td-heigth" style="width:90px;border:1px solid #EAEAEA;"><center><b>P.O</b></center></td>
						<td class="td-heigth" style="width:260px;border:1px solid #EAEAEA;"><center><b>ITEM</b></center></td>
						<td class="td-heigth" style="width:160px;border:1px solid #EAEAEA;"><center><b>QTY</b></center></td>
						<td class="td-heigth" style="width:100px;border:1px solid #EAEAEA;"><center><b>TOTAL QTY</b></center></td>
					</tr>
					<?php foreach ($clientData['ClientOrderDeliverySchedule'] as $key => $scheduleList) { ?>
						<tr>
							<td style="width:15px;"></td>
							<td class="td-heigth" style="width:90px;border:1px solid #EAEAEA;"><center><?php echo $clientData['ClientOrder']['po_number']?></center></td>
							<td class="td-heigth" style="width:120px;border:1px solid #EAEAEA;"><center><?php echo ucfirst($clientData['Product']['name'])?></center></td>
							<td class="td-heigth" style="width:120px;border:1px solid #EAEAEA;">
								<center>
									<?php echo $scheduleList['quantity']?> x
									<?php echo $clientData['QuotationItemDetail']['quantity']?> /
									<?php echo $units[$clientData['QuotationItemDetail']['quantity_unit_id']]?>
								</center>
							</td>
							<td class="td-heigth" style="width:120px;border:1px solid #EAEAEA;">
								<center>
									<?php $totalQty = $clientData['QuotationItemDetail']['quantity'] * $scheduleList['quantity']?>
									<?php echo $totalQty ?> /
									<?php echo $units[$clientData['QuotationItemDetail']['quantity_unit_id']]?>
								</center>
							</td>
						</tr>
					<?php } ?>
				</thead>
			</table>
			<br>
			<table class="layout">
				<thead>
					<tr>
						<td>
							<font style="font-size:8px;">
								White-Customer's Copy ;<br> 
								Yellow-Accounting ; <br>
								Blue & Pink-delivery ;
							</font>
						</td>
						<td style="width:45px;"> </td>
						<td>
							<center>
								PLEASE CHECK YOUR GOODS WITHIN 3 DAYS IF IN GOOD CONDITION <br> 
								ANY COMPLAIN WILL NOT BE ENTERTAINED AFTER THE SAID PERIOD
							</center>
						</td>
					</tr>
				</thead>
			</table>
			<br><br><br>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:300px;">
							<div style="display:inline-block; vertical-align:top; border-bottom: 0px solid #b2b2b2;width:335px">
								<center>
									PREPARED BY: <br><br><br>
									<hr style="width:200px;height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
									Ms. Carryll Yu
								</center>
							</div>
						</td>
						<td style="width:300px;">
							<div style="display:inline-block; vertical-align:top; border-bottom: 0px solid #b2b2b2;width:235px">
								<center>
									CHECKED BY: <br><br><br>
									<hr style="width:200px;height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
									Ms. Carryll Yu
								</center>
							</div>
						</td>
					</tr>
				</thead>
			</table >
			<br>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:300px;">
							<div style="display:inline-block; vertical-align:top; border-bottom: 0px solid #b2b2b2;width:335px">
								<center>
									APPROVED BY: <br><br><br>
									<hr style="width:200px;height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
									Ms. Carryll Yu
								</center>
							</div>
						</td>
						<td style="width:300px;">
							<div style="display:inline-block; vertical-align:top; border-bottom: 0px solid #b2b2b2;width:235px">
								<center>
									RECEIVED BY: <br><br><br>
									<hr style="width:200px;height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
									Ms. Carryll Yu
								</center>
							</div>
						</td>
					</tr>
				</thead>
			</table >
			<table class="layout">
				<thead>
					<tr>
						<td style="width:500px;">
							<div style="display:inline-block; vertical-align:top; border-bottom: 0px solid #b2b2b2;width:335px">
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
			<br><br>
		</div>
	</div>	
</div>