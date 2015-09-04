<?php foreach ($outRecordData as $key => $outRecordDataList ): ?>
        
        <tr class="">

            <td class="text-center">

                <?php echo $outRecordDataList['WarehouseRequest']['id']  ?>  
            </td>

            <td class="text-center">
                <?php echo $outRecordDataList['WarehouseRequest']['uuid'] ?>  
            </td>


            <td class="text-center">
                <?php echo ucfirst($outRecordDataList['OutRecord']['remarks']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($outRecordDataList['OutRecord']['created_by']) ?>
            </td>

           <!--  <td class="">
               <?php echo "<span class='label label-success'>:)</span>"; ?>
            </td> -->

             <td class="text-center">
                <?php echo date('M d, Y', strtotime($outRecordDataList['OutRecord']['created'])) ?>
            </td>

            <td align = "center">

                <?php echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View</font></span>
                          </span> ', array('controller' => 'warehouse_requests', 'action' => 'out_record_view', $outRecordDataList['OutRecord']['id']),array('class' =>' table-link ','escape' => false,'title'=>'Print Transmittal Receipt')); ?>

            </td>

            
        </tr>

<?php endforeach; ?> 

