<?php foreach ($paymentTermData as $PaymentTermDataList ):?>
    
    <tbody aria-relevant="all" aria-live="polite" role="alert">

        <tr class="">

            <td>

         
               <?php  echo ucfirst($PaymentTermDataList['PaymentTermHolder']['name']) ?>
               
            </td>
            <td class="text-center">
                
            
                  <?php echo  date('M d, Y', strtotime($PaymentTermDataList['PaymentTermHolder']['created'])); ?>
            </td>
            
         
            <td>
            
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'settings', 'action' => 'payment_term_edit',$PaymentTermDataList['PaymentTermHolder']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information')); 
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    </span>', array('controller' => 'settings', 'action' => 'deletePaymentTerm',$PaymentTermDataList['PaymentTermHolder']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Payment Term ?'));
                ?>

            </td>    
        </tr>

    </tbody>
<?php endforeach; ?> 
