  <?php 
                        if(!empty($scheduleData)){

                           // pr($scheduleData); exit;

                            foreach ($scheduleData as $scheduleDataList): ?>

                                <tbody aria-relevant="all" aria-live="polite" role="alert">

                                    <tr class="">

                                        <td class="">
                                            <?php echo $scheduleDataList['ClientOrder']['uuid']; ?>  
                                        </td>

                                        <td class="">

                                          <?php  foreach ($scheduleDataList['ClientOrderDeliverySchedule']['schedule'] as $key): 
                                            
                                              echo date('M d, Y', strtotime($key['schedule']));
                                               endforeach; ?>  
                                        </td>

                                        <td>
                                           <?php echo $scheduleDataList['ClientOrderDeliverySchedule']['location']; ?>  
                                           
                                        </td>

                                        <td>
                                           <?php //echo $scheduleDataList['ClientOrderDeliverySchedule']['status']; ?>    
                                        </td>
                                        <td>
                                            <?php
                                                echo $this->Html->link('<span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                                        </span> ', array(
                                                                        'controller' => 'Schedules', 
                                                                        'action' => 'view',
                                                                        $scheduleDataList['ClientOrder']['uuid'] 
                                                                                    ), array(
                                                                        'class' =>' table-link',
                                                                        'escape' => false,
                                                                        'title'=>'View Information'
                                                                    ));

                                            ?>
                                            <?php
                                                echo $this->Html->link('<span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa fa-check-square fa-lg fa-stack-1x fa-inverse"></i>
                                                                        </span> ', array( 
                                                                        'controller' => 'deliveries', 
                                                                        'action' => 'add',
                                                                         $scheduleDataList['ClientOrder']['uuid'], 
                                                                         'schedule' 
                                                                                ), array(
                                                                        'class' =>' table-link',
                                                                        'escape' => false,
                                                                        'title'=>'Create Delivery Information'
                                                        ));

                                            ?>
                                        </td>
                                    </tr>

                                </tbody>
                        <?php 
                            endforeach; 
                        } ?> 