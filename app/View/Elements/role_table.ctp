<?php  foreach ($roleTable as $roleTableList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td>
         
               <?php echo ucfirst($roleTableList['Role']['name']) ?>
               
            </td>

            <td class="text-center">

                <?php echo  date('M d, Y', strtotime($roleTableList['Role']['created'])); ?>

            </td>
            
            <td>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'role_edit',$roleTableList['Role']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Role')); 
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deleteAcl','Role',$roleTableList['Role']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Delete Role','confirm' => 'Do you want to delete this Role ?'));
                ?>

                 

    
            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
