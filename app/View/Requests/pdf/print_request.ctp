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
			<center>
				
					<h4 style = "margin-bottom:0px;">KOU FU PACKAGING CORP.</h4>
					<label style = "margin-top:0px; font-size: 13px;">REQUEST PURCHASE ORDER SLIP</label>
				
			</center>
			<table style="border:2px solid black;border-collapse:collapse; table-layout: fixed;">
				<thead>
			
			
				<tr >
					<td align="center" style="border:1px  white-space: normal; width:150px;">DEPT: <?php echo $department ?> Dept. </td>
					<td align="right" style="width:175px;">DATE: <?php echo (new \DateTime())->format('d/m/Y') ?></td>
					<td align="center" style="width:200px align="right";" class ="pull-right"><>NO: RQ<?php echo $request['Request']['uuid'] ?></td>
					<td></td>
					
				</tr>
				
				</thead>
			
			</table>

			<table style=" border:1px solid black;border-collapse:collapse; margin-bottom:0px;">
			<tr>
				<td align = "center" ></td>
				<td align = "center">Item Description</td>
				<td style="border:1px solid black; width:100px">Qty./Unit</td>
				<td style="border:1px solid black; width:100px">Remarks</td>
			</tr>
			<tr>
				<td  align = "center" style="border:1px solid black; width:30px ">2</td>
				<td style="border:1px solid black; width:257px;">Table cell 2</td>
				<td style="border:1px solid black; width:100px">Table cell 2</td>
				<td style="border:1px solid black; width:150px"><?php echo $request['Request']['remarks'] ?></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black;  "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; "></td>
				<td style="border:1px solid black;"></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black;  "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black;  "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>
			
			</table>

			<table style=" margin-top:0px; border:1px solid black;border-collapse:collapse;">
			
			<tr>
				<td style=" width:20px "></td>
				
			</tr>

			<tr>
				<td  align = "left" style="width:541px "><?php echo $request['Request']['remarks'] ?></td>
			
			</tr>
			
			</table>

			<table style=" margin-top:0px; border:2px solid black;border-collapse: separate;
        border-spacing: 1px ">
			
			<tr>
				<td align = "left" style=" width:180px; vertical-align: text-top; height:30px; ">Prepared by:</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Approved by:</td>
				<td align = "left" style=" width:173px; vertical-align: text-top;">Purchased by:</td>
			</tr>

			<tr>
				<td align = "left" style=" width:30px; padding-right:3px; "><?php echo ucwords($preparedFullName ) ?></td>
				<td align = "left" >Shou Yi Yu</td>
				<td align = "left" ></td>
			</tr>
			
			</table>

			<table style=" margin-top:0px; border:1px solid black;border-collapse:collapse;">
			
			<tr>
				<td align = "left" style=" width:180px; vertical-align: text-top; ">Purchasing</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Dec. No:</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Rev No:</td>
			</tr>
			
			</table>

			<br>

			<center>
				
					<h4 style = "margin-bottom:0px;">KOU FU PACKAGING CORP.</h4>
					<label style = "margin-top:0px; font-size: 13px;">PURCHASE ORDER SLIP</label>
				
			</center>
			<table style="border:2px solid black;border-collapse:collapse;">
				<thead>
			
			
				<tr >
					<td align="center" style="border:1px solid black width:450px;">DEPT: <?php echo $department ?> Dept. </td>
					<td align="right" style="width:170px;">DATE: <?php echo (new \DateTime())->format('d/m/Y') ?></td>
					<td align="center" style="width:205px align="right";" class ="pull-right"><>NO: RQ<?php echo $request['Request']['uuid'] ?></td>
					<td></td>
					
				</tr>
				
				</thead>
			
			</table>

			<table style=" border:1px solid black;border-collapse:collapse; margin-bottom:0px;">
				<tr>
				<td align = "center" ></td>
				<td align = "center">Item Description</td>
				<td style="border:1px solid black; width:100px">Qty./Unit</td>
				<td style="border:1px solid black; width:100px">Remarks</td>
			</tr>
			<tr>
				<td  align = "center" style="border:1px solid black; width:30px ">2</td>
				<td style="border:1px solid black; width:257px;">Table cell 2</td>
				<td style="border:1px solid black; width:100px">Table cell 2</td>
				<td style="border:1px solid black; width:150px"><?php echo $request['Request']['remarks'] ?></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black;  "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; "></td>
				<td style="border:1px solid black;"></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black;  "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black;  "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
				<td style="border:1px solid black; "></td>
			</tr>
			
			</table>

			<table style=" margin-top:0px; border:1px solid black;border-collapse:collapse;">
			
			<tr>
				<td style=" width:20px "></td>
				
			</tr>

			<tr>
				<td  align = "left" style="width:541px "><?php echo $request['Request']['remarks'] ?></td>
			
			</tr>
			
			</table>

			<table style=" margin-top:0px; border:2px solid black;border-collapse: separate;
        border-spacing: 1px ">
			
			<tr>
				<td align = "left" style=" width:180px; vertical-align: text-top; height:30px; ">Prepared by:</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Approved by:</td>
				<td align = "left" style=" width:173px; vertical-align: text-top;">Purchased by:</td>
			</tr>

			<tr>
				<td align = "left" style=" width:30px; padding-right:3px; "><?php echo ucwords($preparedFullName ) ?></td>
				<td align = "left" >Shou Yi Yu</td>
				<td align = "left" ></td>
			</tr>
			
			</table>

			<table style=" margin-top:0px; border:1px solid black;border-collapse:collapse;">
			
			<tr>
				<td align = "left" style=" width:180px; vertical-align: text-top; ">Purchasing</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Dec. No:</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Rev No:</td>
			</tr>
			
			</table>




		</div>
	</div>	

</div>	


