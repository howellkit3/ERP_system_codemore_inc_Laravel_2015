<?php
// header("Content-disposition: attachment; filename="'this.pdf');
// header("Content-type: application/pdf");
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
					<td><h2>Koufu Packaging Corp.</h2></td>
				</tr>	
				<tr>
					<td><strong><?php echo $subProcess[$processId] ?> Job Ticket</strong></td>
					<td class="text-right">
						<label class="strong">Date</label>
						<?php echo date('Y/m/d'); ?>
					</td>
				</tr>				
		</table>
		<br>
		<table class="full-width border" style="font-family:sans-serif;">
				<tr>
					<td>
						Customer <?php echo !empty($companyData[$productData['Product']['company_id']]) ? ucwords($companyData[$productData['Product']['company_id']]) : '';  ?>
					</td>
					<td class="text-right">
						Schedule No <?php echo $ticketUuid; ?>
					</td>
					
				</tr>
				<tr>
					<td>
						Item  <?php echo $productData['Product']['name']; ?>
					</td>
					<td class="text-right">
						Description <?php echo $productData['Product']['remarks']  ?>
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
												<td style="width:100px">pc(s)</td>
												<td><strong>Outs</strong></td>
												<td> </td>
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
								<?php echo $processData['ProductSpecificationPart']['material']?>, 
								<?php echo $processData['ProductSpecificationPart']['size1']?> x
								<?php echo $processData['ProductSpecificationPart']['size2']?> >>
								<?php //echo $outs ?> Outs >>
								<?php echo $processData['ProductSpecificationPart']['paper_quantity'] ?> 
								<?php if(!empty($processData['ProductSpecificationPart']['allowance'])){ ?>
								+ <?php echo $processData['ProductSpecificationPart']['allowance'] ?>

								<?php } ?>
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
					<?php  if (!empty($jobProcess['JobProcess']['remarks']))  {

						echo $jobProcess['JobProcess']['remarks'];

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