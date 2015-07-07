<?php 
$pushRemaining  = array();
$totalremaining = 0;

  if(!empty($transmittalData)){ ?>

      <?php foreach ($transmittalData as $transmittalDataList): ?>

                <tbody aria-relevant="all" aria-live="polite" role="alert">

                    <tr class="">

                        <td class="">
                              <?php echo $transmittalDataList['Transmittal']['tr_uuid']; ?>
                        </td>

                        <td class="">

                            <?php echo $transmittalDataList['Transmittal']['dr_uuid']; ?>
                        
                        </td>

                        <td class="">

                            <?php echo $transmittalDataList['Transmittal']['quantity']; ?>
                        
                        </td>

                        <td class="">

                            <?php echo ucwords($transmittalDataList['Transmittal']['contact_person']); ?>
                        
                        </td>

                        <td class="">
                            <?php if(!empty($transmittalDataList['Transmittal']['remarks'])){ ?>
                                <?php echo $transmittalDataList['Transmittal']['remarks']; ?>
                             <?php } ?>
                        </td>

                        <td>

                            <?php  
                                echo $this->Html->link('<span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-print fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> RePrint </font></span>
                                </span>', array('controller' => 'deliveries', 'action' => 'tr',$transmittalDataList['Delivery']['dr_uuid'],$transmittalDataList['Delivery']['schedule_uuid']),array('class' =>' table-link','escape' => false,'title'=>'Print Delivery Receipt','target' => '_blank'));

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