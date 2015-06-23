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

                            <?php echo $transmittalDataList['Transmittal']['created_by']; ?>
                        
                        </td>

                        <td class="">

                            <?php echo $transmittalDataList['Transmittal']['remarks']; ?>
                        
                        </td>

                    </tr>

                </tbody>
               
        <?php 
          endforeach; 
  } 
  ?> 

<?php echo $this->element('modals');
 ?>