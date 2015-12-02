 <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><a href="#"><span>Date</span></a></th>
                      <th><a href="#" ><span>From</span></a></th>
                      <th><a href="#" ><span>To</span></a></th>
                    <th><a href="#"><span>Description</span></a></th>
                    <th><a href="#"><span>Type</span></a></th>
                    <th class="text-center"><a href="#"><span>Status</span></a></th>
                    <th class="text-center"><a href="#"><span>Action</span></a></th>
                </tr>
            </thead>


            <tbody aria-relevant="all" aria-live="polite" role="alert">
                                    <?php  if(!empty($payrolls)) { ?>
                            <?php foreach ($payrolls as $key => $payroll): ?>
                                                    <tr>
                                                       <td class="">
                                                           <?php echo !empty($payroll['Payroll']['date']) ? date('Y/m/d', strtotime($payroll['Payroll']['date']))  : ''; ?>
                                                        </td>
                                                        <td class="">
                                                           <?php echo !empty($payroll['Payroll']['from']) ? date('Y/m/d', strtotime($payroll['Payroll']['from'])) : '';  ?>
                                                        </td>
                                                        <td class="">
                                                             <?php echo !empty($payroll['Payroll']['to']) ? date('Y/m/d', strtotime($payroll['Payroll']['to'])) : '';  ?>
                                                        </td>
                                                        <td class="">
                                                           <?php echo $payroll['Payroll']['description'] ?>
                                                        </td>
                                                        <td class="">
                                                           <?php echo 'Normal' ?>
                                                        </td>

                                                        <td class="text-center" >
                                                            <?php if($payroll['Payroll']['status'] == 'process') : ?>
                                                            <span class="label label-success">Process</span>
                                                            <?php else : ?>
                                                            <span class="label label-warning">Pending</span>
                                                            <?php endif; ?> 
                                                        </td>

                                                        <td class="text-center">

                                                        <?php echo $this->Html->link('<span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span>',
                                                          array(
                                                            'controller' => 'salaries', 
                                                            'action' => 'payroll_view', $payroll['Payroll']['id'],
                                                            'plugin' => 'human_resource'
                                                           ), 
                                                          array('class' =>' table-link',
                                                        'data-id' => $payroll['Payroll']['id'], 
                                                        'escape' => false,
                                                        'data-toggle' => 'modal',
                                                        'title'=>'View Amorization'
                                                        ));
                                                        
                                                        if($payroll['Payroll']['status'] == 'pending') {

                                                          echo $this->Html->link('<span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
                                                            </span> ', array('controller' => 'salaries', 
                                                              'action' => 'payroll_edit',$payroll['Payroll']['id'],
                                                              'plugin' => 'human_resource'
                                                              ),
                                                            array('class' =>' table-link',
                                                              'escape' => false,
                                                              'title'=>'Edit Information'));

                                                          }

                                                        ?>
                                                        </td>
                                                      
                                                    </tr>
                                          <?php  endforeach;  ?>
                                       <?php } ?> 
                                  </tbody>
                                  </table>
                                  <div class="paging" id="item_type_pagination_ajax">
                                  <?php
                                  echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                  echo $this->Paginator->numbers(array('separator' => ''));
                                  echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                                  ?>
                                  </div>