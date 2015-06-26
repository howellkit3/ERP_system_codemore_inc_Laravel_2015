<style>
<?php include('word.css'); ?>

</style>
<div class="row" style="background:url('http://localhost/koufu_system/img/transmittal.jpgss');background-size: 768px;
  height: 100%;background-repeat:no-repeat;">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<table class="layout" style="line-height:0px; font-family: Verdana , Geneva, sans-serif;">
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

			<table class="layout" style="line-height:50px; width:430px; font-family: Verdana , Geneva, sans-serif;" >
				<thead >
					<tr >
						<td class="td-heigth" style="width:620px;border:1px solid #FFFFFF;"> </td>
						<td >
							<?php echo (new \DateTime())->format('m/d/Y');?>
						</td>
					</tr>
					
				</thead>
			</table>

			<table class="layout" style="line-height:-10px; width:900px; font-family: Verdana , Geneva, sans-serif;" >
				<thead >
					<tr >
						<td class="td-heigth" style="width:25px;border:1px solid #FFF;"> </td>
						<td >
							<?php echo $contactPerson;?>
						</td>
					</tr>
					
				</thead>
			</table>

			<table class="table table-bordered" style="width:0px; line-height:62px; font-family: Verdana , Geneva, sans-serif;">
				<thead>
					<tr>
						<td class="td-heigth" style="width:20px;border:1px solid #FFFFFF;"></td>
						<td class="td-heigth" style="width:110px;border:1px solid #FFFFFF;"><center><b> </b></center></td>
					</tr>
					<?php  ?>
						<tr>
							<td class="td-heigth" style="width:20px;border:1px solid #FFFFFF;"> </td>
							<td class="td-heigth" style="width:70px;border:1px solid #FFFFFF; padding-right: 0px;"><center><?php echo ucfirst($clientData['Product']['name'])?></center></td>
							<td class="td-heigth" style="width:270px;border:1px solid #FFFFFF;"> </td>
							<td class="td-heigth" style="width:50px;border:1px solid #FFFFFF;">
								<center>
									<?php  $remainingQty = $drData['DeliveryDetail']['quantity'] - $drData['DeliveryDetail']['delivered_quantity']?>
									<?php echo $quantityTransmittal ?> 
									<span style="width:1000px;border:1px solid #FFFFFF;"></span>
									
								</center>
							</td>
							<td class="td-heigth" style="width:100px;border:1px solid #FFFFFF;"> </td>
							<td class="td-heigth" style="width:100px;border:1px solid #FFFFFF;">
									/<?php echo $units[$clientData['QuotationItemDetail']['quantity_unit_id']]?>
							</td>
							<td class="td-heigth" style="width:20px;border:1px solid #FFFFFF;">
									<?php echo $remarks?>
							</td>
							<td class="td-heigth" style="width:270px;border:1px solid #FFFFFF;"> </td>
						</tr>
					<?php //} ?>
				</thead>
			</table>
			<br><br><br><br><br><br><br>
			<br><br><br><br>
			<table class="table table-bordered" style="line-height:40px; font-family: Verdana , Geneva, sans-serif;">
				<thead>
					<tr>
						<td class="td-heigth" style="width:20px;border:1px solid #FFFFFF;"> </td>
						<td class="td-heigth" style="width:290px;border:1px solid #FFFFFF;"><center><?php echo ucfirst($prepared['User']['first_name'])?> <?php echo ucfirst($prepared['User']['last_name'])?></center></td>
						<td class="td-heigth" style="width:210px;border:1px solid #FFFFFF;"><center><?php echo ucfirst($approved['User']['first_name'])?> <?php echo ucfirst($approved['User']['last_name'])?></center></td>
						<td class="td-heigth" style="width:300px;border:1px solid #FFFFFF;"> </td>
					</tr>
				</thead>
			</table> 
		</div>
	</div>	
</div>