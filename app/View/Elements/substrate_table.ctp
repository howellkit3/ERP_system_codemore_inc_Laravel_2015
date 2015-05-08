<?php foreach ($substrateData as $substrateDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td class="text-center">
                <?php echo ucfirst($substrateDataList['Substrate']['uuid']) ?>
            </td>
          
            <td class="text-center">
                <?php echo ucfirst($substrateDataList['Substrate']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($substrateDataList['ItemCategoryHolder']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($substrateDataList['ItemTypeHolder']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($substrateDataList['Supplier']['name']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($substrateDataList['Substrate']['type']) ?>
            </td>

            <td class="text-center">
                <?php echo ucfirst($substrateDataList['Substrate']['thickness']) ?>
            </td>

            <td class="text-center">
            
                  <?php echo date('M d, Y', strtotime($substrateDataList['Substrate']['created'])); ?>
            </td>
            <td>

                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array(
                                        'controller' => 'settings', 
                                        'action' => 'view_substrate',
                                        $substrateDataList['Substrate']['id']), array(
                                                                            'class' =>' table-link small-link-icon',
                                                                            'escape' => false, 
                                                                            'title'=>'View Information'));
                ?>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'substrate_edit',$substrateDataList['Substrate']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information'));
                ?>

                 <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deleteSubstrate',$substrateDataList['Substrate']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this General Item?'));
                ?>

            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
