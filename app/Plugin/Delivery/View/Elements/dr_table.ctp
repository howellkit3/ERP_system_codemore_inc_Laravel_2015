<?php 
$pushRemaining  = array();
$totalremaining = 0;

  if(!empty($DRData)){ ?>

      <?php  foreach ($DRData as $deliveryDataList): ?>

                <tbody aria-relevant="all" aria-live="polite" role="alert">

                    <tr class="">

                        <td class="">
                              <?php echo $deliveryDataList['DeliveryReceipt']['dr_uuid']; ?>
                        </td>

                        <td class="">

                            <?php  echo date('M d, Y',strtotime($deliveryDataList['DeliveryReceipt']['schedule'])); ?>
                        
                        </td>

                        <td class="">

                            <?php echo $deliveryDataList['DeliveryReceipt']['location']; ?>
                        
                        </td>

                        <td class="">

                            <?php echo $deliveryDataList['DeliveryReceipt']['quantity']; ?>
                        
                        </td>
                      
                        <td class="">
                            <?php if(!empty($deliveryDataList['DeliveryReceipt']['remarks'])){ ?>
                                <?php echo $deliveryDataList['DeliveryReceipt']['remarks']; ?>
                             <?php } ?>
                        </td>

                        <td class="">

                            <?php echo $deliveryDataList['DeliveryReceipt']['printed_by']; ?>
                        
                        </td>

                        <td class="">

                            <?php  echo date('M d, Y',strtotime($deliveryDataList['DeliveryReceipt']['printed'])); ?>
                        
                        </td>

                        <td>

                            <?php  
                                echo $this->Html->link('<span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> RePrint </font></span>
                                </span>', array('controller' => 'deliveries', 'action' => 'dr',$deliveryDataList['DeliveryReceipt']['dr_uuid'],$deliveryDataList['Delivery']['schedule_uuid']),array('class' =>' table-link','escape' => false,'title'=>'Print Delivery Receipt','target' => '_blank'));

                            ?>
                       </td>
                    </tr>
                </tbody>
               
        <?php 
          endforeach; 
  } 
  ?> 

<?php echo $this->element('modals');
 ?>