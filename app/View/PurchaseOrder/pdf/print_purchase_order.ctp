
<style>
<?php include('word.css'); ?>

</style>


<?php 
for ($x = 0; $x <= 1; $x++) { ?>
<?php $style = count($purchaseItemData) > 1 ? 'padding-bottom:10px' : 'padding-bottom:15px'; ?>
<div class = "one" width = "48%" height = "49%" style="<?php echo $style; ?>" >
	<table class="layout" style =" margin:0px; line-height: 13px; padding:2px; width:750px; border:1px solid black;">
				
				<tr>
					<td style =" padding:0px; padding-top:0px; border:0px solid black; width:40%;">
						<center>

						<!-- <img src="<?php echo Router::url('/', true) ?>img/koufu_logo.png" alt="logo" style="width:165px;height:30px;">  -->
						<img src="<?php echo Router::url('/', true) ?>img/koufu_logo_2.jpg" alt="logo" style="width:210px;height:30px;padding-bottom:10;"><br>
								<label style = "margin-top:0px; font-size: 12px;">Lot 4-5 Blk 4 Mountview Industrial Complex<br>
								Brgy. Bancal Carmona Cavite<br>
								Tel: +632-5844928; &nbsp; +6346-4301576 &nbsp; Fax: +632-5844952</label>
						</center>
					</td>
				
					<td style =" padding:0px;  width:60%;"><center><h1><br>PURCHASE ORDER</h1></center><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 No. : <?php echo $purchaseOrderData['PurchaseOrder']['po_number']; ?>
					</td>
				</tr>	


			</table>

			<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;" >
				<thead>
					<tr>
						<td style="width:110px;">Supplier </td>
						<td style="width:250px; font-size:70%;" class="border-bot">:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['supplier_id'] : ucfirst($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]); ?></td>
						
						<td align = "right" style="width:80px;"> 
						<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date 
						</td>
						<td style="width:120px;" class="border-bot">:<?php echo (new \DateTime())->format('M d, Y') ?>
						</td>
						
					</tr>
			</table>

			<?php if ($purchaseOrderData['PurchaseOrder']['payment_term'] == 10) { ?> 
			<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;">
					<tr>
						<td style="width:110px;" >Contact Person</td>
						<td style="width:150px; font-size:5%" class="border-bot" >:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['contact_person_id'] : ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']) . " " . ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
						
						<td align = "right" style="width:80px;">Terms :  
						</td>
						<?php $font_size = strlen($paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]) > 8 ? 'font-size:70%' : ''; ?>
						<td style="width:120px; <?php echo $font_size; ?>" class="border-bot">:<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
						</td>
						
					</tr>
				</thead>
			</table>
			<?php } else { ?>
			<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;">
					<tr>
						<td style="width:110px;" >Contact Person</td>
						<td style="width:250px;  font-size:70%" class="border-bot">:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['contact_person_id'] : ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']) . " " . ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
						
						<td align = "right" style="width:80px;"> 
						<td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Terms 
						</td>
						<?php $font_size = strlen($paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]) > 8 ? 'font-size:70%' : ''; ?>
						<td style="width:120px; <?php echo $font_size; ?>" class="border-bot">:<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
						</td>
					</tr>
				</thead>
			</table>


			<?php } ?>
			

			<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;">
					<tr>
						<td style="width:110px;" >Telephone</td>
						<td style="width:160px; " class="border-bot">:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['contact_id'] : $telContactData['Contact']['number']; ?></td>
						
						<td align = "right" style="width:120px; "> <?php echo  !empty($faxContactData['Contact']['number']) ? "Fax # :  " .  $faxContactData['Contact']['number'] : " "; ?> </td>
						<td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delivery Date:
						</td>
						<td style="width:120px;" class="border-bot">:<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['delivery_date'])); ?>	
						</td>
						
					</tr>
				</thead>
			</table>
							
			<table class="item-table" style ="line-height: 1.6; width:750px; padding:1px; border:1px solid black;">
				<thead>
					<tr>
						<td class="td-heigth" align = "center" style=" vertical-align:center; line-height:13px; center;width:2%;border:1px solid black; font-size:15px;"><b>No</b></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Item Description </b></center></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Quantity</b></center></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Unit Price</b></center></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Amount</b></center></td>
					</tr>
					<?php $total = 0; $rollHolder = 0; $addRow2 = 8; 

					foreach ($purchaseItemData as $key => $value) {

					  	$key++; $addRow2 = $addRow2 - 1; 
						$dividend = floor($value[$modelTable]['quantity'] / $value[$modelTable]['pieces']);
	                    $difference = $value[$modelTable]['quantity'] - (floor($dividend) * $value[$modelTable]['pieces']); 
	                    $itemdescription = $value[$modelTable]['name'];

	                    if($value[$modelTable]['category'] == 0){ 

		                    $itemdescription .= !empty($value[$modelTable]['width']) ? " " .$value[$modelTable]['width'] . " " .$unitData[$value[$modelTable]['width_unit_id']] : " ";

		                }else{

		                	$itemdescription .= !empty($value[$modelTable]['size1']) ? " " . $value[$modelTable]['size1'] . " " .$unitData[$value[$modelTable]['size1_unit_id']] : " ";

		                    $itemdescription .= !empty($value[$modelTable]['size2']) ? " " .  "x" . " " . $value[$modelTable]['size2'] . " " . $unitData[$value[$modelTable]['size2_unit_id']] : " ";

		                    $itemdescription .= !empty($value[$modelTable]['size3']) ? " " . "x" . " " .$value[$modelTable]['size3'] . " " . $unitData[$value[$modelTable]['size3_unit_id']] : " ";

		                }

                    ?>

						<tr>
							<td align="center" style="width:2%; border:1px solid black; "><?php echo $key ?></td>
							<?php $lengthName = strlen($value[$modelTable]['name'] . $itemdescription)?>

							
							<?php if($lengthName >= 35 && $lengthName <= 70){ ?>

								<td class="td-heigth; " style = "border:1px solid black;" ><span style="font-size:55% !important; word-spacing: 0px;white-space: nowrap;  "><center><?php echo $itemdescription ?></center></td>

							<?php } else if($lengthName >= 70  && $lengthName <= 80) { ?>

								<td class="td-heigth" style = "border:1px solid black;width:200px;word-wrap: break-word;" ><span style="font-size:50%"; ><center><?php echo $itemdescription?></center></td>

							<?php } else if($lengthName >= 80 ) { ?>

								<td class="td-heigth" style = "border:1px solid black;width:200px;word-wrap: break-word;" ><span style="font-size:50%"; ><center><?php echo $itemdescription?></center></td>

							<?php }else{ ?>

								<td class="td-heigth;" style="border:1px solid black;" ><span style=" font-size:90%; height:10px !important; white-space:nowrap;padding:0;margin:0"; ><center><?php echo $itemdescription?></center></td>

							<?php } ?>

							<td class="td-heigth" style="border:1px solid black;"><center><?php echo $value[$modelTable]['pieces'] . " " . $unitData[$value[$modelTable]['quantity_unit_id']]?></center></td>

							<td class="td-heigth" style="border:1px solid black;"><center><?php echo number_format($value[$modelTable]['unit_price'],2)?>  <?php echo ($value[$modelTable]['category'] == 0) ? ' / ' . $unitData[$value[$modelTable]['unit_price_unit_id']] : " " ?></center></td>

							<td class="td-heigth" style="border:1px solid black;">
								<center>
									<?php 
	                                    $amount = $value[$modelTable]['quantity'] * $value[$modelTable]['unit_price'];
	                                    echo ($value[$modelTable]['category'] == 0) ? " " :$currencyData[$value[$modelTable]['unit_price_unit_id']] ." ".  number_format($amount,2);

	                                    if($value[$modelTable]['category'] != 0){

	                                    	$total = $total +  $amount;
	                                    	$rollHolder = $rollHolder + 1;
	                                	}


	                                ?>
								</center>
							</td>
						</tr>
					<?php } ?>
			
					<?php for ($i2=0; $i2 < $addRow2; $i2++) { ?>
						<tr>
							<td class="td-heigth" style="width:10px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:310px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:128px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:138px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:138px;border:1px solid black;">&nbsp;&nbsp;</td>
						</tr>
					<?php } ?>
				</thead>
			</table>

			<table class="table" style ="width: 750px; border:1px solid black;line-height: 13px; padding:0px;">
	            <tr>
	                <!-- <td style="width:300px;">
	                    <?php 
	                        if($purchaseOrderData['PurchaseOrder']['status'] == 8){ 
	                            echo "<span class='label label-default'>Waiting</span>";
	                        }
	                        if($purchaseOrderData['PurchaseOrder']['status'] == 1){ 
	                            echo "<span class='label label-success'>Approved</span>";
	                        }
	                    ?>
	                </td>
	                <td style="width:230px;">Version : <?php echo $purchaseOrderData['PurchaseOrder']['version']; ?></th></td> -->
	                <td align = "right" style="width:300px;" class="border-bot">TOTAL AMOUNT</th>
	                <td align ="center" style="width:70px;" class="border-bot"> <?php echo ($total == 0) ? " " : ": " . $currencyData[$value[$modelTable]['unit_price_unit_id']] . " " . number_format($total,2)?></td>
	            </tr>
	        </table>

			<table class="table" style =" border:1px solid black;line-height: 10px; padding:0px; width:750px;">
	            <tr>
	                <td style="width:300px;">

				<font size="2">Note/s : <?php echo $purchaseOrderData['PurchaseOrder']['remarks']; ?></font>
				 <br><br>          
					</td>
				</tr>
			</table>

			<table class="layout" style ="line-height: 15px; border:1px solid black; width:735px; padding:0px;">
				<thead>
					<tr>
						<td class="td-heigth" style="width:200px;border:1px solid #FFF;">Requested by : <br>
						
						<?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></td>
						<td class="td-heigth" style="vertical-align:top; width:200px;border:1px solid #FFF;">Approved by : <br></td>
						<td class="td-heigth" style="vertical-align:top; width:200px;border:1px solid #FFF;">Purchase by : <br></td>
						<td align = "center" style=" vertical-align:text-top;margin:0px; width:125px; font-size:60%; line-height:8px;"><br>KP-FR-LG1-001 R0 <br>Effective Date: 10 Aug 2015</td>
					</tr>
				</thead>
			</table>
	</div>


<?php }  ?> <br><br>

	 
<div class = "one" width = "48%" height = "48%"  > 

	<table class="layout" style =" margin:0px; line-height: 13px; padding:2px; width:750px; border:1px solid black;">

				<tr>
					<td style =" padding:0px; padding-top:0px;  border:0px solid black; width:40%;">
					<center>
					<!-- <img src="<?php echo Router::url('/', true) ?>img/koufu_logo.png" alt="logo" style="width:165px;height:30px;">  -->
					<img src="<?php echo Router::url('/', true) ?>img/koufu_logo_2.jpg" alt="logo" style="width:210px;height:30px;padding-bottom:10;"><br>
							<label style = "margin-top:0px; font-size: 12px;">Lot 4-5 Blk 4 Mountview Industrial Complex<br>
							Brgy. Bancal Carmona Cavite<br>
							Tel: +632-5844928; &nbsp; +6346-4301576 &nbsp; Fax: +632-5844952</label>
					</center>
					</td>
				
					<td style =" padding:0px;  width:60%;"><center><h1><br>PURCHASE ORDER</h1></center><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 No. : <?php echo $purchaseOrderData['PurchaseOrder']['po_number']; ?>
					</td>
				</tr>	


			</table>

			<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;" >
				<thead>
					<tr>
						<td style="width:110px;">Supplier</td>
						<td style="width:250px; font-size:70%;" class="border-bot">:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['supplier_id'] : ucfirst($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]); ?></td>
						
						<td align = "right" style="width:80px;"> 
						<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date 
						</td>
						<td style="width:120px;" class="border-bot">:<?php echo (new \DateTime())->format('M d, Y') ?>
						</td>
						
					</tr>
			</table>

			<?php if ($purchaseOrderData['PurchaseOrder']['payment_term'] == 10) { ?> 
		<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;">
					<tr>
						<td style="width:110px;" >Contact Person</td>
						<td style="width:150px; font-size:70%" class="border-bot">:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['contact_person_id'] : ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']) . " " . ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
						
						<td align = "right" style="width:80px;">Terms :  
						</td>
						<?php $font_size = strlen($paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]) > 8 ? 'font-size:70%' : ''; ?>
						<td style="width:120px; <?php echo $font_size; ?>" class="border-bot">:<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
						</td>
						
					</tr>
				</thead>
			</table>

			<?php } else { ?>
			<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;">
					<tr>
						<td style="width:110px;" >Contact Person</td>
						<td style="width:250px;  font-size:70%" class="border-bot">:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['contact_person_id'] : ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']) . " " . ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
						
						<td align = "right" style="width:80px;"> 
						<td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Terms 
						</td>
						<?php $font_size = strlen($paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]) > 8 ? 'font-size:70%' : ''; ?>
						<td style="width:120px; <?php echo $font_size; ?>" class="border-bot">:<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
						</td>
						
					</tr>
				</thead>
			</table>


			<?php } ?>
			<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;">
					<tr>
						<td style="width:110px;" >Telephone</td>
						<td style="width:120px;" class="border-bot">:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['contact_id'] : $telContactData['Contact']['number']; ?></td>
						
						<td align = "right" style="width:160px; "> <?php echo  !empty($faxContactData['Contact']['number']) ? "Fax # :  " .  $faxContactData['Contact']['number'] : " "; ?> </td>
						<td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delivery Date:
						</td>
						<td style="width:120px;" class="border-bot">:<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['delivery_date'])); ?>	
						</td>
						
					</tr>
				</thead>
			</table>
							
			<table class="item-table" style ="line-height: 1.6; width:750px; padding:1px; border:1px solid black;">
				<thead>
					<tr>
						<td class="td-heigth" align = "center" style=" vertical-align:center; line-height:13px; center;width:2%;border:1px solid black; font-size:15px;"><b>No</b></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Item Description</b></center></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Quantity</b></center></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Unit Price</b></center></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Amount</b></center></td>
					</tr>
					<?php $total = 0; $addRow2 = 8; 

					foreach ($purchaseItemData as $key => $value) {  

						$key++; $addRow2 = $addRow2 - 1; 
						$dividend = floor($value[$modelTable]['quantity'] / $value[$modelTable]['pieces']);
	                    $difference = $value[$modelTable]['quantity'] - (floor($dividend) * $value[$modelTable]['pieces']);
	                    $itemdescription = $value[$modelTable]['name'];

	                    if($value[$modelTable]['category'] == 0){ 

		                    $itemdescription .= !empty($value[$modelTable]['width']) ? " " .$value[$modelTable]['width'] . " " .$unitData[$value[$modelTable]['width_unit_id']] : " ";

		                }else{

		                	$itemdescription .= !empty($value[$modelTable]['size1']) ? " " . $value[$modelTable]['size1'] . " " .$unitData[$value[$modelTable]['size1_unit_id']] : " ";

		                    $itemdescription .= !empty($value[$modelTable]['size2']) ? " " .  "x" . " " . $value[$modelTable]['size2'] . " " . $unitData[$value[$modelTable]['size2_unit_id']] : " ";

		                    $itemdescription .= !empty($value[$modelTable]['size3']) ? " " . "x" . " " .$value[$modelTable]['size3'] . " " . $unitData[$value[$modelTable]['size3_unit_id']] : " ";

		                }
                    ?>

						<tr>
							<td align="center" style="width:2%; border:1px solid black; "><?php echo $key ?></td>
							<?php $lengthName = strlen($value[$modelTable]['name'] . $itemdescription)?>

							
							<?php if($lengthName >= 35 && $lengthName <= 70){ ?>

								<td class="td-heigth; " style = "border:1px solid black;" ><span style="font-size:55% !important; word-spacing: 0px;white-space: nowrap;  "><center><?php echo $itemdescription?></center></td>

							<?php } else if($lengthName >= 70  && $lengthName <= 80) { ?>

								<td class="td-heigth" style = "border:1px solid black;width:200px;word-wrap: break-word;" ><span style="font-size:50%"; ><center><?php echo $itemdescription?></center></td>

							<?php } else if($lengthName >= 80 ) { ?>

								<td class="td-heigth" style = "border:1px solid black;width:200px;word-wrap: break-word;" ><span style="font-size:50%"; ><center><?php echo $itemdescription?></center></td>

							<?php }else{ ?>

								<td class="td-heigth;" style="border:1px solid black;" ><span style=" font-size:90%; height:10px !important; white-space:nowrap;padding:0;margin:0"; ><center><?php echo $itemdescription?></center></td>

							<?php } ?>


							<!-- <td class="td-heigth" style = "<?php echo strlen($value[$modelTable]['name']) > 3  ? 'font-size: 10% !important' : ''; ?>" ><span style="word-wrap: break-word; width:100px;font-size:65%;"; ><center><?php echo $value[$modelTable]['name']?></center></td> -->

							

							<td class="td-heigth" style="border:1px solid black;"><center><?php echo $value[$modelTable]['pieces'] . " " . $unitData[$value[$modelTable]['quantity_unit_id']]?></center></td>

							<td class="td-heigth" style="border:1px solid black;"><center><?php echo number_format($value[$modelTable]['unit_price'],2)?>  <?php echo ($value[$modelTable]['category'] == 0) ? ' / ' . $unitData[$value[$modelTable]['unit_price_unit_id']] : " " ?></center></td>

							<td class="td-heigth" style="border:1px solid black;">
								<center>
									<?php 
	                                    $amount = $value[$modelTable]['quantity'] * $value[$modelTable]['unit_price'];
	                                    echo ($value[$modelTable]['category'] == 0) ? " " :$currencyData[$value[$modelTable]['unit_price_unit_id']] ." ".  number_format($amount,2);

	                                    if($value[$modelTable]['category'] != 0){

	                                    	$total = $total +  $amount;

	                                	}
	                                ?>
								</center>
							</td>
						</tr>
					<?php } ?>
			
					<?php for ($i2=0; $i2 < $addRow2; $i2++) { ?>
						<tr>
							<td class="td-heigth" style="width:10px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:310px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:128px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:138px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:138px;border:1px solid black;">&nbsp;&nbsp;</td>
						</tr>
					<?php } ?>
				</thead>
			</table>

			<table class="table" style ="width: 750px; border:1px solid black;line-height: 13px; padding:0px;">
	            <tr>
	                <!-- <td style="width:300px;">
	                    <?php 
	                        if($purchaseOrderData['PurchaseOrder']['status'] == 8){ 
	                            echo "<span class='label label-default'>Waiting</span>";
	                        }
	                        if($purchaseOrderData['PurchaseOrder']['status'] == 1){ 
	                            echo "<span class='label label-success'>Approved</span>";
	                        }
	                    ?>
	                </td>
	                <td style="width:230px;">Version : <?php echo $purchaseOrderData['PurchaseOrder']['version']; ?></th></td> -->
	                <td align = "right" style="width:300px;" class="border-bot">TOTAL AMOUNT</th>
	                <td align ="center" style="width:70px;" class="border-bot"> <?php echo ($total == 0) ? " " : ": " . $currencyData[$value[$modelTable]['unit_price_unit_id']] . " " . number_format($total,2)?></td>
	            </tr>
	        </table>

			<table class="table" style =" border:1px solid black;line-height: 10px; padding:0px; width:750px;">
	            <tr>
	                <td style="width:300px;">

				<font size="2">Note/s : <?php echo $purchaseOrderData['PurchaseOrder']['remarks']; ?></font>
				 <br><br>          
					</td>
				</tr>
			</table>

			<table class="layout" style ="line-height: 15px; border:1px solid black; width:735px; padding:0px;">
				<thead>
					<tr>
						<td class="td-heigth" style="width:200px;border:1px solid #FFF;">Requested by : <br>
						<?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></td>
						<td class="td-heigth" style="vertical-align:top; width:200px;border:1px solid #FFF;">Approved by : <br></td>
						<td class="td-heigth" style="vertical-align:top; width:200px;border:1px solid #FFF;">Purchase by : <br></td>
						<td align = "center" style=" vertical-align:text-top;margin:0px; width:125px; font-size:60%; line-height:8px;"><br>KP-FR-LG1-001 R0 <br>Effective Date: 10 Aug 2015</td>
					</tr>
				</thead>
			</table>
	</div>

	<div class = "one" width = "48%" height = "48%" > 
	
	<table class="layout" style =" margin:0px; line-height: 13px; padding:2px; width:750px; border:1px solid black;">

				<tr>
					<td style =" padding:0px; padding-top:0px; border:0px solid black; width:40%;">
					<center>
					<!-- <img src="<?php echo Router::url('/', true) ?>img/koufu_logo.png" alt="logo" style="width:165px;height:30px;">  -->
				
					<img src="<?php echo Router::url('/', true) ?>img/koufu_logo_2.jpg" alt="logo" style="width:210px;height:30px;padding-bottom:10;"><br>
							<label style = "margin-top:0px; font-size: 12px;">Lot 4-5 Blk 4 Mountview Industrial Complex<br>
							Brgy. Bancal Carmona Cavite<br>
							Tel: +632-5844928; &nbsp; +6346-4301576 &nbsp; Fax: +632-5844952</label>
					</center>
					</td>
				
					<td style =" padding:0px;  width:60%;"><center><h1><br>PURCHASE ORDER</h1></center><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 No. : <?php echo $purchaseOrderData['PurchaseOrder']['po_number']; ?>
					</td>
				</tr>	


			</table>

			<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;" >
				<thead>
					<tr>
						<td style="width:110px;">Supplier </td>
						<td style="width:250px; font-size:70%;" class="border-bot">:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['supplier_id'] : ucfirst($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]); ?></td>
						
						<td align = "right" style="width:80px;"> 
						<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date 
						</td>
						<td style="width:120px;" class="border-bot">:<?php echo (new \DateTime())->format('M d, Y') ?>
						</td>
						
					</tr>
			</table>

			<?php if ($purchaseOrderData['PurchaseOrder']['payment_term'] == 10) { ?> 
			<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;">
					<tr>
						<td style="width:110px;" >Contact Person</td>
						<td style="width:150px;  font-size:70%" class="border-bot">:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['contact_person_id'] : ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']) . " " . ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
						
						<td align = "right" style="width:80px;">Terms :  
						</td>
						<td style="width:250px;  font-size:70%" class="border-bot"><?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
						</td>
						
					</tr>
				</thead>
			</table>

			<?php } else { ?>
			<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;">
					<tr>
						<td style="width:110px;" >Contact Person</td>
						<td style="width:250px;  font-size:70%" class="border-bot">:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['contact_person_id'] : ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']) . " " . ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
						
						<td align = "right" style="width:80px;"> 
						<td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Terms 
						</td>
						<?php $font_size = strlen($paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]) > 8 ? 'font-size:70%' : ''; ?>
						<td style="width:120px; <?php echo $font_size; ?>" class="border-bot">:<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
						</td>
					</tr>
				</thead>
			</table>

			<?php } ?>

			<table class="" style ="line-height: 13px; width:750px; padding:1px; border:1px solid black;">
					<tr>
						<td style="width:110px;" >Telephone</td>
						<td style="width:120px;" class="border-bot">:<?php echo empty($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]) ? $purchaseOrderData['PurchaseOrder']['contact_id'] : $telContactData['Contact']['number']; ?></td>
						
						
						<td align = "right" style="width:160px; "> <?php echo  !empty($faxContactData['Contact']['number']) ? "Fax # :  " .  $faxContactData['Contact']['number'] : " "; ?> </td>
						<td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delivery Date:
						</td>
						<td style="width:120px;" class="border-bot">:<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['delivery_date'])); ?>	
						</td>
						
					</tr>
				</thead>
			</table>
							
			<table class="item-table" style ="line-height: 1.6; width:750px; padding:1px; border:1px solid black;">
				<thead>
					<tr>
						<td class="td-heigth" align = "center" style=" vertical-align:center; line-height:13px; center;width:2%;border:1px solid black; font-size:15px;"><b>No</b></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Item Description</b></center></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Quantity</b></center></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Unit Price</b></center></td>
						<td class="td-heigth" style="line-height:15px;  verticalline-height:10px; -align: center;  border:1px solid black;"><center><b>Amount</b></center></td>
					</tr>
					<?php 
						$total = 0; $addRow2 = 8; 

						foreach ($purchaseItemData as $key => $value) {  

							$key++; $addRow2 = $addRow2 - 1; 
							$dividend = floor($value[$modelTable]['quantity'] / $value[$modelTable]['pieces']);
	                   		$difference = $value[$modelTable]['quantity'] - (floor($dividend) * $value[$modelTable]['pieces']);
	                   		$itemdescription = $value[$modelTable]['name'];

		                    if($value[$modelTable]['category'] == 0){ 

			                    $itemdescription .= !empty($value[$modelTable]['width']) ? " " .$value[$modelTable]['width'] . " " .$unitData[$value[$modelTable]['width_unit_id']] : " ";

			                }else{

			                	$itemdescription .= !empty($value[$modelTable]['size1']) ? " " . $value[$modelTable]['size1'] . " " .$unitData[$value[$modelTable]['size1_unit_id']] : " ";

			                    $itemdescription .= !empty($value[$modelTable]['size2']) ? " " .  "x" . " " . $value[$modelTable]['size2'] . " " . $unitData[$value[$modelTable]['size2_unit_id']] : " ";

			                    $itemdescription .= !empty($value[$modelTable]['size3']) ? " " . "x" . " " .$value[$modelTable]['size3'] . " " . $unitData[$value[$modelTable]['size3_unit_id']] : " ";

			                }
                   		?>
						<tr>
							<td align="center" style="width:2%; border:1px solid black; "><?php echo $key ?></td>
							<?php $lengthName = strlen($value[$modelTable]['name'] . $itemdescription)?>

							
							<?php if($lengthName >= 35 && $lengthName <= 70){ ?>

								<td class="td-heigth; " style = "border:1px solid black;" ><span style="font-size:55% !important; word-spacing: 0px;white-space: nowrap;  "><center><?php echo $itemdescription?></center></td>

							<?php } else if($lengthName >= 70  && $lengthName <= 80) { ?>

								<td class="td-heigth" style = "border:1px solid black;width:200px;word-wrap: break-word;" ><span style="font-size:50%"; ><center><?php echo $itemdescription?></center></td>

							<?php } else if($lengthName >= 80 ) { ?>

								<td class="td-heigth" style = "border:1px solid black;width:200px;word-wrap: break-word;" ><span style="font-size:50%"; ><center><?php echo $itemdescription?></center></td>

							<?php }else{ ?>

								<td class="td-heigth;" style="border:1px solid black;" ><span style=" font-size:90%; height:10px !important; white-space:nowrap;padding:0;margin:0"; ><center><?php echo $itemdescription?></center></td>

							<?php } ?>

							<td class="td-heigth" style="border:1px solid black;"><center><?php echo $value[$modelTable]['pieces'] . " " . $unitData[$value[$modelTable]['quantity_unit_id']]?></center></td>

							<td class="td-heigth" style="border:1px solid black;"><center><?php echo number_format($value[$modelTable]['unit_price'],2)?>  <?php echo ($value[$modelTable]['category'] == 0) ? ' / ' . $unitData[$value[$modelTable]['unit_price_unit_id']] : " " ?></center></td>

							<td class="td-heigth" style="border:1px solid black;">
								<center>
									<?php 
	                                    $amount =  $value[$modelTable]['quantity'] * $value[$modelTable]['unit_price'];
	                                    echo ($value[$modelTable]['category'] == 0) ? " " :$currencyData[$value[$modelTable]['unit_price_unit_id']] ." ".  number_format($amount,2);

	                                    if($value[$modelTable]['category'] != 0){

	                                    	$total = $total +  $amount;

	                                	}
	                                ?>
								</center>
							</td>
						</tr>
					<?php } ?>
			
					<?php for ($i2=0; $i2 < $addRow2; $i2++) { ?>
						<tr>
							<td class="td-heigth" style="width:10px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:310px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:128px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:138px;border:1px solid black;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:138px;border:1px solid black;">&nbsp;&nbsp;</td>
						</tr>
					<?php } ?>
				</thead>
			</table>

			<table class="table" style ="width: 750px; border:1px solid black;line-height: 13px; padding:0px;">
	            <tr>
	                <!-- <td style="width:300px;">
	                    <?php 
	                        if($purchaseOrderData['PurchaseOrder']['status'] == 8){ 
	                            echo "<span class='label label-default'>Waiting</span>";
	                        }
	                        if($purchaseOrderData['PurchaseOrder']['status'] == 1){ 
	                            echo "<span class='label label-success'>Approved</span>";
	                        }
	                    ?>
	                </td>
	                <td style="width:230px;">Version : <?php echo $purchaseOrderData['PurchaseOrder']['version']; ?></th></td> -->
	                <td align = "right" style="width:300px;" class="border-bot">TOTAL AMOUNT</th>
	                <td align ="center" style="width:70px;" class="border-bot"> <?php echo ($total == 0) ? " " : ": " . $currencyData[$value[$modelTable]['unit_price_unit_id']] . " " .number_format($total,2)?></td>
	            </tr>
	        </table>

			<table class="table" style =" border:1px solid black;line-height: 10px; padding:0px; width:750px;">
	            <tr>
	                <td style="width:300px;">

				<font size="2">Note/s : <?php echo $purchaseOrderData['PurchaseOrder']['remarks']; ?></font>
				 <br><br>          
					</td>
				</tr>
			</table>

			<table class="layout" style ="line-height: 15px; border:1px solid black; width:735px; padding:0px;">
				<thead>
					<tr>
						<td class="td-heigth" style="width:200px;border:1px solid #FFF;">Requested by : <br>
						<?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></td>
						<td class="td-heigth" style="vertical-align:top; width:200px;border:1px solid #FFF;">Approved by : <br></td>
						<td class="td-heigth" style="vertical-align:top; width:200px;border:1px solid #FFF;">Purchase by : <br></td>
						<td align = "center" style=" vertical-align:text-top;margin:0px; width:125px; font-size:60%; line-height:8px;"><br>KP-FR-LG1-001 R0 <br>Effective Date: 10 Aug 2015</td>
					</tr>
				</thead>
			</table>
	</div>