<?php foreach ($stockData as $stockTableList ): ?>
    
        <tr class="">

            <td class="text-center">
                <?php echo 'WIO' . ucfirst($stockTableList['Stock']['uuid']) ?>  
            </td>

            <td class="text-center">
                <?php echo $stockTableList['Stock']['name'] ?>  
            </td>


            <td class="text-center">
                <?php echo ucfirst($stockTableList['Stock']['quantity']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($areaData[$stockTableList['Stock']['location_id']]) ?>
            </td>

           <!--  <td class="">
               <?php echo "<span class='label label-success'>:)</span>"; ?>
            </td> -->

            <td align = "center">

                <?php echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View</font></span>
                          </span> ', array('controller' => 'warehouse_requests', 'action' => 'stock_view', $stockTableList['Stock']['id']),array('class' =>' table-link ','escape' => false,'title'=>'Print Transmittal Receipt')); ?>

            </td>

            
        </tr>

<?php endforeach; ?> 

