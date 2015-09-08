 <div class="table-responsive">
                                <div class="table-responsive">
                                  <table class="table table-bordered" id="result-cont">
                                    <thead>
                                        <tr>
                                          <th><a href="#"><span>Code</span></a></th>
                                          <th><a href="#" class="desc"><span>Name</span></a></th>
                                          <th class="text-center"><span>Amount</span></th>

                                          <th class="text-center"><span>Payroll Date</span></th>
                                          <th class="text-right"><span>Reason</span></th>
                                          <th class="text-right"><span>Action</span></th>
                                         <!--  <th class="text-right"><span>Actions</span></th> -->
                                        </tr>
                                    </thead>
                                  <tbody>
                                  <?php if (!empty($adjustments)) :?>
                                    <?php foreach ($adjustments as $key => $adjustment) { ?>
                                      <tr>
                                        <td>
                                          <?php 
                                          $employee = $this->CustomEmployee->findEmployee($adjustment['Adjustment']['employee_id']);
                                          echo !empty( $employee ) ?  $employee['Employee']['code'] : ''; ?>  
                                        </td>
                                        <td>  
                                          <?php echo $this->CustomText->getFullname($employee['Employee']); ?>  
                                        </td>
                                        <td>  
                                          <?php echo number_format($adjustment['Adjustment']['amount'],2); ?>
                                        </td>
                                        <td class="text-center">
                                          <?php echo !empty($adjustment['Adjustment']['payroll_date']) ? date('Y-m-d',strtotime($adjustment['Adjustment']['payroll_date'])) : ''; ?>
                                        </td>
                                        <td class="text-center">
                                          <?php echo $adjustment['Adjustment']['reason']; ?>
                                        </td>
                                        <td class="text-right">
                                              <?php
                                                 // echo $this->Html->link('<span class="fa-stack">
                                                 //            <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span>',
                                                 //            '#viewDeductions', 
                                                 //              array('class' =>' table-link view_amortization',
                                                 //                 'data-id' => $adjustment['Adjustment']['id'], 
                                                 //                  'escape' => false,
                                                 //                  'data-toggle' => 'modal',
                                                 //                  'title'=>'View Amorization'
                                                 //            ));
                                                    echo $this->Html->link('<span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                                                        </span> ','#adjustmentModal',
                                                        array(
                                                          'class' =>'table-link edit_adjustment',
                                                          'data-toggle' => 'modal',
                                                          'data-id' => $adjustment['Adjustment']['id'],
                                                          'escape' => false,'title'=>'Edit Information'));

                                                    echo $this->Html->link('<span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
                                                        </span> ', array('controller' => 'salaries', 'action' => 'adjustment_delete',$adjustment['Adjustment']['id']),array('class' =>' table-link delete_Deduction','escape' => false,'title'=>'Edit Information'));
                                              ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                  <?php endif; ?>
                                    </tbody>
                                  </table>
                          </div>