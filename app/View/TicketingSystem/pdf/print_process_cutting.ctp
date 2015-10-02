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
<body>	

<div class="large-padding">
		<table class="full-width">
				<tr>
					<td><h2>Koufu Packaging</h2></td>
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
		<table class="full-width border">
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


		<table class="full-width border">
							<tr>
								<td>
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

		<table class="border full-width" style="font-family:'arial','helvatica'">
						<tr>
							<td> GSM </td>
							<td> Material </td>
							<td> Cutting Size </td>
							<td> Qty </td>
							<td> Allowance </td>
							<td> Total </td>
						</tr>


			</table>
			<table class="full-width border" style="font-family:'arial','helvatica'">
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

			<table class="full-width border" style="font-family:'arial','helvatica'">
							<tr>
								<td>
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


		<table class="full-width border">
				<tr>
					<td>
						Sample
					</td>
					<td class="text-right">
						<strong>Supplier</strong>
					</td>
					
				</tr>
				<tr>
					<td>
						Item  <?php echo $productData['Product']['name']; ?>
					</td>
					<td class="text-right">
						
					</td>
				</tr>
					<tr>
					<td >Item Size <?php echo $specs['ProductSpecification']['size1'].' x '.$specs['ProductSpecification']['size2'].' x '.$specs['ProductSpecification']['size3'] ?></td>
					<td class="text-right"><label class="">Outs</label> </td>
		</tr>
		</table>

			<table class="full-width border" style="height:280px">

			</table>
			<table class="full-width">
			<tr>
			<td>Sales : <?php echo $userData['User']['first_name'].', '.$userData['User']['last_name'] ?></td>
			<td>Approved By: </td>
			</tr>
			</table>		
</div>

</body>
</html>