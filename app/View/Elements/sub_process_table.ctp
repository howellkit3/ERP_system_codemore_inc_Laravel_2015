<?php foreach ($SubProcessData as $SubProcessDataList ): ?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td>
         
               <?php  echo ucfirst($SubProcessDataList['SubProcess']['name']) ?>
               
            </td>

            <td class="">

                <?php echo ucfirst($SubProcessDataList['Process']['name']) ?>
            
            </td>

            <td class="text-center">
                
            
                  <?php echo  date('M d, Y', strtotime($SubProcessDataList['SubProcess']['created'])); ?>
            </td>
            
         
            <td>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'sub_process_edit',$SubProcessDataList['SubProcess']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information')); 
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deleteSubProcess',$SubProcessDataList['SubProcess']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Sub Process ?'));
                ?>

                 

    
            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
