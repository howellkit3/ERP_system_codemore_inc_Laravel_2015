<?php foreach ($processField as $processFieldList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo ucfirst($processFieldList['ProcessField']['process']) ?>
            </td>
            <td>
                <?php echo date('M d, Y', strtotime($processFieldList['ProcessField']['created'])); ?>
            </td>
            <td>
               
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'delete_process',$processFieldList['ProcessField']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Process ?'));
                ?>
                
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 