<?php  foreach ($purchaseOrderData as $purchaseOrderDataList ): ?>
    
        <tr class="">

            <!-- <td class="">
                <?php echo ucfirst($purchaseOrderDataList['PurchaseOrder']['uuid']) ?>  
            </td> -->

            <td class="">

                <?php echo ucfirst($purchaseOrderDataList['PurchaseOrder']['po_number']) ?>

            </td> 

            <td class="">
                <?php echo ucfirst($supplierData[$purchaseOrderDataList['PurchaseOrder']['supplier_id']]) ?>
            </td>

            <td class="">
                <?php echo ucfirst($userName[$purchaseOrderDataList['PurchaseOrder']['created_by']]) ?>
            </td>


            <td class="text-center">
                <?php 
                    if($purchaseOrderDataList['PurchaseOrder']['status'] == 8){ 
                        echo "<span class='label label-default'>Waiting</span>";
                    }

                    if($purchaseOrderDataList['PurchaseOrder']['status'] == 1){ 
                        echo "<span class='label label-success'>Approved</span>";
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
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i>
                    // <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    // </span> ', array('controller' => 'customer_sales', 'action' => 'edit',$inquirylist['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>
             
                
            </td>
        </tr>
        
<?php endforeach; ?> 