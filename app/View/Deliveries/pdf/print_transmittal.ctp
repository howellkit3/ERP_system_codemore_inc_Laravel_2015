<style>
<?php include('word.css'); ?>

</style>
<div class="row" style="background:url('http://localhost/koufunet/img/transmittal.jpg');background-size: 768px;
  height: 100%;background-repeat:no-repeat;">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<table class="layout" style="line-height:5px;">
				<thead>
					<tr>
						<td style="width:550px;"> </td>
						<td style="width:360px;"> </td>
					</tr>
					
					<tr>
						<td style="width:550px;"> </td>
						<td style="width:360px;"> </td>
					</tr>
					<tr>
						<td style="width:550px;"> </td>
						<td style="width:360px;"><?php echo "" ;?></td>
					</tr>
				</thead>
			</table>
			<table class="layout" style="line-height:50px; width:430px;" >
				<thead >
					<tr >
						<td class="td-heigth" style="width:620px;border:1px solid #FFFFFF;"> </td>
						<td >
							<?php echo (new \DateTime())->format('m/d/Y');?>
						</td>
					</tr>
					<tr>
						
						<td style="width:80px;font-family: Calibri;"><b> </b></td>
						<td style="width:20px;"> </td>
						<td style="width:330px;">
							<?php echo ucfirst($companyData['Address'][0]['address1'])?>
						</td>
						<td>
							<?php echo ucfirst($companyData['Company']['tin'])?>
						</td>
					</tr>
				</thead>
			</table>
			<table class="table table-bordered" style="line-height:0px;">
				<thead>
					<tr>
						<td class="td-heigth" style="width:20px;border:1px solid #FFFFFF;"></td>
						<td class="td-heigth" style="width:140px;border:1px solid #FFFFFF;"><center><b> </b></center></td>
						<td class="td-heigth" style="width:280px;border:1px solid #FFFFFF;"><center><b> </b></center></td>
						<td class="td-heigth" style="width:180px;border:1px solid #FFFFFF;"><center><b> </b></center></td>
						<td class="td-heigth" style="width:110px;border:1px solid #FFFFFF;"><center><b> </b></center></td>
					</tr>
					<?php //foreach ($clientData['ClientOrderDeliverySchedule'] as $key => $scheduleList) { ?>
						<tr>
							<td class="td-heigth" style="width:10px;border:1px solid #FFFFFF;"> </td>
							<td class="td-heigth" style="width:70px;border:1px solid #FFFFFF; padding-right: 0px;"><center><?php echo ucfirst($clientData['Product']['name'])?></center></td>


							<td class="td-heigth" style="width:50px;border:1px solid #FFFFFF;">
								<center>
									<?php $totalQty = $clientData['QuotationItemDetail']['quantity'] * $drData['DeliveryDetail']['quantity']?>
									<?php echo $totalQty ?> /
									<?php echo $units[$clientData['QuotationItemDetail']['quantity_unit_id']]?>
								</center>
							</td>
						</tr>
					<?php //} ?>
				</thead>
			</table>
			<br><br><br><br><br><br><br>
			<br><br><br><br>
			<table class="table table-bordered" style="line-height:105px; ">
				<thead>
					<tr>
						<td class="td-heigth" style="width:110px;border:1px solid #FFFFFF;"> </td>
						<td class="td-heigth" style="width:115px;border:1px solid #FFFFFF;"><center><?php echo ucfirst($prepared['User']['first_name'])?> <?php echo ucfirst($prepared['User']['last_name'])?></center></td>
						<td class="td-heigth" style="width:120px;border:1px solid #FFFFFF;"> </td>
						<td class="td-heigth" style="width:115px;border:1px solid #FFFFFF;"><center><?php echo ucfirst($approved['User']['first_name'])?> <?php echo ucfirst($approved['User']['last_name'])?></center></td>
						<td class="td-heigth" style="width:300px;border:1px solid #FFFFFF;"> </td>
					</tr>
				</thead>
			</table> 
		</div>
	</div>	
</div>