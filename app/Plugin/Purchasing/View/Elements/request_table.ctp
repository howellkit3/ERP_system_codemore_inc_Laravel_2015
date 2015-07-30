<?php  foreach ($requestData as $requestList ): ?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

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

            <td class="text-center">

                <?php 
                    if($requestList['Request']['status_id'] == 8){ 
                        echo "<span class='label label-default'>Waiting</span>";
                    }
                    if($requestList['Request']['status_id'] == 1){ 
                        echo "<span class='label label-success'>Approved</span>";
                    }
                    if($requestList['Request']['status_id'] == 0){ 
                        echo "<span class='label label-success'>Purchase Order</span>";
                    }
                ?>

            </td>

            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array('controller' => 'requests', 'action' => 'view',$requestList['Request']['id']),array('class' =>' table-link','escape' => false,'title'=>'Review Request'));
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