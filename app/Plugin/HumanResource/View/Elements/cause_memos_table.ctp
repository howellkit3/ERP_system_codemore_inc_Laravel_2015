  <?php if(!empty($causeMemoData)){ 

       foreach ($causeMemoData as $causeMemoDataList): ?>

                <tbody aria-relevant="all" aria-live="polite" role="alert">

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

                            }?>    
                                
                        </td>

                        

                        <td>

                          <?php echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit.</font></span>
                          </span> ', array('controller' => 'cause_memos', 'action' => 'edit_violation'),array('class' =>' table-link ','escape' => false,'title'=>'Print Transmittal Receipt')); ?>

                          <?php echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit.</font></span>
                          </span> ', array('controller' => 'cause_memos', 'action' => 'print_violation'),array('class' =>' table-link ','escape' => false,'title'=>'Print Transmittal Receipt')); ?>
      
                       </td>  
                    </tr>

                </tbody>


                      
        <?php 
          endforeach; 
  } 
  ?> 

