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
				
					<h3 style = "margin-bottom:0px;">KOU FU PACKAGING CORP.</h3>
					<label style = "margin-top:0px; font-size: 15px;">REQUEST PURCHASE ORDER SLIP</label>
				
			</center>
			<table style="border:2px solid black;border-collapse:collapse;">
				<thead>
			
			
				<tr >
					<td align="center" style="border:1px solid black width:350px;">DEPT: Purchasing Department </td>
					<td align="right" style="width:200px;">DATE: <?php echo (new \DateTime())->format('d/m/Y') ?></td>
					<td align="center" style="width:150px align="right";" class ="pull-right"><>NO: RQ<?php echo $request['Request']['uuid'] ?></td>
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
				<td style="border:1px solid black; width:307px;">Table cell 2</td>
				<td style="border:1px solid black; width:100px">Table cell 2</td>
				<td style="border:1px solid black; width:100px">asd</td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>
			
			</table>

			<table style=" margin-top:0px; border:1px solid black;border-collapse:collapse;">
			
			<tr>
				<td style=" width:25px "></td>
				
			</tr>

			<tr>
				<td  align = "left" style="width:541px ">For RJN-204</td>
			
			</tr>
			
			</table>

			<table style=" margin-top:0px; border:2px solid black;border-collapse:collapse;">
			
			<tr>
				<td align = "left" style=" width:180px; vertical-align: text-top; height:30px; ">Prepared by:</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Approved by:</td>
				<td align = "left" style=" width:180px; vertical-align: text-top;">Purchased by:</td>
			</tr>

			<tr>
				<td align = "center" style=" width:30px "><?php echo $preparedFullName ?></td>
				<td align = "center" style=" width:307px;"></td>
				<td align = "center" style=" width:100px"></td>
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
				
					<h3 style = "margin-bottom:0px;">KOU FU PACKAGING CORP.</h3>
					<label style = "margin-top:0px; font-size: 15px;">PURCHASE ORDER SLIP</label>
				
			</center>
			<table style="border:2px solid black;border-collapse:collapse;">
				<thead>
			
			
				<tr >
					<td align="center" style="border:1px solid black width:350px;">DEPT: Purchasing Department </td>
					<td align="right" style="width:200px;">DATE: <?php echo (new \DateTime())->format('d/m/Y') ?></td>
					<td align="center" style="width:150px align="right";" class ="pull-right"><>NO: <?php echo $request['Request']['uuid'] ?></td>
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
				<td style="border:1px solid black; width:307px;">Table cell 2</td>
				<td style="border:1px solid black; width:100px">Table cell 2</td>
				<td style="border:1px solid black; width:100px">asd</td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>

			<tr>
				<td  align = "center" style="border:1px solid black; width:30px "></td>
				<td style="border:1px solid black; width:307px;"></td>
				<td style="border:1px solid black; width:100px"></td>
				<td style="border:1px solid black; width:100px"></td>
			</tr>
			
			</table>

			<table style=" margin-top:0px; border:1px solid black;border-collapse:collapse;">
			
			<tr>
				<td style=" width:25px "></td>
				
			</tr>

			<tr>
				<td  align = "left" style="width:541px ">For RJN-204</td>
			
			</tr>
			
			</table>

			<table style=" margin-top:0px; border:2px solid black;border-collapse:collapse;">
			
			<tr>
				<td align = "left" style=" width:180px; vertical-align: text-top; height:30px; ">Prepared by:</td>
				<td align = "left" style=" width:181px; vertical-align: text-top;">Approved by:</td>
				<td align = "left" style=" width:180px; vertical-align: text-top;">Purchased by:</td>
			</tr>

			<tr>
				<td align = "center" style=" width:30px "><?php echo $preparedFullName ?></td>
				<td align = "center" style=" width:307px;"></td>
				<td align = "center" style=" width:100px"></td>
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


