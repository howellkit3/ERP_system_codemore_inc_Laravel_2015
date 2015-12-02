<?php if(!empty($requestData)){

 foreach ($requestData as $requestList ): ?>


        <tr class="">

            <td class="">
                <?php echo ucfirst($requestList['WarehouseRequest']['uuid']) ?>  
            </td>

            <td class="">

                <?php if(!empty($requestList['WarehouseRequest']['name'])){ 

                  echo ucfirst($requestList['WarehouseRequest']['name']); 

                } ?>

          
            </td>

            <td> 

                <?php echo ucfirst($requestList['User']['first_name'] . " " . $requestList['User']['last_name']) ?>

            </td>

            <td>

            </td>

            <td class="text-center">

                <?php 
                    if($requestList['WarehouseRequest']['status_id'] == 8){ 
                        echo "<span class='label label-default'>Waiting</span>";
                    }
                    if($requestList['WarehouseRequest']['status_id'] == 1){ 
                        echo "<span class='label label-info'>Approved</span>";
                    }
                    if($requestList['WarehouseRequest']['status_id'] == 12){ 
                        echo "<span class='label label-success'>Deducted</span>";
                    }
                    if($requestList['WarehouseRequest']['status_id'] == 0){ 
                        echo "<span class='label label-success'>Purchase Order</span>";
                    }
                ?>

            </td>

            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array('controller' => 'warehouse_requests', 'action' => 'view',$requestList['WarehouseRequest']['id']),array('class' =>' table-link','escape' => false,'title'=>'Review Request'));
                ?>

                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Remove </font></span>
                        </span>', array('controller' => 'warehouse_requests', 'action' => 'delete',$requestList['WarehouseRequest']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information','confirm' => 'Do you want to remove this Request?'));
                ?>


        </tr>


<?php endforeach; } ?> 