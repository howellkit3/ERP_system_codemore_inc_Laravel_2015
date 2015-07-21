  <?php 
       
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

                                           <?php echo $scheduleDataList['ClientOrderDeliverySchedule']['quantity']; ?>  

                                        </td>

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
                                                    

                                                    //pr($arr);
                                                    // $dataholder = 0;
                                                    // foreach ($arr as $key => $value) {

                                                    //    if ($value == '2' ) {
                                                    //     //pr('ff');
                                                    //      $dataholder = 1;
                                                    //    }

                                                    //    if ($value == '5' ) {
                                                    //     //pr('ff');
                                                    //      $dataholder = 1;
                                                    //    }

                                                    //    if ($value == '' ) {
                                                    //    // pr('s');
                                                    //      $dataholder = 1;
                                                    //    }
                                                    // }
                                                    
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
                                                
                                                $Currentdate = str_replace('-', '', $Currentdate);   

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


                                                    <?php                if(strtotime($Scheddate) < strtotime($Currentdate))
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
