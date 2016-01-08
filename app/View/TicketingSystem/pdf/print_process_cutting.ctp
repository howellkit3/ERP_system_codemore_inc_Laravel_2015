<?php 
// header("Content-disposition: attachment; filename="'this.pdf');
// header("Content-type: application/pdf");

Configure::write('debug',2);
?>
<style>
<?php include('word.css'); ?>

</style>

<?php 
         $outs1  = !empty($part['ProductSpecificationPart']['outs1']) ? $part['ProductSpecificationPart']['outs1']  : 1;
        $outs2  = !empty($part['ProductSpecificationPart']['outs2']) ? $part['ProductSpecificationPart']['outs2']  : 1;
        $outProduct = $outs1 * $outs2; 
        $quantity = $specs['ProductSpecification']['quantity']; 
        $rate  = !empty($part['ProductSpecificationPart']['rate']) ? $part['ProductSpecificationPart']['rate']  : 1;
        $stocks = !empty($specs['ProductSpecification']['stock']) ? $specs['ProductSpecification']['stock']  : 0;
        
        $quantitySubtracted = $quantity - $stocks; 
        $product = $rate * $quantitySubtracted;
        $paper  = ceil($product / $outProduct);

?>

<html>
<head>
	<title>Print Process</title>
</head>
<body style="font-family:sans-serif;">	

<div class="large-padding">
		<table class="full-width" style="font-family:sans-serif;">
				<tr>
					<td><h2>Koufu Packaging Corp.</h2></td>
				</tr>	
				<tr>
					<td><strong><?php //echo $subProcess[$processId] ?> Paper Request Job Ticket</strong></td>
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

						<?php if (!empty($component)) {

							echo '( '. Inflector::humanize($component)  .' )';
						 }else{
						 	if(!empty($componentName)){
						 		echo '( '. Inflector::humanize($componentName)  .' )';
							 }
						 } ?>


					</td>
					<td class="text-right">
						<strong>DESCRIPTION</strong>&nbsp;&nbsp; <?php echo $productData['Product']['remarks']  ?>
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
												<td><strong>Material Type </strong></td>
												<td style="width:100px"> = pc(s)</td>
											</tr>
										</table>
								</td>
								<td>

										<table style="border-left:1px solid #000">
											<tr>
												<td ><strong>PO qty</strong></td>
												<td style="width:100px"> 
										<?php 

										$po_quantity = 0;

										if (!empty($specs['ProductSpecification']['quantity'])) {
											$po_quantity = $specs['ProductSpecification']['quantity']; 
											echo $po_quantity;
											echo " ";
											echo $unitData[$specs['ProductSpecification']['quantity_unit_id']];
										} else {
											echo "pc(s)";
										}
											
												
												 //pc(s)
										?>
												

												</td>
												<td><strong>Outs</strong></td>
												<td> <?php echo $outs; ?></td>
											</tr>
										</table>
								</td>
							</tr>
		</table>

		<table class="border full-width" style="font-family:sans-serif;">
						<tr>
							<td> GSM </td>
							<td> Material </td>
							<td> Cutting Size </td>
							<td> Qty </td>
							<td> Allowance </td>
							<td> Total </td>
						</tr>


			</table>

	


			<table class="full-width border" style="font-family:sans-serif;">
						<tr>
							<td> 
								<?php echo $part['ProductSpecificationPart']['material']?>, 
								<?php echo $part['ProductSpecificationPart']['size1']?> x
								<?php echo $part['ProductSpecificationPart']['size2']?> >
								<?php 
								$total = $paper;
								echo $paper;
								?>
								<?php if(!empty($part['ProductSpecificationPart']['allowance'])){ ?>
								+ <?php echo $part['ProductSpecificationPart']['allowance']; 
								$total += $part['ProductSpecificationPart']['allowance']; ?>
								<?php } ?>
								<?php echo " = ".round($total); echo $unitData[$specs['ProductSpecification']['quantity_unit_id']]; ?>


							</td>
						</tr>
			</table>

			<table class="full-width border" style="font-family:sans-serif;">
							<tr>
								<td style="width:350px">
										<table>
											<tr>
												<td><strong><strong>FOR SHEETS</strong></td>
												
											</tr>
										</table>
								</td>
								<td>

										<table style="border-left:1px solid #000">
											<tr>
												<td><strong><strong>FOR ROLLS</strong></td>
												
											</tr>
										</table>
								</td>
							</tr>
			</table>	


		<table class="full-width border" style="font-family:sans-serif; vertical-alin:top" >
							<tr>
								<td style="width:350px;vertical-align:top">
										<table style="font-family:sans-serif; vertical-align:top">
											<tr>
												<td style="vertical-align:top">

													<strong>Supplier Name</strong>
													<br>	<br>
													<strong>Paper Lot No</strong>


													<p> PAPER SIZE: </p>
												</td>
												
											</tr>
										</table>
								</td>
								<td>

											<table  style="border-left:1px solid #000; font-family:sans-serif; vertical-align:top">
											<tr>
												<td>

													<strong>Supplier Name</strong>
													<br>	<br>

													<strong>Paper Lot No</strong>


													<p> Roll Width </p>

													<p> Roll Cut </p>
												</td>

												
											</tr>
										</table>

										<table class="full-width" style="border-left:1px solid #000; font-family:sans-serif; vertical-align:top">
											<tr>
												<td style="width:180px">
													Qty = 
												</td>

												<td>
													PCS.
												</td>
											</tr>
										</table>

										<table class="full-width" style="border-left:1px solid #000; font-family:sans-serif; vertical-align:top">
											<tr>
												<td style="width:180px">
													
												</td>

												<td>
													TOTAL
												</td>

												<td>
													PCS.
												</td>
											</tr>
										</table>
								</td>
							</tr>
			</table>

			<table class="full-width border" style="height:80px">
				<tr>
				<td style="vertical-align:top">
						<h2 style="font-size:12px">Remarks</h2>
					<br>
					<?php  if (!empty($modelData['CuttingJobTicket']['remarks']))  {

						echo $modelData['CuttingJobTicket']['remarks'];

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