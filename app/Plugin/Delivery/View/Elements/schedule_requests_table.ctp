  <?php 
                        if(!empty($scheduleData)){


                            foreach ($scheduleData as $scheduleDataList): ?>

                                <tbody aria-relevant="all" aria-live="polite" role="alert">

                                    <tr class="">

                                        <td class="">
                                            <?php echo $scheduleDataList['ClientOrder']['uuid']; ?>  
                                        </td>

                                        <td class="">

                                            <?php echo $scheduleDataList['ClientOrder']['po_number']; ?>  
                                        
                                        </td>

                                        <td class="">

                                        <?php echo $scheduleDataList['Company']['company_name']; ?>  </a>
                                    
                                        </td>

                                        <td>
                              
                                           <?php echo $scheduleDataList['Product']['name']; ?>  
                                           <br>
                                           
                                        </td>

                                        <td  class="align">
                                            
                                         <?php foreach($scheduleDataList['ClientOrderDeliverySchedule'] as $key => $layers) : ?>

                                             <?php echo date('M d, Y', strtotime($scheduleDataList['ClientOrderDeliverySchedule'][$key]['schedule']));?> 

                                            <br>

                                           <?php endforeach; ?>

                                        </td class = "align">

                                        <td>

                                            <?php foreach($scheduleDataList['ClientOrderDeliverySchedule'] as $key => $layers) : ?>

                                           <?php echo $scheduleDataList['ClientOrderDeliverySchedule'][$key]['location']; ?>  

                                           <br>
                                            
                                            <?php endforeach; ?>

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