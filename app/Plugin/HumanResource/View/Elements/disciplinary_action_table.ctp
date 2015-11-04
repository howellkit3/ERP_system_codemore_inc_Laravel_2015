  <?php if(!empty($disciplinaryActionData)){ 

       foreach ($disciplinaryActionData as $disciplinaryActionDataList): ?>

                <tbody aria-relevant="all" aria-live="polite" role="alert">

                    <tr class="">

                        <td class="">
                              <?php echo $disciplinaryActionDataList['DisciplinaryAction']['name']; ?>
                        </td>

                         <td class="">
              
                           <?php echo ucwords($UserCreated[$disciplinaryActionDataList['DisciplinaryAction']['created_by']]); ?>    
                                
                        </td>

                         <td class="">
              
                           <?php echo ucwords($disciplinaryActionDataList['DisciplinaryAction']['created']); ?>    
                                
                        </td>

                        <td>

                          <?php echo $this->Html->link('<span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa  fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit.</font></span>
                          </span> ', array('controller' => 'cause_memos', 'action' => 'edit_disciplinary_action', $disciplinaryActionDataList['DisciplinaryAction']['id'] ),array('class' =>' table-link ','escape' => false,'title'=>'Print Transmittal Receipt')); ?>
      
                       </td>  
                    </tr>

                </tbody>


                      
        <?php 
          endforeach; 
  } 
  ?> 