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

                            <?php echo $transmittalDataList['Transmittal']['contact_person']; ?>
                        
                        </td>

                        <td class="">
                            <?php //if(!empty($transmittalDataList['Transmittal']['remarks'])){ ?>
                                <?php echo $transmittalDataList['Transmittal']['remarks']; ?>
                             <?php //} ?>
                        </td>

                    </tr>

                </tbody>
               
        <?php 
          endforeach; 
  } 
  ?> 

<?php echo $this->element('modals');
 ?>