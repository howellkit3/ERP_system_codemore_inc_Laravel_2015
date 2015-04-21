<?php foreach ($generalItemData as $generalItemDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="text-center">
                <?php echo ucfirst($generalItemDataList['GeneralItem']['uuid']) ?>
            </td>
          
            <td class="text-center">
                <?php echo ucfirst($generalItemDataList['GeneralItem']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($generalItemDataList['ItemCategoryHolder']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($generalItemDataList['ItemTypeHolder']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($generalItemDataList['Supplier']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($generalItemDataList['GeneralItem']['measure']) ?>
            </td>

            <td class="text-center">
            
                  <?php echo date('M d, Y', strtotime($generalItemDataList['GeneralItem']['created'])); ?>
            </td>
            <td>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'general_item_edit',$generalItemDataList['GeneralItem']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>

                 <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deleteGeneralItem',$generalItemDataList['GeneralItem']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this General Item?'));
                ?>

               

            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
