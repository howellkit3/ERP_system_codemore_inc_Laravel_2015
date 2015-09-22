<?php 

foreach ($company as $customerlist): ?>
   
        <tr class="">
            <td class="">
                <?php echo ucfirst($customerlist['Company']['company_name']) ?>  
            </td>
            <td class="">
                <?php echo $customerlist['Company']['website'] ?>
            </td>
            <td class="">
                <?php echo $customerlist['Company']['tin'] ?>
            </td>
            <td class="">
                <div>
                <?php 
                    if(!empty($customerlist['ContactPerson'])) { 
                        
                        foreach ($customerlist['ContactPerson'] as $key => $value) {
                                echo ucfirst($value['firstname']);  
                                echo '&nbsp';
                                echo ucfirst($value['middlename']); 
                                echo '&nbsp';
                                echo ucfirst($value['lastname']); 
                                if (count($customerlist['ContactPerson']) > 1) {
                                    echo "<br>";
                                }
                            }    
                       
                    } 
                ?>
                </div>
            </td>
            <td>
                <?php echo date('M d, Y', strtotime($customerlist['Company']['created'])); ?>
            </td>
            <td>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'customer_sales', 'action' => 'view',$customerlist['Company']['id']), array('class' =>' table-link '.$noPermission,'escape' => false, 'title'=>'View Information'
                    ));
                ?>
                <?php
                    echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                    </span> ', array('controller' => 'customer_sales', 'action' => 'edit',$customerlist['Company']['id']),array('class' =>' table-link '.$noPermission,'escape' => false,'title'=>'Edit Information'));
                ?>
                <?php
                    // echo $this->Html->link('<span class="fa-stack">
                    // <i class="fa fa-square fa-stack-2x"></i>
                    // <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                    // </span>', array('controller' => 'customer_sales', 'action' => 'delete',$customerlist['Company']['id']),array('class' =>' table-link','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete Customer ?'));
                ?>
            </td>
        </tr>
    
<?php endforeach; ?> 