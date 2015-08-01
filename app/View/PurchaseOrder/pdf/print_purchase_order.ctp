
<style>
<?php include('word.css'); ?>

</style>

<?php for ($i=0; $i < 2; $i++) { ?>
	<div class="one">

		<div class="header">
			
			<center>
				<label style = "margin-top:0px; font-size: 16px;">Kou Fu Packaging Corporation</label><br>
				<label style = "margin-top:0px; font-size: 10px;">Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</label><br>
				<label style = "margin-top:0px; font-size: 10px;">Tel: +63(2)5844928 &nbsp; Fax: +63(2)5844952</label>
			</center>
						
		</div>

		<div class="purchase">

			<table class="layout">
				<thead>
					<tr>
						<td style="width:210px;">PURCHASE ORDER</td>
						<td style="width:190px;">Date : <?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?></td>
						<td>PO No. : 
							<?php echo $purchaseOrderData['PurchaseOrder']['po_number']; ?>
						</td>
					</tr>
				</thead>
			</table>

		</div>

		<div class="purchase">

			<table class="layout">
				<thead>
					<tr>
						<td style="width:70px;">Supplier </td>
						<td style="width:150px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]); ?></td>
						<td style="width:40px;">Date :</td>
						<td style="width:90px;" class="border-bot">
							<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?>
						</td>
						<td style="width:40px;">Terms &nbsp;&nbsp;
						</td>
						<td style="width:50px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
						</td>
					</tr>
					<tr>
						<td style="width:70px;" >Contact </td>
						<td style="width:150px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']); ?> <?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
						<td style="width:40px;">Tel# :</td>
						<td style="width:90px;" class="border-bot">
							<?php echo $purchaseOrderData['Contact']['number']; ?>
						</td>
						<td style="width:40px;">Delivery Date &nbsp;&nbsp;
						</td>
						<td style="width:50px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['delivery_date'])); ?>	
						</td>
					</tr>
				</thead>
			</table>
						
		</div>

		<div class="purchase">

			<table class="item-table">
				<thead>
					<tr>
						<td class="td-heigth" style="width:5px;border:1px solid #EAEAEA;">&nbsp;&nbsp;#</td>
						<td class="td-heigth" style="width:200px;border:1px solid #EAEAEA;font-family: Tahoma, Helvetica, Arial, "Microsoft Yahei","微软雅黑", STXihei, "华文细黑", sans-serif;"><center>Item Description</center></td>
						<td class="td-heigth" style="width:100px;border:1px solid #EAEAEA;"><center>Quantity</center></td>
						<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;"><center>Unit Price</center></td>
						<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;"><center>Amount</center></td>
					</tr>
					<?php $total = 0; $addRow2 = 8; foreach ($purchaseItemData as $key => $value) {  $key++; $addRow2 = $addRow2 - 1; ?>
						<tr>
							<td class="td-heigth" style="width:5px;border:1px solid #EAEAEA;">&nbsp;&nbsp;<?php echo $key ?></td>
							<td class="td-heigth" style="width:200px;border:1px solid #EAEAEA;"><center><?php echo $value[$modelTable]['name']?></center></td>
							<td class="td-heigth" style="width:100px;border:1px solid #EAEAEA;"><center><?php echo $value[$modelTable]['quantity']?>/<?php echo $unitData[$value[$modelTable]['quantity_unit_id']]?></center></td>
							<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;"><center><?php echo number_format($value[$modelTable]['unit_price'],2)?>/<?php echo $unitData[$value[$modelTable]['unit_price_unit_id']]?></center></td>
							<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;">
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
					<tr>
						<td class="td-heigth" style="width:5px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
						<td class="td-heigth" style="width:200px;border:1px solid #EAEAEA;"><center>------END------</center></td>
						<td class="td-heigth" style="width:100px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
						<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
						<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					</tr>
					<?php for ($i2=0; $i2 < $addRow2; $i2++) { ?>
						<tr>
							<td class="td-heigth" style="width:5px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:200px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:100px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
						</tr>
					<?php } ?>
				</thead>
			</table>

		</div>

		<div class="purchase">

			<table class="table">
	            <tr>
	                <td style="width:200px;">
	                    <?php 
	                        if($purchaseOrderData['PurchaseOrder']['status'] == 8){ 
	                            echo "<span class='label label-default'>Waiting</span>";
	                        }
	                        if($purchaseOrderData['PurchaseOrder']['status'] == 1){ 
	                            echo "<span class='label label-success'>Approved</span>";
	                        }
	                    ?>
	                </td>
	                <td style="width:170px;">Version : <?php echo $purchaseOrderData['PurchaseOrder']['version']; ?></th>
	                <td style="width:90px;" class="border-bot">Total : PHP <?php echo number_format($total,2)?></th>
	            </tr>
	        </table>

		</div>

		<div class="purchase">

			<font size="2">Note : <?php echo $purchaseOrderData['PurchaseOrder']['remarks']; ?></font>
			 <br><br>          
		</div>

		<div class="purchase">

			<table class="layout">
				<thead>
					<tr>
						<td class="td-heigth" style="width:172px;border:1px solid #FFF;">Requested by : <?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></td>
						<td class="td-heigth" style="width:172px;border:1px solid #FFF;">Approved by : </td>
						<td class="td-heigth" style="width:172px;border:1px solid #FFF;">Purchase by : </td>
					</tr>
				</thead>
			</table>
			            
		</div>

	</div>
<?php } ?>

<br><br>
<?php for ($i=0; $i < 2; $i++) { ?>
	<div class="one">

		<div class="header">
			
			<center>
				<label style = "margin-top:0px; font-size: 16px;">Kou Fu Packaging Corporation</label><br>
				<label style = "margin-top:0px; font-size: 10px;">Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</label><br>
				<label style = "margin-top:0px; font-size: 10px;">Tel: +63(2)5844928 &nbsp; Fax: +63(2)5844952</label>
			</center>
						
		</div>

		<div class="purchase">

			<table class="layout">
				<thead>
					<tr>
						<td style="width:210px;">PURCHASE ORDER</td>
						<td style="width:190px;">Date : <?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?></td>
						<td>PO No. : 
							<?php echo $purchaseOrderData['PurchaseOrder']['po_number']; ?>
						</td>
					</tr>
				</thead>
			</table>

		</div>

		<div class="purchase">

			<table class="layout">
				<thead>
					<tr>
						<td style="width:70px;">Supplier </td>
						<td style="width:150px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]); ?></td>
						<td style="width:40px;">Date :</td>
						<td style="width:90px;" class="border-bot">
							<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?>
						</td>
						<td style="width:40px;">Terms &nbsp;&nbsp;
						</td>
						<td style="width:50px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
						</td>
					</tr>
					<tr>
						<td style="width:70px;" >Contact </td>
						<td style="width:150px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']); ?> <?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
						<td style="width:40px;">Tel# :</td>
						<td style="width:90px;" class="border-bot">
							<?php echo $purchaseOrderData['Contact']['number']; ?>
						</td>
						<td style="width:40px;">Delivery Date &nbsp;&nbsp;
						</td>
						<td style="width:50px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['delivery_date'])); ?>	
						</td>
					</tr>
				</thead>
			</table>
						
		</div>

		<div class="purchase">

			<table class="item-table">
				<thead>
					<tr>
						<td class="td-heigth" style="width:5px;border:1px solid #EAEAEA;">&nbsp;&nbsp;#</td>
						<td class="td-heigth" style="width:200px;border:1px solid #EAEAEA;font-family: Tahoma, Helvetica, Arial, "Microsoft Yahei","微软雅黑", STXihei, "华文细黑", sans-serif;"><center>Item Description</center></td>
						<td class="td-heigth" style="width:100px;border:1px solid #EAEAEA;"><center>Quantity</center></td>
						<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;"><center>Unit Price</center></td>
						<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;"><center>Amount</center></td>
					</tr>
					<?php $total = 0; $addRow1 = 8; foreach ($purchaseItemData as $key => $value) {  $key++; $addRow1 = $addRow1 - 1; ?>
						<tr>
							<td class="td-heigth" style="width:5px;border:1px solid #EAEAEA;">&nbsp;&nbsp;<?php echo $key ?></td>
							<td class="td-heigth" style="width:200px;border:1px solid #EAEAEA;"><center><?php echo $value[$modelTable]['name']?></center></td>
							<td class="td-heigth" style="width:100px;border:1px solid #EAEAEA;"><center><?php echo $value[$modelTable]['quantity']?>/<?php echo $unitData[$value[$modelTable]['quantity_unit_id']]?></center></td>
							<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;"><center><?php echo number_format($value[$modelTable]['unit_price'],2)?>/<?php echo $unitData[$value[$modelTable]['unit_price_unit_id']]?></center></td>
							<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;">
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

					<tr>
						<td class="td-heigth" style="width:5px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
						<td class="td-heigth" style="width:200px;border:1px solid #EAEAEA;"><center>------END------</center></td>
						<td class="td-heigth" style="width:100px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
						<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
						<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					</tr>
					<?php for ($i1=0; $i1 < $addRow1; $i1++) { ?>
						<tr>
							<td class="td-heigth" style="width:5px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:200px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:100px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
							<td class="td-heigth" style="width:110px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
						</tr>
					<?php } ?>
				</thead>
			</table>

		</div>

		<div class="purchase">

			<table class="table">
	            <tr>
	                <td style="width:200px;">
	                    <?php 
	                        if($purchaseOrderData['PurchaseOrder']['status'] == 8){ 
	                            echo "<span class='label label-default'>Waiting</span>";
	                        }
	                        if($purchaseOrderData['PurchaseOrder']['status'] == 1){ 
	                            echo "<span class='label label-success'>Approved</span>";
	                        }
	                    ?>
	                </td>
	                <td style="width:170px;">Version : <?php echo $purchaseOrderData['PurchaseOrder']['version']; ?></th>
	                <td style="width:90px;" class="border-bot">Total : PHP <?php echo number_format($total,2)?></th>
	            </tr>
	        </table>

		</div>

		<div class="purchase">

			<font size="2">Note : <?php echo $purchaseOrderData['PurchaseOrder']['remarks']; ?></font>
			 <br><br>          
		</div>

		<div class="purchase">

			<table class="layout">
				<thead>
					<tr>
						<td class="td-heigth" style="width:172px;border:1px solid #FFF;">Requested by : <?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></td>
						<td class="td-heigth" style="width:172px;border:1px solid #FFF;">Approved by : </td>
						<td class="td-heigth" style="width:172px;border:1px solid #FFF;">Purchase by : </td>
					</tr>
				</thead>
			</table>
			            
		</div>

	</div>
<?php } ?>

