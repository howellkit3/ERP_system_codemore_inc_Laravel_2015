<?php  foreach ($requestData as $requestList ): ?>


        <tr class="">

            <td class="">
                <?php echo ucfirst($requestList['Request']['uuid']) ?>  
            </td>

            <td class="">

                <?php if(!empty($requestList['Request']['name'])){ 

                  echo ucfirst($requestList['Request']['name']); 

                } ?>

            </td>

            <td class="">

                <?php echo $type[$requestList['Request']['pur_type_id']];?>
                
            </td>

            <td class="">
                <?php echo date('Y/m/d',strtotime($requestList['Request']['created']));?>
                
            </td>

            <td class="">

                <?php echo $userName[$requestList['Request']['prepared_by']];?>
                
            </td>

            <td class="text-center">

                <?php 
                    if($requestList['Request']['status_id'] == 8){ 
                        echo "<span class='label label-default'>Waiting</span>";
                    }
                    if($requestList['Request']['status_id'] == 1){ 
                        echo "<span class='label label-info'>Approved</span>";
                    }
                    if($requestList['Request']['status_id'] == 0){ 
                        echo "<span class='label label-success'>Purchase Order</span>";
                    }
                ?>

            </td>

            <td>

                <?php if(!empty($purchased)) { ?>

                <?php echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array('controller' => 'requests', 'action' => 'view',$requestList['Request']['id'],1),array('class' =>' table-link','escape' => false,'title'=>'Review Request'));
                ?>
               
                <?php }else{ ?>

                    <?php echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array('controller' => 'requests', 'action' => 'view',$requestList['Request']['id']),array('class' =>' table-link','escape' => false,'title'=>'Review Request'));
                ?>

            <?php  

                if(in_array($userData['User']['role_id'],array('1','2','7','16'))) { 
                        
                        echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Remove </font></span>
                        </span>', array('controller' => 'requests', 'action' => 'delete',$requestList['Request']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information','confirm' => 'Do you want to remove this Request?'));

                        }
                ?>

                <?php } ?>
                
            </td>
        </tr>


<?php endforeach; ?> 