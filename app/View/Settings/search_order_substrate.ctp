<?php 
$active_page = !empty($this->params['controller']) ? $this->params['controller'] : '';
$active_action = !empty($this->params['action']) ? $this->params['action'] : '';
?>


<?php foreach ($substrateData as $substrateDataList ):?>
    
  

        <tr class="">

            <td class="text-center">
                <?php echo ucfirst($substrateDataList['Substrate']['uuid']) ?>
            </td>
          
            <td class="text-center">
                <?php echo ucfirst($substrateDataList['Substrate']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($categoryData[$substrateDataList['Substrate']['category_id']]) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($typeData[$substrateDataList['Substrate']['type_id']]) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst(!empty($supplierData[$substrateDataList['Substrate']['manufacturer_id']]) ? $supplierData[$substrateDataList['Substrate']['manufacturer_id']] : " ") ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($substrateDataList['Substrate']['type']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($substrateDataList['Substrate']['thickness']) ?>
            </td>

            <td class="text-center">
            
                  <?php echo date('M d, Y', strtotime($substrateDataList['Substrate']['created'])); ?>
            </td>
            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array(
                                        'controller' => 'settings', 
                                        'action' => 'view_general_item',
                                        $substrateDataList['Substrate']['id'],$indicator), array(
                                                                            'class' =>' table-link small-link-icon',
                                                                            'escape' => false, 
                                                                            'title'=>'View Information'));
                ?>

                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'general_item_edit',$substrateDataList['Substrate']['id'],$indicator),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information'));
                ?>

                 <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deleteGeneralItem',$substrateDataList['Substrate']['id'],$indicator),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this General Item?'));
                ?>

               

            </td>    
        </tr>


<?php endforeach; ?> 
