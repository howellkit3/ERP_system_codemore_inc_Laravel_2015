<?php     //pr($deliveryEdit); exit;
  if(!empty($deliveryEdit)){
              ?>
      <?php foreach ($deliveryEdit as $deliveryDataList): ?>

                <tbody aria-relevant="all" aria-live="polite" role="alert">

                    <tr class="">

                        <td class="">
                              <?php echo $deliveryDataList['Delivery']['dr_uuid']; ?>
                        </td>

                        <td class="">

                            <?php echo date('M d, Y',strtotime($deliveryDataList['DeliveryDetail']['schedule'])); ?>
                        
                        </td>

                        <td class="">
              
                           <?php echo  $deliveryDataList['DeliveryDetail']['location']; ?>    
                           
                           
                        </td>

                        <td class="">

                            <?php echo $deliveryDataList['DeliveryDetail']['quantity']; ?>

                        
                        </td>

                        <td class="">

                            <?php if(empty($deliveryDataList['DeliveryDetail']['remaining_quantity'])){ 

                                 echo 0; }else{?> 

                                <?php echo $deliveryDataList['DeliveryDetail']['remaining_quantity']; ?>

                            <?php } ?>
                        </td>

                        <td class="">
              
                           <?php  $Scheddate = $scheduleInfo['ClientOrderDeliverySchedule']['schedule'];
                                        $Currentdate = date("Y-m-d H:i:s");

                                        $Scheddate = str_replace('-', '', $Scheddate);
                                        $Currentdate = str_replace('-', '', $Currentdate); ?>  

                                        <?php  if (!empty($deliveryDataList[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']])) {  

                                                    if(strtotime($Scheddate) < strtotime($Currentdate))
                                                        {
                                                            echo "<span class='label label-success'>Due</span>"; 
                                                        }else{   

                                                     if($deliveryDataList[$scheduleInfo['ClientOrderDeliverySchedule']['uuid']] == 'Approved') { 
                                                    
                                                              echo "<span class='label label-warning'>Delivering</span>";  

                                                  
                                                     }
                                                   }
                                                 }else{

                                                            echo "<span class='label label-default'>Delivering</span>";

                                           } ?>   
                           
                           
                        </td>

                        <td>
                            <?php
                                echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit</font></span>
                                    </span> ', array('controller' => 'deliveries', 'action' => 'delivery_edit',$deliveryDataList['Delivery']['dr_uuid'], $scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                            ?>

                            <?php
                                echo $this->Html->link('<span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-reply fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Return</font></span>
                                    </span> ', array('controller' => 'deliveries', 'action' => 'delivery_edit'),array('class' =>' table-link','escape' => false,'title'=>'Review Inquiry'));
                            ?>
                     
                            <?php
                                echo $this->Html->link('<span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Print </font></span>
                                </span>', array('controller' => 'deliveries', 'action' => 'print_dr',$deliveryDataList['Delivery']['dr_uuid'],$scheduleInfo['ClientOrderDeliverySchedule']['uuid']),array('class' =>' table-link','escape' => false,'title'=>'Print Delivery Receipt','target' => '_blank'));

                            ?>


                       </td>

                       

                       
                    </tr>

                </tbody>
        <?php 
          endforeach; 
  } ?> 
