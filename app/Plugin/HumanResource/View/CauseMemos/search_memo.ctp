  <?php if(!empty($CauseMemoData)){ 

       foreach ($CauseMemoData as $causeMemoDataList): ?>

                
                    <tr class="">

                        <td class="">
                              SCM<?php echo $causeMemoDataList['CauseMemo']['uuid']; ?>
                        </td>

                         <td class="">
                              <?php echo $employeeName[$causeMemoDataList['CauseMemo']['employee_id']]; ?>
                        </td>

                        <td class="">
              
                           <?php echo ucwords($causeMemoDataList['CauseMemo']['description']); ?>    
                                
                        </td>

                        <td class="">
              
                           <?php echo ucwords($violationTableData[$causeMemoDataList['CauseMemo']['violation_id']]); ?>    
                                
                        </td>

                        <td class="">
              
                           <?php if($causeMemoDataList['CauseMemo']['status_id'] == 9){

                             echo "<span class='label label-info'>Executing</span>";

                            } elseif ($causeMemoDataList['CauseMemo']['status_id'] == 1){

                             echo "<span class='label label-warning'>Approved</span>";

                            } elseif ($causeMemoDataList['CauseMemo']['status_id'] == 5){

                               echo "<span class='label label-danger'>Terminated</span>";

                            } elseif ($causeMemoDataList['CauseMemo']['status_id'] == 10){

                               echo "<span class='label label-success'>Closed</span>";

                              }?>  
                                
                        </td>

                        

                        <td>

                          <?php

                          if($causeMemoDataList['CauseMemo']['status_id'] == 1){
                           echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit</font></span>
                          </span> ', array('controller' => 'cause_memos', 'action' => 'edit', $causeMemoDataList['CauseMemo']['id']),array('class' =>' table-link ','escape' => false,'title'=>'Edit Cause Memo')); 

                          }else{

                           
                           echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit</font></span>
                          </span> ', array('controller' => 'cause_memos', 'action' => 'edit', $causeMemoDataList['CauseMemo']['id']),array('class' =>' table-link not-active','escape' => false,'title'=>'Edit Cause Memo')); 

                            }?>

                          <?php echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View</font></span>
                          </span> ', array('controller' => 'cause_memos', 'action' => 'view', $causeMemoDataList['CauseMemo']['id']),array('class' =>' table-link ','escape' => false,'title'=>'Print Transmittal Receipt')); ?>

                         <!--  <?php echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print</font></span>
                          </span> ', array('controller' => 'cause_memos', 'action' => 'print_cause_memo', $causeMemoDataList['CauseMemo']['id']),array('class' =>' table-link ','escape' => false,'title'=>'Print Transmittal Receipt')); ?> -->
      
                       </td>  
                    </tr>

      


                      
        <?php 
          endforeach; 
  } 
  ?> 

