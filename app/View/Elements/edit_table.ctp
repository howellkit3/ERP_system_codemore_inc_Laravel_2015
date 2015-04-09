<?php foreach ($categoryData as $CategoryDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">


            <td class="">
                <?php echo ucfirst($CategoryDataList['ItemCategoryHolder']['name']) ?>
            </td>
            
            <td class="">
                
            
                  <?php echo date('M d, Y', strtotime($CategoryDataList['ItemCategoryHolder']['created'])); ?>
            </td>
            <td>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'category_edit',$CategoryDataList['ItemCategoryHolder']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                ?>

                

               

            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
