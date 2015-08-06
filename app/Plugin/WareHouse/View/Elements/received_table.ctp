<?php foreach ($received_orders as $requestOrderDataList ): ?>
    

        <tr class="">

            <td class="">
                <?php echo 'RCV' . ucfirst($requestOrderDataList['ReceivedOrder']['uuid']) ?>  
            </td>

            <td class="">

                <?php echo ucfirst($requestOrderDataList['PurchaseOrder']['uuid']) ?>

            </td>

            <td class="">
                <?php echo ucfirst($supplierData[$requestOrderDataList['PurchaseOrder']['supplier_id']]) ?>
            </td>

            <td class="">
                <?php echo ucfirst($userName[$requestOrderDataList['ReceivedOrder']['received_by']]) ?>
            </td>

            <td class="">
                <?php echo date('M d, Y', strtotime($requestOrderDataList['ReceivedOrder']['created'])) ?>
            </td>

            <td class="">
                <?php if($requestOrderDataList['ReceivedOrder']['status_id'] == 11){

                    echo "<span class='label label-warning'>Received</span>"; 


                     }   ?>
            </td>

            <td>

                <?php echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View</font></span>
                          </span> ', array('controller' => 'receivings', 'action' => 'view', $requestOrderDataList['PurchaseOrder']['id']),array('class' =>' table-link ','escape' => false,'title'=>'Print Transmittal Receipt')); ?>

                <a data-toggle="modal" href="#myModalReceiving<?php echo $requestOrderDataList['ReceivedOrder']['id'] ?>" class="table-link "><i class="fa fa-lg "></i><span class="fa-stack">
                                  <i class="fa fa-square fa-stack-2x"></i>
                                  <i class="fa  fa-level-down fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Approve </font></span></a> 
            </td>
        </tr>



<?php endforeach; ?> 

