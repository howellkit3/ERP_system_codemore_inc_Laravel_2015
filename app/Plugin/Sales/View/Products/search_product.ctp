<?php if (!empty($productData)) { ?>
    <?php foreach ($productData as $productList): ?>
        
            <tr class="">
                 <td class="">
                    <?php echo $productList['Product']['uuid'] ?>  
                </td>
                <td class="">
                    <?php echo ucfirst($productList['Product']['name']) ?>  
                </td>
                <td class="">
                    <?php echo ucfirst($productList['Product']['company_id']) ?>
                </td>
                <td class="text-center">
                     <?php echo $productList['Product']['item_category_holder_id'] ?>
                </td>

                <td class="text-center">
                  <?php echo $productList['Product']['item_type_holder_id'] ?>
                </td>
                <td class="text-center">
                  <?php echo $productList['Product']['remarks'] ?>
                </td>
                <td class="text-center">
                  <?php echo $productList['Product']['created'] ?>
                </td>


                <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span>
                        </span> ', array(
                                        'controller' => 'products', 
                                        'action' => 'view',
                                        $productList['Product']['id']), array(
                                                                            'class' =>' table-link small-link-icon',
                                                                            'escape' => false, 
                                                                            'title'=>'View Information'
                        ));
                ?>

                <?php 
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' =>'products', 'action' => 'edit',$productList['Product']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information'
                        )); 
                ?>
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i>
                    // <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    // </span>', array('controller' => 'products', 'action' => 'deleteProduct',$productList['Product']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Product ?'
                    //     ));
                    // echo "&emsp;";
                   
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-plus-square fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Specs </font></span>
                    </span>', array('controller' => 'products', 'action' => 'specification',$productList['Product']['id']),array('class' =>' table-link','escape' => false,'title'=>'Add Specifications'
                        ));
                ?>
                </td>
            </tr>
        
    <?php endforeach; ?> 
<?php }else{
    echo "<font color='red'><b>No result..</b></font>";
    } ?> 
