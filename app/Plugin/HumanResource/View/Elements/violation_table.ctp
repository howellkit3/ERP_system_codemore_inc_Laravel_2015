  <?php if(!empty($violationData)){ 

       foreach ($violationData as $violationDataList): ?>

                <tbody aria-relevant="all" aria-live="polite" role="alert">

                    <tr class="">

                        <td class="">
                              <?php echo $violationDataList['Violation']['name']; ?>
                        </td>

                        <td class="">
              
                           <?php echo ucwords($violationDataList['Violation']['description']); ?>    
                                
                        </td>

                         <td class="">
              
                           <?php echo ucwords($UserCreated[$violationDataList['Violation']['created_by']]); ?>    
                                
                        </td>

                         <td class="">
              
                           <?php echo ucwords($violationDataList['Violation']['created']); ?>    
                                
                        </td>

                        <td>

                          <?php echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit.</font></span>
                          </span> ', array('controller' => 'cause_memos', 'action' => 'edit_violation'),array('class' =>' table-link ','escape' => false,'title'=>'Print Transmittal Receipt')); ?>
      
                       </td>  
                    </tr>

                </tbody>


                      
        <?php 
          endforeach; 
  } 
  ?> 

