
            
            <div class="main-box-body clearfix ">
                <div class="table-responsive">
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr >
                                <th class="text-center"><a href="#"><span>Schedule#</span></a></th>
                                <th class="text-center"><a href="#"><span>Client Order#</span></a></th>
                                <th class="text-center"><a href="#"><span>P.O. Number</span></a></th>
                                <th class="text-center"><a href="#"><span>Customer Name</span></a></th>
                                <th class="text-center"><a href="#"><span>Item Name</span></a></th>
                                <th class="text-center"><a href="#"><span>Quantity</span></a></th>
                                <th class="text-center"><a href="#"><span>P.O. Balance</span></a></th>
                                <th class="text-center"><a href="#"><span>Status</span></a></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody aria-relevant="all" aria-live="polite" class="OrderFields" role="alert" >
                            
                             <?php  if(!empty($clientsOrder)){ ?>
                                    <?php foreach ($clientsOrder as $scheduleDataList): 

                                        if($scheduleDataList['ClientOrder']['status_id'] == null  && $scheduleDataList['ClientOrderDeliverySchedule']['status_id'] == 0){ ?>

                                         <tr class="">

                                              <td class="text-center">
                                                  <?php  echo !empty($jobTicketData[$scheduleDataList['ClientOrder']['id']]) ? $jobTicketData[$scheduleDataList['ClientOrder']['id']] : "No Job Ticket yet"; ?>  
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
                                                  
                                                  $checkItem = $this->DeliveryFunction->getbyScheduleID($scheduleDataList['ClientOrderDeliverySchedule']['uuid']);

                                                    $arrholder = array();
                                                    
                                                    foreach ($checkItem as $key => $value) {
                                                    
                                                      // if($value['DeliveryDetail']['status'] != 5){
                                                      //     array_push($arrholder,$value['DeliveryDetail']['delivered_quantity']);
                                                      //   }

                                                        if($value['DeliveryDetail']['status'] == 3 && $value['Delivery']['status'] == 1){
                                          
                                                            $difference = empty($value['DeliveryDetail']['delivered_quantity']) ? $value['DeliveryDetail']['quantity'] : $value['DeliveryDetail']['delivered_quantity'] ; 

                                                              array_push($arrholder,$difference);
                                                            
                                                        }else if ($value['DeliveryDetail']['status'] != 5 && $value['Delivery']['status'] == 1){

                                                            $difference = $value['DeliveryDetail']['quantity']; 

                                                              array_push($arrholder,$difference);
                                              
                                                        }

                                                  }

                                                 echo (intval($scheduleDataList['ClientOrderDeliverySchedule']['quantity']) - (array_sum($arrholder)));

                                                ?> 


                                                  <br>

                                              </td >

                                              <td class="text-center">

                                                  
                                                    
                                                      <?php 

                                                      $uuidClientsOrder = $scheduleDataList['ClientOrderDeliverySchedule']['uuid'];
                                                     

                                                      $deliveryStatus = $arr = array();

                                                      foreach ($checkItem as $key => $inner) {
                                                        
                                                        if ($inner['DeliveryDetail']['status'] == 3) {
                                                          
                                                          if($inner['DeliveryDetail']['status'] != 5){
                                                              array_push($arr,$inner['DeliveryDetail']['delivered_quantity']);
                                                            }
                                                        }
                                                        
                                                        $deliveryStatus[] = $inner['Delivery']['status'];
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
                                          

                                      <?php 
                                          }
                                        endforeach; 
                                      } ?> 

                        </tbody>
                        <tbody aria-relevant="all" aria-live="polite" class="searchAppend" role="alert" >
                        </tbody>

                       <!--  <tbody aria-relevant="all" aria-live="polite" class="" role="alert" style="display:none;">
                        </tbody> -->

                    </table>
                    <hr>
                        <div class="paging" id="item_type_pagination">
                            <?php
                            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                            echo $this->Paginator->numbers(array('separator' => ''));
                            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                            ?>
                    </div>
                </div>
            </div>
   