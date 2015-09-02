<?php $this->Html->addCrumb('Purchase Order', array('controller' => 'purchase_orders', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'purchase_orders', 'action' => 'view',$purchaseOrderid)); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="filter-block pull-right">
                    
    <?php 
        
        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'purchase_orders', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));

        if ($purchaseOrderData['PurchaseOrder']['status'] == 8) {

            echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i> Approved', array('controller' => 'purchase_orders', 'action' => 'approved',$purchaseOrderid),array('class' =>'btn btn-primary pull-right','escape' => false));

            echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit', array('controller' => 'purchase_orders', 'action' => 'edit',$purchaseOrderid),array('class' =>'btn btn-primary pull-right','escape' => false));
        }

        echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print', array('controller' => 'purchase_orders', 'action' => 'print_purchase_order',$purchaseOrderid),array('class' =>'btn btn-primary pull-right','escape' => false,'target' => '_blank'));
    ?>
    <br><br>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            <center>
            <table  width="100%" >
                <tr>
                    <td >
                        <center>
                        <!-- <img src="<?php echo Router::url('/', true) ?>img/koufu_logo.png" alt="logo" style="width:165px;height:30px;">  -->
                        <img src="<?php echo Router::url('/', true) ?>img/koufu_logo.jpg" alt="logo" style="width:225px;height:60px;padding-bottom:10;"><br>
                                <label style = "margin-top:0px; font-size: 12px;">Lot 4-5 Blk 4 Mountview Industrial Complex<br>
                                Brgy. Bancal Carmona Cavite<br>
                                Tel: +632-5844928; &nbsp; +6346-4301576 &nbsp; Fax: +632-5844952</label>
                        </center>
                    </td>
                    <td width = "55%">
                        
                            <h1 style = "margin-bottom:0px; margin-top:0px; margin-bottom:30px; padding-top:0px;"><b>PURCHASE ORDER </b></h1>
                            &emsp;&emsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            PO No  : <u><?php echo $purchaseOrderData['PurchaseOrder']['po_number']; ?></u>
                        
                    </td>
                </tr>   
            </table>

            <br><br>

            <table  width = "100%" style="margin-left:2%;" >
                
                    <tr>
                        <td align = "left" width = "25%">Supplier </td>
                        <td align = "left" width = "25%">:<?php echo ucfirst($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]); ?></td>
                         
                        <td align = "left" width = "25%">Date </td>
                        <td align = "left" width = "25%">:<?php echo (new \DateTime())->format('M d, Y') ?>
                        </td>
                    </tr>
            </table>

            <table  width = "100%" style="margin-left:2%;" >
                    <tr>
                        <td align = "left" width = "25%">Contact Person</td>
                        <td align = "left" width = "25%">:<?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']); ?> <?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?></td>
                        
                        <td align = "left" width = "25%">Terms </td>
                        <td align = "left" width = "25%">:<?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?>   
                        </td>
                        
                    </tr>
                
            </table>

            <table  width = "100%"  style="margin-left:2%;">
                    <tr>
                        <td align = "left" width = "25%">Telephone</td>
                        <td align = "left" width = "25%">:<?php echo $purchaseOrderData['Contact']['number']; ?></td>
                         
                        <td align = "left" width = "25%">Delivery Date:</td>
                        <td align = "left" width = "25%">:<?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['delivery_date'])); ?> 
                        </td>
                        
                    </tr>
                </thead>
            </table>

            <br><br>

            <div class="main-box-body clearfix">
            
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th class="text-center">Item Decription</th>
                            <th class="text-center">Quantity/Unit</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Amount</th>
                        </thead>
                        <?php  $total = 0; foreach ($purchaseItemData as $key => $value) {  $key++ ?>
                            <tr>
                               <?php  $dividend = floor($value[$modelTable]['quantity'] / $value[$modelTable]['pieces']);
                                $difference = $value[$modelTable]['quantity'] - (floor($dividend) * $value[$modelTable]['pieces']); ?>

                                <td><?php echo $key ?></td>
                                <td class="text-center"><?php echo $value[$modelTable]['name']?></td>
                                <td class="text-center"><?php echo ($difference == 0 ?  $dividend . " x " . $value[$modelTable]['pieces'] . " " . $unitData[$value[$modelTable]['quantity_unit_id']] : $dividend . " x " . $value[$modelTable]['pieces'] . " + " . $difference . " " . $unitData[$value[$modelTable]['quantity_unit_id']])?></td>
                                <td class="text-center"><?php echo number_format($value[$modelTable]['unit_price'],2)?><?php //echo $unitData[$value[$modelTable]['unit_price_unit_id']]?></td>
                                <td class="text-center">
                                    <?php 
                                        $amount = $value[$modelTable]['quantity'] * $value[$modelTable]['unit_price'];
                                        echo number_format($amount,2)."/".$unitData[$value[$modelTable]['unit_price_unit_id']];

                                        $total = $total + $amount;
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td> </td>
                            <td class="text-center">------END------</td>
                            <td class="text-center"> </td>
                            <td class="text-center"> </td>
                            <td class="text-center"> </td>
                        </tr>
                         <tr>
                            <td> </td>
                            <td class="text-center"></td>
                            <td class="text-center"> </td>
                            <td class="text-center"> </td>
                            <td class="text-center"><b>Total : PHP <?php echo number_format($total,2)?></b></td>
                        </tr>
                    </table>

                    <!-- <table width = "100%">
                        <thead>
                            <th width = "33%">
                                <?php 
                                    if($purchaseOrderData['PurchaseOrder']['status'] == 8){ 
                                        echo "<span class='label label-default'>Waiting</span>";
                                    }
                                    if($purchaseOrderData['PurchaseOrder']['status'] == 1){ 
                                        echo "<span class='label label-success'>Approved</span>";
                                    }
                                    if($purchaseOrderData['PurchaseOrder']['status'] == 11){ 
                                        echo "<span class='label label-success'>Received</span>";
                                    }
                                ?>
                            </th>
                            <th width = "33%">Version : <?php //echo $purchaseOrderData['PurchaseOrder']['version']; ?></th> 

                            <th width = "21%"</th>
                            <th width = "33%" align="right"></th>
                        </thead>
                    </table> -->
                   <div style = " margin-left:0;"class="col-lg-1">
                    Note/s : <?php echo ucfirst($purchaseOrderData['PurchaseOrder']['remarks']); ?><br><br>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <th class="text-center">Requested by :</th>
                            <th class="text-center">Approved by :</th>
                            <th class="text-center">Purchased by :</th>
                            </thead>
                        <tr>
                            <td class="text-center"><?php echo ucfirst($preparedData['User']['first_name'])?> <?php echo ucfirst($preparedData['User']['last_name'])?></td>
                            <td class="text-center">Shou Yi Yu</td>
                            <td class="text-center"> </td>
                        </tr>
                    </table>

                    <div class = " pull-right ">
                    <label style = "font-size:60%;">
                         <center>KP-FR-LG1-001 R0 <br>Effective Date: 10 Aug 2015 </center>
                    </label>
                    </div> 
                </div>

            </div>

        </div>
    </div>
</div>