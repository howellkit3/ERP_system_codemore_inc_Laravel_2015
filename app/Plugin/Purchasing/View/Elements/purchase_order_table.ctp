<?php  foreach ($purchaseOrderData as $purchaseOrderDataList ): ?>
    

        <tr class="">

            <td class="">
                PUO-<?php echo ucfirst($purchaseOrderDataList['PurchaseOrder']['po_number']) ?>
            </td>

            <td class="">
                PR-<?php echo ucfirst($purchaseOrderDataList['Request']['uuid']) ?>
            </td>

            <td class="">
                <?php echo !empty($supplierData[$purchaseOrderDataList['PurchaseOrder']['supplier_id']]) ? ucfirst(substr($supplierData[$purchaseOrderDataList['PurchaseOrder']['supplier_id']],0,20)) : $purchaseOrderDataList['PurchaseOrder']['supplier_id']?>..
            </td>

            <td class="">
                <?php echo ucfirst($userName[$purchaseOrderDataList['PurchaseOrder']['created_by']]) ?>
            </td>

            <td class="text-center">
                <?php 
                    if($purchaseOrderDataList['PurchaseOrder']['status'] == 8){ 
                        echo "<span class='label label-default'>Waiting</span>";
                    }

                    else if($purchaseOrderDataList['PurchaseOrder']['status'] == 1){ 
                        echo "<span class='label label-warning'>Approved</span>";
                    }

                    else{
                        echo "<span class='label label-success'>Received</span>";
                    }
                ?>
            </td>

            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array('controller' => 'purchase_orders', 'action' => 'view',$purchaseOrderDataList['PurchaseOrder']['id']),array('class' =>' table-link','escape' => false,'title'=>'Review Purchase Order'));
                ?>

                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Remove </font></span>
                    </span>', array('controller' => 'purchase_orders', 'action' => 'delete',$purchaseOrderDataList['PurchaseOrder']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Remove P.O.','confirm' => 'Do you want to delete this Purchase Order ?'));
                ?>
                
            </td>
        </tr>

<?php endforeach; ?> 