<?php
// header("Content-disposition: attachment; filename="'this.pdf');
// header("Content-type: application/pdf");
Configure::write('debug',0);
?>
<style>
<?php include('word.css'); ?>
@page { margin: 5px; }
body { margin: 5px; }
</style>

<<html>
<head>
	<title> Print Main Job Ticket</title>
</head>
<body style="font-family:sans-serif;">

		<table class="border full-width" style="font-size:10px">
				<tr>
						<td><h2 style="font-size:12px">Koufu Packaging Corp.</h2></td>
				</tr>
				<tr>
					<td><h1 style="font-size:11px">Main Job Ticket</h1></td>  <td class="text-right"> <b>Date</b> <?php echo date('Y/m/d'); ?> </td>
				</tr>

		</table>

		<table class="border full-width" style="font-size:10px; margin:0px">

				<tr class="border">
					<td >
						<table class="small-font full-width" style="font-size:9px">
							<tr>
								<td class="border-bottom-dashed" style="font-size:9px"> <?php 
									
										echo !empty($companyData[$productData['Product']['company_id']]) ? ucfirst($companyData[$ticketData['Product']['company_id']]) : '' ;

									?> </td>
								<td class="text-right border-bottom-dashed"><label class="strong">Schedule No </label> 
								<?php echo $ticketData['JobTicket']['uuid']; ?></td>
							</tr>
							<tr>
								<td class="border-bottom-dashed"><label class="strong">Item </label> <?php echo $ticketData['Product']['name']; ?></td>
								<td class="text-right border-bottom-dashed"><label>   </label> <?php echo $ticketData['JobTicket']['po_number']; ?> </td>
							</tr>
							
							<tr>
								<td ><label class="strong">Item Size </label> 

									<?php if(empty($specs['ProductSpecification']['size1']) && empty($specs['ProductSpecification']['size2']) && empty($specs['ProductSpecification']['size3'])){ ?>

									<?php }else{?>

									<?php echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size1'] : '0' ?>

									<?php echo !empty($specs['ProductSpecification']['size2']) ? ' x ' .  $specs['ProductSpecification']['size2'] : '' ?>
									
									<?php echo !empty($specs['ProductSpecification']['size3']) ? ' x ' .  $specs['ProductSpecification']['size3'] : '' ?></td>

									<?php }  ?>
								<td class="text-right"><label class="strong">Del Date </label> <?php 
								echo !empty($delData['ClientOrderDeliverySchedule'][0]['schedule']) ? date('M d, Y', strtotime($delData['ClientOrderDeliverySchedule'][0]['schedule'])) : ''; ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
		</table>

		<table class="border full-width" style="line-height:0.5">
				<tr class="">
					<td>
						<table class="small-font full-width" style="font-size:8px">
							
							<tr>
								<td><label class="strong">PO Quantity</label>
								<?php echo !empty( $specs['ProductSpecification']['quantity'] ) ?  $specs['ProductSpecification']['quantity'] : ''
								?>

								<?php 
								echo !empty($specs['ProductSpecification']['quantity_unit_id']) ?  $unitData[$specs['ProductSpecification']['quantity_unit_id']] : ''
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
								<table class="table small-font">
									<thead>
										<?php $countSpecs = count($formatDataSpecs);  


											$product = array();

										foreach ($formatDataSpecs as $key => $specLists) { ?>
							
											<?php

										      	if($specLists['ProductSpecificationDetail']['model'] == 'Component'){

										      		echo $this->element('Specs/reports/component', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $componentCounter,'ticketUuid' => $ticketUuid));
										      		$componentCounter++;
										      	}
										      	if($specLists['ProductSpecificationDetail']['model'] == 'Part'){
										      		
										      		echo $this->element('Specs/reports/part', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $partCounter,'ticketUuid' => $ticketUuid));
										      		$partCounter++;
										      		

										      			if (!empty($specLists['ProductSpecificationDetail'])) {
										      				$product = $specLists['ProductSpecificationDetail'];


										      		}
										      	}

										      	if($specLists['ProductSpecificationDetail']['model'] == 'Process'){
										      		
										      		echo $this->element('Specs/reports/process', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $processCounter,'ticketUuid' => $ticketUuid ,'product'=> $product));
										      		$processCounter++;

										      		$countSpecs = count($formatDataSpecs[$key]['ProductSpecificationProcess']['ProcessHolder']);

										      	}
									      	?>
							      	
										<?php } ?>


										<?php 


											if (count($formatDataSpecs) < 5) : 

										$minimunTd = !empty($ticketData['JobTicket']['remarks']) ?  4 : 4;


										$line = 10 - count($formatDataSpecs);

										for ($i=1; $i <= $line ; $i++) { ?>
										


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

						   	<?php 
						   	if (count($formatDataSpecs) > 10) :  ?>
						   	<div style="page-break-before: always;"></div>


		<table class="border full-width" style="font-size:10px">
				<tr>
						<td><h2 style="font-size:12px">Koufu Packaging Corp.</h2></td>
				</tr>
				<tr>
						<td><h1 style="font-size:11px">Main Job Ticket</h1></td>  <td class="text-right"> <b>Date</b> <?php echo date('Y/m/d'); ?> </td>
				</tr>

		</table>

		<table class="border full-width" style="font-size:10px; margin:0px">

				<tr class="border">
					<td >
						<table class="small-font full-width" style="font-size:9px">
							<tr>
								<td class="border-bottom-dashed" style="font-size:9px"> <?php 
									
										echo !empty($companyData[$productData['Product']['company_id']]) ? ucfirst($companyData[$ticketData['Product']['company_id']]) : '' ;

									?> </td>
								<td class="text-right border-bottom-dashed"><label class="strong">Schedule No</label> <?php echo $ticketUuid; ?></td>
							</tr>
							<tr>
								<td class="border-bottom-dashed"><label class="strong">Item</label> <?php echo $ticketData['Product']['name']; ?></td>
								<td class="text-right border-bottom-dashed"><label>   </label> <?php echo $ticketData['JobTicket']['po_number']; ?> </td>
							</tr>
							
							<tr>
								<td ><label class="strong">Item Size</label> 

									<?php if(empty($specs['ProductSpecification']['size1']) && empty($specs['ProductSpecification']['size2']) && empty($specs['ProductSpecification']['size3'])){ ?>

									<?php }else{?>

									<?php echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size1'] : '0' ?>

									<?php echo !empty($specs['ProductSpecification']['size2']) ? ' x ' .  $specs['ProductSpecification']['size2'] : '' ?>
									
									<?php echo !empty($specs['ProductSpecification']['size3']) ? ' x ' .  $specs['ProductSpecification']['size3'] : '' ?></td>

									<?php }  ?>
								<td class="text-right"><label class="strong">Del Date</label> <?php 
								echo !empty($delData['ClientOrderDeliverySchedule'][0]['schedule']) ? date('M d, Y', strtotime($delData['ClientOrderDeliverySchedule'][0]['schedule'])) : ''; ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
		</table>

					<div class="border">
								<table class="table small-font">
									<thead>
								<?php 

								 if ($countSpecs < 20) : 

										$minimunTd = !empty($ticketData['JobTicket']['remarks']) ?  4 : 4;

										for ($i=1; $i <= 30 ; $i++) { ?>
										


											<tr>
											<td class="td-heigth" style="width:120px;border:1px solid #EAEAEA;"> <i style="color:#fff"> i <i>
											</td>
											<td class="td-heigth" style="width:150px;border:1px solid #EAEAEA;">  <i style="color:#fff"> i <i> 
											</td>
											<td class="td-heigth" style="width:228px; border:1px solid #EAEAEA;"> <i style="color:#fff"> i <i> 
											</td>
											</tr>
										<?php  } ?>
								<?php endif; ?>
							</thead>
								</table>
							</div>
						   <?php endif; ?>

						   	<?php if (!empty($ticketData['JobTicket']['remarks'])) : ?>
						   		<table class="border full-width">

								<tr class="">
									<td>
										<table class="medium-font full-width" style="vertical-align:top">
											
											<tr>
												<td>
													<label class="strong">Remarks</label>

													 <?php 
													if (strlen($ticketData['JobTicket']['remarks']) > 70) { ?>
													<p style="text-align:center; font-size:50%"><?php echo $ticketData['JobTicket']['remarks']; ?></p>
													<?php } else { ?>
													<p style="text-align:center"><?php echo $ticketData['JobTicket']['remarks']; ?></p>
													<?php } ?>	

												</td>

											</tr>
											
										</table>
									</td>
								</tr>
						</table>
					<?php endif; ?>

						<table class="border full-width" style="font-size:10px" style="line-height:0">

								<tr class="">
									<td>
										<table class="small-font full-width">
											
											<tr>
												<td class="border-bottom-dashed"><label class="strong">Packing Option</label></td>

											</tr>
											<tr>
												<td class="border-bottom-dashed"><label class="strong">Labels</label></td>

											</tr>
										</table>
									</td>
								</tr>
						</table>

						<table class="full-width" style="line-height:0;margin-top:2.5px">

								<tr class="">
									<td>
										<table class="small-font full-width">
											
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