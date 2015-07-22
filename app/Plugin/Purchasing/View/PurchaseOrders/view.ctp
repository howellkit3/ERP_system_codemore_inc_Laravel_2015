<?php $this->Html->addCrumb('Purchase Order', array('controller' => 'purchase_orders', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'purchase_orders', 'action' => 'view',$purchaseOrderid)); ?>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="filter-block pull-right">
                    
    <?php 
        
        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'purchase_orders', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));

        if ($purchaseOrderData['PurchaseOrder']['status'] == 8) {

            echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i> Approved', array('controller' => 'purchase_orders', 'action' => 'approved',$purchaseOrderid),array('class' =>'btn btn-primary pull-right','escape' => false));

        }

        echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit', array('controller' => 'purchase_orders', 'action' => 'edit',$purchaseOrderid),array('class' =>'btn btn-primary pull-right','escape' => false));

        //echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print', array('controller' => 'purchase_orders', 'action' => 'print'),array('class' =>'btn btn-primary pull-right','escape' => false));
    ?>
    <br><br>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            <center>
                <header class="main-box-header clearfix"><?php //echo pr($contactInfo);die; ?>
                    <h1>Kou Fu Packaging Corporation</h1>
                    <h5>Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h5>
                    <h6>
                        Tel: +63(2)5844928  &emsp;Fax: +63(2)5844952
                    </h6><br>
                    <b><h2>Purchase Order Slip</h2></b>
                    <br>
                </header>
            </center>

            <div class="main-box-body clearfix">
                <form class="form-horizontal" role="form">
                    
                    <div class="form-group">
                        
                        <div class="col-lg-6">
                            &emsp;&emsp;
                        </div>
                        <div class="col-lg-3">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
                            
                        </div>
                        <div class="col-lg-3">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
                            PO No  : <u>RQO<?php echo $purchaseOrderData['PurchaseOrder']['po_number']; ?></u>
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-lg-2">
                            &emsp;&emsp;Supplier
                        </div>
                        <div class="col-lg-4">
                            :&emsp;<?php echo ucfirst($supplierData[$purchaseOrderData['PurchaseOrder']['supplier_id']]); ?>
                            
                        </div>
                        <div class="col-lg-3">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
                            Date : <u><?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['created'])); ?></u>
                        </div>
                        <div class="col-lg-3">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
                            Terms  : <u><?php echo $paymentTermData[$purchaseOrderData['PurchaseOrder']['payment_term']]; ?></u>
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-lg-2">
                            &emsp;&emsp;Contact
                        </div>
                        <div class="col-lg-4">
                            :&emsp;<?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['firstname']); ?> <?php echo ucfirst($purchaseOrderData['SupplierContactPerson']['lastname']); ?>
                            
                        </div>
                        <div class="col-lg-3">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
                            Tel# : <u><?php echo $purchaseOrderData['Contact']['number']; ?></u>
                        </div>
                        <div class="col-lg-3">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
                            Delivery Date  : <u><?php echo date('M d, Y', strtotime($purchaseOrderData['PurchaseOrder']['delivery_date'])); ?></u>
                        </div>
                    </div>
                    
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th class="text-center">Item Decription</th>
                            <th class="text-center">Quantity/Unit</th>
                            <th class="text-center">Remarks</th>
                        </thead>
                        <?php foreach ($purchaseItemData as $key => $value) {  $key++ ?>
                            <tr>
                                <td><?php echo $key ?></td>
                                <td class="text-center"><?php echo $value['PurchasingItem']['name']?></td>
                                <td class="text-center"><?php echo $value['PurchasingItem']['quantity']?>/<?php echo $unitData[$value['PurchasingItem']['quantity_unit_id']]?></td>
                                <td class="text-center"> </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td> </td>
                            <td class="text-center">------END------</td>
                            <td class="text-center"> </td>
                            <td class="text-center"> </td>
                        </tr>
                    </table>

                    <table class="table">
                        <thead>
                            <th class="">
                                <?php 
                                    if($purchaseOrderData['PurchaseOrder']['status'] == 8){ 
                                        echo "<span class='label label-default'>Waiting</span>";
                                    }
                                ?>
                            </th>
                            <th class="">Version : <?php echo $purchaseOrderData['PurchaseOrder']['version']; ?></th>
                            <th class="">Total : </th>
                        </thead>
                    </thead>
                   
                    Note : <?php echo ucfirst($purchaseOrderData['PurchaseOrder']['remarks']); ?><br><br>
                    
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
                </div>

            </div>

        </div>
    </div>
</div>