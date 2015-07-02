<?php 
$pushRemaining  = array();
$totalremaining = 0;

  if(!empty($DRData)){ ?>

      <?php foreach ($DRData as $transmittalDataList): ?>

                <tbody aria-relevant="all" aria-live="polite" role="alert">

                    <tr class="">

                        <td class="">
                              <?php echo $transmittalDataList['DeliveryReceipt']['dr_uuid']; ?>
                        </td>

                        <td class="">

                            <?php  echo date('M d, Y',strtotime($transmittalDataList['DeliveryReceipt']['schedule'])); ?>
                        
                        </td>

                        <td class="">

                            <?php echo $transmittalDataList['DeliveryReceipt']['location']; ?>
                        
                        </td>

                        <td class="">

                            <?php echo $transmittalDataList['DeliveryReceipt']['quantity']; ?>
                        
                        </td>
                      
                        <td class="">
                            <?php if(!empty($transmittalDataList['DeliveryReceipt']['remarks'])){ ?>
                                <?php echo $transmittalDataList['DeliveryReceipt']['remarks']; ?>
                             <?php } ?>
                        </td>

                        <td class="">

                            <?php echo $transmittalDataList['DeliveryReceipt']['printed_by']; ?>
                        
                        </td>

                        <td class="">

                            <?php  echo date('M d, Y',strtotime($transmittalDataList['DeliveryReceipt']['printed'])); ?>
                        
                        </td>

                    </tr>

                </tbody>
               
        <?php 
          endforeach; 
  } 
  ?> 

<?php echo $this->element('modals');
 ?>