<?php foreach ($nameTypeData as $nameTypeDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo ucfirst($nameTypeData['ItemTypeHolder']['name']) ?>
            </td>

            <td class="">
                <?php echo ucfirst($nameTypeData['ItemTypeHolder']['item_category_holder_id']) ?>
            </td>
          
            <td class="text-center">
            
                  <?php echo date('M d, Y', strtotime($nameTypeData['ItemTypeHolder']['created'])); ?>
            </td>

            <td>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'category_edit',$nameTypeData['ItemTypeHolder']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>

                 <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'delete',$nameTypeData['ItemTypeHolder']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Process ?'));
                ?>

               

            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
