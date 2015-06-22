<style>
<?php include('word.css'); ?>

</style>
<div class="row" style="background:url('http://localhost/koufunet/img/transmitta.jpg');background-size: 768px;
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
					
				</thead>
			</table>
			<table class="table table-bordered" style="width:0px; line-height:85px;">
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
									<?php echo $remainingQty ?> 
									<span style="width:1000px;border:1px solid #FFFFFF;"></span>
									
								</center>
							</td>
							<td class="td-heigth" style="width:100px;border:1px solid #FFFFFF;"> </td>
							<td class="td-heigth" style="width:270px;border:1px solid #FFFFFF;">
									/<?php echo $units[$clientData['QuotationItemDetail']['quantity_unit_id']]?>
							</td>
							<td class="td-heigth" style="width:270px;border:1px solid #FFFFFF;"> </td>
						</tr>
					<?php //} ?>
				</thead>
			</table>
			<br><br><br><br><br><br><br>
			<br><br><br><br>
			<table class="table table-bordered" style="line-height:40px; ">
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