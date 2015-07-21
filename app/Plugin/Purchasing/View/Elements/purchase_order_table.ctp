<?php  foreach ($purchaseOrderData as $purchaseOrderDataList ): ?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo ucfirst($purchaseOrderDataList['PurchaseOrder']['uuid']) ?>  
            </td>

            <td class="">

                <?php echo ucfirst($purchaseOrderDataList['PurchaseOrder']['po_number']) ?>

            </td>

            <td class="">
                <?php echo ucfirst($supplierData[$purchaseOrderDataList['PurchaseOrder']['supplier_id']]) ?>
            </td>

            <td>
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    //     <i class="fa fa-square fa-stack-2x"></i>
                    //     <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                    //     </span> ', array('controller' => 'requests', 'action' => 'purcahy',$requestList['Request']['id']),array('class' =>' table-link','escape' => false,'title'=>'Review Request'));
                ?>
               
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i>
                    // <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    // </span> ', array('controller' => 'customer_sales', 'action' => 'edit',$inquirylist['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>
             
                
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 