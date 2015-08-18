   <thead>
                <tr>
                  <th><a href="#"><span>Code</span></a></th>
                  <th><a href="#" class="desc"><span>Name</span></a></th>
                  <th class="text-center"><a href="#" class="asc"><span>From</span></a></th>
                  <th class="text-center"><span>To</span></th>
                  <th class="text-center"><span>Mode</span></th>
                  <th class="text-center"><span>Amount</span></th>
                  <th class="text-right"><span>Reason</span></th>
                  <th class="text-right"><span>Action</span></th>
                 <!--  <th class="text-right"><span>Actions</span></th> -->
                </tr>
                </thead>
                <tbody>
                  <?php if (!empty($deductions)) :?>
                  <?php foreach ($deductions as $key => $deduction) { ?>
                    <tr>
                      <td>
                        <?php 
                        $employee = $this->CustomEmployee->findEmployee($deduction['Deduction']['employee_id']);
                        echo !empty( $employee ) ?  $employee['Employee']['code'] : ''; ?>  
                      </td>
                      <td>  
                        <?php 
                        
                        echo $this->CustomText->getFullname($employee['Employee']); ?>  
                      </td>
                      <td class="text-center">
                       <?php echo !empty($deduction['Deduction']['from']) && $deduction['Deduction']['from'] != '00:00:00' ? date('Y-m-d', strtotime($deduction['Deduction']['from'])) : ''; ?>  
                      </td>

                      <td class="text-center">
                       <?php 
                       echo !empty($deduction['Deduction']['to']) && $deduction['Deduction']['to'] != '00:00:00' ? date('Y-m-d', strtotime($deduction['Deduction']['to'])) : ''; ?>  
                      </td class="text-center">
                      <td class="text-center">
                        <?php echo ucwords($deduction['Deduction']['mode'])?>   
                      </td>
                      <td class="text-center">
                        <?php echo $deduction['Deduction']['amount']?>   
                      </td>
                      <td class="text-right">
                        <?php echo $deduction['Deduction']['reason']?>   
                      </td>

                      <td class="text-right">
                            <?php echo $this->Html->link('<span class="fa-stack">
                                          <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span>',
                                          '#viewDeductions', 
                                            array('class' =>' table-link view_amortization',
                                               'data-id' => $deduction['Deduction']['id'], 
                                                'escape' => false,
                                                'data-toggle' => 'modal',
                                                'title'=>'View Amorization'
                                          ));




                                      echo $this->Html->link('<span class="fa-stack">
                                      <i class="fa fa-square fa-stack-2x"></i>
                                      <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                                      </span> ', array('controller' => 'deductions', 'action' => 'edit',$deduction['Deduction']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
                            ?>
                      </td>
                  </tr>
                  <?php } ?>
                <?php endif; ?>
                  </tbody>