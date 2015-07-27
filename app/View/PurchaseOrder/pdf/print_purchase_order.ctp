
<style>
<?php include('word.css'); ?>

</style>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<center>
				<header class="main-box-header clearfix" >
					<h1 style="padding-bottom:10px;">Kou Fu Packaging Corporation</h1>
					<h5 style="padding-bottom:8px;">Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h5>
					<h6>
						Tel: +63(2)5844928 &nbsp; Fax: +63(2)5844952
						<!-- Tel: +63(46)4301576 / +63(46)9721111<br>
						+63(2)5844928 / +63(2)5844929<br>
						+63(2)5844947 Local: 302<br>

						Fax: +63(2)5844952 / +63(46)9720120<br>
						Mobile: +63(917)8922637<br>
						Taiwan: +886 922565185<br> -->
					</h6><br>
				</header>
			</center>

			<table class="layout">
				<thead>
					<tr>
						<td style="width:40px;">&nbsp;</td>
						<td style="width:40px;">&nbsp;</td>
						<td style="width:40px;">&nbsp;</td>
						<td style="width:350px;">&nbsp;</td>
						<td>PO No. : 
							<?php echo $purchaseOrderData['PurchaseOrder']['po_number']; ?>
						</td>
					</tr>
				</thead>
			</table>

			<table class="layout">
				<thead>
					<tr>
						<td style="width:40px;">Customer &nbsp;&nbsp; </td>
						<td style="width:260px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]); ?></td>
						<td style="width:40px;">Date :</td>
						<td style="width:130px;" class="border-bot">
							<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?>
						</td>
						<td>Terms &nbsp;&nbsp;
						</td>
						<td style="width:137px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>	
						</td>
					</tr>
				</thead>
			</table>

			<table class="layout">
				<thead>
					<tr>
						<td style="width:60px;" >Contact &nbsp;&nbsp; </td>
						<td style="width:260px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']); ?> <?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
						<td style="width:40px;">Tel# :</td>
						<td style="width:130px;" class="border-bot">
							<?php echo $purchaseOrderData['Contact']['number']; ?>
						</td>
						<td>Delivery Date &nbsp;&nbsp;
						</td>
						<td style="width:99px;" class="border-bot">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['delivery_date'])); ?>	
						</td>
					</tr>
				</thead>
			</table>
			<br>
			<table class="layout">
				<thead>
					<tr>
						<td class="td-heigth" style="width:20px;border:1px solid #EAEAEA;">&nbsp;&nbsp;#</td>
						<td class="td-heigth" style="width:260px;border:1px solid #EAEAEA;font-family: Tahoma, Helvetica, Arial, "Microsoft Yahei","微软雅黑", STXihei, "华文细黑", sans-serif;"><center><b>ITEM DESCRIPTION</b></center></td>
						<td class="td-heigth" style="width:127px;border:1px solid #EAEAEA;"><center><b>QUANTITY/UNIT</b></center></td>
						<td class="td-heigth" style="width:127px;border:1px solid #EAEAEA;"><center><b>UNIT PRICE</b></center></td>
						<td class="td-heigth" style="width:127px;border:1px solid #EAEAEA;"><center><b>AMOUNT</b></center></td>
					</tr>
					<?php $total = 0; foreach ($purchaseItemData as $key => $value) {  $key++ ?>
						<tr>
							<td class="td-heigth" style="width:20px;border:1px solid #EAEAEA;">&nbsp;&nbsp;<?php echo $key ?></td>
							<td class="td-heigth" style="width:260px;border:1px solid #EAEAEA;"><center><?php echo $value['PurchasingItem']['name']?></center></td>
							<td class="td-heigth" style="width:127px;border:1px solid #EAEAEA;"><center><?php echo $value['PurchasingItem']['quantity']?>/<?php echo $unitData[$value['PurchasingItem']['quantity_unit_id']]?></center></td>
							<td class="td-heigth" style="width:127px;border:1px solid #EAEAEA;"><center><?php echo number_format($value['PurchasingItem']['unit_price'],2)?>/<?php echo $unitData[$value['PurchasingItem']['unit_price_unit_id']]?></center></td>
							<td class="td-heigth" style="width:127px;border:1px solid #EAEAEA;">
								<center>
									<?php 
                                        $amount = $value['PurchasingItem']['quantity'] * $value['PurchasingItem']['unit_price'];
                                        echo number_format($amount,2)."/".$unitData[$value['PurchasingItem']['unit_price_unit_id']];

                                        $total = $total + $amount;
                                    ?>
								</center>
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td class="td-heigth" style="width:20px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
						<td class="td-heigth" style="width:260px;border:1px solid #EAEAEA;"><center>------END------</center></td>
						<td class="td-heigth" style="width:127px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
						<td class="td-heigth" style="width:127px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
						<td class="td-heigth" style="width:127px;border:1px solid #EAEAEA;">&nbsp;&nbsp;</td>
					</tr>
				</thead>
			</table>

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
                    <td style="width:270px;">Version : <?php echo $purchaseOrderData['PurchaseOrder']['version']; ?></th>
                    <td style="width:205px;" class="border-bot">Total : PHP <?php echo number_format($total,2)?></th>
                </tr>
            </table>

            <table class="layout">
				<thead>
					<tr>
						<td class="td-heigth" style="width:223px;border:1px solid #EAEAEA;"><center><b>REQUESTED BY :</b></center></td>
						<td class="td-heigth" style="width:223px;border:1px solid #EAEAEA;"><center><b>APPROVED BY :</b></center></td>
						<td class="td-heigth" style="width:223px;border:1px solid #EAEAEA;"><center><b>PURCHASE BY :</b></center></td>
					</tr>
					<tr>
						<td class="td-heigth" style="width:223px;border:1px solid #EAEAEA;"><center><?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></center></td>
						<td class="td-heigth" style="width:223px;border:1px solid #EAEAEA;"> </td>
						<td class="td-heigth" style="width:223px;border:1px solid #EAEAEA;"> </td>
					</tr>
				</thead>
			</table>

		</div>
	</div>
</div>