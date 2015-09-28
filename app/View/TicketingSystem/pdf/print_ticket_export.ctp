<?php
// header("Content-disposition: attachment; filename="'this.pdf');
// header("Content-type: application/pdf");
?>
<style>
<?php include('word.css'); ?>

</style>

<<html>
<head>
	<title> Print Main Job Ticket</title>
</head>
<body>

		<table class="border full-width">
				<tr>
						<td><h2>Koufu Packaging Corp.</h2></td>
				</tr>
				<tr>
						<td><h1>Main Job Ticket</h1></td>  <td class="text-right"> <b>Date</b> <?php echo date('Y/m/d'); ?> </td>
				</tr>

		</table>

		<table class="border full-width">

				<tr class="border">
					<td >
						<table class="medium-font full-width">
							<tr>
								<td> <?php echo !empty($companyData[$productData['Product']['company_id']]) ? ucwords($companyData[$productData['Product']['company_id']]) : '';  ?> </td>
								<td class="text-right"><label class="strong">Schedule No</label> <?php echo $ticketUuid; ?></td>
							</tr>
							<tr>
								<td><label class="strong">Item</label> <?php echo $productData['Product']['name']; ?></td>
								<td class="text-right"><label>   </label> <?php echo $ticketData['JobTicket']['po_number']; ?> </td>
							</tr>
							
							<tr>
								<td><label class="strong">Item Size</label> <?php echo $specs['ProductSpecification']['size1'].' x '.$specs['ProductSpecification']['size2'].' x '.$specs['ProductSpecification']['size3'] ?></td>
								<td class="text-right"><label class="strong">Del Date</label> <?php 
								echo !empty($delData['ClientOrderDeliverySchedule'][0]['schedule']) ? date('M d, Y', strtotime($delData['ClientOrderDeliverySchedule'][0]['schedule'])) : ''; ?> </td>
							</tr>
						</table>
					</td>
				</tr>
		</table>

		<table class="border full-width">

				<tr class="">
					<td>
						<table class="medium-font full-width">
							
							<tr>
								<td><label class="strong">PO Quantity</label>
								<?php echo !empty( $specs['ProductSpecification']['quantity'] ) ?  $specs['ProductSpecification']['quantity'] : ''
								?>

								<?php echo !empty($unitData[$specs['ProductSpecification']['quantity_unit_id']]) ?  $unitData[$specs['ProductSpecification']['quantity_unit_id']] : ''
								?>
							</td>
								<td class="text-right"><label class="strong">Stock Quantity </label> <?php 
								echo !empty($specs['ProductSpecification']['stock']) ? $specs['ProductSpecification']['stock'] : ''?> </td>
							</tr>
						</table>
					</td>
				</tr>
		</table>



							<?php $componentCounter = 1?>
							<?php $partCounter = 1?>
							<?php $processCounter = 1?>
							<div class="border">
								<table class="table medium-font">
									<thead>
										<?php $countSpecs = count($formatDataSpecs);  foreach ($formatDataSpecs as $key => $specLists) { ?>
							
											<?php

										      	if($specLists['ProductSpecificationDetail']['model'] == 'Component'){

										      		echo $this->element('Specs/reports/component', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $componentCounter));
										      		$componentCounter++;
										      	}
										      	if($specLists['ProductSpecificationDetail']['model'] == 'Part'){
										      		
										      		echo $this->element('Specs/reports/part', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $partCounter));
										      		$partCounter++;
										      		
										      	}
										      	if($specLists['ProductSpecificationDetail']['model'] == 'Process'){
										      		
										      		echo $this->element('Specs/reports/process', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $processCounter));
										      		$processCounter++;

										      	}
									      	?>
							      	
										<?php } ?>


										<?php  if ($countSpecs < 20) : 

										$minimunTd = 20;

										$addTable = $minimunTd - $countSpecs;

										for ($i=$countSpecs; $i <= $minimunTd ; $i++) { ?>
									
											<tr>
											<td class="td-heigth" style="width:120px;border:1px solid #EAEAEA;"> <i style="color:#fff"> i <i>
											</td>
											<td class="td-heigth" style="width:150px;border:1px solid #EAEAEA;">  <i style="color:#fff"> i <i> 
											</td>
											<td class="td-heigth" style="width:228px; border:1px solid #EAEAEA;"> <i style="color:#fff"> i <i> 
											</td>
											</tr>
										<?php } ?>

										<?php endif; ?>
									</thead>
							    </table>
						   	</div> 

						<table class="border full-width">

								<tr class="">
									<td>
										<table class="medium-font full-width">
											
											<tr>
												<td><label class="strong">Packing Option</label></td>

											</tr>
											<tr>
												<td><label class="strong">Labels</label></td>

											</tr>
										</table>
									</td>
								</tr>
						</table>

						<table class="full-width">

								<tr class="">
									<td>
										<table class="medium-font full-width">
											
											<tr>
												<td><label class="strong">Sales</label>
													<?php echo $userData['User']['first_name'].', '. $userData['User']['last_name']; ?>
												</td>
												<td><label class="strong">Approved By</label></td>

											</tr>
										</table>
									</td>
								</tr>
						</table>

</body>
</html>