  <?php 
                        if(!empty($clientsOrder)){

                            //pr($clientsOrder); 
?>

                                <?php foreach ($clientsOrder as $scheduleDataList): ?>

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

                                       <?php    $Scheddate = $scheduleDataList['ClientOrderDeliverySchedule']['schedule'];
                                                $Currentdate = date("Y-m-d H:i:s");

                                                $Scheddate = str_replace('-', '', $Scheddate);
                                                $Currentdate = str_replace('-', '', $Currentdate);   

                                                  if (!empty($deliveryData[$scheduleDataList['ClientOrderDeliverySchedule']['uuid']])) {   

                                                            if(strtotime($Scheddate) < strtotime($Currentdate))
                                                                {
                                                                    echo "<span class='label label-warning'>Due</span>"; 
                                                                }else{    

                                                         if($deliveryData[$scheduleDataList['ClientOrderDeliverySchedule']['uuid']] == 'Approved') { 
                                                        
                                                                  echo "<span class='label label-success'>Approved</span>";  

                                                          
                                                             }
                                                         }
                                                     }else{

                                                                    echo "<span class='label label-default'>Waiting</span>";

                                                 } ?>
                                   
                                       
                                        </td>

                                        <td class="text-center">

                                            <?php //pr( $scheduleDataList);

                                                echo $this->Html->link('<span class="fa-stack">
                                                                         <i class="fa fa-square fa-stack-2x"></i>
                                                                      <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
                                                                          <span class ="post"><font size = "1px">View</font></span>
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
