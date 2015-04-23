<?php foreach ($corrugatedPaperData as $corrugatedPaperDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="text-center">
                <?php echo ucfirst($corrugatedPaperDataList['CorrugatedPaper']['uuid']) ?>
            </td>
          
            <td class="text-center">
                <?php echo ucfirst($corrugatedPaperDataList['CorrugatedPaper']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($corrugatedPaperDataList['ItemCategoryHolder']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($corrugatedPaperDataList['ItemTypeHolder']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($corrugatedPaperDataList['Supplier']['name']) ?>
            </td>

            <td class="text-center">
            
                  <?php echo date('M d, Y', strtotime($corrugatedPaperDataList['CorrugatedPaper']['created'])); ?>
            </td>
            <td>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'compound_substrate_edit',$corrugatedPaperDataList['CorrugatedPaper']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>

                 <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deleteCompoundSubstrate',$corrugatedPaperDataList['CorrugatedPaper']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Compound Substrate?'));
                ?>

            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
