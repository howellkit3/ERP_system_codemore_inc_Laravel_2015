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
							<img src="<?php echo Router::url('/', true) ?>img/koufu_logo.jpg" alt="logo" style="width:155px;height:20px;padding-bottom:10;">
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
							<td></td>
							<td></td>
							<td ></td>
							<td align="right" style="line-height:8px;"><span style="font-size:70%"; ><b>No: </b>RQ<?php echo $request['Request']['uuid'] ?><br><br><b>Date: </b><?php echo date('Y/m/d') ?></span></td>
						</tr>

					</tbody>
				</table>

				<table style=" border:1px solid black;border-collapse:collapse; margin-bottom:0px;  ">
					<tr>
						<td align = "center" style="border:1px solid black; width:10px; font-size:70%;" ><b>No.</b></td>
						<td align = "center" style =" width:180px; word-wrap: break-word;" ><b>Item Description</b></td>
						<td align = "center" style="border:1px solid black; width:20px; font-size:70%;"><b>Qty Needed</b></td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:70%;"><b>UOM</b></td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:60%;"><b>Current Stock</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>For Purchasing</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Date Needed</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Purpose</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Remarks</b></td>
					</tr>

					<?php $ctr = 8;

					foreach($requestItem as $key=>$value) { ?>

					<tr>
						<td  align = "center" style="border:1px solid black; width:10px;   word-wrap: break-word; "><span style="font-size:70%"; ><?php echo $key + 1 ?></span></td>

						<?php $lengthName = strlen($requestRequestItem[$key]['RequestItem']['name'])?>

						<?php if($lengthName >= 30 && $lengthName <= 70){ ?>

							<td style="border:1px solid black; "><span style="font-size:45%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
							</td>

						<?php } else if($lengthName >= 70) { ?>

							<td style="border:1px solid black; "><span style="font-size:40%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
							</td>

						<?php }else{ ?>

							<td style="border:1px solid black; "><span style="font-size:70%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
							</td>

						<?php } ?>

						<td align = "center"style="border:1px solid black; font-size:80% "><?php echo $value['RequestItem']['quantity'] ?></td>
						
						<td align = "center" style="border:1px solid black; font-size:70% "><?php echo $unitData[$value['RequestItem']['quantity_unit_id']]?></td>

						<td align = "center" style="border:1px solid black; font-size:80% "><?php ?></td>

						<td align = "center" style="border:1px solid black; font-size:80% "><?php ?></td>

						<td align = "center" style="border:1px solid black; font-size:50% "><?php echo date("Y-m-d", strtotime($value['RequestItem']['date_needed'])) ?></td>

						
						<?php

						 $lengthName = strlen($requestRequestItem[$key]['RequestItem']['purpose']);

						 if($lengthName >= 30 && $lengthName <= 70){ ?>

							<td style="border:1px solid black; width:50px"><span style="font-size:35%"; ><?php echo $value['RequestItem']['purpose'] ?></span>
							</td>

						<?php } else if($lengthName >= 70) { ?>

							<td style="border:1px solid black; width:50px"><span style="font-size:30%"; ><?php echo $value['RequestItem']['purpose'] ?></span>
							</td>

						<?php }else{ ?>

							<td style="border:1px solid black;width:50px"><span style="font-size:50%"; ><?php echo $value['RequestItem']['purpose'] ?></span>
							</td>

						<?php } ?>

						<td align ="center" style="border:1px solid black; word-wrap: break-word; font-size:50%; max-width:50px"><?php echo $value['RequestItem']['remarks'] ?></td>
						
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
						<td style="border:1px solid black; "></td>
					</tr>

					<?php } ?>
					
				</table>

					<br>

					<table style=" margin-top:0px; border:0px solid black;border-collapse: separate; border-spacing: 0px; padding:0px; margin:0px; line-height:0px; ">
					
					<tr>
						<td align = "left" style=" width:183px; vertical-align: text-top; height:25px; ">Requisitioner:</td>
						<td align = "left" style=" width:182px; vertical-align: text-top;">Approved by:</td>
						<td align = "left" style=" width:182px; vertical-align: text-top;">Purchased by:</td>
					</tr>

					<tr>
						<td align = "center" style=" width:183px; vertical-align: bottom; height:10px; margin:0px;"><?php echo ucwords($preparedFullName )?><br>____________________</td>
						<td align = "center" style=" width:183px; vertical-align: bottom; height:10px; margin:0px; "> 
							Ms. Carryl Yu
						<br>____________________</td>
						<td align = "center" style=" width:183px; vertical-align: bottom; height:15px;margin:0px; ">____________________<br></td>
					</tr>

					</table>
						
					<table style =" padding:0px; margin:0px;">
					<tr>
						<td align = "center" style="  vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%;"><br>PRINT NAME AND SIGN</td>
						<td align = "center" style="width:200px; vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%; color:white;">Un </td>
						<td align = "center" style=" vertical-align:text-top;margin:0px; font-size:60%; line-height:8px;"><br>PURCHASING PERSONNEL</td>
					</tr>

					<tr>
						<td align = "center" style="  vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%;"><br>*Unit of Measure(UOM)  could be <I>pcs, kgs, liter, MT </I></td>
						<td align = "center" style="width:200px; vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%; color:white;"><br><br>Un </td>
						<td align = "center" style=" vertical-align:text-top;margin:0px; font-size:60%; line-height:8px;"><br>KP-FR-LG1-001 R0 <br>Effective Date: 10 Aug 2015</td>
					</tr>
				</table>
					
				</div>

				<div style = "height: 48%; margin-top: 10px;">
					<table>
					<tr>
						<td>
							<img src="<?php echo Router::url('/', true) ?>img/koufu_logo.jpg" alt="logo" style="width:155px;height:20px;padding-bottom:10;">
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
									<td></td>
									<td></td>
									<td ></td>
									<td align="right" style="line-height:8px;"><span style="font-size:70%"; ><b>No: </b>RQ<?php echo $request['Request']['uuid'] ?><br><br><b>Date: </b><?php echo date('Y/m/d') ?></span></td>
								</tr>

							</tbody>
						</table>

					<table style=" border:1px solid black;border-collapse:collapse; margin-bottom:0px;  ">
					<tr>
						<td align = "center" style="border:1px solid black; width:10px; font-size:70%;" ><b>No.</b></td>
						<td align = "center" style =" width:180px; word-wrap: break-word;" ><b>Item Description</b></td>
						<td align = "center" style="border:1px solid black; width:20px; font-size:70%;"><b>Qty Needed</b></td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:70%;"><b>UOM</b></td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:60%;"><b>Current Stock</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>For Purchasing</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Date Needed</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Purpose</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Remarks</b></td>
					</tr>

					<?php $ctr = 8;

					foreach($requestItem as $key=>$value) { ?>

					<tr>
						<td  align = "center" style="border:1px solid black; width:10px;   word-wrap: break-word; "><span style="font-size:70%"; ><?php echo $key + 1 ?></span></td>

						<?php $lengthName = strlen($requestRequestItem[$key]['RequestItem']['name'])?>

						<?php if($lengthName >= 30 && $lengthName <= 70){ ?>

							<td style="border:1px solid black; "><span style="font-size:45%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
							</td>

						<?php } else if($lengthName >= 70) { ?>

							<td style="border:1px solid black; "><span style="font-size:40%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
							</td>

						<?php }else{ ?>

							<td style="border:1px solid black; "><span style="font-size:70%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
							</td>

						<?php } ?>

						<td align = "center"style="border:1px solid black; font-size:80% "><?php echo $value['RequestItem']['quantity'] ?></td>
						
						<td align = "center" style="border:1px solid black; font-size:70% "><?php echo $unitData[$value['RequestItem']['quantity_unit_id']]?></td>

						<td align = "center" style="border:1px solid black; font-size:80% "><?php ?></td>

						<td align = "center" style="border:1px solid black; font-size:80% "><?php ?></td>

						<td align = "center" style="border:1px solid black; font-size:50% "><?php echo date("Y-m-d", strtotime($value['RequestItem']['date_needed'])) ?></td>

					

						
						<?php

						 $lengthName = strlen($requestRequestItem[$key]['RequestItem']['purpose']);

						 if($lengthName >= 30 && $lengthName <= 70){ ?>

							<td style="border:1px solid black; width:50px"><span style="font-size:35%"; ><?php echo $value['RequestItem']['purpose'] ?></span>
							</td>

						<?php } else if($lengthName >= 70) { ?>

							<td style="border:1px solid black; width:50px"><span style="font-size:30%"; ><?php echo $value['RequestItem']['purpose'] ?></span>
							</td>

						<?php }else{ ?>

							<td style="border:1px solid black;width:50px"><span style="font-size:50%"; ><?php echo $value['RequestItem']['purpose'] ?></span>
							</td>

						<?php } ?>

						<td align ="center" style="border:1px solid black; word-wrap: break-word; font-size:50%"><?php echo $value['RequestItem']['remarks'] ?></td>	
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
						<td style="border:1px solid black; "></td>
					</tr>

					<?php } ?>
					
					</table>

					<br>

					<table style=" margin-top:0px; border:0px solid black;border-collapse: separate; border-spacing: 0px; padding:0px; margin:0px; line-height:0px; ">
					
					<tr>
						<td align = "left" style=" width:183px; vertical-align: text-top; height:25px; ">Requisitioner:</td>
						<td align = "left" style=" width:182px; vertical-align: text-top;">Approved by:</td>
						<td align = "left" style=" width:182px; vertical-align: text-top;">Purchased by:</td>
					</tr>

					<tr>
						<td align = "center" style=" width:183px; vertical-align: bottom; height:10px; margin:0px;"><?php echo ucwords($preparedFullName )?><br>____________________</td>
						<td align = "center" style=" width:183px; vertical-align: bottom; height:10px; margin:0px; ">
							Ms. Carryl Yu <br>____________________</td>
						<td align = "center" style=" width:183px; vertical-align: bottom; height:15px;margin:0px; ">____________________<br></td>
					</tr>

					</table>
						
					<table style =" padding:0px; margin:0px;">
					<tr>
						<td align = "center" style="  vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%;"><br>PRINT NAME AND SIGN</td>
						<td align = "center" style="width:200px; vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%; color:white;">Un </td>
						<td align = "center" style=" vertical-align:text-top;margin:0px; font-size:60%; line-height:8px;"><br>PURCHASING PERSONNEL</td>
					</tr>

					<tr>
						<td align = "center" style="  vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%;"><br>*Unit of Measure(UOM)  could be <I>pcs, kgs, liter, MT </I></td>
						<td align = "center" style="width:200px; vertical-align: text-top;; margin:0px; line-height:10px;font-size:60%; color:white;"><br><br>Un </td>
						<td align = "center" style=" vertical-align:text-top;margin:0px; font-size:60%; line-height:8px;"><br>KP-FR-LG1-001 R0 <br>Effective Date: 10 Aug 2015</td>
					</tr>
				</table>
					
				</div>

				
			</div>
	</div>	
</div>	



