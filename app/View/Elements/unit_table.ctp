<?php foreach ($unitData as $UnitDataDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td>
         
               <?php  echo strtolower($UnitDataDataList['Unit']['unit']) ?>
               
            </td>

            <td>
         
               <?php  echo !empty($typeMeasureData[$UnitDataDataList['Unit']['type_measure']]) ? strtolower($typeMeasureData[$UnitDataDataList['Unit']['type_measure']]) : "Countable" ?>
               
            </td>

            <td>
                
            
                  <?php echo  date('M d, Y', strtotime($UnitDataDataList['Unit']['created'])); ?>
            </td>
            
         
            <td>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'unit_edit',$UnitDataDataList['Unit']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information')); 
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deleteUnit',$UnitDataDataList['Unit']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Unit ?'));
                ?>

                 

    
            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
