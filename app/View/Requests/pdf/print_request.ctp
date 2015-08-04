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

			for ($i = $ctrTable; $i >= 1; $i--) { ?>

			<center>
				
					<h4 style = "margin-bottom:0px;">KOU FU PACKAGING CORP.</h4>
					<label style = "margin-top:0px; font-size: 13px;">REQUEST PURCHASE ORDER SLIP</label>
				
			</center>
			<table  style="border:2px solid black;border-collapse:collapse; table-layout: fixed; width: 567;line-height: 0px; padding:0px; ">

			<thead style= "">

				<tr >
					<td align="center" style="  border:1px solid black width:450px; height="0""></td>
					<td align="right" style="width:170px; height="0""></td>
					<td align="center" style="width:205px; height="0"; align="right";" class ="pull-right"><> </td>
					<td></td>
					
				</tr>

			</thead>
			
				<tr >
					<td align="center" style="">DEPT: <?php echo $department ?> Dept. </td>
					<td align="right" >DATE: <?php echo (new \DateTime())->format('d/m/Y') ?></td>
					<td align="center" style=" align="right";" class ="pull-right"><>NO: RQ<?php echo $request['Request']['uuid'] ?></td>
					<td></td>
					
				</tr>

			</table>

			<table style=" border:1px solid black;border-collapse:collapse; margin-bottom:0px; ">
			<tr>
				<td align = "center" ></td>
				<td align = "center" style =" width:266px; word-wrap: break-word;" >Item Description</td>
				<td style="border:1px solid black; width:100px">Qty./Unit</td>
				<td style="border:1px solid black; width:150px">Remarks</td>
			</tr>

			<?php $ctr = 8;

			foreach($requestItem as $key=>$value) { ?>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px;   word-wrap: break-word; "><?php echo $key + 1 ?></td>

				<?php $lengthName = strlen($requestRequestItem[$key]['RequestItem']['name'])?>

				<?php if($lengthName >= 35 && $lengthName <= 70){ ?>

					<td style="border:1px solid black; "><span style="font-size:80%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
					</td>

				<?php } else if($lengthName >= 70) { ?>

					<td style="border:1px solid black; "><span style="font-size:65%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
					</td>

				<?php }else{ ?>

					<td style="border:1px solid black; "><span style="font-size:100%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
					</td>

				<?php } ?>

				<td style="border:1px solid black;  "><?php echo $value['RequestItem']['quantity'] . ' ' . $unitData[$value['RequestItem']['quantity_unit_id']]?></td>
				

				<?php $lengthRemarks = strlen($request['Request']['remarks'])?>

				<?php if($lengthRemarks >= 35 && $lengthRemarks <= 70){ ?>
					<td style="border:1px solid black; word-wrap: break-word; font-size:65%"><?php echo $request['Request']['remarks'] ?></td>
				<?php 
					}else{ ?>
					<td style="border:1px solid black; word-wrap: break-word; font-size:65%"><?php echo $request['Request']['remarks'] ?></td>
				<?php } ?>	
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
			</tr>

			<?php } ?>
			
			</table>

			<table style="height:4px; margin-top:0px; border:1px solid black;border-collapse:collapse;">
			
				<tr>
					<td style=" height:1px; width:20px "></td>
					
				</tr>

				<tr> 
					<td  align = "left" style=" width:548px "><?php echo $request['Request']['remarks'] ?></td>
				</tr>
			
			</table>

			<table style=" margin-top:0px; border:2px solid black;border-collapse: separate; border-spacing: 1px ">
			
			<tr>
				<td align = "left" style=" width:180px; vertical-align: text-top; height:25px; ">Prepared by:</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Approved by:</td>
				<td align = "left" style=" width:180px; vertical-align: text-top;">Purchased by:</td>
			</tr>

			<tr>
				<td align = "left" style=" width:30px; padding-right:3px; "><?php echo ucwords($preparedFullName ) ?></td>
				<td align = "left" >Shou Yi Yu</td>
				<td align = "left" ></td>
			</tr>
			
			</table>

			<table style="margin-top:0px; border:1px solid black;border-collapse:collapse;">
			
			<tr>
				<td align = "left" style=" width:182px; vertical-align: text-top; ">Purchasing</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Dec. No:</td>
				<td align = "left" style=" width:185px; vertical-align: text-top;">Rev No:</td>
			</tr>
			
			</table>

			<br>
			<?php } ?>

			
			<center>
				
					<h4 style = "margin-bottom:0px;">KOU FU PACKAGING CORP.</h4>
					<label style = "margin-top:0px; font-size: 13px;">PURCHASE ORDER SLIP</label>
				
			</center>
			<table  style="border:2px solid black;border-collapse:collapse; table-layout: fixed; width: 567;line-height: 0px; padding:0px; ">
				<thead style= "">

				<tr >
					<td align="center" style="  border:1px solid black width:450px; height="0""></td>
					<td align="right" style="width:170px; height="0""></td>
					<td align="center" style="width:205px; height="0"; align="right";" class ="pull-right"><> </td>
					<td></td>
					
				</tr>

			</thead>
			
				<tr >
					<td align="center" style="">DEPT: <?php echo $department ?> Dept. </td>
					<td align="right" >DATE: <?php echo (new \DateTime())->format('d/m/Y') ?></td>
					<td align="center" style=" align="right";" class ="pull-right"><>NO: RQ<?php echo $request['Request']['uuid'] ?></td>
					<td></td>
					
				</tr>
			</table>

			<table style=" border:1px solid black;border-collapse:collapse; margin-bottom:0px;">
			<tr>
				<td align = "center" ></td>
				<td align = "center" style =" width:266px; word-wrap: break-word;" >Item Description</td>
				<td style="border:1px solid black; width:100px">Qty./Unit</td>
				<td style="border:1px solid black; width:150px">Remarks</td>
			</tr>

			<?php $ctr = 8;

			foreach($requestItem as $key=>$value) { ?>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px;   word-wrap: break-word; "><?php echo $key + 1 ?></td>

				<?php $lengthName = strlen($requestRequestItem[$key]['RequestItem']['name'])?>

				<?php if($lengthName >= 35 && $lengthName <= 70){ ?>

					<td style="border:1px solid black; "><span style="font-size:80%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
					</td>

				<?php } else if($lengthName >= 70) { ?>

					<td style="border:1px solid black; "><span style="font-size:65%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
					</td>

				<?php }else{ ?>

					<td style="border:1px solid black; "><span style="font-size:100%"; ><?php echo $requestRequestItem[$key]['RequestItem']['name']?></span>
					</td>

				<?php } ?>

				<td style="border:1px solid black;  "><?php echo $value['RequestItem']['quantity'] . ' ' . $unitData[$value['RequestItem']['quantity_unit_id']]?></td>
				

				<?php $lengthRemarks = strlen($request['Request']['remarks'])?>

				<?php if($lengthRemarks >= 35 && $lengthRemarks <= 70){ ?>
					<td style="border:1px solid black; word-wrap: break-word; font-size:65%"><?php echo $request['Request']['remarks'] ?></td>
				<?php 
					}else{ ?>
					<td style="border:1px solid black; word-wrap: break-word; font-size:100%"><?php echo $request['Request']['remarks'] ?></td>
				<?php } ?>	
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
			</tr>

			<?php } ?>
			
			</table>

			<table style="height:4px; margin-top:0px; border:1px solid black;border-collapse:collapse;">
			
				<tr>
					<td style=" height:1px; width:20px "></td>
					
				</tr>

				<tr>
					<td  align = "left" style="width:548px "><?php echo $request['Request']['remarks'] ?></td>
				
				</tr>
			
			</table>

			<table style=" margin-top:0px; border:2px solid black;border-collapse: separate; border-spacing: 1px ">
			
			<tr>
				<td align = "left" style=" width:182px; vertical-align: text-top; height:25px; ">Prepared by:</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Approved by:</td>
				<td align = "left" style=" width:178px; vertical-align: text-top;">Purchased by:</td>
			</tr>

			<tr>
				<td align = "left" style=" width:30px; padding-right:3px; "><?php echo ucwords($preparedFullName ) ?></td>
				<td align = "left" >Shou Yi Yu</td>
				<td align = "left" ></td>
			</tr>
			
			</table>

			<table style=" margin-top:0px; border:1px solid black;border-collapse:collapse;">
			
			<tr>
				<td align = "left" style=" width:182px; vertical-align: text-top; ">Purchasing</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Dec. No:</td>
				<td align = "left" style=" width:185px; vertical-align: text-top;">Rev No:</td>
			</tr>
			
			</table>

		</div>
	</div>	

</div>	



