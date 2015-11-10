<?php 
$pushRemaining  = array();
$totalremaining = 0;

  if(!empty($DRData)){ ?>

      <?php  foreach ($DRData as $deliveryDataList): ?>

                    <tr class="">

                        <td class="">
                              <?php echo $deliveryDataList['DeliveryReceipt']['dr_uuid']; ?>
                        </td>

                        <!-- <td class="">

                            <?php  echo date('M d, Y',strtotime($deliveryDataList['DeliveryReceipt']['schedule'])); ?>
                        
                        </td> -->

                        <td class="">

                            <?php echo substr($deliveryDataList['Company']['name'],0,25); ?> ..
                        
                        </td>

                        <td class="">

                            <?php echo ucfirst(substr($deliveryDataList['Product']['name'],0,25)); ?>..
                        
                        </td>

                        <td class="">

                            <?php echo $deliveryDataList['ClientOrder']['po_number']; ?>

                        </td>
                      

                        <td class="text-center">

                           <?php echo ucfirst($deliveryDataList['DeliveryReceipt']['quantity']); ?>

                       </td>

                         <td class="">

                            <?php if(!empty($deliveryDataList['DeliveryReceipt']['type'])){ 

                               echo 'for replacing'; 
                            }else{

                                echo ''; 

                            } ?>  

                        </td>

                        <td class="">

                            <?php  echo date('M d, Y',strtotime($deliveryDataList['DeliveryReceipt']['printed'])); ?>
                        
                        </td>

                        <td class="">

                            <?php echo ucfirst($userFName[$deliveryDataList['DeliveryReceipt']['printed_by']]) . " " . ucfirst($userLName[$deliveryDataList['DeliveryReceipt']['printed_by']]); ?>
                        
                        </td>

                       

                       
                    </tr>


                     <!--  <?php 

                            echo $this->Html->link('<span class="fa-stack">
                                                     <i class="fa fa-square fa-stack-2x"></i>
                                                  <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
                                                      <span class ="post"><font size = "1px">View</font></span>
                                                      </span> ', array('controller' => 'deliveries', 
                                                                     'action' => 'view_dr',
                                                     $deliveryDataList['DeliveryReceipt']['id']),
                                                      array('class' =>' table-link small-link-icon '.$noPermissionSales,'escape' => false,'title'=>'Edit Information'
                                                 )); 
                            ?>  -->    

                            <?php  
                                // echo $this->Html->link('<span class="fa-stack">
                                // <i class="fa fa-square fa-stack-2x"></i>
                                // <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> RePrint </font></span>
                                // </span>', array('controller' => 'deliveries', 'action' => 'dr',$deliveryDataList['DeliveryReceipt']['dr_uuid'],$deliveryDataList['Delivery']['schedule_uuid']),array('class' =>' table-link','escape' => false,'title'=>'Print Delivery Receipt'));

                            ?>
     
               
        <?php 
          endforeach; 
  } 
  ?> 

<?php echo $this->element('modals');
 ?>