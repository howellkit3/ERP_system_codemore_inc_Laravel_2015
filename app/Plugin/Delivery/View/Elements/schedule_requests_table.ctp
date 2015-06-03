  <?php 
                        if(!empty($clientsOrder)){

                          //  pr($clientsOrder); exit;

                            foreach ($clientsOrder as $scheduleDataList): ?>

                                <tbody aria-relevant="all" aria-live="polite" role="alert">

                                    <tr class="">

                                        <td class="text-center">
                                            <?php  echo $scheduleDataList['ClientOrder']['uuid']; ?>  
                                        </td>

                                        <td class="text-center">

                                            <?php  echo $scheduleDataList['ClientOrder']['po_number']; ?>  
                                        
                                        </td>

                                        <td class="text-center">

                                        <?php echo $scheduleDataList['Company']['company_name'] ?> 

                                        
                                        </td>

                                        <td class="text-center">
                              
                                           <?php echo $scheduleDataList['Product']['name']; ?>  
                                           <br>
                                           
                                        </td>

                                        <td class="text-center" >
                                            
                                             <?php  echo date('M d, Y', strtotime($scheduleDataList['ClientOrderDeliverySchedule']['schedule']));?> 

                                            <br>

                                        </td >

                                        <td class="text-center">

                                           <?php  echo $scheduleDataList['ClientOrderDeliverySchedule']['quantity']; ?>  

                                        </td>

                                        <td class="text-center">
                                           <?php echo "<span class='label label-default'>Waiting</span>"; ?>    
                                        </td>

                                        <td class="text-center">

                                        
                                            <?php 
                                                echo $this->Html->link('<span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                         <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
                                                                         <span class ="post"><font size = "1px"> Edit </font></span>
                                                                         </span> ', array('controller' =>'Deliveries', 
                                                                                            'action' => 'edit',
                                                                        $scheduleDataList['ClientOrderDeliverySchedule']['uuid']),
                                                                         array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information'
                                                                    )); 
                                                ?>  
                                                
                                            <?php 

                                                echo $this->Html->link('<span class="fa-stack">
                                                                         <i class="fa fa-square fa-stack-2x"></i>
                                                                      <i class="fa fa-check-square-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
                                                                          <span class ="post"><font size = "1px">Approve</font></span>
                                                                          </span> ', array('controller' => 'Deliveries', 
                                                                                         'action' => 'view',
                                                                         $scheduleDataList['ClientOrderDeliverySchedule']['id']),
                                                                          array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information'
                                                                     )); 
                                            ?>     
                                             

                                            <br>
                                             
                                        </td>
                                    </tr>

                                </tbody>
                        <?php 
                            endforeach; 
                        } ?> 
