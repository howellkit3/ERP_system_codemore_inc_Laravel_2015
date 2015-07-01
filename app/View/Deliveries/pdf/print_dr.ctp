<style>

<?php include('word.css'); ?>

</style>

<div class="row" style="background:url('http://localhost/koufunet_staging/img/s.jpg');background-size: 768px;
  height: 100%;background-repeat:no-repeat; background-position: 0px 10px;">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<br><br><br><br>
			<table class="layout" style="line-height:8px;padding-top:25px; font-family: Verdana , Geneva, sans-serif;">
				<thead>
					<tr>
						<td style="width:15px;"> </td>
						<td style="width:80px;font-family: Calibri;"><b> </b></td>
						<td style="width:20px;"> </td>
						<td style="width:480px;">
						</td>
						<td style="text-align:right;">
							<?php echo (new \DateTime())->format('m/d/Y'); ?>
						</td>
					</tr>
					<tr>
						<td style="width:15px; height: 5px"> </td>
						<td style="width:80px;font-family: Calibri;"><b> </b></td>
						<td style="width:20px;"> </td>
						<td style="width:480px;">
							<?php echo ucfirst($companyData['Company']['company_name'])?>
						</td>
						<td style="text-align:right; ">
							DR# <?php echo $drData['Delivery']['dr_uuid']?>
						</td>
					</tr>
					<tr>
						<td style="width:15px;"> </td>
						<td style="width:80px;font-family: Calibri;"><b> </b></td>
						<td style="width:20px;"> </td>
						<td style="width:480px;">
							<?php echo substr(ucfirst($companyData['Address'][0]['address1']), 0 , 30);?>
						</td>
						<td style="text-align:right;">
							<?php echo ucfirst($companyData['Company']['tin'])?>
						</td>
					</tr>
				</thead>
			</table>
			
			<table class="table table-bordered" style="line-height:20px;padding-top:5px; font-family: Verdana , Geneva, sans-serif;">
				<thead>
					<?php //foreach ($clientData['ClientOrderDeliverySchedule'] as $key => $scheduleList) { ?>
						<tr>
							<td class="td-heigth" style="width:30px;border:1px solid #FFFFFF;"> </td>
							<td class="td-heigth" style="width:95px;border:1px solid #FFFFFF;"><?php echo $clientData['ClientOrder']['po_number']?></td>
							<td class="td-heigth" style="width:300px;border:1px solid #FFFFFF;"><center><?php echo ucfirst($clientData['Product']['name'])?></center></td>
							<td class="td-heigth" style="width:220px;border:1px solid #FFFFFF;">
								<center> 
									<?php if(!empty($drQuantity)){ ?>
											<?php echo $drQuantity ?> x
											<?php $totalQty = $clientData['QuotationItemDetail']['quantity'] * $drQuantity?>
									<?php }else{ ?>
											 <?php $totalQty = $clientData['QuotationItemDetail']['quantity'] * $drData['DeliveryDetail']['quantity']?>
											 <?php echo $drData['DeliveryDetail']['quantity']  ?> x
									 <?php } ?>
									<?php echo $clientData['QuotationItemDetail']['quantity']?> /
									<?php echo $units[$clientData['QuotationItemDetail']['quantity_unit_id']]?>
								</center>
							</td>
							<td class="td-heigth" style="width:130px;border:1px solid #FFFFFF;">
								<center>
									<?php echo $totalQty ?> /
									<?php echo $units[$clientData['QuotationItemDetail']['quantity_unit_id']]?>
								</center>
							</td>
						</tr>
					<?php //} ?>
				</thead>
			</table>
			<br><br><br><br><br>
			<br><br><br>
			<table class="table table-bordered" style="line-height:20px;padding-top:45px; font-family: Verdana , Geneva, sans-serif;">
				<thead>
					<tr>
						<td style="width:30px;"> </td>
						<td class="td-heigth " style="width:155px;border:1px solid #FFFFFF;"><center><?php echo ucfirst($prepared['User']['first_name'])?> <?php echo ucfirst($prepared['User']['last_name'])?></center></td>
						<td class="td-heigth" style="width:150px;border:1px solid #FFFFFF;"> </td>
						<td class="td-heigth" style="width:120px;border:1px solid #FFFFFF;text-align:left;"><center><?php echo ucfirst($approved['User']['first_name'])?> <?php echo ucfirst($approved['User']['last_name'])?></center></td>
						<td class="td-heigth" style="width:300px;border:1px solid #FFFFFF;"> </td>
					</tr>
				</thead>
			</table> 
		</div>
	</div>	
</div>