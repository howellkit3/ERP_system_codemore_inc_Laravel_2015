<?php foreach ($customField as $customFieldList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="">
                <?php echo ucfirst($customFieldList['CustomField']['fieldlabel']) ?>
            </td>
            <td>
                <?php echo date('M d, Y', strtotime($customFieldList['CustomField']['created'])); ?>
            </td>
            <td>
               
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                    </span>', array('controller' => 'settings', 'action' => 'delete_field',$customFieldList['CustomField']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete Custom Field Label ?'));
                ?>
                
            </td>
        </tr>

    </tbody>
<?php endforeach; ?> 