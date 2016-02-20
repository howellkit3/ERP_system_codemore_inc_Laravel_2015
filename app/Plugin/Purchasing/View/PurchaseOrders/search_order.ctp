<div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                               <!--  <th>Purchase Order No</th> -->
                                <th>Purchase Order No.</th>
                                <th>Request No.</th>
                                <th>Supplier</th>
                                <th>Prepared by</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody aria-relevant="all" aria-live="polite" class="requestFields" role="alert" >
        <?php if(!empty($purchaseOrderData)) : ?>                     
      <?php  foreach ($purchaseOrderData as $purchaseOrderDataList ): ?>
    

        <tr class="">

            <td class="">

                <?php echo ucfirst($purchaseOrderDataList['PurchaseOrder']['po_number']) ?>

            </td>

            <td class="">

                <?php echo ucfirst($purchaseOrderDataList['Request']['uuid']) ?>
            
            </td>

            <td class="">
                
                <?php echo !empty($supplierData[$purchaseOrderDataList['PurchaseOrder']['supplier_id']]) ? ucfirst($supplierData[$purchaseOrderDataList['PurchaseOrder']['supplier_id']]) : $purchaseOrderDataList['PurchaseOrder']['supplier_id']; ?>
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
               
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i>
                    // <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    // </span> ', array('controller' => 'customer_sales', 'action' => 'edit',$inquirylist['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>
             
                
            </td>
        </tr>

<?php endforeach; ?> 
     <?php else : ?>
        <tr>
            <td colspan="6">   <span style="color:red">No Result </span> </td>
         </tr>   
      
     <?php endif; ?>
    </tbody>
    <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
    </tbody>

   
        
 </table>
<hr>
</div>
