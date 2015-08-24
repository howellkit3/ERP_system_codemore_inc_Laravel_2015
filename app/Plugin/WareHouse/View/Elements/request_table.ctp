<?php   foreach ($requestData as $requestDataList ): ?>

        <tr class="">

            <td class="">
                <?php echo ucfirst($requestDataList['Request']['uuid']) ?>  
            </td>

            <td class="">

                <?php echo ucfirst($requestDataList['Request']['name']) ?>

            </td>

            <td class="">
                <?php echo ucfirst($requestDataList['PurchasingType']['name']) ?>
            </td>

            <td >
               
                <span class='label label-default'>Waiting</span>
                  
            </td>

            <td class="">

                <?php echo ucwords($userNameList[$requestDataList['Request']['prepared_by']]) ?>

            </td>

            <td class="">

                <?php echo ucwords($roleData[$userRoleList[$requestDataList['Request']['prepared_by']]]) ?>

            </td>


             <td class="">

                <?php echo date('M d, Y', strtotime($requestDataList['Request']['created'])); ?>

            </td>

            <td>

                 <?php
                        echo $this->Html->link('<span class="fa-stack">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-search fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View</font></span>
                            </span> ', array('controller' => 'receivings', 'action' => 'view', $requestDataList['Request']['id'], $requestDataList['Request']['uuid'], 0),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                    ?>     

                      <?php
                        echo $this->Html->link('<span class="fa-stack">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-sign-in fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> OutRecord</font></span>
                            </span> ', array('controller' => 'receivings', 'action' => 'out_record_item', $requestDataList['Request']['id'], $requestDataList['Request']['uuid'], 0),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                    ?>                  

            </td>
    
<div class="md-overlay"></div>


<?php endforeach; ?> 

