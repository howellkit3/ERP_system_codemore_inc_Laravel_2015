<?php 

//pr($productData);
foreach ($productData as $ProductDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">
           

             <td>

            <?php echo ucfirst($ProductDataList['Product']['uuid']) ?>
        </td>
            <td>    

               <?php echo ucfirst($ProductDataList['Product']['name']) ?>
               
            </td>

            <td>

               <?php  echo ucfirst($ProductDataList['Product']['item_category_holder_id']) ?>
               
            </td>

            <td>

               <?php  echo ucfirst($ProductDataList['Product']['item_type_holder_id']) ?>
               
            </td>
            <td>

         
               <?php  echo ucfirst($ProductDataList['Product']['remarks']) ?>
               
            </td>

             <td>

               <?php  echo ucfirst($ProductDataList['Product']['created']) ?>
               
            </td>

            
            
         
            <td>
            
                <?php /* 
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' =>'products', 'action' => 'product_edit',$ProductDataList['Product']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information')); */
                ?>
                 <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'products', 'action' => 'deleteProduct',$ProductDataList['Product']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Product ?'));
                ?>

                 

    
            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 