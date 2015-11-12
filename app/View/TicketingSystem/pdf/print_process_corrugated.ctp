<?php
// header("Content-disposition: attachment; filename="'this.pdf');
// header("Content-type: application/pdf");

Configure::write('debug',0);
?>
<style>
<?php include('word.css'); ?>

</style>

<html>
<head>
	<title>Print Process</title>
</head>
<body style="font-family:sans-serif;">	

<div class="large-padding">
		<table class="full-width" style="font-family:sans-serif;">
				<tr>
					<td><h2>Koufu Packaging Corp.</h2> </td>
				</tr>	
				<tr>
					<td><strong> Single Face Job Ticket</strong></td>
					<td class="text-right">
						<label class="strong">Date</label>
						<?php echo date('Y/m/d'); ?>
					</td>
				</tr>				
		</table>
		<br>

		<?php $outs = floatval($part['ProductSpecificationPart']['outs1']) * floatval($part['ProductSpecificationPart']['outs2']);
        ?>

			<table class="full-width border" style="font-family:sans-serif;">
				<tr>
					<td>
						<strong>CUSTOMER</strong> &nbsp;&nbsp; <?php echo !empty($companyData[$productData['Product']['company_id']]) ? ucwords($companyData[$productData['Product']['company_id']]) : '';  ?>
					</td>
					<td class="text-right">
						<strong>SCHED No</strong>&nbsp;&nbsp; <?php  echo $ticketUuid; ?>
					</td>
					
				</tr>
				<tr>
					<td>
						<strong>ITEM</strong>&nbsp;&nbsp; <?php echo $productData['Product']['name']; ?>
					</td>
					<td class="text-right">
						<strong>DESCRIPTION</strong>&nbsp;&nbsp; <?php echo $productData['Product']['remarks']  ?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>PO#</strong>&nbsp;&nbsp; <?php echo $ticketData['JobTicket']['po_number']; ?>
					</td>
					<td class="text-right">
						<strong>PO Qty</strong>&nbsp;&nbsp; <?php echo $specs['ProductSpecification']['quantity']  ?>
					</td>
				</tr>		
					<!-- <tr>
					<td >Item Size <?php echo $specs['ProductSpecification']['size1'].' x '.$specs['ProductSpecification']['size2'].' x '.$specs['ProductSpecification']['size3'] ?></td>
					<td class="text-right"><label class="">Outs</label> </td>
					</tr> -->
			</table>

			<table class="full-width border" style="font-family:sans-serif;">
				<tr>
					<td style="width:350px">
							<table>

								<tr>
									<td style="width:200px"><strong>Flute Combination</strong></td>
									<td></td>
								</tr>


								
								<tr>
									<?php if($flutecombination == " "){ 

										$flutecombination = 'kit'; ?>

										<td style = "align:right; color:white;"><?php echo $flutecombination ?></td>

									<?php }else{ ?>

										<td style = "align:right; "><?php echo $flutecombination ?></td>

									<?php } ?>
									
									<?php ?>

									<td></td>
								</tr>
							
							</table>
					</td>
					<td>

							<table style="border-left:1px solid #000">

								<tr>
									<td style="width:200px"><strong>Cutting size</strong></td>
									<td><strong>Qty + Allowance = Total Qty</strong></td>
								</tr>
								<tr>
									<?php 

										// $size1 = !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size1'] . " mm " : " ";
										// $size2 = !empty($specs['ProductSpecification']['size2']) ? " x " . $specs['ProductSpecification']['size2'] . " mm " : " ";
										// $size3 = !empty($specs['ProductSpecification']['size3']) ? " x " . $specs['ProductSpecification']['size3'] . " mm " : " ";

										// $cuttingSize = $size1 . " " . $size2 . " " . $size3;

										$cuttingSize = $size1 . " x " . $size2;

									?>
									<td style = "align:right; "><?php echo $cuttingSize ?></td>
									<td><?php  echo $specs['ProductSpecification']['quantity'] ?> + <?php  echo !empty($allowance) ? $allowance : 0 ?> = <?php echo $total ?> </td>
								</tr>
							</table>
					</td>
				</tr>
			</table>	

			<table class="border full-width" style="font-family:sans-serif;">
						<tr>
							<td style="width:50px;"> No </td>
							<td style="width:110px;"> Flute </td>
							<td style="width:50px;"> Substrate </td>
							<td style="width:400px;">  </td>
							<td>Estimated KG</td>
						</tr>
			</table>

			<table class="full-width border" style="font-family:sans-serif;">

				<?php foreach ($corrugated['ItemGroupLayer'] as $key => $layerList){ ?>

				<tr>
					<td>
						<table >

							<tr>
								<td> <?php echo $key + 1?></td>

								<?php if(!empty( $layerList['flute'])) {?>

									<td style="width:80px; text-align:center; border-left:1px solid #000; border-right:1px solid #000; "><?php echo $layerList['flute'] ?></td>

								<?php }else{ ?>

									<td style="width:80px; color:white; border-left:1px solid #000; border-right:1px solid #000; "><?php echo 0 ?></td>

								<?php } ?>

									<td style=" text-align:left; padding-left:40px;"><?php echo $layerList['substrate'] ?></td>
							</tr>
						</table>
					</td>
				</tr>

				<?php } ?>

			</table>

			<table class="full-width border" style="height:80px">
				<tr>
				<td style="vertical-align:top">
						<h2 style="font-size:12px">Remarks</h2>
					<br>
					<?php  if (!empty($corrugatedJobTicket['CorrugatedPaperJobTicket']['remarks']))  {

						echo $corrugatedJobTicket['CorrugatedPaperJobTicket']['remarks'];

					}?>	
				</td>
				</tr>	
					
			</table>
			<table class="full-width">
			<tr>
			<td>Prepared by : <?php echo $userData['User']['first_name'].', '.$userData['User']['last_name'] ?></td>
			<td>Approved By: </td>
			</tr>
			</table>		
</div>

</body>
</html>