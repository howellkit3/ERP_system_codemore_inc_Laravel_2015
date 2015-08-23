<?php foreach ($stock_table as $stockTableList ): ?>
    
        <tr class="">

            <td class="">
                <?php echo 'WIO' . ucfirst($stockTableList['Stock']['uuid']) ?>  
            </td>

            <td class="">
                <?php echo $stockTableList['Stock']['item_id'] ?>  
            </td>

            <td class="">
                <?php echo ucfirst($supplierData[$stockTableList['Stock']['supplier_id']]) ?>
            </td>

            <td class="">
                <?php echo ucfirst($stockTableList['Stock']['quantity']) ?>
            </td>

            <td class="">
                <?php echo ucfirst($stockTableList['Stock']['location_id']) ?>
            </td>

            <td class="">
                <?php echo date('M d, Y', strtotime($stockTableList['Stock']['created'])) ?>
            </td>

            <td align = "center">

                <?php echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View</font></span>
                          </span> ', array('controller' => 'receivings', 'action' => 'view', $stockTableList['Stock']['id']),array('class' =>' table-link ','escape' => false,'title'=>'Print Transmittal Receipt')); ?>

   

            </td>

        
        </tr>

<?php endforeach; ?> 

