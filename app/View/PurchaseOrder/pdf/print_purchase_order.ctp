
<style>
<?php include('word.css'); ?>

</style>
 
<div class="one" style = "height: 48%;">
		<table class="layout" style =" padding:0px; border:1px solid black; width:751px;">
			<tr>
			<td>
				<center>
					<label style = "margin-top:0px; font-size: 25px;">Kou Fu Packaging Corporation</label><br>
					<label style = "margin-top:0px; font-size: 15px;">Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</label><br>
					<label style = "margin-top:0px; font-size: 15px;">Tel: +63(2)5844928 &nbsp; Fax: +63(2)5844952</label>
				</center>
			</td>
			</tr>			
		</table>

		<table class="layout" style ="line-height: 13px; padding:0px; border:1px solid black;">
			<thead>
				<tr>
					<td style="width:290px;">PURCHASE ORDER</td>
					<td style="width:270px;">Date : <?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?></td>
					<td style="width:175px;">PO No. : 
						<?php echo $purchaseOrderData['PurchaseOrder']['po_number']; ?>
					</td>
				</tr>
			</thead>
		</table>

		<table class="layout" style ="line-height: 13px; width:751px; padding:1px; border:1px solid black;" >
			<thead>
				<tr>
					<td style="width:80px;">Supplier </td>
					<td style="width:180px;" class="border-bot">:<?php echo ucfirst($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]); ?></td>
					<td style="width:45px;">Date :</td>
					<td style="width:160px;" class="border-bot">
						<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?>
					</td>
					<td style="width:120px;">Terms 
					</td>
					<td style="width:120px;" class="border-bot">:<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
					</td>
				</tr>
				<tr>
					<td style="width:70px;" >Contact </td>
					<td style="width:150px;" class="border-bot">:<?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']); ?> <?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
					<td style="width:40px;">Tel# :</td>
					<td style="width:90px;" class="border-bot">
						<?php echo $purchaseOrderData['Contact']['number']; ?>
					</td>
					<td style="width:40px;">Delivery Date 
					</td>
					<td style="width:50px;" class="border-bot">:<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['delivery_date'])); ?>	
					</td>
				</tr>
			</thead>
		</table>
						
		<table class="item-table" style ="line-height:1.6; height: 300px; padding:0px; width:751px; margin:0px;table-layout: fixed; display: table" >
			<thead>
				<tr>
					<td class="td-heigth" style=" vertical-align: center;width:2%;border:1px solid black;">#</td>
					<td class="td-heigth" style=" border:1px solid black;width:314px"><center><b>Item Description</b></center></td>
					<td class="td-heigth" style=" vertical-align: center;  border:1px solid black;"><center><b>Quantity</b></center></td>
					<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center><b>Unit Price</b></center></td>
					<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center><b>Amount</b></center></td>
				</tr>
				<?php $total = 0; $addRow2 = 8; foreach ($purchaseItemData as $key => $value) {  $key++; $addRow2 = $addRow2 - 1; ?>
					<tr>
						<td class="" style="width:2%; border:1px solid black; "><?php echo $key ?></td>
						<?php $lengthName = strlen($value[$modelTable]['name'])?>

						
						<?php if($lengthName >= 35 && $lengthName <= 70){ ?>

							<td class="td-heigth; border:1px solid black;" ><span style="font-size:90% !important; word-spacing: 0px;white-space: nowrap;  "><center><?php echo $value[$modelTable]['name']?></center></td>

						<?php } else if($lengthName >= 70) { ?>

							<td class="td-heigth" style = "border:1px solid black;width:200px;word-wrap: break-word;" ><span style="font-size:65%"; ><center><?php echo $value[$modelTable]['name']?></center></td>

						<?php }else{ ?>

							<td class="td-heigth;" style="border:1px solid black;" ><span style=" font-size:100%; height:10px !important; white-space:nowrap;padding:0;margin:0"; ><center><?php echo $value[$modelTable]['name']?></center></td>

						<?php } ?>


						<!-- <td class="td-heigth" style = "<?php echo strlen($value[$modelTable]['name']) > 3  ? 'font-size: 10% !important' : ''; ?>" ><span style="word-wrap: break-word; width:100px;font-size:65%;"; ><center><?php echo $value[$modelTable]['name']?></center></td> -->

						

						<td class="td-heigth" style="border:1px solid black;"><center><?php echo $value[$modelTable]['quantity']?>/<?php echo $unitData[$value[$modelTable]['quantity_unit_id']]?></center></td>
						<td class="td-heigth" style="border:1px solid black;"><center><?php echo number_format($value[$modelTable]['unit_price'],2)?>/<?php echo $unitData[$value[$modelTable]['unit_price_unit_id']]?></center></td>
						<td class="td-heigth" style="border:1px solid black;">
							<center>
								<?php 
                                    $amount = $value[$modelTable]['quantity'] * $value[$modelTable]['unit_price'];
                                    echo number_format($amount,2)."/".$unitData[$value[$modelTable]['unit_price_unit_id']];

                                    $total = $total + $amount;
                                ?>
							</center>
						</td>
					</tr>
				<?php } ?>
				<!-- <tr>
					<td class="td-heigth" style="width:10px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					<td class="td-heigth" style="width:310px;border:1px solid #EAEAEA;"><center>------END------</center></td>
					<td class="td-heigth" style="width:128px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					<td class="td-heigth" style="width:140px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					<td class="td-heigth" style="width:140px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
				</tr> -->
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

		<table class="table" style ="width: 751px; border:1px solid black;line-height: 13px; padding:0px;">
            <tr>
                <td style="width:300px;">
                    <?php 
                        if($purchaseOrderData['PurchaseOrder']['status'] == 8){ 
                            echo "<span class='label label-default'>Waiting</span>";
                        }
                        if($purchaseOrderData['PurchaseOrder']['status'] == 1){ 
                            echo "<span class='label label-success'>Approved</span>";
                        }
                    ?>
                </td>
                <td style="width:230px;">Version : <?php echo $purchaseOrderData['PurchaseOrder']['version']; ?></th>
                <td style="width:150px;" class="border-bot">Total : PHP <?php echo number_format($total,2)?></th>
            </tr>
        </table>

		<table class="table" style =" border:1px solid black;line-height: 13px; padding:0px; width:751px;">
            <tr>
                <td style="width:300px;">

			<font size="2">Note : <?php echo $purchaseOrderData['PurchaseOrder']['remarks']; ?></font>
			 <br><br>          
				</td>
			</tr>
		</table>

		<table class="layout" style ="line-height: 13px; border:1px solid black; width:751px; padding:0px;">
			<thead>
				<tr>
					<td class="td-heigth" style="width:250px;border:1px solid #FFF;">Requested by : <?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></td>
					<td class="td-heigth" style="width:252px;border:1px solid #FFF;">Approved by : </td>
					<td class="td-heigth" style="width:172px;border:1px solid #FFF;">Purchase by : </td>
				</tr>
			</thead>
		</table>

	</div>


<div class="one" style = "height: 48%;">
		<table class="layout" style =" padding:0px; border:1px solid black; width:751px;">
			<tr>
			<td>
				<center>
					<label style = "margin-top:0px; font-size: 25px;">Kou Fu Packaging Corporation</label><br>
					<label style = "margin-top:0px; font-size: 15px;">Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</label><br>
					<label style = "margin-top:0px; font-size: 15px;">Tel: +63(2)5844928 &nbsp; Fax: +63(2)5844952</label>
				</center>
			</td>
			</tr>			
		</table>

		<table class="layout" style ="line-height: 13px; padding:0px; border:1px solid black;">
			<thead>
				<tr>
					<td style="width:290px;">PURCHASE ORDER</td>
					<td style="width:270px;">Date : <?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?></td>
					<td style="width:175px;">PO No. : 
						<?php echo $purchaseOrderData['PurchaseOrder']['po_number']; ?>
					</td>
				</tr>
			</thead>
		</table>

		<table class="layout" style ="line-height: 13px; width:751px; padding:1px; border:1px solid black;" >
			<thead>
				<tr>
					<td style="width:80px;">Supplier </td>
					<td style="width:180px;" class="border-bot">:<?php echo ucfirst($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]); ?></td>
					<td style="width:45px;">Date :</td>
					<td style="width:160px;" class="border-bot">
						<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?>
					</td>
					<td style="width:120px;">Terms 
					</td>
					<td style="width:120px;" class="border-bot">:<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
					</td>
				</tr>
				<tr>
					<td style="width:70px;" >Contact </td>
					<td style="width:150px;" class="border-bot">:<?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']); ?> <?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
					<td style="width:40px;">Tel# :</td>
					<td style="width:90px;" class="border-bot">
						<?php echo $purchaseOrderData['Contact']['number']; ?>
					</td>
					<td style="width:40px;">Delivery Date 
					</td>
					<td style="width:50px;" class="border-bot">:<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['delivery_date'])); ?>	
					</td>
				</tr>
			</thead>
		</table>
						
		<table class="item-table" style ="line-height:1.6; height: 300px; padding:0px; width:751px; margin:0px;table-layout: fixed; display: table" >
			<thead>
				<tr>
					<td class="td-heigth" style=" vertical-align: center;width:2%;border:1px solid black;">#</td>
					<td class="td-heigth" style=" border:1px solid black;width:314px"><center><b>Item Description</b></center></td>
					<td class="td-heigth" style=" vertical-align: center;  border:1px solid black;"><center><b>Quantity</b></center></td>
					<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center><b>Unit Price</b></center></td>
					<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center><b>Amount</b></center></td>
				</tr>
				<?php $total = 0; $addRow2 = 8; foreach ($purchaseItemData as $key => $value) {  $key++; $addRow2 = $addRow2 - 1; ?>
					<tr>
						<td class="" style="width:2%; border:1px solid black; "><?php echo $key ?></td>
						<?php $lengthName = strlen($value[$modelTable]['name'])?>

						
						<?php if($lengthName >= 35 && $lengthName <= 70){ ?>

							<td class="td-heigth; border:1px solid black;" ><span style="font-size:90% !important; word-spacing: 0px;white-space: nowrap;  "><center><?php echo $value[$modelTable]['name']?></center></td>

						<?php } else if($lengthName >= 70) { ?>

							<td class="td-heigth" style = "border:1px solid black;width:200px;word-wrap: break-word;" ><span style="font-size:65%"; ><center><?php echo $value[$modelTable]['name']?></center></td>

						<?php }else{ ?>

							<td class="td-heigth;" style="border:1px solid black;" ><span style=" font-size:100%; height:10px !important; white-space:nowrap;padding:0;margin:0"; ><center><?php echo $value[$modelTable]['name']?></center></td>

						<?php } ?>


						<!-- <td class="td-heigth" style = "<?php echo strlen($value[$modelTable]['name']) > 3  ? 'font-size: 10% !important' : ''; ?>" ><span style="word-wrap: break-word; width:100px;font-size:65%;"; ><center><?php echo $value[$modelTable]['name']?></center></td> -->

						

						<td class="td-heigth" style="border:1px solid black;"><center><?php echo $value[$modelTable]['quantity']?>/<?php echo $unitData[$value[$modelTable]['quantity_unit_id']]?></center></td>
						<td class="td-heigth" style="border:1px solid black;"><center><?php echo number_format($value[$modelTable]['unit_price'],2)?>/<?php echo $unitData[$value[$modelTable]['unit_price_unit_id']]?></center></td>
						<td class="td-heigth" style="border:1px solid black;">
							<center>
								<?php 
                                    $amount = $value[$modelTable]['quantity'] * $value[$modelTable]['unit_price'];
                                    echo number_format($amount,2)."/".$unitData[$value[$modelTable]['unit_price_unit_id']];

                                    $total = $total + $amount;
                                ?>
							</center>
						</td>
					</tr>
				<?php } ?>
				<!-- <tr>
					<td class="td-heigth" style="width:10px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					<td class="td-heigth" style="width:310px;border:1px solid #EAEAEA;"><center>------END------</center></td>
					<td class="td-heigth" style="width:128px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					<td class="td-heigth" style="width:140px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					<td class="td-heigth" style="width:140px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
				</tr> -->
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

		<table class="table" style ="width: 751px; border:1px solid black;line-height: 13px; padding:0px;">
            <tr>
                <td style="width:300px;">
                    <?php 
                        if($purchaseOrderData['PurchaseOrder']['status'] == 8){ 
                            echo "<span class='label label-default'>Waiting</span>";
                        }
                        if($purchaseOrderData['PurchaseOrder']['status'] == 1){ 
                            echo "<span class='label label-success'>Approved</span>";
                        }
                    ?>
                </td>
                <td style="width:230px;">Version : <?php echo $purchaseOrderData['PurchaseOrder']['version']; ?></th>
                <td style="width:150px;" class="border-bot">Total : PHP <?php echo number_format($total,2)?></th>
            </tr>
        </table>

		<table class="table" style =" border:1px solid black;line-height: 13px; padding:0px; width:751px;">
            <tr>
                <td style="width:300px;">

			<font size="2">Note : <?php echo $purchaseOrderData['PurchaseOrder']['remarks']; ?></font>
			 <br><br>          
				</td>
			</tr>
		</table>

		<table class="layout" style ="line-height: 13px; border:1px solid black; width:751px; padding:0px;">
			<thead>
				<tr>
					<td class="td-heigth" style="width:250px;border:1px solid #FFF;">Requested by : <?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></td>
					<td class="td-heigth" style="width:252px;border:1px solid #FFF;">Approved by : </td>
					<td class="td-heigth" style="width:172px;border:1px solid #FFF;">Purchase by : </td>
				</tr>
			</thead>
		</table>

	</div>

<br><br>

<?php for ($i=0; $i < 2; $i++) { ?>
	<div class="one" style = "height: 48%;">
		<table class="layout" style =" padding:0px; border:1px solid black; width:751px;">
			<tr>
			<td>
				<center>
					<label style = "margin-top:0px; font-size: 25px;">Kou Fu Packaging Corporation</label><br>
					<label style = "margin-top:0px; font-size: 15px;">Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</label><br>
					<label style = "margin-top:0px; font-size: 15px;">Tel: +63(2)5844928 &nbsp; Fax: +63(2)5844952</label>
				</center>
			</td>
			</tr>			
		</table>

		<table class="layout" style ="line-height: 13px; padding:0px; border:1px solid black;">
			<thead>
				<tr>
					<td style="width:290px;">PURCHASE ORDER</td>
					<td style="width:270px;">Date : <?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?></td>
					<td style="width:175px;">PO No. : 
						<?php echo $purchaseOrderData['PurchaseOrder']['po_number']; ?>
					</td>
				</tr>
			</thead>
		</table>

		<table class="layout" style ="line-height: 13px; width:751px; padding:1px; border:1px solid black;" >
			<thead>
				<tr>
					<td style="width:80px;">Supplier </td>
					<td style="width:180px;" class="border-bot">:<?php echo ucfirst($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]); ?></td>
					<td style="width:45px;">Date :</td>
					<td style="width:160px;" class="border-bot">
						<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?>
					</td>
					<td style="width:120px;">Terms 
					</td>
					<td style="width:120px;" class="border-bot">:<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
					</td>
				</tr>
				<tr>
					<td style="width:70px;" >Contact </td>
					<td style="width:150px;" class="border-bot">:<?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']); ?> <?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
					<td style="width:40px;">Tel# :</td>
					<td style="width:90px;" class="border-bot">
						<?php echo $purchaseOrderData['Contact']['number']; ?>
					</td>
					<td style="width:40px;">Delivery Date 
					</td>
					<td style="width:50px;" class="border-bot">:<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['delivery_date'])); ?>	
					</td>
				</tr>
			</thead>
		</table>
						
		<table class="item-table" style ="line-height:1.6; height: 300px; padding:0px; width:751px; margin:0px;table-layout: fixed; display: table" >
			<thead>
				<tr>
					<td class="td-heigth" style=" vertical-align: center;width:2%;border:1px solid black;">#</td>
					<td class="td-heigth" style=" border:1px solid black;width:314px"><center><b>Item Description</b></center></td>
					<td class="td-heigth" style=" vertical-align: center;  border:1px solid black;"><center><b>Quantity</b></center></td>
					<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center><b>Unit Price</b></center></td>
					<td class="td-heigth" style="vertical-align: center;border:1px solid black;"><center><b>Amount</b></center></td>
				</tr>
				<?php $total = 0; $addRow2 = 8; foreach ($purchaseItemData as $key => $value) {  $key++; $addRow2 = $addRow2 - 1; ?>
					<tr>
						<td class="" style="width:2%; border:1px solid black; "><?php echo $key ?></td>
						<?php $lengthName = strlen($value[$modelTable]['name'])?>

						
						<?php if($lengthName >= 35 && $lengthName <= 70){ ?>

							<td class="td-heigth; border:1px solid black;" ><span style="font-size:90% !important; word-spacing: 0px;white-space: nowrap;  "><center><?php echo $value[$modelTable]['name']?></center></td>

						<?php } else if($lengthName >= 70) { ?>

							<td class="td-heigth" style = "border:1px solid black;width:200px;word-wrap: break-word;" ><span style="font-size:65%"; ><center><?php echo $value[$modelTable]['name']?></center></td>

						<?php }else{ ?>

							<td class="td-heigth;" style="border:1px solid black;" ><span style=" font-size:100%; height:10px !important; white-space:nowrap;padding:0;margin:0"; ><center><?php echo $value[$modelTable]['name']?></center></td>

						<?php } ?>


						<!-- <td class="td-heigth" style = "<?php echo strlen($value[$modelTable]['name']) > 3  ? 'font-size: 10% !important' : ''; ?>" ><span style="word-wrap: break-word; width:100px;font-size:65%;"; ><center><?php echo $value[$modelTable]['name']?></center></td> -->

						

						<td class="td-heigth" style="border:1px solid black;"><center><?php echo $value[$modelTable]['quantity']?>/<?php echo $unitData[$value[$modelTable]['quantity_unit_id']]?></center></td>
						<td class="td-heigth" style="border:1px solid black;"><center><?php echo number_format($value[$modelTable]['unit_price'],2)?>/<?php echo $unitData[$value[$modelTable]['unit_price_unit_id']]?></center></td>
						<td class="td-heigth" style="border:1px solid black;">
							<center>
								<?php 
                                    $amount = $value[$modelTable]['quantity'] * $value[$modelTable]['unit_price'];
                                    echo number_format($amount,2)."/".$unitData[$value[$modelTable]['unit_price_unit_id']];

                                    $total = $total + $amount;
                                ?>
							</center>
						</td>
					</tr>
				<?php } ?>
				<!-- <tr>
					<td class="td-heigth" style="width:10px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					<td class="td-heigth" style="width:310px;border:1px solid #EAEAEA;"><center>------END------</center></td>
					<td class="td-heigth" style="width:128px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					<td class="td-heigth" style="width:140px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					<td class="td-heigth" style="width:140px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
				</tr> -->
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

		<table class="table" style ="width: 751px; border:1px solid black;line-height: 13px; padding:0px;">
            <tr>
                <td style="width:300px;">
                    <?php 
                        if($purchaseOrderData['PurchaseOrder']['status'] == 8){ 
                            echo "<span class='label label-default'>Waiting</span>";
                        }
                        if($purchaseOrderData['PurchaseOrder']['status'] == 1){ 
                            echo "<span class='label label-success'>Approved</span>";
                        }
                    ?>
                </td>
                <td style="width:230px;">Version : <?php echo $purchaseOrderData['PurchaseOrder']['version']; ?></th>
                <td style="width:150px;" class="border-bot">Total : PHP <?php echo number_format($total,2)?></th>
            </tr>
        </table>

		<table class="table" style =" border:1px solid black;line-height: 13px; padding:0px; width:751px;">
            <tr>
                <td style="width:300px;">

			<font size="2">Note : <?php echo $purchaseOrderData['PurchaseOrder']['remarks']; ?></font>
			 <br><br>          
				</td>
			</tr>
		</table>

		<table class="layout" style ="line-height: 13px; border:1px solid black; width:751px; padding:0px;">
			<thead>
				<tr>
					<td class="td-heigth" style="width:250px;border:1px solid #FFF;">Requested by : <?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></td>
					<td class="td-heigth" style="width:252px;border:1px solid #FFF;">Approved by : </td>
					<td class="td-heigth" style="width:172px;border:1px solid #FFF;">Purchase by : </td>
				</tr>
			</thead>
		</table>

	</div>
<?php } ?>

