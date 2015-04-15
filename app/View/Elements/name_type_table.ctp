<?php foreach ($nameTypeData as $nameTypeDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo ucfirst($nameTypeDataList['ItemTypeHolder']['name']) ?>
            </td>

            <td class="">
                <?php echo ucfirst($nameTypeDataList['ItemCategoryHolder']['name']) ?>
            </td>

            <td class="text-center">
            
                  <?php echo date('M d, Y', strtotime($nameTypeDataList['ItemTypeHolder']['created'])); ?>
            </td>

            <td>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'name_type_edit',$nameTypeDataList['ItemTypeHolder']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>

                 <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deleteType',$nameTypeDataList['ItemTypeHolder']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Process ?'));
                ?>

               

            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
