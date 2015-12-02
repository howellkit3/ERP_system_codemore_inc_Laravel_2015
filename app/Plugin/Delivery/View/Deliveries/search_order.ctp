  <?php 
       
                       // if(!empty($clientsOrder)){
                         // pr($deliveryDetailsData); exit;
?>
                                <?php foreach ($clientsOrder as $scheduleDataList): 

                                  if($scheduleDataList['ClientOrder']['status_id'] == null  && $scheduleDataList['ClientOrderDeliverySchedule']['status_id'] == 0){ ?>
                              
                                    <tr class="">

                                        <td class="text-center">
                                                  <?php  echo !empty($scheduleDataList['JobTicket']['uuid']) ? $scheduleDataList['JobTicket']['uuid'] : "No Job Ticket yet"; ?>  
                                        </td>

                                        <td class="text-center">

                                                  <?php  echo $scheduleDataList['ClientOrder']['uuid']; ?>  
                                              
                                        </td>

                                        <td class="text-center">

                                            <?php  echo $scheduleDataList['ClientOrder']['po_number']; ?>  
                                        
                                        </td>

                                       <td class="text-center">

                                        <?php echo substr($scheduleDataList['Company']['company_name'],0,25);  ?> ..

                                        
                                        </td>

                                        <td class="text-center">
                              
                                           <?php echo substr($scheduleDataList['Product']['name'],0,20);  ?>..
                                           
                                        </td>

                                        <td class="text-center">

                                           <?php echo $scheduleDataList['ClientOrderDeliverySchedule']['quantity']; ?>  

                                        </td>

                                        <td class="text-center" >

                                          <?php 
                                            
                                            $uuidClients = $scheduleDataList['ClientOrderDeliverySchedule']['uuid'];
                                               
                                                $arrholder = array();

                                                 foreach ($deliveryStatus as $key => $value) {

                                                  $IdClientsOrder = $orderListHelper[$value['Delivery']['clients_order_id']];
  
                                                    if($value['Delivery']['schedule_uuid'] == $scheduleDataList['ClientOrderDeliverySchedule']['uuid']  ){  

                                                      if($value['DeliveryDetail']['status'] != 5){
                                                   
                                                      array_push($arrholder,$value['DeliveryDetail']['delivered_quantity']);

                                                      }

                                                    }  
                                                                                                    
                                                  }
                                            
                                            echo(array_sum($arrholder));?> 

                                            <br>

                                        </td >

                                        <td class="text-center">

                                           <?php 

                                                      $uuidClientsOrder = $scheduleDataList['ClientOrderDeliverySchedule']['uuid'];
                                                     

                                                      $arr = array();

                                                       foreach ($deliveryStatus as $key => $value) {

                                                        $IdClientsOrder = !empty($scheduleDataList['Delivery']['dr_uuid']) ? $scheduleDataList['Delivery']['dr_uuid'] : "";

                                                          if($value['Delivery']['schedule_uuid'] == $scheduleDataList['ClientOrderDeliverySchedule']['uuid'] &&  $value['DeliveryDetail']['status'] == 3 ){  

                                                            if($value['DeliveryDetail']['status'] != 5){
                                                         
                                                            array_push($arr,$value['DeliveryDetail']['delivered_quantity']);

                                                          }

                                                        }  
                                                          
                                                      }

                                                      $Scheddate = $scheduleDataList['ClientOrderDeliverySchedule']['schedule'];

                                                      $Currentdate = date("Y-m-d H:i:s");

                                                      $Scheddate = str_replace('-', '', $Scheddate);
                                                      
                                                      $Currentdate = str_replace('-', '', $Currentdate); 

                                                      if (array_sum($arr) == $scheduleDataList['ClientOrderDeliverySchedule']['quantity']){ 

                                                          echo "<span class='label label-success'>Completed</span>";
                                        
                                                      }elseif (array_sum($arrholder) != 0) { 
                                                            
                                                           echo "<span class='label label-warning'>Approved</span>"; ?> &nbsp<?php
                                                        

                                                      }else{

                                                          echo "<span class='label label-default'>Waiting</span>"; ?> &nbsp


                                                          <?php    

                                                            $Scheddate = date('Y-m-d',strtotime($Scheddate)).' 23:00:00';

                                                          if(strtotime($Currentdate) >= strtotime( $Scheddate ))
                                                          {
                                                              echo "<span class='label label-danger'>Due</span>"; 
                                                          } 
                                                            
                                                           
                                                  } ?>
                                        </td>

                                        <td class="text-center">

                                            <?php 
                                             // pr($scheduleDataList['ClientOrderDeliverySchedule']['uuid']); 
                                              echo $this->Html->link('<span class="fa-stack">
                                                         <i class="fa fa-square fa-stack-2x"></i>
                                                      <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
                                                          <span class ="post"><font size = "1px"></font></span>
                                                          </span> ', array('controller' => 'deliveries', 
                                                                         'action' => 'view',
                                                         $scheduleDataList['ClientOrderDeliverySchedule']['id'], $scheduleDataList['ClientOrderDeliverySchedule']['uuid'], $scheduleDataList['ClientOrder']['uuid']),
                                                          array('class' =>' table-link small-link-icon '.$noPermissionSales,'escape' => false,'title'=>'Edit Information'
                                                     )); 
                                            ?>     

                                             <?php

                                                      echo $this->Html->link('<span class="fa-stack">
                                                          <i class="fa fa-square fa-stack-2x"></i>
                                                          <i class="fa fa-trash fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px">  </font></span>
                                                          </span>', array('controller' => 'deliveries', 'action' => 'terminate',$scheduleDataList['ClientOrderDeliverySchedule']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information','confirm' => 'Do you want to remove this client order delivery schedule in the list?'));

                                            ?>

                                            <br>
                                             
                                        </td>
                                    </tr>

                        <?php }
                            endforeach; 
                        //} ?> 
