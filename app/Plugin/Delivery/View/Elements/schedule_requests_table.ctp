  <?php  //pr($orderDeliveryList); exit;
       
                        if(!empty($clientsOrder)){
                              
?>
                                <?php foreach ($clientsOrder as $scheduleDataList): ?>

                                   <tr class="">

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
                              
                                           <?php echo substr($scheduleDataList['Product']['name'],0,20);  ?>  
                                           <br>
                                           
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
                                                               
                                                    if($value['Delivery']['schedule_uuid'] == $orderDeliveryList[$uuidClients]  ){  

                                                      if($value['DeliveryDetail']['status'] != 5){
                                                   
                                                      array_push($arrholder,$value['DeliveryDetail']['delivered_quantity']);

                                                      }

                                                    }  
                                                                                                    
                                                  }
                                            
                                            echo($scheduleDataList['ClientOrderDeliverySchedule']['quantity'] - array_sum($arrholder));?> 

                                            <br>

                                        </td >

                                        <td class="text-center">

                                                <?php 

                                                $uuidClientsOrder = $scheduleDataList['ClientOrderDeliverySchedule']['uuid'];
                                               

                                                $arr = array();

                                                 foreach ($deliveryStatus as $key => $value) {

                                                  $IdClientsOrder = $orderListHelper[$value['Delivery']['clients_order_id']];
  
                                                    if($value['Delivery']['schedule_uuid'] == $orderDeliveryList[$uuidClientsOrder]  ){  

                                                      if($value['DeliveryDetail']['status'] != 5){
                                                   
                                                      array_push($arr,$value['DeliveryDetail']['delivered_quantity']);

                                                      }

                                                    }  
                                                    
                                                  }

                                                  $arrDelivered = array();

                                                  foreach ($deliveryStatus as $key => $value) {

                                                  $DeliveredHolder = $deliveryDetailList[$value['Delivery']['dr_uuid']];
  
                                                    if($value['Delivery']['schedule_uuid'] == $orderDeliveryList[$uuidClientsOrder] AND $value['DeliveryDetail']['status'] != 5 ){  

                                                      array_push($arrDelivered,$DeliveredHolder);

                                                    }  

                                                }

                                                $sumDelivered = array_sum($arrDelivered);
                                               
                                                $Scheddate = $scheduleDataList['ClientOrderDeliverySchedule']['schedule'];

                                                $Currentdate = date("Y-m-d H:i:s");

                                                $Scheddate = str_replace('-', '', $Scheddate);
                                                
                                                $Currentdate = str_replace('-', '', $Currentdate); // pr($deliveryData);  

                                                  if (!empty($deliveryData[$scheduleDataList['ClientOrderDeliverySchedule']['uuid']]) || !empty($deliveryList[$scheduleDataList['ClientOrderDeliverySchedule']['uuid']])) {   

                                                    if (array_sum($arr) == $scheduleDataList['ClientOrderDeliverySchedule']['quantity']){ 

                                                        echo "<span class='label label-success'>Completed</span>";

                                                    }elseif ($sumDelivered == $scheduleDataList['ClientOrderDeliverySchedule']['quantity']){

                                                            echo "<span class='label label-success'>Delivered</span>";

                                                    }elseif ($deliveryData[$scheduleDataList['ClientOrderDeliverySchedule']['uuid']] == '1') { 
                                                    
                                                         echo "<span class='label label-warning'>Approved</span>"; ?> &nbsp<?php
                                                    } 
  
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

                                                echo $this->Html->link('<span class="fa-stack">
                                                                         <i class="fa fa-square fa-stack-2x"></i>
                                                                      <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
                                                                          <span class ="post"><font size = "1px">View</font></span>
                                                                          </span> ', array('controller' => 'deliveries', 
                                                                                         'action' => 'view',
                                                                         $scheduleDataList['ClientOrderDeliverySchedule']['id'],$scheduleDataList['QuotationDetail']['quotation_id'],$scheduleDataList['ClientOrderDeliverySchedule']['uuid']),
                                                                          array('class' =>' table-link small-link-icon '.$noPermissionSales,'escape' => false,'title'=>'Edit Information'
                                                                     )); 
                                            ?>     

                                            <br>
                                             
                                        </td>
                                    </tr>

                        <?php 
                            endforeach; 
                        } ?> 

                        <style type="text/css">
                          .btn.disabled, .btn[disabled], fieldset[disabled] .btn {
                            box-shadow: none;
                            cursor: not-allowed;
                            opacity: 0.65;
                            pointer-events: none;
                        }
                        </style>
