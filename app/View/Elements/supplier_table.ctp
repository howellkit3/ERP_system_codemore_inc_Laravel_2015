<?php foreach ($supplierData as $SupplierDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">
        
            <td>
    
               <?php  echo ucfirst($SupplierDataList['Supplier']['name']) ?>
               
            </td>

            <td>

               <?php  echo ucfirst($SupplierDataList['Supplier']['description']) ?>
               
            </td>

            <td class="text-center">
         
                  <?php echo  date('M d, Y', strtotime($SupplierDataList['Supplier']['created'])); ?>
            </td>
            
         
            <td>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'supplier_edit',$SupplierDataList['Supplier']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information')); 
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deleteSupplier',$SupplierDataList['Supplier']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Supplier ?'));
                ?>
 
            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
