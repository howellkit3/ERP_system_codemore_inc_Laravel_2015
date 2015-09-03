<!DOCTYPE html>
<style>
<?php include('word.css'); ?>

table {
    border-collapse: collapse;
}
th, td {
    padding: 0; height:20px; width: 90%;  ;
}

</style> 
			
<div class="row" style="background:url('http://localhost/koufu_system/img/pr.pngs');background-size: 768px;
  height: 100%;background-repeat:no-repeat;">
	<div class="col-lg-12">
		<div class="main-box main-pdf"  >
				<?php $ctrTable = 2; 
					  $txtHolder = " ";?>
				
				<div style = "height: 48% ">
				<table>
					<tr>
						<td>
							<img src="<?php echo Router::url('/', true) ?>img/koufu_logo.jpg" alt="logo" style="width:165px;height:30px;padding-bottom:10;">
						</td>
					<td>
						<center>
							<h4 style = "margin-bottom:0px; margin-top:0px; padding-top:0px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PURCHASE REQUISITION</h4>
						</center>
					</td>
					</tr>

				</table>	

				<table border="0" width="100%" style = "margin:0px; padding:0px; line-height:0px;">
					<tbody>
					
						<tr>
							<td align="left" style="line-height:8px;"><span style="font-size:70%"; ><B>Department: <?php echo $roleName ?> </B></td>
							<td></td>
							<td ></td>
							<td align="right" style="line-height:8px;"><span style="font-size:70%"; ><b>No: </b>RQ<?php echo $request['WarehouseRequest']['uuid'] ?><br><br><b>Date: </b><?php echo (new \DateTime())->format('d/m/Y') ?></span></td>
						</tr>

					</tbody>
				</table>

				<table style=" border:1px solid black;border-collapse:collapse; margin-bottom:0px;  ">
					<tr>
						<td align = "center" style="border:1px solid black; width:10px; font-size:70%;" ><b>No.</b></td>
						<td align = "center" style =" width:230px; word-wrap: break-word;" ><b>Item Description</b></td>
						<td align = "center" style="border:1px solid black; width:20px; font-size:70%;"><b>Qty Needed</b></td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:70%;"><b>UOM</b></td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:60%;"><b>Current Stock</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Date Needed</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Purpose</b></td>
						<td align = "center" style="border:1px solid black; width:60px; font-size:60%;"><b>Remarks</b></td>
					</tr>

					<?php $ctr = 8;

					foreach($request['WarehouseRequestItem'] as $key=>$value) {  ?>

					<tr>
						<td  align = "center" style="border:1px solid black; width:10px;   word-wrap: break-word; "><span style="font-size:70%"; ><?php echo $key + 1 ?></span></td>

						<?php $lengthName = strlen($value['name'])?>

						<?php if($lengthName >= 30 && $lengthName <= 70){ ?>

							<td style="border:1px solid black; "><span style="font-size:45%"; ><?php echo $value['name']?></span>
							</td>

						<?php } else if($lengthName >= 70) { ?>

							<td style="border:1px solid black; "><span style="font-size:40%"; ><?php echo $value['name']?></span>
							</td>

						<?php }else{ ?>

							<td style="border:1px solid black; "><span style="font-size:70%"; ><?php echo $value['name']?></span>
							</td>

						<?php } ?>

						<td align = "center"style="border:1px solid black; font-size:80% "><?php echo $value['quantity'] ?></td>
						
						<td align = "center" style="border:1px solid black; font-size:70% "><?php echo $unitData[$value['quantity_unit_id']]?></td>

						<td align = "center" style="border:1px solid black; font-size:80% "><?php echo empty($value['stock_quantity']) ? 0 : $value['stock_quantity'];?></td>

						<td align = "center" style="border:1px solid black; font-size:40% "><?php ?><?php echo date('M d, Y', strtotime($value['date_needed'])) ?></td>

						<td align = "center" style="border:1px solid black; font-size:40% "><?php ?><?php echo $value['purpose'] ?></td>

						<td align ="center" style="border:1px solid black; word-wrap: break-word; font-size:50%"><?php echo $value['remarks'] ?></td>
					
					</tr>

					<?php 

					$ctr--;

					}

					for ($i = $ctr; $i >= 1; $i--) { ?>
		   			 
					<tr>
						<td align = "center" style="border:1px solid black;  "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
					</tr>

					<?php } ?>
					
				</table>

					<br>

					<table style="width:100%; margin-top:0px; border:0px solid black;border-collapse: separate; border-spacing: 0px; padding:0px; margin:0px; line-height:0px; ">
					
					<tr>
						<td align = "left" style=" width:20%; vertical-align: text-top; height:25px; ">Requested by:</td>
						<td align = "left" style=" width:20%; vertical-align: text-top;">Approved by:</td>
						<td align = "left" style=" width:20%; vertical-align: text-top;">Issued by:</td>
						<td align = "left" style=" width:20%; vertical-align: text-top;">Received by:</td>
					</tr>

					<tr>
						<td align = "center" style=" width:20%; vertical-align: bottom; height:10px; margin:0px;"><?php echo ucwords($preparedFullName )?><br>_______________</td>
						<td align = "center" style=" width:20%; vertical-align: bottom; height:10px; margin:0px; ">Carryll Yu <br>_______________</td>
						<td align = "center" style=" width:20%; vertical-align: bottom; height:15px;margin:0px; ">_______________<br></td>
						<td align = "center" style=" width:20%; vertical-align: bottom; height:15px;margin:0px; ">_______________<br></td>
					</tr>

					</table>
						
					<table style =" padding:0px; margin:0px;">
					<tr>
						<td align = "left" style="vertical-align: text-top; line-height:10px;font-size:60%;"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRINT NAME AND SIGN</td>
						<td align = "center" style="vertical-align: text-top; line-height:10px;font-size:60%;"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Warehouse In-charge</td>
						<td align = "center" style=" vertical-align:text-top;margin:0px; font-size:60%; line-height:8px;"><br></td>
						
						
						<td> </td>
					</tr>

					<tr>
						<td align = "center" style="  vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%;"><br>*Unit of Measure(UOM)  could be <I>pcs, kgs, liter, MT </I></td>
						<td align = "center" style="width:200px; vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%; color:white;"><br><br>Un </td>
						<td align = "center" style=" vertical-align:text-top;margin:0px; font-size:60%; line-height:8px;"><br>KP-FR-LG1-001 R0 <br>Effective Date: 10 Aug 2015</td>
						<td></td>
					</tr>
				</table>
					
				</div>

				<div style = "height: 48% ">
				<table>
					<tr>
						<td>
							<img src="<?php echo Router::url('/', true) ?>img/koufu_logo.jpg" alt="logo" style="width:165px;height:30px;padding-bottom:10;">
						</td>
					<td>
						<center>
							<h4 style = "margin-bottom:0px; margin-top:0px; padding-top:0px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PURCHASE REQUISITION</h4>
						</center>
					</td>
					</tr>

				</table>	

				<table border="0" width="100%" style = "margin:0px; padding:0px; line-height:0px;">
					<tbody>
					
						<tr>
							<td align="left" style="line-height:8px;"><span style="font-size:70%"; ><B>Department: <?php echo $roleName ?> </B></td>
							<td></td>
							<td ></td>
							<td align="right" style="line-height:8px;"><span style="font-size:70%"; ><b>No: </b>RQ<?php echo $request['WarehouseRequest']['uuid'] ?><br><br><b>Date: </b><?php echo (new \DateTime())->format('d/m/Y') ?></span></td>
						</tr>

					</tbody>
				</table>

				<table style=" border:1px solid black;border-collapse:collapse; margin-bottom:0px;  ">
					<tr>
						<td align = "center" style="border:1px solid black; width:10px; font-size:70%;" ><b>No.</b></td>
						<td align = "center" style =" width:230px; word-wrap: break-word;" ><b>Item Description</b></td>
						<td align = "center" style="border:1px solid black; width:20px; font-size:70%;"><b>Qty Needed</b></td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:70%;"><b>UOM</b></td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:60%;"><b>Current Stock</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Date Needed</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Purpose</b></td>
						<td align = "center" style="border:1px solid black; width:60px; font-size:60%;"><b>Remarks</b></td>
					</tr>

					<?php $ctr = 8;

					foreach($request['WarehouseRequestItem'] as $key=>$value) {  ?>

					<tr>
						<td  align = "center" style="border:1px solid black; width:10px;   word-wrap: break-word; "><span style="font-size:70%"; ><?php echo $key + 1 ?></span></td>

						<?php $lengthName = strlen($value['name'])?>

						<?php if($lengthName >= 30 && $lengthName <= 70){ ?>

							<td style="border:1px solid black; "><span style="font-size:45%"; ><?php echo $value['name']?></span>
							</td>

						<?php } else if($lengthName >= 70) { ?>

							<td style="border:1px solid black; "><span style="font-size:40%"; ><?php echo $value['name']?></span>
							</td>

						<?php }else{ ?>

							<td style="border:1px solid black; "><span style="font-size:70%"; ><?php echo $value['name']?></span>
							</td>

						<?php } ?>

						<td align = "center"style="border:1px solid black; font-size:80% "><?php echo $value['quantity'] ?></td>
						
						<td align = "center" style="border:1px solid black; font-size:70% "><?php echo $unitData[$value['quantity_unit_id']]?></td>

						<td align = "center" style="border:1px solid black; font-size:80% "><?php ?><?php echo empty($value['stock_quantity']) ? 0 : $value['stock_quantity'];?></td>

						<td align = "center" style="border:1px solid black; font-size:40% "><?php ?><?php echo date('M d, Y', strtotime($value['date_needed'])) ?></td>

						<td align = "center" style="border:1px solid black; font-size:40% "><?php ?><?php echo $value['purpose'] ?></td>

						<td align ="center" style="border:1px solid black; word-wrap: break-word; font-size:50%"><?php echo $value['remarks'] ?></td>
					</tr>

					<?php 

					$ctr--;

					}

					for ($i = $ctr; $i >= 1; $i--) { ?>
		   			 
					<tr>
						<td align = "center" style="border:1px solid black;  "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
						<td style="border:1px solid black; "></td>
					</tr>

					<?php } ?>
					
				</table>

					<br>

					<table style="width:100%; margin-top:0px; border:0px solid black;border-collapse: separate; border-spacing: 0px; padding:0px; margin:0px; line-height:0px; ">
					
					<tr>
						<td align = "left" style=" width:20%; vertical-align: text-top; height:25px; ">Requested by:</td>
						<td align = "left" style=" width:20%; vertical-align: text-top;">Approved by:</td>
						<td align = "left" style=" width:20%; vertical-align: text-top;">Issued by:</td>
						<td align = "left" style=" width:20%; vertical-align: text-top;">Received by:</td>
					</tr>

					<tr>
						<td align = "center" style=" width:20%; vertical-align: bottom; height:10px; margin:0px;"><?php echo ucwords($preparedFullName )?><br>_______________</td>
						<td align = "center" style=" width:20%; vertical-align: bottom; height:10px; margin:0px; ">Carryll Yu <br>_______________</td>
						<td align = "center" style=" width:20%; vertical-align: bottom; height:15px;margin:0px; ">_______________<br></td>
						<td align = "center" style=" width:20%; vertical-align: bottom; height:15px;margin:0px; ">_______________<br></td>
					</tr>

					</table>
						
					<table style =" padding:0px; margin:0px;">
					<tr>
						<td align = "left" style="vertical-align: text-top; line-height:10px;font-size:60%;"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRINT NAME AND SIGN</td>
						<td align = "center" style="vertical-align: text-top; line-height:10px;font-size:60%;"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Warehouse In-charge</td>
						<td align = "center" style=" vertical-align:text-top;margin:0px; font-size:60%; line-height:8px;"><br></td>
						
						
						<td> </td>
					</tr>

					<tr>
						<td align = "center" style="  vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%;"><br>*Unit of Measure(UOM)  could be <I>pcs, kgs, liter, MT </I></td>
						<td align = "center" style="width:200px; vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%; color:white;"><br><br>Un </td>
						<td align = "center" style=" vertical-align:text-top;margin:0px; font-size:60%; line-height:8px;"><br>KP-FR-LG1-001 R0 <br>Effective Date: 10 Aug 2015</td>
						<td></td>
					</tr>
				</table>
					
				</div>
			</div>
	</div>	
</div>	



