<?php foreach ($compoundSubstrateData as $compoundSubstrateDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="text-center">
                <?php echo ucfirst($compoundSubstrateDataList['CompoundSubstrate']['uuid']) ?>
            </td>
          
            <td class="text-center">
                <?php echo ucfirst($compoundSubstrateDataList['CompoundSubstrate']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($compoundSubstrateDataList['ItemCategoryHolder']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($compoundSubstrateDataList['ItemTypeHolder']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($compoundSubstrateDataList['Supplier']['name']) ?>
            </td>

            <td class="text-center">
            
                  <?php echo date('M d, Y', strtotime($compoundSubstrateDataList['CompoundSubstrate']['created'])); ?>
            </td>
            <td>

                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array(
                                        'controller' => 'settings', 
                                        'action' => 'view_compound_substrate',
                                        $compoundSubstrateDataList['CompoundSubstrate']['id']), array(
                                                                            'class' =>' table-link',
                                                                            'escape' => false, 
                                                                            'title'=>'View Information'));
                ?>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'compound_substrate_edit',$compoundSubstrateDataList['CompoundSubstrate']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>

                 <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deleteCompoundSubstrate',$compoundSubstrateDataList['CompoundSubstrate']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Compound Substrate?'));
                ?>

            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
