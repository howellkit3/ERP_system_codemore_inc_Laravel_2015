<?php foreach ($packagingData as $PackagingDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td>

         
               <?php  echo ucfirst($PackagingDataList['PackagingHolder']['name']) ?>
               
            </td>
            <td class="text-center">
                
            
                  <?php echo  date('M d, Y', strtotime($PackagingDataList['PackagingHolder']['created'])); ?>
            </td>
            
         
            <td>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'packaging_edit',$PackagingDataList['PackagingHolder']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information')); 
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deletePackaging',$PackagingDataList['PackagingHolder']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Package ?'));
                ?>

                 

    
            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
