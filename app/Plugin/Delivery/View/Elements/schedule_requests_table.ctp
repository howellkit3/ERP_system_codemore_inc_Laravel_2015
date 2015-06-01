  <?php 
                        if(!empty($scheduleData)){

                            //pr($scheduleData); exit;
                            foreach ($scheduleData as $scheduleDataList): ?>

                                <tbody aria-relevant="all" aria-live="polite" role="alert">

                                    <tr class="">

                                        <td class="text-center">
                                            <?php echo $scheduleDataList['ClientOrder']['uuid']; ?>  
                                        </td>

                                        <td class="text-center">

                                            <?php echo $scheduleDataList['ClientOrder']['po_number']; ?>  
                                        
                                        </td>

                                        <td class="text-center">

                                         <?php foreach($scheduleDataList['ClientOrderDeliverySchedule'] as $key => $layers) : ?>   

                                        <?php //echo $companyData[$scheduleDataList[$key]['ClientOrder']['company_id']]; ?> 

                                         <?php endforeach; ?>
                                    
                                        </td>

                                        <td class="text-center">
                              
                                           <?php //echo $scheduleDataList['Product']['name']; ?>  
                                           <br>
                                           
                                        </td>

                                        <td class="text-center" >
                                            
                                         <?php foreach($scheduleDataList['ClientOrderDeliverySchedule'] as $key => $layers) : ?>

                                             <?php // echo date('M d, Y', strtotime($scheduleDataList['ClientOrderDeliverySchedule'][$key]['schedule']));?> 

                                            <br>

                                           <?php endforeach; ?>

                                        </td >

                                        <td class="text-center">

                                           <?php //echo $scheduleDataList['QuotationItemDetail']['quantity']; ?>  

                                        </td>

                                        <td class="text-center">
                                           <?php //echo $scheduleDataList['ClientOrderDeliverySchedule']['status']; ?>    
                                        </td>

                                        <td class="text-center">

                                            <?php  foreach ($scheduleDataList['ClientOrderDeliverySchedule'] as $key => $layers): 

                                                echo $this->Html->link('<span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                         <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
                                                                         <span class ="post"><font size = "1px"> View </font></span>
                                                                         </span> ', array('controller' => 'Deliveries', 
                                                                                        'action' => 'view',
                                                                        $scheduleDataList['ClientOrderDeliverySchedule'][$key]['uuid']),
                                                                         array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information'
                                                                    )); 
                                            ?>  

                                            <?php 
                                                echo $this->Html->link('<span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                         <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
                                                                         <span class ="post"><font size = "1px"> Edit </font></span>
                                                                         </span> ', array('controller' =>'Deliveries', 
                                                                                            'action' => 'edit',
                                                                        $scheduleDataList['ClientOrderDeliverySchedule'][$key]['uuid']),
                                                                         array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information'
                                                                    )); 
                                                ?>  
                                                    <br>
                                              <?php endforeach; ?>  

                                            <br>
                                             
                                        </td>
                                    </tr>

                                </tbody>
                        <?php 
                            endforeach; 
                        } ?> 
